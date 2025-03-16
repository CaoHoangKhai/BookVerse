<?php
class DashboardModel extends DB
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
}
?>