<?php
class DashboardSeller extends DB
{
    private function countByCondition($query, $Seller_id)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $Seller_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return reset($data); // Lấy giá trị đầu tiên trong mảng kết quả
    }

    public function countBooksBySeller($Seller_id)
    {
        $query = "SELECT COUNT(*) AS total_books FROM book WHERE User_id = ?";
        return $this->countByCondition($query, $Seller_id);
    }

    public function countNewsBySeller($Seller_id)
    {
        $query = "SELECT COUNT(*) AS total_news FROM news WHERE User_id = ?";
        return $this->countByCondition($query, $Seller_id);
    }

    public function getTotalRevenueByPublisher($publisher_id)
    {
        $sql = "
        SELECT 
            SUM(DISTINCT o.Sum) AS Total_Revenue
        FROM `order` o
        JOIN orderdetail od ON o.Order_id = od.Order_id
        JOIN book b ON od.Book_id = b.Book_id
        WHERE b.User_id = ?
    ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Lỗi prepare: " . $this->conn->error);
        }

        $stmt->bind_param("i", $publisher_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data['Total_Revenue'] ?? 0;
    }

    public function getTotalOrdersByPublisher($publisher_id)
    {
        $sql = "
        SELECT 
            COUNT(DISTINCT o.Order_id) AS Total_Orders
        FROM `order` o
        JOIN orderdetail od ON o.Order_id = od.Order_id
        JOIN book b ON od.Book_id = b.Book_id
        WHERE b.User_id = ?
    ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Lỗi prepare: " . $this->conn->error);
        }

        $stmt->bind_param("i", $publisher_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data['Total_Orders'] ?? 0;
    }
    public function getOrderStatusStatisticsBySeller($publisher_id)
    {
        // Câu truy vấn SQL để thống kê số lượng đơn hàng theo trạng thái cho từng nhà xuất bản
        $sql = "
    SELECT 
        o.Status AS Order_Status, 
        os.Status_name, 
        COUNT(*) AS total_orders
    FROM `order` o
    JOIN orderstatus os ON os.Status_id = o.Status
    JOIN orderdetail od ON o.Order_id = od.Order_id
    JOIN book b ON od.Book_id = b.Book_id
    WHERE b.User_id = ?  -- Lọc theo nhà xuất bản
    GROUP BY o.Status
    ";

        // Sử dụng prepared statement để tránh SQL injection
        if ($stmt = $this->conn->prepare($sql)) {
            // Gắn tham số vào câu lệnh
            $stmt->bind_param("i", $publisher_id);

            // Thực thi câu lệnh
            if ($stmt->execute()) {
                // Lấy kết quả
                $result = $stmt->get_result();
                $statistics = [];

                // Lặp qua kết quả và đưa vào mảng
                while ($row = $result->fetch_assoc()) {
                    $statistics[] = [
                        'Order_Status' => $row['Order_Status'],  // Trạng thái đơn hàng
                        'Status_name' => $row['Status_name'],    // Tên trạng thái
                        'Total_orders' => $row['total_orders']   // Số lượng đơn hàng
                    ];
                }

                return $statistics;
            } else {
                die("Lỗi thực thi câu lệnh: " . $stmt->error);
            }
        } else {
            die("Lỗi chuẩn bị câu lệnh: " . $this->conn->error);
        }
    }
    public function getTotalOrdersByPublisherByDate($publisher_id)
    {
        // Lấy ngày hôm nay và 28 ngày gần nhất
        $today = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime($today . ' - 27 days'));

        // Câu truy vấn SQL lấy số lượng đơn theo ngày của publisher
        $sql = "
        SELECT 
            o.Order_date, 
            COUNT(DISTINCT o.Order_id) AS total_orders
        FROM `order` o
        JOIN orderdetail od ON o.Order_id = od.Order_id
        JOIN book b ON od.Book_id = b.Book_id
        WHERE b.User_id = ? AND o.Order_date BETWEEN ? AND ?
        GROUP BY o.Order_date
        ORDER BY o.Order_date DESC
    ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Lỗi prepare: " . $this->conn->error);
        }

        $stmt->bind_param("iss", $publisher_id, $start_date, $today);
        $stmt->execute();

        $result = $stmt->get_result();

        // Khởi tạo mảng mặc định số đơn hàng bằng 0 cho 28 ngày
        $orders = [];
        for ($i = 0; $i < 28; $i++) {
            $date = date('Y-m-d', strtotime("$today - $i days"));
            $orders[$date] = 0;
        }

        // Ghi đè lại số đơn nếu có trong kết quả truy vấn
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[$row['Order_date']] = $row['total_orders'];
            }
        }

        // Chuyển sang dạng mảng có ngày định dạng dd-mm-YYYY
        $formatted_orders = [];
        foreach ($orders as $date => $count) {
            $formatted_orders[] = [
                'Order_date' => date('d-m-Y', strtotime($date)),
                'total_orders' => $count
            ];
        }

        // Sắp xếp theo ngày tăng dần
        usort($formatted_orders, function ($a, $b) {
            return strtotime($a['Order_date']) - strtotime($b['Order_date']);
        });

        return $formatted_orders;
    }
    function getBestSellingBooks($user_id)
    {
        $sql = "
        SELECT 
            bd.Title AS Book_Title, 
            bi.Image_URL,
            c.Category_type,
            SUM(od.Quantity) AS Total_Sold
        FROM orderdetail od
        INNER JOIN book b ON od.Book_id = b.Book_id
        INNER JOIN bookdetail bd ON b.Book_id = bd.id
        INNER JOIN bookimages bi ON b.Book_id = bi.Book_id
        JOIN category c ON b.Category_id= c.Category_id
        WHERE b.User_id = ?  -- Filter by User_id
        GROUP BY b.Book_id
        ORDER BY Total_Sold DESC
        LIMIT 5;
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);  // Bind the parameter for User_id
        $stmt->execute();
        $result = $stmt->get_result();
        $bestSellingBooks = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();  // Close the statement
        return $bestSellingBooks;
    }
    public function getNewOrderSeller($publisher_id)
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
        WHERE b.User_id = ? AND os.Status_id = 1
        ORDER BY o.Order_date DESC
        LIMIT 5
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


}
?>