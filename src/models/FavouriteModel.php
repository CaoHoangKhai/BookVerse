<?php
class FavouriteModel extends DB
{
    function getListFavourite($User_id)
    {
        $sql = "
            SELECT 
                b.Book_id, 
                bd.Title, 
                bd.Price,
                c.Category_type,
                (SELECT Image_URL FROM BookImages WHERE Book_id = b.Book_id LIMIT 1) AS Image
            FROM favourite f
            JOIN book b ON b.Book_id = f.Book_id
            JOIN bookdetail bd ON b.Book_id = bd.id
            JOIN category c ON c.Category_id = b.Category_id
            WHERE f.User_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $User_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function checkFavourite($User_id, $Book_id)
    {
        $sql = "SELECT COUNT(*) FROM favourite WHERE User_id = ? AND Book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $User_id, $Book_id);
        $stmt->execute();

        $count = 0;
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }
    public function addFavorite($User_id, $Book_id)
    {
        // Kiểm tra xem sách đã có trong danh sách yêu thích chưa
        $sql_check = "SELECT id FROM favourite WHERE User_id = ? AND Book_id = ?";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->execute([$User_id, $Book_id]);
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $stmt_check->close();

            // Nếu đã có, xóa khỏi danh sách yêu thích
            $sql_delete = "DELETE FROM favourite WHERE User_id = ? AND Book_id = ?";
            $stmt_delete = $this->conn->prepare($sql_delete);
            $stmt_delete->execute([$User_id, $Book_id]);

            if ($stmt_delete->affected_rows > 0) {
                return "removed"; // Trả về trạng thái đã xóa
            } else {
                return false; // Xóa thất bại
            }
        } else {
            $stmt_check->close();

            // Nếu chưa có, thêm vào danh sách yêu thích
            $sql_insert = "INSERT INTO favourite (User_id, Book_id) VALUES (?, ?)";
            $stmt_insert = $this->conn->prepare($sql_insert);
            $stmt_insert->execute([$User_id, $Book_id]);

            if ($stmt_insert->affected_rows > 0) {
                return "added";
            } else {
                return false;
            }
        }
    }
}
?>