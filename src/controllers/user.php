<?php
class User extends Controller
{
    private $UserModel;
    private $AuthModel;
    private $User_id;
    private $FavouriteModel;
    private $OrderModel;


    public function __construct()
    {
        parent::__construct();
        $this->UserModel = $this->model("UserModel");
        $this->AuthModel = $this->model("AuthModel");
        $this->FavouriteModel = $this->model("FavouriteModel");
        $this->OrderModel = $this->model("OrderModel");
        $this->User_id = isset($_SESSION['user_Info'][0]) ? $_SESSION['user_Info'][0] : null;

    }


    function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
            $username = trim($_POST["username"]);
            $phonenumber = trim($_POST["phonenumber"]);
            $email = trim($_POST["email"]);
            $currentUser = $this->UserModel->getUserById($this->User_id);

            if (!$this->UserModel->isValidEmail($email)) {
                $_SESSION['error-message'] = "Email không đúng định dạng.";
                header("Location: " . APP_PATH . "/user/profile");
                exit();
            }
            if (!$this->UserModel->isValidPhoneNumber($phonenumber)) {
                $_SESSION['error-message'] = "Số điện thoại không đúng định dạng.";
                header("Location: " . APP_PATH . "/user/profile");
                exit();
            }
            if ($email !== $currentUser['Email']) {
                $existingEmail = $this->AuthModel->getByEmail($email);
                if ($existingEmail && $existingEmail['User_id'] != $this->User_id) {
                    $_SESSION['error-message'] = "Email đã tồn tại!";
                    header("Location: " . APP_PATH . "/user/profile");
                    exit();
                }
            }
            if ($phonenumber !== $currentUser['Phone_Number']) {
                $existingPhone = $this->AuthModel->checkPhoneNumber($phonenumber);
                if ($existingPhone && $existingPhone['User_id'] != $this->User_id) {
                    $_SESSION['error-message'] = "Số điện thoại đã tồn tại!";
                    header("Location: " . APP_PATH . "/user/profile");
                    exit();
                }
            }
            $result = $this->UserModel->updateUser($this->User_id, $username, $phonenumber, $email);
            if ($result) {
                $updatedUser = $this->UserModel->getUserById($this->User_id);

                // Cập nhật lại session với thông tin mới theo dạng mảng tuần tự
                $_SESSION['user_Info'] = [
                    $updatedUser['User_id'],
                    $updatedUser['Email'],
                    $updatedUser['Role_id'],
                    $updatedUser["Full_Name"]
                ];
                $_SESSION['message'] = "Cập nhật thành công!";
            } else {
                $_SESSION['error-message'] = "Có lỗi xảy ra!";
            }
            header("Location: " . APP_PATH . "/user/profile");
            exit();
        }
        $this->view("main_layout", [
            "Title" => "Hồ sơ cá nhân",
            "Page" => "user/profile",
            "Script" => ["auth/register"],
            "User" => $this->UserModel->getUserById($this->User_id),
        ]);
    }

    function favorite()
    {

        $this->view("main_layout", [
            "Title" => "Hồ sơ cá nhân",
            "Page" => "user/favorite",
            "Favourite" => $this->FavouriteModel->getListFavourite($this->User_id)
        ]);
    }
    function order()
    {

        $OrdersList = $this->OrderModel->getOrdersByUser($this->User_id);
        foreach ($OrdersList as &$order) {
            $order['City_Order'] = $this->UserModel->getLocationName($order['City_Code']);
            $order['District_Order'] = $this->UserModel->getLocationName($order['City_Code'], $order['District_Code']);
        }
        $this->view("main_layout", [
            "Title" => "Hồ sơ cá nhân",
            "Page" => "user/order",
            "OrdersList" => $OrdersList,
        ]);
    }
    function order_detail($Order_id)
    {
        // Kiểm tra nếu người dùng gửi form hủy đơn hàng
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancelOrder'])) {
            $result = $this->OrderModel->cancelOrder($Order_id);

            if ($result) {
                $_SESSION['message'] = "Đã hủy đơn hàng thành công";
            } else {
                $_SESSION['error-message'] = "Hủy đơn hàng thất bại. Vui lòng thử lại!";
            }

            // Redirect để tránh gửi lại form khi refresh
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Lấy thông tin chi tiết đơn hàng
        $OrderDetail = $this->OrderModel->getOrderDetail($Order_id);
        $OrderDetail['City_Order'] = $this->UserModel->getLocationName($OrderDetail['City_Code']);
        $OrderDetail['District_Order'] = $this->UserModel->getLocationName($OrderDetail['City_Code'], $OrderDetail['District_Code']);

        // Hiển thị view
        $this->view("main_layout", [
            "Title" => "Chi tiết đơn hàng",
            "Page" => "user/order_detail",
            "OrderDetail" => $OrderDetail,
        ]);
    }

    function location()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addLocation'])) {
            $city = trim($_POST["city"]);
            $district = trim($_POST["district"]);
            $address = trim($_POST["address"]);
            if (empty($city) || empty($district) || empty($address)) {
                $_SESSION['error-message'] = "Vui lòng điền đầy đủ thông tin!";
            } else {
                $result = $this->UserModel->addAddress($this->User_id, $city, $district, $address);
                if ($result) {
                    $_SESSION['message'] = "Thêm địa chỉ thành công";
                } else {
                    $_SESSION['error-message'] = "Có lỗi xảy ra khi thêm địa chỉ!";
                }
            }
            header("Location: " . APP_PATH . "/user/location");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteLocation'])) {
            $Address_id = $_POST["address_id"];
            $result = $this->UserModel->deleteAddress($this->User_id, $Address_id);

            if ($result) {
                $_SESSION['message'] = "Địa chỉ đã được xóa!";
            } else {
                $_SESSION['error-message'] = "Có lỗi xảy ra khi xoá địa chỉ!";
            }
            header("Location: " . APP_PATH . "/user/location");
            exit();
        }

        $this->view("main_layout", [
            "Title" => "Hồ sơ cá nhân",
            "Page" => "user/location",
            "Script" => [
                "auth/register",
                "auth/login"
            ],
            "Location" => $this->UserModel->getUserById($this->User_id),
        ]);
    }
    function comment()
    {

        $this->view("main_layout", [
            "Title" => "Hồ sơ cá nhân",
            "Page" => "user/comment",
        ]);
    }
}


?>