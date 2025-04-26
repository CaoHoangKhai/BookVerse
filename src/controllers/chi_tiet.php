<?php
class Chi_tiet extends Controller
{
    public $ProductModel;
    private $FavouriteModel;
    private $CartModel;
    public function __construct()
    {
        $this->ProductModel = $this->model("ProductModel");
        $this->FavouriteModel = $this->model("FavouriteModel");
        $this->CartModel = $this->model("CartModel");
        parent::__construct();
    }
    public function default($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBookCart'])) {
            $Book_id = $_POST["Book_id"];

            if (isset($_SESSION['user_Info'][0])) {
                $User_id = $_SESSION['user_Info'][0];
            } else {
                $_SESSION['error-message'] = "Bạn cần đăng nhập để đặt hàng.";
                header("Location: " . APP_PATH . "/chi_tiet/$Book_id");
                exit();
            }

            $bookStatus = $this->ProductModel->isBookAvailable($Book_id);

            if ($bookStatus === true) {
                $stock = $this->ProductModel->getBookStock($Book_id);
                $cartQuantity = $this->CartModel->getCartQuantity($User_id, $Book_id); // Sửa lỗi này

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
                $_SESSION['error-message'] = $bookStatus;
            }

            header("Location: " . APP_PATH . "/chi_tiet/$Book_id");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addFavorite'])) {
            $Book_id = $_POST["Book_id"];
            if (!isset($_SESSION['user_Info'])) {
                $_SESSION['error-message'] = "Bạn cần đăng nhập để thêm vào danh sách yêu thích.";
                header("Location: " . APP_PATH . "/chi_tiet/$Book_id");
                exit();
            }
            $User_id = $_SESSION['user_Info'][0];
            $result = $this->FavouriteModel->addFavorite($User_id, $Book_id);
            if ($result === "added") {
                $_SESSION['message'] = "Đã thêm vào danh sách yêu thích!";
            } elseif ($result === "removed") {
                $_SESSION['message'] = "Đã xóa khỏi danh sách yêu thích!";
            } else {
                $_SESSION['error-message'] = "Có lỗi xảy ra!";
            }
            header("Location: " . APP_PATH . "/chi_tiet/$Book_id");
            exit();
        }
        $getBook = $this->ProductModel->getBook($id);
        $User_id = isset($_SESSION['user_Info'][0]) ? $_SESSION['user_Info'][0] : null;
        $checkFavourite = $this->FavouriteModel->checkFavourite($User_id, $id);
        $this->view("single_layout", [
            "Page" => "products/book_detail",
            "Title" => "Chi Tiết Sản Phẩm",
            "Book" => $getBook,
            "checkFavourite" => $checkFavourite,
        ]);
    }
}

?>