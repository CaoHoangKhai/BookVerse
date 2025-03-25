<?php
class ProductModel extends DB
{
    function getCategories()
    {
        $sql = "SELECT * FROM Category";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
            return $categories;
        } else {
            return [];
        }
    }
    function getBookStatus()
    {
        $sql = "SELECT * FROM bookstatus";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $bookstatus = [];
            while ($row = $result->fetch_assoc()) {
                $bookstatus[] = $row;
            }
            return $bookstatus;
        } else {
            return [];
        }
    }
    public function getBooks()
    {
        $updateSql = "UPDATE book SET Status_id = 2 WHERE quantity = 0";
        $this->conn->query($updateSql);
        $sql = "
        SELECT 
            b.Book_id, 
            bd.Title, 
            a.Name AS Author_Name, 
            bd.Description, 
            bd.Price, 
            b.Date_added,
            b.Category_id,
            b.quantity,
            b.Status_id,
            bs.Status_name AS Status,
            c.Category_name AS Category_name,
            c.Category_type AS Category_type,
            (SELECT GROUP_CONCAT(bi.Image_URL) 
             FROM bookimages bi 
             WHERE bi.Book_id = b.Book_id) AS Images
        FROM book b
        INNER JOIN bookdetail bd ON b.Book_id = bd.id
        INNER JOIN author a ON b.Author_id = a.Author_id
        INNER JOIN category c ON b.Category_id = c.Category_id
        LEFT JOIN bookstatus bs ON b.Status_id = bs.Status_id
        ORDER BY b.Date_added DESC;
        ";
        $result = $this->conn->query($sql);
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $row['Images'] = $row['Images'] ? explode(",", $row['Images']) : [];
            $books[] = $row;
        }
        return $books;
    }
}
?>