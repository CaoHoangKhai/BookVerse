<?php
class DashboardAdmin extends DB
{
    private function getCount($table, $condition = "")
    {
        $sql = "SELECT COUNT(*) as total FROM `$table` $condition";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return isset($result['total']) ? $result['total'] : 0;

    }

    public function getCountsUser()
    {
        return $this->getCount("user", "WHERE Role_id = 0");
    }

    public function getCountsBook()
    {
        return $this->getCount("book");
    }
    public function getCountOrder()
    {
        return $this->getCount("order");
    }

    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(Sum) AS Total_Order_Value FROM `Order` WHERE Status=4 ";
        $result = $this->conn->query($sql);
        return ($result->num_rows > 0) ? $result->fetch_assoc()['Total_Order_Value'] : "Không có dữ liệu";
    }
    function getNewOrderAdmin()
    {
        $sql = "
            SELECT * 
            FROM `order` 
            WHERE `Status` = 1 
            ORDER BY `Order_date` DESC 
            LIMIT 5
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = $result->fetch_all(MYSQLI_ASSOC);
        return $orders;
    }
    function getBestSellingBooks()
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
        GROUP BY b.Book_id
        ORDER BY Total_Sold DESC
        LIMIT 5;
    ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $bestSellingBooks = $result->fetch_all(MYSQLI_ASSOC);
        return $bestSellingBooks;
    }

    // function getTotalRevenueByDate($period)
    // {
    //     // Lấy ngày hiện tại
    //     $currentDate = date('Y-m-d');

    //     // Xác định ngày bắt đầu tùy theo khoảng thời gian
    //     switch ($period) {
    //         case '7days':
    //             $startDate = date('Y-m-d', strtotime('-7 days', strtotime($currentDate)));
    //             break;
    //         case '28days':
    //             $startDate = date('Y-m-d', strtotime('-28 days', strtotime($currentDate)));
    //             break;
    //         case '90days':
    //             $startDate = date('Y-m-d', strtotime('-90 days', strtotime($currentDate)));
    //             break;
    //         case '365days':
    //             $startDate = date('Y-m-d', strtotime('-365 days', strtotime($currentDate)));
    //             break;
    //         case 'alltime':
    //             $startDate = '1900-01-01'; // Dữ liệu từ mọi thời điểm
    //             break;
    //         default:
    //             throw new Exception("Invalid period");
    //     }

    //     // Câu truy vấn SQL để tính tổng doanh thu theo ngày từ ngày bắt đầu đến nay
    //     $sql = "SELECT Order_date, SUM(Sum) AS total_revenue
    //         FROM `order`
    //         WHERE Order_date >= '$startDate'
    //         GROUP BY Order_date
    //         ORDER BY Order_date DESC";

    //     // Thực thi câu truy vấn
    //     $result = mysqli_query($this->conn, $sql);

    //     // Kiểm tra xem có kết quả trả về không
    //     if (mysqli_num_rows($result) > 0) {
    //         // Mảng chứa dữ liệu tổng doanh thu theo ngày
    //         $revenues = [];

    //         // Lặp qua từng kết quả và thêm vào mảng
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $revenues[] = $row;
    //         }

    //         return $revenues; // Trả về mảng kết quả
    //     } else {
    //         return []; // Nếu không có kết quả, trả về mảng rỗng
    //     }
    // }
    public function getTotalRevenueByDate()
    {
        // Lấy ngày hôm nay và tính toán khoảng thời gian 28 ngày trước
        $today = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime($today . ' - 27 days'));

        // Câu truy vấn SQL
        $sql = "SELECT Order_date, SUM(Sum) AS total_revenue
                FROM `order`
                WHERE Order_date BETWEEN '$start_date' AND '$today'
                GROUP BY Order_date
                ORDER BY Order_date DESC";

        $result = mysqli_query($this->conn, $sql);

        // Mảng chứa doanh thu cho 28 ngày
        $revenues = [];

        // Tạo mảng doanh thu mặc định cho tất cả các ngày
        for ($i = 0; $i < 28; $i++) {
            $date = date('Y-m-d', strtotime("$today - $i days"));
            $revenues[$date] = 0; // Khởi tạo tất cả doanh thu là 0
        }

        // Xử lý dữ liệu trả về từ cơ sở dữ liệu
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $revenues[$row['Order_date']] = number_format($row['total_revenue'], 0, ',', '.') . ' VND';  // Định dạng doanh thu
            }
        }

        // Chuyển đổi kết quả thành mảng để dễ dàng sử dụng
        $formatted_revenues = [];
        foreach ($revenues as $date => $revenue) {
            $formatted_revenues[] = [
                'Order_date' => date('d-m-Y', strtotime($date)), // Định dạng ngày
                'total_revenue' => $revenue // Doanh thu
            ];
        }

        // Sắp xếp mảng $formatted_revenues theo ngày (từ nhỏ đến lớn)
        usort($formatted_revenues, function ($a, $b) {
            return strtotime($a['Order_date']) - strtotime($b['Order_date']);
        });

        return $formatted_revenues;
    }
    public function getOrderStatusStatistics()
    {
        // Câu truy vấn SQL để thống kê số lượng đơn hàng theo trạng thái
        $sql = "SELECT Status, COUNT(*) AS total_orders
            FROM `order`
            GROUP BY Status";

        // Thực thi câu truy vấn
        $result = mysqli_query($this->conn, $sql);

        // Mảng chứa kết quả thống kê
        $statistics = [];

        // Xử lý kết quả trả về từ cơ sở dữ liệu
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $statistics[] = [
                    'Status_id' => $row['Status'],  // Lấy Status_id
                    'Total_orders' => $row['total_orders'] // Số lượng đơn hàng theo trạng thái
                ];
            }
        }
        return $statistics;
    }
}
?>