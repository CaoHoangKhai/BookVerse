<?php
class CommonModel extends DB
{
    function getAllRole()
    {
        $sql = "SELECT * FROM Role WHERE Role_id !=2";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $roles = [];
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row;
            }
            return $roles;
        } else {
            return [];
        }
    }
    function getAllStatus()
    {
        $sql = "SELECT * FROM userstatus";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $roles = [];
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row;
            }
            return $roles;
        } else {
            return [];
        }
    }
    function getNationality()
    {
        $sql = "SELECT * FROM countries";
        $result = $this->conn->query($sql);

        $countries = [];
        while ($row = $result->fetch_assoc()) {
            $countries[] = $row;
        }
        return $countries;
    }
}
?>