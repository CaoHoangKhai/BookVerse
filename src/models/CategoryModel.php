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
}

?>