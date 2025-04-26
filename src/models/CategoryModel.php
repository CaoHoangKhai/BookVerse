<?php
class CategoryModel extends DB
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

    function getCategoryType($id)
    {
        $sql = "SELECT Category_type FROM Category WHERE Category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['Category_type'];
        }
        return null;
    }

    public function getBooksByCategoryType($categoryType)
    {
        // Truy vấn SQL để lấy thông tin sách từ bảng bookdetail
        $sql = "
        SELECT 
            b.Book_id, 
            bd.Title, 
            a.Name AS Author_Name, 
            bd.Description, 
            bd.Price, 
            b.Date_added,
            c.Category_name AS Category_name,
            c.Category_type AS Category_type,
            s.Status_name AS Book_Status,
            (SELECT GROUP_CONCAT(Image_URL) 
             FROM BookImages 
             WHERE Book_id = b.Book_id) AS Images
        FROM book b
        INNER JOIN bookdetail bd ON b.Book_id = bd.id  -- Liên kết với bảng bookdetail
        INNER JOIN author a ON b.Author_id = a.Author_id
        INNER JOIN category c ON b.Category_id = c.Category_id
        INNER JOIN bookstatus s ON b.Status_id = s.Status_id
        WHERE c.Category_type = ? AND b.Status_id != 5
        ORDER BY b.Book_id;
    ";
        $stmt = $this->conn->prepare($sql);

        // Liên kết tham số với câu lệnh SQL (tránh SQL injection)
        $stmt->bind_param("s", $categoryType);

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy kết quả từ câu lệnh
        $result = $stmt->get_result();

        // Tạo mảng chứa danh sách sách
        $books = [];

        // Duyệt qua từng dòng kết quả và thêm vào mảng $books
        while ($row = $result->fetch_assoc()) {
            // Nếu có hình ảnh, tách chuỗi thành mảng
            $row['Images'] = !empty($row['Images']) ? explode(",", $row['Images']) : [];

            // Thêm thông tin sách vào mảng $books
            $books[] = $row;
        }

        // Trả về mảng sách
        return $books;
    }
}

?>