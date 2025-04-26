<?php
class CheckRole extends DB
{
    public function checkLogin()
    {
        if (empty($_SESSION['user_Info'])) {
            $_SESSION['error-message'] = "Bạn cần đăng nhập để thực hiện thao tác này.";
            header("Location: " . APP_PATH . "/login");
            exit();
        }
    }
    function checkSellerPermission()
    {
        if (!isset($_SESSION['user_Info']) || $_SESSION['user_Info'][2] != 1) {
            $_SESSION['error-message'] = "Bạn không có quyền truy cập trang này.";
            header("Location: " . APP_PATH . "/home");
            exit();
        }
        return $_SESSION['user_Info'][0];
    }
    function checkAdminPermission()
    {
        if (!isset($_SESSION['user_Info'][2]) || $_SESSION['user_Info'][2] != 2) {
            $_SESSION['error-message'] = "Bạn không có quyền truy cập trang này.";
            header("Location: " . APP_PATH . "/home");
            exit();
        }
    }
    function checkAlreadyLoggedIn()
    {
        if (!empty($_SESSION['user_Info'])) {
            $_SESSION['error-message'] = "Bạn đã đăng nhập, không thể truy cập trang đăng nhập.";
            header("Location: " . APP_PATH . "/home");
            exit();
        }
    }
    function checkAlreadyRegistered()
    {
        if (!empty($_SESSION['user_Info'])) {
            $_SESSION['error-message'] = "Bạn đã đăng nhập, không thể truy cập trang đăng ký.";
            header("Location: " . APP_PATH . "/home");
            exit();
        }
    }
}
?>