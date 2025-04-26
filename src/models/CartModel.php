<?php
class CartModel extends DB
{
    public function addCart($User_id, $Book_id)
    {
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $sql = "SELECT Quantity FROM cart WHERE User_id = ? AND Book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $User_id, $Book_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Nếu sách đã có trong giỏ hàng, tăng số lượng
            $newQuantity = $row['Quantity'] + 1;
            $updateSql = "UPDATE cart SET Quantity = ? WHERE User_id = ? AND Book_id = ?";
            $stmt = $this->conn->prepare($updateSql);
            $stmt->bind_param("iii", $newQuantity, $User_id, $Book_id);
        } else {
            // Nếu sách chưa có trong giỏ hàng, thêm mới
            $insertSql = "INSERT INTO cart (User_id, Book_id, Quantity) VALUES (?, ?, 1)";
            $stmt = $this->conn->prepare($insertSql);
            $stmt->bind_param("ii", $User_id, $Book_id);
        }
        return $stmt->execute();
    }
    public function getCartUser($User_id)
    {
        $sql = "
        SELECT 
            c.Cart_id, 
            c.Quantity, 
            b.Book_id, 
            b.User_id AS Seller_id,
            s.Full_Name AS Nha_Xuat_Ban,
            bd.Title, 
            bd.Price, 
            (
                SELECT Image_URL 
                FROM BookImages 
                WHERE Book_id = b.Book_id 
                LIMIT 1
            ) AS Image, 
            cat.Category_name,
            cat.Category_type,
            bs.Status_name,
            bs.Status_id
        FROM cart c
        JOIN book b ON b.Book_id = c.Book_id
        JOIN bookdetail bd ON bd.id = b.Book_id
        JOIN category cat ON cat.Category_id = b.Category_id
        JOIN bookstatus bs ON b.Status_id = bs.Status_id 
        JOIN user s ON s.User_id = b.User_id
        WHERE c.User_id = ? AND b.Status_id != 5
        ORDER BY b.User_id, c.Cart_id
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $User_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Nhóm theo Seller_id
        $groupedCart = [];
        while ($row = $result->fetch_assoc()) {
            $sellerName = $row['Nha_Xuat_Ban'];
            $groupedCart[$sellerName][] = $row;
        }

        return $groupedCart;
    }

    public function getAvailableCartItems($User_id)
    {
        $sql = "
        SELECT 
            c.Cart_id, 
            c.Quantity, 
            b.Book_id, 
            b.User_id AS Seller_id,
            s.Full_Name AS Nha_Xuat_Ban,
            bd.Title, 
            bd.Price, 
            (
                SELECT Image_URL 
                FROM BookImages 
                WHERE Book_id = b.Book_id 
                LIMIT 1
            ) AS Image, 
            cat.Category_name,
            cat.Category_type,
            bs.Status_name,
            bs.Status_id
        FROM cart c
        JOIN book b ON b.Book_id = c.Book_id
        JOIN bookdetail bd ON bd.id = b.Book_id
        JOIN category cat ON cat.Category_id = b.Category_id
        JOIN bookstatus bs ON b.Status_id = bs.Status_id 
        JOIN user s ON s.User_id = b.User_id
        WHERE c.User_id = ? AND b.Status_id != 5
        ORDER BY b.User_id, c.Cart_id
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $User_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Nhóm theo Seller_id
        $groupedCart = [];
        while ($row = $result->fetch_assoc()) {
            $sellerName = $row['Nha_Xuat_Ban'];
            $groupedCart[$sellerName][] = $row;
        }

        return $groupedCart;
    }


    function deleteCartBook($User_id, $Book_id)
    {
        $sql = "DELETE FROM `cart` WHERE User_id = ? AND Book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $User_id, $Book_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function reduceQuantityBook($User_id, $Book_id)
    {
        $query = "SELECT Quantity FROM cart WHERE User_id = ? AND Book_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $User_id, $Book_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $currentQuantity = $row['Quantity'];

            if ($currentQuantity <= 1) {
                // Nếu chỉ còn 1 sách, xóa khỏi giỏ hàng
                $deleteQuery = "DELETE FROM cart WHERE User_id = ? AND Book_id = ?";
                $stmt = $this->conn->prepare($deleteQuery);
                $stmt->bind_param("ii", $User_id, $Book_id);
                $stmt->execute();
            } else {
                // Giảm số lượng đi 1
                $updateQuery = "UPDATE cart SET Quantity = Quantity - 1 WHERE User_id = ? AND Book_id = ?";
                $stmt = $this->conn->prepare($updateQuery);
                $stmt->bind_param("ii", $User_id, $Book_id);
                $stmt->execute();
            }
        }
    }

    function addQuantityBook($User_id, $Book_id)
    {
        $checkStockQuery = "SELECT quantity FROM book WHERE Book_id = ?";
        $stmt = $this->conn->prepare($checkStockQuery);
        $stmt->bind_param("i", $Book_id);
        $stmt->execute();
        $stockResult = $stmt->get_result();
        if ($stockRow = $stockResult->fetch_assoc()) {
            $stockQuantity = $stockRow['quantity'];
            $cartQuery = "SELECT Quantity FROM cart WHERE User_id = ? AND Book_id = ?";
            $stmt = $this->conn->prepare($cartQuery);
            $stmt->bind_param("ii", $User_id, $Book_id);
            $stmt->execute();
            $cartResult = $stmt->get_result();
            if ($cartRow = $cartResult->fetch_assoc()) {
                $cartQuantity = $cartRow['Quantity'];
                if ($cartQuantity < $stockQuantity) {
                    $updateQuery = "UPDATE cart SET Quantity = Quantity + 1 WHERE User_id = ? AND Book_id = ?";
                    $stmt = $this->conn->prepare($updateQuery);
                    $stmt->bind_param("ii", $User_id, $Book_id);
                    $stmt->execute();
                    return "Đã tăng số lượng sách trong giỏ hàng.";
                } else {
                    return "Không thể thêm, số lượng sách trong giỏ đã đạt giới hạn kho.";
                }
            } else {
                if ($stockQuantity > 0) {
                    $insertQuery = "INSERT INTO cart (User_id, Book_id, Quantity) VALUES (?, ?, 1)";
                    $stmt = $this->conn->prepare($insertQuery);
                    $stmt->bind_param("ii", $User_id, $Book_id);
                    $stmt->execute();
                    return "Sách đã được thêm vào giỏ hàng.";
                } else {
                    return "Sách đã hết hàng.";
                }
            }
        } else {
            return "Sách không tồn tại.";
        }
    }
    public function getCartQuantity($User_id, $Book_id)
    {
        $query = "SELECT Quantity FROM cart WHERE User_id = ? AND Book_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $User_id, $Book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['Quantity'] : 0; // Nếu không có sách này trong giỏ hàng, trả về 0
    }
}
?>