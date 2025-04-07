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
            o.Payment_Status,
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
                        "Payment_Status" => $row["Payment_Status"],
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

    public function createOrder($user_id, $full_Name, $phone_Number, $email, $address, $note, $pay, $sum, $order_date, $order_code)
    {
        $this->conn->begin_transaction();
        try {
            $sql = "INSERT INTO `order`(`User_id`, `Full_Name`, `Phone_Number`, `Email`, `Address`, `Note`, `PaymentMethod_id`, `Sum`, `Order_date`, `Item_code`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("issssssdss", $user_id, $full_Name, $phone_Number, $email, $address, $note, $pay, $sum, $order_date, $order_code);

            if (!$stmt->execute()) {
                throw new Exception("Lỗi khi thêm đơn hàng: " . $stmt->error);
            }
            $order_id = $this->conn->insert_id;
            $stmt->close();

            $cartQuery = "
        SELECT c.Book_id, c.Quantity, bd.Price, b.Status_id, b.quantity AS Stock
        FROM cart c
        JOIN bookdetail bd ON bd.id = c.Book_id
        JOIN book b ON b.Book_id = c.Book_id
        WHERE c.User_id = ?";
            $stmt = $this->conn->prepare($cartQuery);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $cartItems = $stmt->get_result();
            $stmt->close();

            if ($cartItems->num_rows == 0) {
                throw new Exception("Giỏ hàng trống.");
            }

            $validBooks = [];
            while ($item = $cartItems->fetch_assoc()) {
                if ($item['Status_id'] == 1) {
                    if ($item['Quantity'] > $item['Stock']) {
                        throw new Exception("Sách ID " . $item['Book_id'] . " không đủ hàng.");
                    }
                    $validBooks[] = $item;
                }
            }

            if (empty($validBooks)) {
                throw new Exception("Không có sách hợp lệ để đặt hàng.");
            }

            $orderDetailQuery = "INSERT INTO orderdetail (Order_id, Book_id, Quantity, Price) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($orderDetailQuery);
            foreach ($validBooks as $item) {
                $stmt->bind_param("iiid", $order_id, $item['Book_id'], $item['Quantity'], $item['Price']);
                if (!$stmt->execute()) {
                    throw new Exception("Lỗi khi thêm vào order_detail: " . $stmt->error);
                }
            }
            $stmt->close();

            $updateStockQuery = "UPDATE book SET quantity = quantity - ? WHERE Book_id = ?";
            $stmt = $this->conn->prepare($updateStockQuery);
            foreach ($validBooks as $item) {
                $stmt->bind_param("ii", $item['Quantity'], $item['Book_id']);
                if (!$stmt->execute()) {
                    throw new Exception("Lỗi khi cập nhật số lượng sách ID " . $item['Book_id']);
                }
            }
            $stmt->close();

            // Thêm điều kiện Status_id = 1 vào câu lệnh xóa sách khỏi giỏ hàng
            $deleteCartQuery = "DELETE FROM cart WHERE User_id = ? AND Book_id = ? AND Book_id IN (SELECT Book_id FROM book WHERE Status_id = 1)";
            $stmt = $this->conn->prepare($deleteCartQuery);
            foreach ($validBooks as $item) {
                $stmt->bind_param("ii", $user_id, $item['Book_id']);
                if (!$stmt->execute()) {
                    throw new Exception("Lỗi khi xóa sách ID " . $item['Book_id'] . " khỏi giỏ hàng.");
                }
            }
            $stmt->close();
            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollback();
            return "Lỗi: " . $e->getMessage();
        }
    }
    function updatePaymentStatusById($order_id)
    {
        $stmt = $this->conn->prepare("UPDATE `order` SET Payment_Status = 1 WHERE Order_id = ?");
        return $stmt->execute([$order_id]);
    }
}
?>