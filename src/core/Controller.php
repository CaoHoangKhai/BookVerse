<?php
class Controller
{
    public function __construct()
    {
        // Constructor
    }

    public function model($model)
    {
        require_once "./src/models/" . $model . ".php";
        return new $model;
    }

    public function view($view, $data = [])
    {

        $scripts = isset($data['Script']) ? (array) $data['Script'] : [];
        $plugins = isset($data['Plugin']) ? (array) $data['Plugin'] : [];
        $styles = isset($data['Style']) ? (array) $data['Style'] : [];

        // Chèn CSS
        foreach ($styles as $style) {
            echo "<link rel='stylesheet' href='" . APP_PATH . "/public/css/{$style}.css'>";
        }

        // Chèn file view
        $viewPath = "./src/views/" . $view . ".php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "View file không tồn tại!";
        }

        // Chèn JS Plugins
        foreach ($plugins as $plugin) {
            echo "<script src='" . APP_PATH . "/public/js/{$plugin}.js' defer></script>";
        }

        // Chèn Script JS
        foreach ($scripts as $script) {
            echo "<script src='" . APP_PATH . "/public/js/pages/{$script}.js' defer></script>";
        }
    }
    public function image_author($imageName)
    {
        // Check if imageName is empty
        if (empty($imageName)) {
            return "" . APP_PATH . "/public/media/photos/authors/avatar2.jpg";
        }

        // If imageName is not empty, return the image path
        $imagePath = "" . APP_PATH . "/public/media/photos/authors/{$imageName}";
        return $imagePath;
    }
    public function image_books($imageType, $imageName)
    {
        // Nếu thiếu dữ liệu, trả về ảnh mặc định
        if (empty($imageType) || empty($imageName)) {
            return "" . APP_PATH . "/public/media/photos/books/default.jpg";
        }
        // Chuẩn hóa giá trị để tránh lỗi
        $imageType = trim($imageType);
        $imageName = trim($imageName);
        // Xây dựng đường dẫn hợp lệ
        return "" . APP_PATH . "/public/media/photos/books/{$imageType}/{$imageName}";
    }
    function image_contact($imageName)
    {
        $imagePath = "" . APP_PATH . "/public/media/photos/contact/{$imageName}";
        return $imagePath;
    }

}
?>