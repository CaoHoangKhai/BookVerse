<?php
class Auth extends Controller
{
    private $CheckRole;
    private $AuthModel;

    public function __construct()
    {
        $this->CheckRole = $this->model("CheckRole");
        $this->AuthModel = $this->model("AuthModel");
        parent::__construct();
    }
    function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $status = $this->AuthModel->checkStatus($email);
            if ($status === 2) {
                $_SESSION['error-message'] = "Tài khoản của bạn đã bị hủy kích hoạt. Vui lòng liên hệ quản trị viên.";
                return;
            }
            $user = $this->AuthModel->login($email, $password);
            if (!is_array($user)) {
                $_SESSION['error-message'] = $user === "wrong_password"
                    ? "Mật khẩu không đúng."
                    : "Email không tồn tại. Hãy chuyển sang trang đăng ký.";
                return;
            }
            $_SESSION['user_Info'] = [$user['User_id'], $email, $user['Role_id'], $user["Full_Name"]];
            $_SESSION['message'] = "Đăng nhập thành công.";
            header("Location: " . APP_PATH . "/home");
            exit();
        }
        $this->CheckRole->checkAlreadyLoggedIn();
        $this->view("single_layout", [
            "Title" => "Đăng Nhập",
            "Page" => "auth/login",
            "Script" => [
                "auth/login",
                "auth/showpassword"
            ]
        ]);
    }
    function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $fullname = trim($_POST['username']);
            $password = trim($_POST['password']);
            $phonenumber = trim($_POST['phonenumber']);
            $email = trim($_POST['email']);
            $city = intval($_POST['city']);
            $district = intval($_POST['district']);
            $address = trim($_POST['address']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error-message'] = "Email không hợp lệ.";
                header("Location: " . APP_PATH . "/auth/register");
                exit();
            }
            if ($this->AuthModel->getByEmail($email)) {
                $_SESSION['error-message'] = "Email đã được đăng ký. Vui lòng chọn email khác.";
                header("Location: " . APP_PATH . "/auth/register");
                exit();
            }

            if ($this->AuthModel->checkPhoneNumber($phonenumber)) {
                $_SESSION['error-message'] = "Số điện thoại đã được đăng ký. Vui lòng chọn số điện thoại khác khác.";
                header("Location: " . APP_PATH . "/auth/register");
                exit();
            }
            $result = $this->AuthModel->create($fullname, $password, $phonenumber, $email, $city, $district, $address);
            if ($result === true) {
                $_SESSION['message'] = "Đăng ký thành công. Bạn có thể đăng nhập";
                header("Location: " . APP_PATH . "/auth/login");
                exit();
            } else {
                $_SESSION['error-message'] = "Đăng ký thất bại: " . $result;
                header("Location: " . APP_PATH . "/auth/register");
                exit();
            }
        }
        $this->CheckRole->checkAlreadyRegistered();
        $this->view("single_layout", [
            "Title" => "Đăng Nhập",
            "Page" => "auth/register",
            "Script" => [

                "auth/register",
                "auth/showpassword"
            ]
        ]);
    }
    function logout()
    {
        unset($_SESSION['user_Info']);
        $_SESSION['message'] = "Đăng xuất thành công";
        header("Location: " . APP_PATH . "/auth/login");
        exit();
    }

}

?>