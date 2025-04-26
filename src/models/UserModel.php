<?php
class UserModel extends DB
{
    function getUserById($User_id)
    {
        $sql = "SELECT 
                u.*, 
                r.Role_Name,
                us.*
            FROM `user` u
            JOIN `role` r ON u.Role_id = r.Role_id
            JOIN `userstatus` us ON u.Status = us.id
            WHERE u.User_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $User_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            $user["Address"] = $this->getUserAddresses($User_id);
            return $user;
        }
        return null;
    }

    function getUserAddresses($User_id)
    {
        $sql = "SELECT 
            ul.id,
            ul.City, 
            ul.District, 
            ul.Address
        FROM `userlocation` ul
        WHERE ul.User_id = ? AND ul.Status = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $User_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $addresses = [];
        while ($row = $result->fetch_assoc()) {
            $row["City_Name"] = isset($row["City"]) ? $this->getLocationName($row["City"]) : "Không xác định";
            $row["District_Name"] = isset($row["City"], $row["District"]) ? $this->getLocationName($row["City"], $row["District"]) : "Không xác định";
            $addresses[] = $row;
        }
        return $addresses;
    }

    function getLocationData()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/json/vietnam_administrative_data.json";
        if (!file_exists($path)) {
            return [];
        }
        $jsonContent = file_get_contents($path);
        $data = json_decode($jsonContent, true);

        return is_array($data) ? $data : [];
    }

    function getLocationName($cityId, $districtId = null)
    {
        $data = $this->getLocationData();
        foreach ($data as $city) {
            if ($city["Id"] == $cityId) {
                if ($districtId === null) {
                    return $city["Name"];
                }
                foreach ($city["Districts"] as $district) {
                    if ($district["Id"] == $districtId) {
                        return $district["Name"];
                    }
                }
            }
        }
        return "Không xác định";
    }


    function isValidEmail($email)
    {
        return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email) === 1;
    }
    function isValidPhoneNumber($phoneNumber)
    {
        return preg_match('/^[0-9]{10}$/', $phoneNumber) === 1;
    }


    function updateUser($id, $username, $phonenumber, $email, $role_id = null, $status = null)
    {
        if (!$this->isValidEmail($email)) {
            return "invalid_email";
        }

        $sqlCheck = "SELECT Full_Name, Phone_Number, Email, Role_id, Status FROM `user` WHERE User_id = ?";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->bind_param("i", $id);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();

        if ($row = $result->fetch_assoc()) {
            if (
                $row['Full_Name'] === $username &&
                $row['Phone_Number'] === $phonenumber &&
                $row['Email'] === $email &&
                ($role_id === null || $row['Role_id'] == $role_id) &&
                ($status === null || $row['Status'] == $status)
            ) {
                return "no_changes";
            }
        }

        $sql = "UPDATE `user` SET Full_Name = ?, Phone_Number = ?, Email = ?";

        if ($role_id !== null) {
            $sql .= ", Role_id = ?";
        }
        if ($status !== null) {
            $sql .= ", Status = ?";
        }
        $sql .= " WHERE User_id = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        if ($role_id !== null && $status !== null) {
            $stmt->bind_param("sssiii", $username, $phonenumber, $email, $role_id, $status, $id);
        } elseif ($role_id !== null) {
            $stmt->bind_param("sssii", $username, $phonenumber, $email, $role_id, $id);
        } elseif ($status !== null) {
            $stmt->bind_param("sssii", $username, $phonenumber, $email, $status, $id);
        } else {
            $stmt->bind_param("sssi", $username, $phonenumber, $email, $id);
        }

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0;
        }
        return false;
    }
    function addAddress($User_id, $City, $District, $Address)
    {
        $sql = "INSERT INTO userlocation (User_id, City, District, Address, Status) 
                VALUES (?, ?, ?, ?,  1)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $User_id, $City, $District, $Address);

        if ($stmt->execute()) {
            return "Địa chỉ đã được thêm thành công!";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }
    function deleteAddress($User_id, $Address_id)
    {
        $sql = "UPDATE userlocation SET Status = 0 WHERE id = ? AND User_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$Address_id, $User_id]);
    }
    function getUserRole($role_id)
    {
        $sql = "SELECT
            u.User_id,
            u.Full_Name,
            u.Email,
            u.Phone_Number,
            us.Status_Name
        FROM `user` u
        JOIN `role` r ON u.Role_id = r.Role_id
        JOIN `userstatus` us ON us.id = u.Status
        WHERE u.Role_id = ?
    ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $role_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }
    function checkUserExists($email, $phonenumber)
    {
        $stmt = $this->conn->prepare("SELECT Email, Phone_Number FROM user WHERE Email = ? OR Phone_Number = ?");
        $stmt->bind_param("ss", $email, $phonenumber);
        $stmt->execute();
        $result = $stmt->get_result();

        $exists = [
            "email" => false,
            "phone" => false
        ];
        while ($row = $result->fetch_assoc()) {
            if ($row['Email'] === $email) {
                $exists["email"] = true;
            }
            if ($row['Phone_Number'] === $phonenumber) {
                $exists["phone"] = true;
            }
        }
        return $exists;
    }
    function addUsers($fullname, $password, $phonenumber, $email)
    {
        try {
            $stmt = $this->conn->prepare("SELECT Email, Phone_Number FROM user WHERE Email = ? OR Phone_Number = ?");
            $stmt->bind_param("ss", $email, $phonenumber);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                if ($row['Email'] === $email) {
                    return "❌ Email đã tồn tại.";
                }
                if ($row['Phone_Number'] === $phonenumber) {
                    return "❌ Số điện thoại đã tồn tại.";
                }
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `user` (`Full_Name`, `Phone_Number`, `Pass_Word`, `Email`) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $fullname, $phonenumber, $hashedPassword, $email);

            if ($stmt->execute()) {
                return true;
            } else {
                return "❌ Lỗi khi thêm người dùng: " . $stmt->error;
            }
        } catch (Exception $e) {
            return "❌ Lỗi: " . $e->getMessage();
        }
    }
}




?>