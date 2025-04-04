<?php
class AuthorModel extends DB
{
    public function getAllAuthors()
    {
        $sql = "SELECT a.*, 
                       c.id, 
                       c.name AS Nationality 
                FROM Author a 
                JOIN countries c ON a.Nationality = c.id
                ORDER BY a.Author_id DESC"; // Sắp xếp theo thời gian tạo mới nhất

        $result = $this->conn->query($sql);
        $authors = [];

        while ($row = $result->fetch_assoc()) {
            // Lấy số lượng sách của từng tác giả
            $row['book_count'] = $this->countBooksByAuthor($row['Author_id']);
            $authors[] = $row;
        }
        return $authors;
    }
    public function countBooksByAuthor($author_id)
    {
        $query = "SELECT COUNT(*) AS book_count FROM Book WHERE Author_id = ?";

        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("i", $author_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['book_count'];
        }
        return 0;
    }

    public function createAuthor($name, $biography, $date_of_birth, $nationality, $image)
    {

        $sql = "INSERT INTO author (Name, Biography, Date_of_Birth, Nationality, Img_Author) 
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sssss", $name, $biography, $date_of_birth, $nationality, $image);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function getBooksByAuthorId($author_id)
    {
        $sql = "SELECT 
                b.Book_id, 
                b.User_id, 
                b.Author_id, 
                b.Category_id, 
                b.Date_added, 
                b.Status_id,
                c.Category_name,
                c.Category_type,
                bd.Title,
                bd.Description,
                bd.Price,
                (SELECT bi.Image_URL 
                 FROM BookImages bi 
                 WHERE bi.Book_id = b.Book_id 
                 ORDER BY bi.Image_id ASC 
                 LIMIT 1) AS Image_URL
            FROM Book b
            LEFT JOIN Category c ON b.Category_id = c.Category_id
            LEFT JOIN bookdetail bd ON b.Book_id = bd.id
            WHERE b.Author_id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $author_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $books = [];
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
            return $books;
        }
        return [];
    }
    function getAuthor($id)
    {
        $sql = "SELECT a.*,
        c.id,
        c.name AS Nationality
        FROM Author a 
        JOIN countries c ON a.Nationality = c.id
        WHERE Author_id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $author = $result->fetch_assoc();
            if (!$author) {
                return null;
            }
            $book_count = $this->countBooksByAuthor($id);
            $author['book_count'] = $book_count;
            return $author;
        }
        return null;
    }
    function updateAuthor($id, $author_name, $biography, $date_of_birth, $nationality, $img_author)
    {
        $sql = "UPDATE author SET 
                Name = ?, 
                Biography = ?, 
                Date_of_Birth = ?, 
                Nationality = ?, 
                Img_Author = ? 
            WHERE Author_id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sssssi", $author_name, $biography, $date_of_birth, $nationality, $img_author, $id);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            return false;
        }
    }
    public function deleteAuthor($author_id)
    {
        // Lấy thông tin tác giả để biết đường dẫn ảnh
        $sql = "SELECT Img_Author FROM author WHERE Author_id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $author_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $author = $result->fetch_assoc();
            $stmt->close();

            if ($author) {
                // Xóa file ảnh
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/authors/" . $author['Img_Author'];
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Xóa file ảnh
                }

                // Xóa tác giả trong database
                $sqlDelete = "DELETE FROM author WHERE Author_id = ?";
                if ($stmtDelete = $this->conn->prepare($sqlDelete)) {
                    $stmtDelete->bind_param("i", $author_id);
                    if ($stmtDelete->execute()) {
                        $stmtDelete->close();
                        return true;
                    } else {
                        $stmtDelete->close();
                        return false;
                    }
                }
            }
        }
        return false;
    }
}

?>