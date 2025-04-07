<?php
class SearchModel extends DB
{
    function searchBookByName($BookName)
    {
        $sql = "
        SELECT 
            b.Book_id, 
            bd.Title,
            a.Name AS Author_Name,
            b.Author_id,
            b.User_id,
            bd.Description,
            bd.Price,
            b.Date_added,
            bs.Status_name AS Status,
            bs.Status_id AS Status_id,
            c.Category_name AS Category_name,
            c.Category_type AS Category_type,
            u.Full_Name,
            b.quantity AS Quantity,
            (SELECT GROUP_CONCAT(Image_URL) FROM BookImages WHERE Book_id = b.Book_id) AS Images
        FROM Book b
        INNER JOIN Author a ON b.Author_id = a.Author_id
        INNER JOIN Category c ON b.Category_id = c.Category_id
        LEFT JOIN BookStatus bs ON b.Status_id = bs.Status_id
        LEFT JOIN user u ON b.user_id = u.user_id
        INNER JOIN BookDetail bd ON b.Book_id = bd.id
        WHERE bd.Title LIKE ?
        ";

        $stmt = $this->conn->prepare($sql);
        $searchTerm = '%' . $BookName . '%';
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $books = [];
        while ($book = $result->fetch_assoc()) {
            $book['Images'] = $book['Images'] ? explode(",", $book['Images']) : [];
            $books[] = $book;
        }

        return $books;
    }
}
?>
