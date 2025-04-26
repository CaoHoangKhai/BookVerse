<?php
class OrderModel extends DB
{
    function getOrderStatus()
    {
        $sql = "SELECT * FROM `orderstatus`";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        } else {
            return [];
        }
    }
    public function getOrders()
    {
        $sql = "SELECT 
            o.Order_id, 
            o.User_id, 
            o.Full_Name AS Order_Name, 
            o.Phone_Number, 
            o.Email, 
            o.Address, 
            o.Note,
            o.Item_code,
            o.Status AS Order_Status, 
            os.Status_name AS Status_Name, 
            o.PaymentMethod_id, 
            pm.PaymentMethod_name, 
            o.Sum, 
            o.Order_date, 
            u.Full_Name AS User_Name, 
            u.Phone_Number AS User_Phone, 
            u.Email AS User_Email,
            ul.City AS City_Code,         
            ul.District AS District_Code, 
            ul.Address AS User_Location_Address
        FROM `order` o
        LEFT JOIN `user` u ON o.User_id = u.User_id
        LEFT JOIN `orderstatus` os ON o.Status = os.Status_id
        LEFT JOIN `paymentmethods` pm ON o.PaymentMethod_id = pm.PaymentMethod_id
        LEFT JOIN `userlocation` ul ON o.Address = ul.id
        ORDER BY o.Order_id DESC";
        $result = $this->conn->query($sql);
        if ($result === false) {
            die("SQL Error: " . $this->conn->error);
        }
        if ($result->num_rows > 0) {
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        } else {
            return [];
        }
    }

    public function getOrderDetail($User_id)
    {
        $sql = "
        SELECT 
            o.Order_id, 
            o.User_id, 
            o.Full_Name AS Order_Name, 
            o.Phone_Number, 
            o.Email, 
            o.Address AS Order_Address, 
            o.Note, 
            o.Status AS Order_Status, 
            o.PaymentMethod_id,
            o.Sum, 
            o.Order_date,
            o.Item_code,
            ul.City AS City_Code,
            ul.District AS District_Code,
            ul.Address AS User_Location_Address,
            od.Status_name AS Status_Name,
            p.PaymentMethod_name,
            ord.Book_id,
            ord.Quantity,
            ord.Price,
            bd.Title,
            bd.Price AS Book_Price,
            (SELECT Image_URL FROM BookImages WHERE Book_id = bd.id LIMIT 1) AS Image
        FROM `Order` o
        JOIN `userlocation` ul ON ul.id = o.Address
        JOIN `orderstatus` od ON od.Status_id = o.Status
        JOIN `paymentmethods` p ON p.Paymentmethod_id = o.Paymentmethod_id
        JOIN `orderdetail` ord ON ord.Order_id =  o.Order_id
        JOIN `bookdetail` bd ON bd.id = ord.Book_id
        WHERE o.Order_id = ?
    ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $User_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orderDetails = [];
            while ($row = $result->fetch_assoc()) {
                if (empty($orderDetails)) {
                    $orderDetails = [
                        "Order_id" => $row["Order_id"],
                        "User_id" => $row["User_id"],
                        "Order_Name" => $row["Order_Name"],
                        "Phone_Number" => $row["Phone_Number"],
                        "Email" => $row["Email"],
                        "Order_Address" => $row["Order_Address"],
                        "Note" => $row["Note"],
                        "Order_Status" => $row["Order_Status"],
                        "PaymentMethod_id" => $row["PaymentMethod_id"],
                        "Sum" => $row["Sum"],
                        "Order_date" => $row["Order_date"],
                        "City_Code" => $row["City_Code"],
                        "District_Code" => $row["District_Code"],
                        "User_Location_Address" => $row["User_Location_Address"],
                        "Status_Name" => $row["Status_Name"],
                        "PaymentMethod_name" => $row["PaymentMethod_name"],
                        "Item_code" => $row["Item_code"],
                        "Products" => []
                    ];
                }
                $orderDetails["Products"][] = [
                    "Book_id" => $row["Book_id"],
                    "Title" => $row["Title"],
                    "Quantity" => $row["Quantity"],
                    "Price" => $row["Price"],
                    "Book_Price" => $row["Book_Price"],
                    "Image" => $row["Image"]
                ];
            }
            return $orderDetails;
        }
        return null;
    }

    function updateOrderStatus($Status_id, $Order_id)
    {
        $stmt = $this->conn->prepare("UPDATE `order` SET Status = ? WHERE Order_id = ?");
        return $stmt->execute([$Status_id, $Order_id]);
    }

    public function createOrderGroupedByPublisher($user_id, $full_Name, $phone_Number, $email, $address, $note, $pay, $order_date)
    {
        $this->conn->begin_transaction();
        try {
            // Lấy các sản phẩm trong giỏ hàng và kèm User_id (chính là NXB)
            $cartQuery = "
                SELECT c.Book_id, c.Quantity, bd.Price, b.Status_id, b.quantity AS Stock, b.User_id AS Publisher_id
                FROM cart c
                JOIN bookdetail bd ON bd.id = c.Book_id
                JOIN book b ON b.Book_id = c.Book_id
                WHERE c.User_id = ?";
            $stmt = $this->conn->prepare($cartQuery);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result->num_rows == 0) {
                throw new Exception("Giỏ hàng trống.");
            }

            // Nhóm theo nhà xuất bản (Publisher_id)
            $groupedItems = [];
            while ($item = $result->fetch_assoc()) {
                if ($item['Status_id'] == 1 && $item['Quantity'] <= $item['Stock']) {
                    $publisher = $item['Publisher_id'];
                    if (!isset($groupedItems[$publisher])) {
                        $groupedItems[$publisher] = [];
                    }
                    $groupedItems[$publisher][] = $item;
                }
            }

            if (empty($groupedItems)) {
                throw new Exception("Không có sách hợp lệ để đặt hàng.");
            }

            // Lặp qua từng nhà xuất bản để tạo đơn hàng riêng
            foreach ($groupedItems as $publisherId => $items) {
                $sum = 0;
                foreach ($items as $item) {
                    $sum += $item['Price'] * $item['Quantity'];
                }

                $order_code = uniqid("ORDER_");
                if (empty($order_date)) {
                    $order_date = date("Y-m-d"); // hoặc chỉ "Y-m-d" nếu kiểu dữ liệu trong DB là DATE
                }
                $insertOrderSQL = "INSERT INTO `order`(`User_id`, `Full_Name`, `Phone_Number`, `Email`, `Address`, `Note`, `PaymentMethod_id`, `Sum`, `Order_date`, `Item_code`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($insertOrderSQL);
                $stmt->bind_param("issssssdss", $user_id, $full_Name, $phone_Number, $email, $address, $note, $pay, $sum, $order_date, $order_code);
                if (!$stmt->execute()) {
                    throw new Exception("Lỗi tạo đơn hàng cho NXB ID $publisherId: " . $stmt->error);
                }
                $order_id = $this->conn->insert_id;
                $stmt->close();

                // Thêm chi tiết đơn hàng
                $orderDetailQuery = "INSERT INTO orderdetail (Order_id, Book_id, Quantity, Price) VALUES (?, ?, ?, ?)";
                $stmt = $this->conn->prepare($orderDetailQuery);
                foreach ($items as $item) {
                    $stmt->bind_param("iiid", $order_id, $item['Book_id'], $item['Quantity'], $item['Price']);
                    if (!$stmt->execute()) {
                        throw new Exception("Lỗi thêm chi tiết đơn hàng (Book ID: {$item['Book_id']}): " . $stmt->error);
                    }
                }
                $stmt->close();

                // Cập nhật tồn kho
                $updateStockQuery = "UPDATE book SET quantity = quantity - ? WHERE Book_id = ?";
                $stmt = $this->conn->prepare($updateStockQuery);
                foreach ($items as $item) {
                    $stmt->bind_param("ii", $item['Quantity'], $item['Book_id']);
                    if (!$stmt->execute()) {
                        throw new Exception("Lỗi cập nhật tồn kho (Book ID: {$item['Book_id']})");
                    }
                }
                $stmt->close();

                // Xóa sách khỏi giỏ hàng
                $deleteCartQuery = "DELETE FROM cart WHERE User_id = ? AND Book_id = ?";
                $stmt = $this->conn->prepare($deleteCartQuery);
                foreach ($items as $item) {
                    $stmt->bind_param("ii", $user_id, $item['Book_id']);
                    if (!$stmt->execute()) {
                        throw new Exception("Lỗi xoá giỏ hàng (Book ID: {$item['Book_id']})");
                    }
                }
                $stmt->close();
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            return "Lỗi: " . $e->getMessage();
        }
    }

    // function updatePaymentStatusById($order_id)
    // {
    //     $stmt = $this->conn->prepare("UPDATE `order` SET Payment_Status = 1 WHERE Order_id = ?");
    //     return $stmt->execute([$order_id]);
    // }

    public function getOrdersByUser($user_id)
    {
        $query = "
        SELECT 
            o.Order_id,
            o.Item_code,
            o.Order_date,
            o.Sum,
            o.PaymentMethod_id, 
            pm.PaymentMethod_name, 
            o.Status AS O,
            l.city AS City_Code,
            l.district AS District_Code,
            l.address AS Order_Address,
            os.Status_name AS Status_Name,
            COUNT(od.Book_id) AS total_books
        FROM `order` o
        LEFT JOIN orderdetail od ON o.Order_id = od.Order_id
        JOIN userlocation l ON l.id = o.Address
        JOIN `orderstatus` os ON os.Status_id = o.Status
        JOIN `paymentmethods` pm ON o.PaymentMethod_id = pm.PaymentMethod_id
        WHERE o.User_id = ?
        GROUP BY o.Order_id
        ORDER BY o.Order_id DESC
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        $stmt->close();
        return $orders;
    }

    public function getOrdersByPublisher($publisher_id)
    {
        $sql = "
        SELECT 
            o.Order_id,
            o.Full_Name,
            o.Phone_Number,
            o.Email,
            o.Address,
            o.Note,
            o.Sum,
            o.Order_date,
            o.Status AS Order_Status,
            o.Item_code,
            od.Book_id,
            od.Quantity,
            od.Price,
            pm.PaymentMethod_name,
            b.User_id AS Publisher_id,
            u.Full_Name AS Publisher_Name,
            ul.City AS City_Code,
            ul.District AS District_Code,
            ul.Address,
            os.Status_name AS Status_Name
        FROM `order` o
        JOIN orderdetail od ON o.Order_id = od.Order_id
        JOIN book b ON od.Book_id = b.Book_id
        JOIN user u ON b.User_id = u.User_id
        JOIN paymentmethods pm ON pm.PaymentMethod_id = o.PaymentMethod_id
        JOIN userlocation ul ON ul.id = o.Address
        JOIN orderstatus os ON os.Status_id = o.Status
        WHERE b.User_id = ?
        ORDER BY o.Order_date DESC
    ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Lỗi prepare: " . $this->conn->error);
        }

        $stmt->bind_param("i", $publisher_id); 

        $stmt->execute();

        $result = $stmt->get_result();

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        return $orders;
    }
    
    function cancelOrder($Order_id) {
        // Bắt đầu transaction
        $this->conn->begin_transaction();
    
        try {
            // 1. Lấy chi tiết đơn hàng
            $sqlDetail = "SELECT Book_id, Quantity FROM orderdetail WHERE Order_id = ?";
            $stmtDetail = $this->conn->prepare($sqlDetail);
            $stmtDetail->bind_param("i", $Order_id);
            $stmtDetail->execute();
            $result = $stmtDetail->get_result();
    
            // 2. Cập nhật lại số lượng sách
            while ($row = $result->fetch_assoc()) {
                $sqlUpdateBook = "UPDATE book SET quantity = quantity + ? WHERE Book_id = ?";
                $stmtBook = $this->conn->prepare($sqlUpdateBook);
                $stmtBook->bind_param("ii", $row['Quantity'], $row['Book_id']);
                $stmtBook->execute();
            }
    
            // 3. Cập nhật trạng thái đơn hàng về trạng thái "Đã hủy" (giả sử ID = 4)
            $cancelStatus = 8;
            $sqlUpdateOrder = "UPDATE `order` SET Status = ? WHERE Order_id = ?";
            $stmtOrder = $this->conn->prepare($sqlUpdateOrder);
            $stmtOrder->bind_param("ii", $cancelStatus, $Order_id);
            $stmtOrder->execute();
    
            // 4. Commit transaction
            $this->conn->commit();
            return true;
    
        } catch (Exception $e) {
            $this->conn->rollback(); // Nếu có lỗi thì rollback
            error_log("Lỗi khi hủy đơn hàng: " . $e->getMessage());
            return false;
        }
    }
    
}
?>