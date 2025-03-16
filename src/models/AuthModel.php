<?php
class AuthModel extends DB
{
    function getByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }
    public function checkStatus($email)
    {
        $stmt = $this->conn->prepare("SELECT Status FROM user WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user['Status'];
        }

        return null;
    }
    public function login($email, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Pass_Word'])) {
                return $user;
            } else {
                return "wrong_password";
            }
        }
        return "email_not_found";
    }
    public function checkPhoneNumber($phonenumber)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone_Number = ?");
        $stmt->bind_param("s", $phonenumber);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }
    public function create($fullname, $password, $phonenumber, $email, $city, $district, $address)
    {
        $this->conn->begin_transaction();
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql1 = "INSERT INTO `user`(`Full_Name`, `Phone_Number`, `Pass_Word`, `Email`) VALUES (?, ?, ?, ?)";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->bind_param("ssss", $fullname, $phonenumber, $hashedPassword, $email);
            if (!$stmt1->execute()) {
                throw new Exception("Lỗi khi thêm vào user: " . $stmt1->error);
            }
            $userId = $stmt1->insert_id;
            $sql2 = "INSERT INTO `userlocation` (`User_id`, `City`, `District`, `Address`) VALUES (?, ?, ?, ?)";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bind_param("iiis", $userId, $city, $district, $address);

            if (!$stmt2->execute()) {
                throw new Exception("Lỗi khi thêm vào userlocation: " . $stmt2->error);
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            return $e->getMessage();
        }
    }
}
?>