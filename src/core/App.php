<?php
class App
{
    protected $controller = "home"; // Controller mặc định
    protected $action = "default";   // Action mặc định
    protected $params = [];         // Danh sách tham số
    protected $errorHandled = false; // Đảm bảo chỉ xử lý lỗi một lần

    function __construct()
    {
        $arr = $this->UrlProcess();

        // Nếu không có controller trong URL, redirect về /home
        if (empty($arr) || $arr[0] == "") {
            header("Location: " . APP_PATH . "/home");
            exit();
        }
        // Xử lý Controller
        if (!empty($arr) && file_exists("./src/controllers/" . $arr[0] . ".php")) {
            $this->controller = $arr[0];
            unset($arr[0]);
        } else {
            $this->setErrorController();
        }

        require_once "./src/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        // Xử lý Action
        if (isset($arr[1]) && method_exists($this->controller, $arr[1])) {
            $this->action = $arr[1];
            unset($arr[1]);
        } elseif (isset($arr[1])) {
            array_unshift($arr, $arr[1]);
            $this->action = "default";
            unset($arr[1]);
        }

        // Xử lý Params
        $this->params = array_values($arr) ?: [];

        // Gọi controller và action với params
        try {
            call_user_func_array([$this->controller, $this->action], $this->params);
        } catch (ArgumentCountError $e) {
            $this->setErrorController();
            call_user_func_array([$this->controller, "default"], []);
        }
    }

    // Xử lý URL
    function UrlProcess()
    {
        if (isset($_GET["url"])) {
            $url = filter_var(trim($_GET["url"], "/"));
            $segments = explode("/", $url);

            // Loại bỏ các phần tử lặp lại liên tục
            $filteredSegments = [];
            foreach ($segments as $segment) {
                if (empty($filteredSegments) || end($filteredSegments) !== $segment) {
                    $filteredSegments[] = $segment;
                }
            }

            return $filteredSegments;
        }
        return [];
    }

    // Cấu hình Controller xử lý lỗi
    private function setErrorController()
    {
        if ($this->errorHandled) {
            die("Critical Error: Unable to handle the request.");
        }
        $this->errorHandled = true;

        $this->controller = "myerror";
        $this->action = "default"; // Đảm bảo luôn có action mặc định
        require_once "./src/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;
    }
}
