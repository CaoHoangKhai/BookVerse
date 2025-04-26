<?php
class Auth extends Controller
{
    private $CheckRole;
    private $AuthModel;
    private $ProductModel;
    private $CartModel;
    private $UserModel;
    private $OrderModel;
    private $CommonModel;

    public function __construct()
    {
        $this->CheckRole = $this->model("CheckRole");
        $this->AuthModel = $this->model("AuthModel");
        $this->ProductModel = $this->model("ProductModel");
        $this->CartModel = $this->model("CartModel");
        $this->UserModel = $this->model("UserModel");
        $this->OrderModel = $this->model("OrderModel");
        $this->CommonModel = $this->model("CommonModel");
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
                header("Location: " . APP_PATH . "/auth/login");
                exit();
            }
            $user = $this->AuthModel->login($email, $password);
            if (!is_array($user)) {
                $_SESSION['error-message'] = $user === "wrong_password"
                    ? "Mật khẩu không đúng."
                    : "Email không tồn tại. Hãy chuyển sang trang đăng ký.";
                header("Location: " . APP_PATH . "/auth/login");
                exit();
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
    public function cart()
    {
        if (!isset($_SESSION['user_Info'][0])) {
            $_SESSION['error-message'] = "Bạn cần đăng nhập để xem giỏ hàng!";
            header("Location: " . APP_PATH . "/auth/login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteCartBook'])) {
            $User_id = $_POST["User_id"];
            $Book_id = $_POST["book_id"];

            if ($this->CartModel->deleteCartBook($User_id, $Book_id)) {
                $_SESSION['message'] = "Sản phẩm đã được xóa khỏi giỏ hàng!";
            } else {
                $_SESSION['error-message'] = "Có lỗi xảy ra, vui lòng thử lại!";
            }
            header("Location: " . APP_PATH . "/auth/cart");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reduceQuantityBook'])) {

            $Book_id = $_POST["Book_id"];
            $User_id = $_SESSION['user_Info'][0];
            $this->CartModel->reduceQuantityBook($User_id, $Book_id);
            $_SESSION['message'] = "Cập nhật sản phẩm thành công";
            header("Location: " . APP_PATH . "/auth/cart");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addQuantityBook'])) {
            $Book_id = $_POST["Book_id"];
            $User_id = $_SESSION['user_Info'][0];
            $message = $this->CartModel->addQuantityBook($User_id, $Book_id);
            if ($message === "Đã tăng số lượng sách trong giỏ hàng." || $message === "Sách đã được thêm vào giỏ hàng.") {
                $_SESSION['message'] = $message;
            } else {
                $_SESSION['error-message'] = $message;
            }
            header("Location: " . APP_PATH . "/auth/cart");
            exit();
        }
        $getCart = $this->CartModel->getCartUser($_SESSION['user_Info'][0]);

        $this->view("single_layout", [
            "Title" => "Giỏ hàng",
            "Page" => "cart/cart",
            "Script" => "pages/cart",
            "Cart" => $getCart,
        ]);
    }

    public function order()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_detail'])) {
            $user_id = $_SESSION["user_Info"][0];
            $full_Name = $_POST["username"];
            $phone_Number = $_POST["phonenumber"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $note = $_POST["note"];
            $pay = (int) $_POST["payment_method"];
            $sum = $_POST["sum"];
            $order_date = $_POST["order_date"];
            $valid_payments = [2, 3, 4, 5, 6];
            $_SESSION['pending_order'] = [
                'user_id' => $user_id,
                'full_Name' => $full_Name,
                'phone_Number' => $phone_Number,
                'email' => $email,
                'address' => $address,
                'note' => $note,
                'pay' => $pay,
                'sum' => $sum,
                'order_date' => $order_date
            ];
            $order_date = $_POST["order_date"];
            $result = $this->OrderModel->createOrderGroupedByPublisher(
                $user_id,
                $full_Name,
                $phone_Number,
                $email,
                $address,
                $note,
                $pay,
                $order_date
            );
            if ($result === true) {
                $_SESSION['message'] = "Đơn hàng đã được tạo thành công!";
            } else {
                $_SESSION['error-message'] = $result;
            }

            header("Location: " . APP_PATH . "/auth/cart");
            exit();
        }

        $getPay = $this->CommonModel->getPaymentMethods();

        $this->view("single_layout", [
            "Title" => "Giỏ hàng",
            "Page" => "cart/order",
            "Script" => "auth/login",
            "Pay" => $getPay,
            "User" => $this->UserModel->getUserById($_SESSION["user_Info"][0]),
            "Order" => $this->CartModel->getAvailableCartItems($_SESSION["user_Info"][0])
        ]);
    }


}

?>