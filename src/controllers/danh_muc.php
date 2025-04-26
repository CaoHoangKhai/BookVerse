<?php
class Danh_muc extends Controller
{
    public $ProductModel;
    private $CategoryModel;
    private $CartModel;
    public function __construct()
    {
        $this->ProductModel = $this->model("ProductModel");
        $this->CategoryModel = $this->model("CategoryModel");
        $this->CartModel = $this->model("CartModel");
        parent::__construct();
    }

    public function default($Category_type = "")
    {
        // Lấy danh sách sách theo danh mục, nếu không có danh mục thì lấy tất cả
        $Books = empty($Category_type) ? $this->ProductModel->getBooks() : $this->CategoryModel->getBooksByCategoryType($Category_type);

        // Xử lý thêm vào giỏ hàng
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCartCategory'])) {
            $Book_id = $_POST["Book_id"];

            if (isset($_SESSION['user_Info'][0])) {
                $User_id = $_SESSION['user_Info'][0];
            } else {
                $_SESSION['error-message'] = "Bạn cần đăng nhập để đặt hàng.";
                header("Location: " . APP_PATH . "/danh_muc/$Category_type");
                exit();
            }

            $bookStatus = $this->ProductModel->isBookAvailable($Book_id);

            if ($bookStatus === true) {
                $stock = $this->ProductModel->getBookStock($Book_id);
                $cartQuantity = $this->CartModel->getCartQuantity($User_id, $Book_id);

                if ($cartQuantity < $stock) {
                    if ($this->CartModel->addCart($User_id, $Book_id)) {
                        $_SESSION['message'] = "Sản phẩm đã được thêm vào giỏ hàng!";
                    } else {
                        $_SESSION['error-message'] = "Có lỗi xảy ra, vui lòng thử lại!";
                    }
                } else {
                    $_SESSION['error-message'] = "Bạn đã thêm tối đa số lượng tồn kho của sản phẩm này!";
                }
            } else {
                $_SESSION['error-message'] = $bookStatus; // Chính là thông báo lỗi trả về từ isBookAvailable()
            }

            header("Location: " . APP_PATH . "/danh_muc/$Category_type");
            exit();
        }

        // Trả dữ liệu ra view
        $this->view("single_layout", [
            "Page" => "products/product_category",
            "Title" => "Danh mục sách",
            "Type" => $Category_type,
            "Books" => $Books,
        ]);
    }
}
?>