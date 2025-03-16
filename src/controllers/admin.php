<?php
use Shuchkin\SimpleXLSX;
class Admin extends Controller
{
    private $CheckRole;
    public $UserModel;
    private $AuthModel;
    private $CheckModel;
    private $CommonModel;
    private $DashboardModel;


    public function __construct()
    {
        parent::__construct();
        $this->UserModel = $this->model("UserModel");
        $this->CommonModel = $this->model("CommonModel");
        $this->AuthModel = $this->model("AuthModel");
        $this->CheckModel = $this->model("CheckRole");
        $this->DashboardModel = $this->model("DashboardModel");
    }

    function dashboard()
    {
        $this->CheckModel->checkAdminPermission();
        $this->view("main_layout", [
            "Title" => "Trang Tổng Quan",
            "Page" => "admin/dashboard",
            "CountUser" => $this->DashboardModel->getCountsUser(),
            "CountBook" => $this->DashboardModel->getCountsBook(),
            "SumOrder" => $this->DashboardModel->getTotalRevenue(),
            "CountOrder" => $this->DashboardModel->getCountOrder(),
        ]);
    }

    function users_list()
    {
        $this->CheckModel->checkAdminPermission();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addUser'])) {
            $fullname = trim($_POST['username']);
            $password = trim($_POST['password']);
            $phonenumber = trim($_POST['phonenumber']);
            $email = trim($_POST['email']);
            $city = trim($_POST['city']);
            $district = trim($_POST['district']);
            $address = trim($_POST['address']);
            if (!$this->UserModel->isValidEmail($email)) {
                $_SESSION['error-message'] = "Email không đúng định dạng.";
                header("Location: " . APP_PATH . "/admin/users_list");
                exit();
            }
            if (!$this->UserModel->isValidPhoneNumber($phonenumber)) {
                $_SESSION['error-message'] = "Số điện thoại không đúng định dạng.";
                header("Location: " . APP_PATH . "/admin/users_list");
                exit();
            }
            $existingEmail = $this->AuthModel->getByEmail($email);
            if ($existingEmail) {
                $_SESSION['error-message'] = "Email đã tồn tại!";
                header("Location: " . APP_PATH . "/admin/users_list");
                exit();
            }
            $existingPhone = $this->AuthModel->checkPhoneNumber($phonenumber);
            if ($existingPhone) {
                $_SESSION['error-message'] = "Số điện thoại đã tồn tại!";
                header("Location: " . APP_PATH . "/admin/users_list");
                exit();
            }
            $result = $this->AuthModel->create($fullname, $password, $phonenumber, $email, $city, $district, $address);
            if ($result === true) {
                $_SESSION['message'] = "Thêm Người Dùng Thành Công";
            } else {
                $_SESSION['error-message'] = "Thêm Người Dùng Thất Bại: " . $result;
            }
            header("Location: " . APP_PATH . "/admin/users_list");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uploadUsers'])) {
            $password = $_POST['admin_password'];
            $email = $_POST['email'];
            $user = $this->AuthModel->login($email, $password);
            if ($user) {
                if (empty($_FILES['files']['name'][0])) {
                    $_SESSION['error-message'] = "❌ Bạn phải chọn ít nhất một file để tải lên.";
                    header("Location: " . APP_PATH . "/admin/users_list");
                    exit();
                }
                $_SESSION['message'] = "✅ Nhận diện mật khẩu thành công!";
                $_SESSION['parsed_data'] = '<h2>Danh sách người dùng</h2>';
                $_SESSION['parsed_data'] .= '<table border="1" cellpadding="3" style="border-collapse: collapse">';
                $_SESSION['parsed_data'] .= '<tr><th>Họ và Tên</th><th>Mật khẩu</th><th>Số Điện Thoại</th><th>Email</th><th>Trạng thái</th></tr>';
                $_SESSION['error-message'] = isset($_SESSION['error-message']) ? $_SESSION['error-message'] : "";
                foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
                    if ($xlsx = SimpleXLSX::parse($tmpName)) {
                        $rows = $xlsx->rows();
                        if (count($rows) < 2) {
                            $_SESSION['error-message'] .= "❌ Lỗi: File không chứa dữ liệu khách hàng!";
                            continue;
                        }
                        $expectedHeaders = ["Họ và Tên", "Mật khẩu", "Số Điện Thoại", "Email"];
                        $fileHeaders = array_map('trim', $rows[0]);

                        if ($fileHeaders !== $expectedHeaders) {
                            $_SESSION['error-message'] .= "❌ Lỗi: File không đúng định dạng! Hãy kiểm tra lại tiêu đề.";
                            continue;
                        }
                        for ($i = 1; $i < count($rows); $i++) {
                            $row = $rows[$i];
                            if (count($row) < 4) {
                                $_SESSION['error-message'] .= "❌ Lỗi: Hàng $i không đủ thông tin!";
                                continue;
                            }
                            $fullname = trim($row[0]);
                            $password = trim($row[1]);
                            $phonenumber = trim($row[2]);
                            $email = trim($row[3]);
                            $check = $this->UserModel->checkUserExists($email, $phonenumber);
                            if ($check["email"]) {
                                $status = "❌ Email đã tồn tại";
                            } elseif ($check["phone"]) {
                                $status = "❌ Số điện thoại đã tồn tại";
                            } else {
                                $result = $this->UserModel->addUsers($fullname, $password, $phonenumber, $email);
                                $status = $result ? "✅ Thành công" : "❌ Lỗi khi thêm";
                            }
                            $_SESSION['parsed_data'] .= "<tr>
                                <td>$fullname</td>
                                <td>******</td> <!-- Không hiển thị mật khẩu -->
                                <td>$phonenumber</td>
                                <td>$email</td>
                                <td>$status</td>
                            </tr>";
                        }
                    } else {
                        $_SESSION['error-message'] .= "❌ Lỗi khi xử lý file: " . SimpleXLSX::parseError();
                    }
                }
                $_SESSION['parsed_data'] .= '</table>';
            } else {
                $_SESSION['error-message'] = "❌ Sai mật khẩu!";
            }
            header("Location: " . APP_PATH . "/admin/users_list");
            exit();
        }
        $this->view("main_layout", [
            "Title" => "Danh Sách Người Dùng",
            "Page" => "admin/users_list",
            "Script" => [
                "auth/register",
                "admin/users_list"
            ],
            "Users" => $this->UserModel->getUserRole(0),
        ]);
    }
    function user_detail($User_id)
    {
        $this->view("main_layout", [
            "Title" => "Danh Sách Người Dùng",
            "Page" => "admin/user_detail",
            "User" => $this->UserModel->getUserById($User_id),
            "AllRole" => $this->CommonModel->getAllRole(),
            "Status" =>$this->CommonModel->getAllStatus()
        ]);
    }

}

?>