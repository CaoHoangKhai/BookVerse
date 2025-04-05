<?php
class NewsModel extends DB
{
    private function createSlug($string)
    {
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $string);
        $string = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $string);
        $string = preg_replace('/[iíìỉĩị]/u', 'i', $string);
        $string = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $string);
        $string = preg_replace('/[úùủũụưứừửữự]/u', 'u', $string);
        $string = preg_replace('/[ýỳỷỹỵ]/u', 'y', $string);
        $string = preg_replace('/đ/u', 'd', $string);
        $string = preg_replace('/[^a-z0-9\s]/', '', $string);
        $string = preg_replace('/\s+/', '_', $string);
        return $string;
    }
    public function createNews($user_id, $title, $description, $image1, $content1, $image2, $content2, $current_date, $status)
    {
        $link = $this->createSlug($title); // Tạo link từ title

        $sql = "INSERT INTO news (user_id, title, description, content_1, content_2, date, status, image_1, image_2, link) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $user_id,
            $title,
            $description,
            $content1,
            $content2,
            $current_date,
            $status,
            $image1,
            $image2,
            $link
        ]);
    }

    public function getNewsAdmin()
    {
        $sql = "SELECT title, date, status, description, image_1 FROM news ORDER BY date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $news = [];

        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }

        return $news;
    }
    function getNewsSeller($Seller_id)
    {
        // Thêm điều kiện lọc theo User_id (người bán)
        $sql = "SELECT title, date, status, description, image_1 FROM news WHERE user_id = ? ORDER BY date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $Seller_id); // Ràng buộc User_id là số nguyên
        $stmt->execute();
        $result = $stmt->get_result();
        $news = [];
    
        // Lấy dữ liệu từ kết quả truy vấn
        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
    
        return $news;
    }
    
    public function getNewsHome()
    {
        $sql = "SELECT title, date,  status, description, image_1, link
                FROM news 
                WHERE status = 1 
                ORDER BY date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $news = [];

        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }

        return $news;
    }
    public function getNewsByLink($link)
    {
        $sql = "SELECT * FROM news WHERE link = ? AND status = 1 LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$link]);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

}
?>