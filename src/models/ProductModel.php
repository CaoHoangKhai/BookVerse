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
        $this->conn->query("UPDATE book SET Status_id = 2 WHERE quantity = 0 AND Status_id NOT IN (3, 4, 5)");
        $this->conn->query("UPDATE book SET Status_id = 1 WHERE quantity > 0 AND Status_id NOT IN (3, 4, 5)");
        // Truy vấn danh sách sách
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
            (
                SELECT GROUP_CONCAT(bi.Image_URL) 
                FROM bookimages bi 
                WHERE bi.Book_id = b.Book_id
            ) AS Images
        FROM book b
        INNER JOIN bookdetail bd ON b.Book_id = bd.id
        INNER JOIN author a ON b.Author_id = a.Author_id
        INNER JOIN category c ON b.Category_id = c.Category_id
        LEFT JOIN bookstatus bs ON b.Status_id = bs.Status_id
        WHERE b.Status_id != 5
        ORDER BY b.Date_added DESC
    ";

        $result = $this->conn->query($sql);
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $row['Images'] = $row['Images'] ? explode(",", $row['Images']) : [];
            $books[] = $row;
        }
        return $books;
    }

    function createBookImage($book_id, $image_url)
    {
        $sqlImage = "INSERT INTO bookimages (Book_id, Image_URL) VALUES (?, ?)";
        $stmtImage = $this->conn->prepare($sqlImage);
        $stmtImage->bind_param("is", $book_id, $image_url);
        return $stmtImage->execute();
    }
    function createBook($publishers_id, $author, $category, $date, $status, $title, $description, $price)
    {
        $checkAuthor = "SELECT Author_id FROM author WHERE Author_id = ?";
        $stmtCheckAuthor = $this->conn->prepare($checkAuthor);
        $stmtCheckAuthor->bind_param("i", $author);
        $stmtCheckAuthor->execute();
        $result = $stmtCheckAuthor->get_result();

        if ($result->num_rows == 0) {
            return false;
        }
        $sqlBook = "INSERT INTO book (User_id, Author_id, Category_id, Date_added, Status_id) 
                VALUES (?, ?, ?, ?, ?)";
        $stmtBook = $this->conn->prepare($sqlBook);
        $stmtBook->bind_param("iiisi", $publishers_id, $author, $category, $date, $status);

        if ($stmtBook->execute()) {
            $book_id = $stmtBook->insert_id;

            $sqlDetail = "INSERT INTO bookdetail (id, Title, Description, Price) 
                      VALUES (?, ?, ?, ?)";
            $stmtDetail = $this->conn->prepare($sqlDetail);
            $stmtDetail->bind_param("issd", $book_id, $title, $description, $price);

            if ($stmtDetail->execute()) {
                return $book_id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getBook($id)
    {

        $this->conn->query("UPDATE book SET Status_id = 2 WHERE quantity = 0 AND Status_id NOT IN (3, 4, 5)");
        $this->conn->query("UPDATE book SET Status_id = 1 WHERE quantity > 0 AND Status_id NOT IN (3, 4, 5)");
        $sql = "
            SELECT 
                b.Book_id, 
                bd.Title,  -- Lấy Title từ bảng bookdetail
                a.Name AS Author_Name,
                b.Author_id,
                b.User_id,
                bd.Description,  -- Lấy Description từ bảng bookdetail
                bd.Price,  -- Lấy Price từ bảng bookdetail
                b.Date_added,  -- Lấy Date_added từ bảng bookdetail
                bs.Status_name AS Status,
                bs.Status_id AS Status_id,
                c.Category_name AS Category_name,
                c.Category_type AS Category_type,
                u.Full_Name,
                b.User_id,
                b.quantity AS Quantity,
                (SELECT GROUP_CONCAT(Image_URL) FROM BookImages WHERE Book_id = b.Book_id) AS Images
            FROM Book b
            INNER JOIN Author a ON b.Author_id = a.Author_id
            INNER JOIN Category c ON b.Category_id = c.Category_id
            LEFT JOIN BookStatus bs ON b.Status_id = bs.Status_id
            LEFT JOIN user u ON b.user_id = u.user_id  -- JOIN với bảng Publishers
            INNER JOIN BookDetail bd ON b.Book_id = bd.id  -- JOIN với bảng bookdetail để lấy Title, Description, Price, Date_added
            WHERE b.Book_id = ? 
            LIMIT 1;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $book = $result->fetch_assoc();
        if ($book) {
            $book['Images'] = $book['Images'] ? explode(",", $book['Images']) : [];
        }
        return $book;
    }

    public function updateBook($Book_id, $user_id, $author_id, $category_id, $bookStatus, $title, $description, $price, $quantity)
    {
        try {
            $this->conn->begin_transaction();
            $stmt1 = $this->conn->prepare("UPDATE book SET User_id = ?, Author_id = ?, Category_id = ?, Status_id = ?, quantity = quantity + ? WHERE Book_id = ?");
            $stmt1->bind_param("iiiiii", $user_id, $author_id, $category_id, $bookStatus, $quantity, $Book_id);

            if (!$stmt1->execute()) {
                throw new Exception("Lỗi khi thực thi truy vấn 'book': " . $stmt1->error);
            }
            $rowsAffected1 = $stmt1->affected_rows;
            $stmt1->close();

            $stmt2 = $this->conn->prepare("UPDATE bookdetail SET Title = ?, Description = ?, Price = ? WHERE id = ?");
            $stmt2->bind_param("ssdi", $title, $description, $price, $Book_id);

            if (!$stmt2->execute()) {
                throw new Exception("Lỗi khi thực thi truy vấn 'bookdetail': " . $stmt2->error);
            }
            $rowsAffected2 = $stmt2->affected_rows;
            $stmt2->close();
            if ($rowsAffected1 > 0 || $rowsAffected2 > 0) {
                $this->conn->commit();
                return true;
            } else {
                $this->conn->rollback();
                return false;
            }
        } catch (Exception $e) {
            $this->conn->rollback();
            throw new Exception("Lỗi khi cập nhật sách: " . $e->getMessage());
        }
    }

    function deleteBookImage($book_id, $image_url)
    {
        $stmt = $this->conn->prepare("DELETE FROM bookimages WHERE Book_id = ? AND Image_URL = ?");
        $stmt->bind_param("is", $book_id, $image_url);

        if ($stmt->execute()) {
            return "Ảnh đã được xóa thành công!";
        } else {
            return "Lỗi khi xóa ảnh!";
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

    public function getByImageBook($Book_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM bookimages WHERE Book_id = ?");
        $stmt->bind_param("i", $Book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }

    public function deleteBookWithDetailsAndImages($Book_id)
    {
        $this->conn->begin_transaction();
        try {
            $sqlImages = "DELETE FROM `bookimages` WHERE `Book_id` = ?";
            $stmtImages = $this->conn->prepare($sqlImages);
            if (!$stmtImages) {
                throw new Exception("Prepare failed: " . $this->conn->error);
            }
            $stmtImages->bind_param("i", $Book_id);
            $stmtImages->execute();
            $sqlDetail = "DELETE FROM `bookdetail` WHERE `id` = ?";
            $stmtDetail = $this->conn->prepare($sqlDetail);
            if (!$stmtDetail) {
                throw new Exception("Prepare failed: " . $this->conn->error);
            }
            $stmtDetail->bind_param("i", $Book_id);
            $stmtDetail->execute();
            $sqlBook = "DELETE FROM `book` WHERE `Book_id` = ?";
            $stmtBook = $this->conn->prepare($sqlBook);
            if (!$stmtBook) {
                throw new Exception("Prepare failed: " . $this->conn->error);
            }
            $stmtBook->bind_param("i", $Book_id);
            $stmtBook->execute();
            if ($stmtBook->affected_rows === 0) {
                $this->conn->rollback();
                return "not_found";
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Delete failed: " . $e->getMessage());
            return "error";
        }
    }
    public function bookHome()
    {

        // Cập nhật trạng thái sách dựa theo số lượng tồn kho, chỉ cập nhật sách có Status_id khác 5
        $this->conn->query("UPDATE book SET Status_id = 2 WHERE quantity = 0 AND Status_id NOT IN (3, 4, 5)");
        $this->conn->query("UPDATE book SET Status_id = 1 WHERE quantity > 0 AND Status_id NOT IN (3, 4, 5)");

        // Truy vấn danh sách sách
        $sql = "
        SELECT 
            b.Book_id, 
            bd.Title, 
            a.Name AS Author_Name, 
            bd.Price, 
            b.Date_added,
            b.Category_id,
            b.quantity,
            b.Status_id,
            bs.Status_name AS Status,
            c.Category_name AS Category_name,
            c.Category_type AS Category_type,
            (
                SELECT GROUP_CONCAT(DISTINCT bi.Image_URL) 
                FROM bookimages bi 
                WHERE bi.Book_id = b.Book_id
            ) AS Images
        FROM book b
        INNER JOIN bookdetail bd ON b.Book_id = bd.id
        INNER JOIN author a ON b.Author_id = a.Author_id
        INNER JOIN category c ON b.Category_id = c.Category_id
        LEFT JOIN bookstatus bs ON b.Status_id = bs.Status_id
        WHERE b.Status_id != 5
        ORDER BY c.Category_name ASC, b.Date_added DESC;
    ";

        $result = $this->conn->query($sql);
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $row['Images'] = $row['Images'] ? explode(",", $row['Images']) : [];
            $books[] = $row;
        }

        return $books;
    }

    public function getBooksSeller($Seller_id)
    {
        // Cập nhật trạng thái sách hết hàng chỉ của người bán cụ thể
        $updateSql = "UPDATE book SET Status_id = 2 WHERE quantity = 0 AND User_id = ?";
        $stmt = $this->conn->prepare($updateSql);
        $stmt->bind_param("i", $Seller_id);
        $stmt->execute();

        // Truy vấn danh sách sách của người bán
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
        (SELECT GROUP_CONCAT(bi.Image_URL SEPARATOR ',') 
         FROM bookimages bi 
         WHERE bi.Book_id = b.Book_id) AS Images
    FROM book b
    INNER JOIN bookdetail bd ON b.Book_id = bd.id
    INNER JOIN author a ON b.Author_id = a.Author_id
    INNER JOIN category c ON b.Category_id = c.Category_id
    LEFT JOIN bookstatus bs ON b.Status_id = bs.Status_id
    WHERE b.User_id = ?
    ORDER BY b.Date_added DESC;
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $Seller_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $books = [];
        while ($row = $result->fetch_assoc()) {
            $row['Images'] = !empty($row['Images']) ? explode(",", $row['Images']) : [];
            $books[] = $row;
        }

        return $books;
    }
    public function isBookAvailable($bookId)
    {
        $sql = "SELECT Status_id FROM book WHERE Book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $statusMapping = [
                2 => "Sách đã hết hàng.",
                3 => "Sách đã ngừng kinh doanh.",
                4 => "Sách đang chờ cập nhật.",
            ];
            return $statusMapping[$row['Status_id']] ?? true; // Nếu không có trong mapping thì sách có sẵn
        }

        return "Không tìm thấy sách.";
    }
    public function getBookStock($Book_id)
    {
        $query = "SELECT quantity FROM book WHERE Book_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $Book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['quantity'] : 0;
    }


}
?>