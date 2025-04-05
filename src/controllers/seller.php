<?php
class Seller extends Controller
{
    private $CheckRole;
    private $UserModel;
    private $AuthModel;
    private $CheckModel;
    private $CommonModel;
    private $DashboardModel;
    private $ProductModel;
    private $CategoryModel;
    private $AuthorModel;
    private $OrderModel;
    private $NewsModel;
    public function __construct()
    {
        parent::__construct();
        $this->UserModel = $this->model("UserModel");
        $this->CommonModel = $this->model("CommonModel");
        $this->AuthModel = $this->model("AuthModel");
        $this->CheckModel = $this->model("CheckRole");
        $this->DashboardModel = $this->model("DashboardModel");
        $this->ProductModel = $this->model("ProductModel");
        $this->CategoryModel = $this->model("CategoryModel");
        $this->AuthorModel = $this->model("AuthorModel");
        $this->OrderModel = $this->model("OrderModel");
        $this->NewsModel = $this->model("NewsModel");
    }
    function dashboard()
    {
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Trang Tổng Quan",
            "Page" => "seller/dashboard"
        ]);
    }
    function revenue()
    {
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Doanh Thu Của Tôi",
            "Page" => "seller/revenue"
        ]);
    }
    function my_books()
    {
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Doanh Thu Của Tôi",
            "Page" => "seller/product/product_list",
            "Script" => ["products/product_list"],
            "Categories" => $this->CategoryModel->getCategories(),
            "SellerBooks" => $this->ProductModel->getBooksSeller($_SESSION['user_Info'][0]),
        ]);
    }

    function add_book()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBook'])) {
            $title = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $author = $_POST['author'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $date = $_POST["current_date"];
            $publisher = $_SESSION['user_Info'][0];
            $category_type = $this->CategoryModel->getCategoryType($category);

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/books/" . $category_type . "/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $book_id = $this->ProductModel->createBook($publisher, $author, $category, $date, $status, $title, $description, $price);
            if ($book_id) {
                if (isset($_FILES["book_image"])) {
                    $fileName = basename($_FILES["book_image"]["name"]);
                    $targetFile = $uploadDir . $fileName;
                    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                    $allowTypes = ["jpg", "jpeg", "png", "gif", "webp"];

                    if (in_array($fileType, $allowTypes)) {

                        if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $targetFile)) {

                            if ($this->ProductModel->createBookImage($book_id, $fileName)) {
                                $_SESSION['message'] = "Thêm sản phẩm và ảnh thành công";
                            } else {
                                $_SESSION['error-message'] = "Lỗi khi lưu ảnh.";
                            }
                        } else {
                            $_SESSION['error-message'] = "Lỗi khi tải ảnh.";
                        }
                    } else {
                        $_SESSION['error-message'] = "Chỉ hỗ trợ JPG, JPEG, PNG, GIF, WEBP.";
                    }
                } else {
                    $_SESSION['error-message'] = "Không có file nào được tải lên.";
                }
            } else {
                $_SESSION['error-message'] = "Lỗi khi thêm sản phẩm.";
            }
        }
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Doanh Thu Của Tôi",
            "Page" => "seller/product/add_product",
            "Script" => [
                "auth/login",
            ],
            "Categories" => $this->CategoryModel->getCategories(),
            "BookStatus" => $this->ProductModel->getBookStatus(),
            "Publishers" => $this->UserModel->getUserRole(1),
            "Authors" => $this->AuthorModel->getAllAuthors(),
        ]);
    }
    function product_detail($Book_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editBook'])) {
            $Book_id = $_POST["Book_id"];
            $title = $_POST["title"];
            $price = $_POST["price"];
            $category = $_POST["category"];
            $author = $_POST["author"];
            $User_id = $_SESSION['user_Info'][0];
            $status = $_POST["status"];
            $description = $_POST["description"];
            $quantity = $_POST["add_quantity"];
            unset($_SESSION['error-message']);
            unset($_SESSION['message']);
            $isUpdated = false;
            try {
                $bookUpdated = $this->ProductModel->updateBook($Book_id, $User_id, $author, $category, $status, $title, $description, $price, $quantity);
                if ($bookUpdated) {
                    $_SESSION['message'] = "Sách đã được cập nhật thành công!";
                    $isUpdated = true;
                }
                if (!empty($_FILES["book_image"]["name"]) && $_FILES["book_image"]["size"] > 0) {
                    $category_type = $this->ProductModel->getCategoryType($category);
                    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/books/" . $category_type . "/";

                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $fileType = strtolower(pathinfo($_FILES["book_image"]["name"], PATHINFO_EXTENSION));
                    $newFileName = uniqid("book_", true) . "." . $fileType;
                    $targetFile = $uploadDir . $newFileName;
                    $allowTypes = ["jpg", "jpeg", "png", "gif", "webp"];

                    if (in_array($fileType, $allowTypes)) {
                        if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $targetFile)) {
                            if ($this->ProductModel->createBookImage($Book_id, $newFileName)) {
                                $_SESSION['message'] .= " Ảnh đã được cập nhật thành công!";
                                $isUpdated = true;
                            } else {
                                $_SESSION['error-message'] = "Lỗi khi lưu ảnh vào database.";
                            }
                        } else {
                            $_SESSION['error-message'] = "Lỗi khi di chuyển file ảnh.";
                        }
                    } else {
                        $_SESSION['error-message'] = "Chỉ hỗ trợ định dạng JPG, JPEG, PNG, GIF, WEBP.";
                    }
                }
                if (!$isUpdated) {
                    $_SESSION['error-message'] = "Không có thay đổi nào được thực hiện!";
                }
            } catch (Exception $e) {
                $_SESSION['error-message'] = "Lỗi: " . $e->getMessage();
            }
            header("Location: " . APP_PATH . "/seller/product_detail/$Book_id");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteImage'])) {
            $Book_id = $_POST["book_id"];
            $ImageUrl = $_POST["image"];
            if (!empty($Book_id) && !empty($ImageUrl)) {
                $isDeleted = $this->ProductModel->deleteBookImage($Book_id, $ImageUrl);
                if ($isDeleted) {
                    $book = $this->ProductModel->getBook($Book_id);
                    if ($book) {
                        $category_type = $book["Category_type"];
                        $filePath = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/books/" . $category_type . "/" . $ImageUrl;
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                        $_SESSION['message'] = "Ảnh đã được xóa khỏi cơ sở dữ liệu và thư mục!";
                    } else {
                        $_SESSION['error-message'] = "Lỗi: Không tìm thấy thông tin sách!";
                    }
                } else {
                    $_SESSION['error-message'] = "Lỗi khi xóa ảnh trong cơ sở dữ liệu!";
                }
            } else {
                $_SESSION['error-message'] = "Thiếu thông tin để xóa ảnh!";
            }
            header("Location: " . APP_PATH . "/seller/product_detail/$Book_id");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteBook'])) {
            $book = $this->ProductModel->getBook($Book_id);
            if ($book) {
                $category_type = $book["Category_type"];
                $images = $this->ProductModel->getByImageBook($Book_id);
                foreach ($images as $image) {
                    $filePath = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/books/" . $category_type . "/" . $image['Image_URL'];
                    if (file_exists($filePath)) {
                        unlink($filePath); // Xóa file ảnh
                    }
                }
                $deleteResult = $this->ProductModel->deleteBookWithDetailsAndImages($Book_id);
                if ($deleteResult === true) {
                    $_SESSION['message'] = "Xóa sách, chi tiết và hình ảnh thành công!";
                } elseif ($deleteResult === "not_found") {
                    $_SESSION['error-message'] = "Không tìm thấy sách để xóa.";
                } else {
                    $_SESSION['error-message'] = "Lỗi khi xóa sách. Kiểm tra lại dữ liệu.";
                }
            } else {
                $_SESSION['error-message'] = "Sách không tồn tại.";
            }

            header("Location: " . APP_PATH . "/seller/my_books");
            exit();
        }
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Chi tiết sản phẩm",
            "Page" => "seller/product/product_detail",
            "Book" => $this->ProductModel->getBook($Book_id),
            "Categories" => $this->CategoryModel->getCategories(),
            "BookStatus" => $this->ProductModel->getBookStatus(),
            "Publishers" => $this->UserModel->getUserRole(1),
            "Authors" => $this->AuthorModel->getAllAuthors(),
        ]);
    }

    function my_orders()
    {
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Danh sách đơn hàng",
            "Page" => "seller/order/my_orders",
            "script" => ["orders/orders"],

        ]);
    }
    function my_news()
    {
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Tin tức của tôi",
            "Page" => "seller/news/my_news",
            "NewsSeller" =>$this->NewsModel->getNewsSeller($_SESSION['user_Info'][0]),
        ]);
    }

    function new_detail()
    {
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Chi tiết tin tức",
            "Page" => "seller/news/new_detail",
        ]);
    }
    function add_new()
    {
        if (isset($_POST['addSellerNew'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $content1 = $_POST['content1'];
            $content2 = !empty($_POST['content2']) ? $_POST['content2'] : ""; // Nếu trống
            $current_date = $_POST['current_date'];
            $status = 2;
            $user_id = $_SESSION['user_Info'][0];

            $targetDir = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/news/";

            // Xử lý image1
            $image1 = $_FILES['image1']['name'];
            $targetFile1 = $targetDir . basename($image1);
            $imageFileType1 = strtolower(pathinfo($targetFile1, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($imageFileType1, $allowed)) {
                $_SESSION['error-message'] = "Ảnh 1 không hợp lệ";
                header("Location: " . APP_PATH . "/seller/add_new");
                exit;
            }
            // Xử lý image2 (có thể trống)
            $image2 = !empty($_FILES['image2']['name']) ? $_FILES['image2']['name'] : "";
            if (!empty($image2)) {
                $targetFile2 = $targetDir . basename($image2);
                $imageFileType2 = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));
                if (!in_array($imageFileType2, $allowed)) {
                    $_SESSION['error-message'] = "Ảnh 2 không hợp lệ";
                    header("Location: " . APP_PATH . "/seller/add_new");
                    exit;
                }
            }
            move_uploaded_file($_FILES['image1']['tmp_name'], $targetFile1);
            if (!empty($image2)) {
                move_uploaded_file($_FILES['image2']['tmp_name'], $targetFile2);
            }

            // Gọi Model
            $result = $this->NewsModel->createNews(
                $user_id,
                $title,
                $description,
                $image1,
                $content1,
                $image2,
                $content2,
                $current_date,
                $status
            );
            if ($result) {
                $_SESSION['message'] = "Thêm tin tức thành công";
                header("Location: " . APP_PATH . "/seller/add_new");
                exit;
            } else {
                $_SESSION['error-message'] = "Lỗi khi thêm tin tức";
                header("Location: " . APP_PATH . "/seller/add_new");
            }
        }
        $this->CheckModel->checkSellerPermission();
        $this->view("main_layout", [
            "Title" => "Thêm tin tức",
            "Page" => "seller/news/add_new",
        ]);
    }

}

?>