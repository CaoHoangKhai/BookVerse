<?php
use Shuchkin\SimpleXLSX;
class Admin extends Controller
{
    private $CheckRole;
    private $UserModel;
    private $AuthModel;
    private $CheckModel;
    private $CommonModel;
    private $DashboardAdmin;
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
        $this->DashboardAdmin = $this->model("DashboardAdmin");
        $this->ProductModel = $this->model("ProductModel");
        $this->CategoryModel = $this->model("CategoryModel");
        $this->AuthorModel = $this->model("AuthorModel");
        $this->OrderModel = $this->model("OrderModel");
        $this->NewsModel = $this->model("NewsModel");
    }
    function dashboard()
    {
        //$this->CheckModel->checkAdminPermission();
        $this->view("main_layout", [
            "Title" => "Trang Tổng Quan",
            "Page" => "admin/dashboard",
            "CountUser" => $this->DashboardAdmin->getCountsUser(),
            "CountBook" => $this->DashboardAdmin->getCountsBook(),
            "SumOrder" => $this->DashboardAdmin->getTotalRevenue(),
            "CountOrder" => $this->DashboardAdmin->getCountOrder(),
            "NewOrder" => $this->DashboardAdmin->getNewOrderAdmin(),
            "BestSell" => $this->DashboardAdmin->getBestSellingBooks(),
            "getTotalRevenueByDate" => $this->DashboardAdmin->getTotalRevenueByDate(),
            "OrderPercentage" => $this->DashboardAdmin->getOrderStatusStatistics(),
        ]);
    }
    function users_list()
    {
        //$this->CheckModel->checkAdminPermission();
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
            "Page" => "admin/auth/users_list",
            "Script" => [
                "auth/register",
                "users/users_list"
            ],
            "Users" => $this->UserModel->getUserRole(0),
        ]);
    }
    function user_detail($User_id)
    {
        //$this->CheckModel->checkAdminPermission();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
            $fullname = $_POST['username'];
            $phonenumber = $_POST['phonenumber'];
            $email = $_POST['email'];
            $role_id = $_POST['role_id'];
            $status = $_POST['status'];
            // Lấy thông tin người dùng hiện tại
            $oldUser = $this->UserModel->getUserById($User_id);

            if ($email !== $oldUser['Email']) { // Chỉ kiểm tra nếu email bị thay đổi
                if (!$this->UserModel->isValidEmail($email)) {
                    $_SESSION['error-message'] = "Email không đúng định dạng.";
                    header("Location: " . APP_PATH . "/admin/user_detail/$User_id");
                    exit();
                }

                // Kiểm tra xem email có tồn tại không
                $existingEmail = $this->AuthModel->getByEmail($email);
                if ($existingEmail && $existingEmail['User_id'] != $User_id) {
                    $_SESSION['error-message'] = "Email đã tồn tại!";
                    header("Location: " . APP_PATH . "/admin/user_detail/$User_id");
                    exit();
                }
            }


            // Kiểm tra số điện thoại nếu thay đổi
            if ($phonenumber !== $oldUser['Phone_Number']) { // Chỉ kiểm tra nếu số điện thoại bị thay đổi
                if (!$this->UserModel->isValidPhoneNumber($phonenumber)) {
                    $_SESSION['error-message'] = "Số điện thoại không đúng định dạng.";
                    header("Location: " . APP_PATH . "/admin/user_detail/$User_id");
                    exit();
                }

                // Kiểm tra nếu số điện thoại đã tồn tại và khác số hiện tại
                $existingPhone = $this->AuthModel->checkPhoneNumber($phonenumber);
                if ($existingPhone && $existingPhone['User_id'] != $User_id) {
                    $_SESSION['error-message'] = "Số điện thoại đã tồn tại!";
                    header("Location: " . APP_PATH . "/admin/user_detail/$User_id");
                    exit();
                }
            }

            // Cập nhật thông tin người dùng
            $updateResult = $this->UserModel->updateUser($User_id, $fullname, $phonenumber, $email, $role_id, $status);
            if ($updateResult === true) {
                $_SESSION['message'] = "Cập nhật thông tin thành công!";
            } elseif ($updateResult === "no_changes") {
                $_SESSION['error-message'] = "Không có gì thay đổi.";
            } else {
                $_SESSION['error-message'] = "Có lỗi xảy ra khi cập nhật thông tin.";
            }
            header("Location: " . APP_PATH . "/admin/user_detail/$User_id");
            exit();
        }
        $this->view("main_layout", [
            "Title" => "Danh Sách Người Dùng",
            "Page" => "admin/auth/user_detail",
            "User" => $this->UserModel->getUserById($User_id),
            "AllRole" => $this->CommonModel->getAllRole(),
            "Status" => $this->CommonModel->getAllStatus()
        ]);
    }
    function sellers_list()
    {
        //$this->CheckModel->checkAdminPermission();
        $this->view("main_layout", [
            "Title" => "Danh sách nhà xuất bản",
            "Page" => "admin/auth/sellers_list",
            "Sellers" => $this->UserModel->getUserRole(1),
        ]);
    }
    function add_user()
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
                header("Location: " . APP_PATH . "/admin/add_user");
                exit();
            }
            if (!$this->UserModel->isValidPhoneNumber($phonenumber)) {
                $_SESSION['error-message'] = "Số điện thoại không đúng định dạng.";
                header("Location: " . APP_PATH . "/admin/add_user");
                exit();
            }
            $existingEmail = $this->AuthModel->getByEmail($email);
            if ($existingEmail) {
                $_SESSION['error-message'] = "Email đã tồn tại!";
                header("Location: " . APP_PATH . "/admin/add_user");
                exit();
            }
            $existingPhone = $this->AuthModel->checkPhoneNumber($phonenumber);
            if ($existingPhone) {
                $_SESSION['error-message'] = "Số điện thoại đã tồn tại!";
                header("Location: " . APP_PATH . "/admin/add_user");
                exit();
            }
            $result = $this->AuthModel->create($fullname, $password, $phonenumber, $email, $city, $district, $address);
            if ($result === true) {
                $_SESSION['message'] = "Thêm Người Dùng Thành Công";
            } else {
                $_SESSION['error-message'] = "Thêm Người Dùng Thất Bại: " . $result;
            }
            header("Location: " . APP_PATH . "/admin/add_user");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uploadUsers'])) {
            $password = $_POST['admin_password'];
            $email = $_POST['email'];
            $user = $this->AuthModel->login($email, $password);
            if ($user) {
                if (empty($_FILES['files']['name'][0])) {
                    $_SESSION['error-message'] = "❌ Bạn phải chọn ít nhất một file để tải lên.";
                    header("Location: " . APP_PATH . "/admin/add_user");
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
            header("Location: " . APP_PATH . "/admin/add_user");
            exit();
        }
        $this->view("main_layout", [
            "Title" => "Danh sách nhà xuất bản",
            "Page" => "admin/auth/add_user",
            "Script" => [
                "auth/register",
                "auth/login",
            ]
        ]);
    }
    function products_list()
    {
        $this->CheckModel->checkAdminPermission();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBook'])) {
            $title = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $author = $_POST['author'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $date = $_POST["current_date"];
            $publisher = $_POST["publisher"];
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uploadBooks'])) {
            $password = $_POST['admin_password'];
            $email = $_POST['email'];
            $user = $this->UserModel->login($email, $password);

            if ($user) {
                $_SESSION['message'] = "Nhận diện mật khẩu thành công!";
                header("Location: " . APP_PATH . "/admin/products_list");
                exit();
            } else {
                $_SESSION['error-message'] = "Vui lòng nhập mật khẩu!!!!!!";
                header("Location: " . APP_PATH . "/admin/products_list");
                exit();
            }
        }
        $this->view("main_layout", [
            "Title" => "Danh sách nhà xuất bản",
            "Page" => "admin/product/product_list",
            "Script" => [
                "products/product_list",
                "auth/login"
            ],
            "Books" => $this->ProductModel->getBooks(),
            "Categories" => $this->ProductModel->getCategories(),
            "BookStatus" => $this->ProductModel->getBookStatus(),
            "Publishers" => $this->UserModel->getUserRole(1),
            "Authors" => $this->AuthorModel->getAllAuthors(),



        ]);
    }
    function product_detail($Book_id)
    {
        $this->CheckModel->checkAdminPermission();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editBook'])) {
            $Book_id = $_POST["Book_id"];
            $title = $_POST["title"];
            $price = $_POST["price"];
            $category = $_POST["category"];
            $author = $_POST["author"];
            $User_id = $_POST["publisher"];
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
            header("Location: " . APP_PATH . "/admin/product_detail/$Book_id");
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
            header("Location: " . APP_PATH . "/admin/product_detail/$Book_id");
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

            header("Location: " . APP_PATH . "/admin/products_list");
            exit();
        }
        $this->view("main_layout", [
            "Title" => "Chi tiết sản phẩm",
            "Page" => "admin/product/product_detail",
            "Book" => $this->ProductModel->getBook($Book_id),
            "Categories" => $this->CategoryModel->getCategories(),
            "BookStatus" => $this->ProductModel->getBookStatus(),
            "Publishers" => $this->UserModel->getUserRole(1),
            "Authors" => $this->AuthorModel->getAllAuthors(),
        ]);
    }
    function add_product()
    {
        $this->CheckModel->checkAdminPermission();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBook'])) {
            $title = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $author = $_POST['author'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $date = $_POST["current_date"];
            $publisher = $_POST["publisher"];
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
        $this->view("main_layout", [
            "Title" => "Thêm sản phẩm",
            "Page" => "admin/product/add_product",
            "Script" => [
                "auth/login"
            ],
            "Categories" => $this->CategoryModel->getCategories(),
            "BookStatus" => $this->ProductModel->getBookStatus(),
            "Publishers" => $this->UserModel->getUserRole(1),
            "Authors" => $this->AuthorModel->getAllAuthors(),

        ]);
    }
    function orders_list()
    {
        $Orders = $this->OrderModel->getOrders();
        foreach ($Orders as &$order) {
            $order['City_Order'] = $this->UserModel->getLocationName($order['City_Code']);
            $order['District_Order'] = $this->UserModel->getLocationName($order['City_Code'], $order['District_Code']);
        }
        $this->view("main_layout", [
            "Title" => "Danh sách Đơn Hàng",
            "Page" => "admin/order/order_list",
            "Script" => ["orders/orders"],
            "Orders" => $Orders,
            "OrdersStatus" => $this->OrderModel->getOrderStatus(),
        ]);
    }
    function order_detail($Order_id)
    {
        //$this->CheckModel->checkAdminPermission();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateOrderStatus'])) {
            if (!empty($_POST["order_id"]) && !empty($_POST["order_status"])) {
                $order_id = intval($_POST["order_id"]);
                $order_status = intval($_POST["order_status"]);


                $updateStatus = $this->OrderModel->updateOrderStatus($order_status, $order_id);

                if ($updateStatus) {
                    $_SESSION['message'] = "Cập nhật trạng thái đơn hàng thành công!";
                } else {
                    $_SESSION['error-message'] = "Có lỗi xảy ra, vui lòng thử lại!";
                }
            } else {
                $_SESSION['error-message'] = "Thiếu thông tin đơn hàng hoặc trạng thái!";
            }
            header("Location: " . APP_PATH . "/admin/order_detail/$order_id");
            exit(); // Đảm bảo không chạy tiếp code khác
        }
        $OrderDetail = $this->OrderModel->getOrderDetail($Order_id);
        $OrderDetail['City_Order'] = $this->UserModel->getLocationName($OrderDetail['City_Code']);
        $OrderDetail['District_Order'] = $this->UserModel->getLocationName($OrderDetail['City_Code'], $OrderDetail['District_Code']);
        $this->view("main_layout", [
            "Title" => "Chi Tiết Đơn Hàng",
            "Page" => "admin/order/order_detail",
            "Order" => $OrderDetail,
            "Status" => $this->OrderModel->getOrderStatus(),
        ]);
    }
    function authors_list()
    {
        //$this->CheckModel->checkAdminPermission();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addAuthor'])) {
            $authorName = trim($_POST["author_name"]);
            $biography = trim($_POST["biography"]);
            $date_of_birth = trim($_POST["date_of_birth"]);
            $nationality = trim($_POST["nationality"]);
            $image = null;
            if (isset($_FILES["author_image"]) && $_FILES["author_image"]["error"] == 0) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/authors/";
                $fileName = basename($_FILES["author_image"]["name"]);
                $imagePath = $uploadDir . $fileName;
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    if (move_uploaded_file($_FILES["author_image"]["tmp_name"], $imagePath)) {
                        $image = $fileName;
                    } else {
                        $_SESSION['error-message'] = "Lỗi khi di chuyển ảnh!";
                    }
                } else {
                    $_SESSION['error-message'] = "Định dạng ảnh không hợp lệ!";
                }
            }

            $author_id = $this->AuthorModel->createAuthor($authorName, $biography, $date_of_birth, $nationality, $image);
            $_SESSION['message'] = $author_id ? "Thêm tác giả thành công!" : "Lỗi khi thêm tác giả.";
            header("Location: " . APP_PATH . "/admin/authors_list");
            exit();
        }
       
        $this->view("main_layout", [
            "Title" => "Danh sách Tác Giả",
            "Page" => "admin/author/author_list",
            "Script" => ["authors/authors", "auth/login"],
            "Nationality" => $this->CommonModel->getNationality(),
            "Authors" => $this->AuthorModel->getAllAuthors(),
        ]);
    }
    function author_detail($Author_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_author'])) {
            $author_name = $_POST["author_name"];
            $biography = $_POST["biography"];
            $date_of_birth = $_POST["date_of_birth"];
            $nationality = $_POST["nationality"];

            if ($_FILES["author_image"]["error"] === 0) {
                $author_image = $_FILES["author_image"];
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $file_mime_type = mime_content_type($author_image["tmp_name"]);

                if (!in_array($file_mime_type, $allowed_types)) {
                    $_SESSION['error-message'] = "Chỉ cho phép tải lên tệp hình ảnh (JPEG, PNG, GIF, WebP).";
                    header("Location: " . APP_PATH . "/admin/author_detail/$Author_id");
                    exit;
                }

                $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/" . APP_PATH . "/public/media/photos/authors/";
                $target_file = $target_dir . basename($author_image["name"]);

                if (move_uploaded_file($author_image["tmp_name"], $target_file)) {
                    $img_author = basename($author_image["name"]);
                } else {
                    $_SESSION['error-message'] = "Có lỗi khi tải lên hình ảnh.";
                    header("Location: " . APP_PATH . "/admin/author_detail/$Author_id");
                    exit;
                }
            } else {
                $img_author = $_POST['Img_Author'];
            }
            $result = $this->AuthorModel->updateAuthor($Author_id, $author_name, $biography, $date_of_birth, $nationality, $img_author);

            if ($result) {
                $_SESSION['message'] = "Cập nhật tác giả thành công!";
            } else {
                $_SESSION['error-message'] = "Cập nhật tác giả thất bại!";
            }

            header("Location: " . APP_PATH . "/admin/author_detail/$Author_id");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_author'])) {
            $author_id = $Author_id;
            $result = $this->AuthorModel->deleteAuthor($author_id);
            if ($result) {
                $_SESSION['message'] = "Xóa tác giả và hình ảnh thành công!";
            } else {
                $_SESSION['error-message'] = "Xóa tác giả thất bại!";
            }
            header("Location: " . APP_PATH . "/admin/authors_list");
            exit();
        }

        $this->CheckModel->checkAdminPermission();
        $this->view("main_layout", [
            "Title" => "Danh sách tác giả",
            "Page" => "admin/author/author_detail",
            "Author" => $this->AuthorModel->getAuthor($Author_id),
            "Books" => $this->AuthorModel->getBooksByAuthorId($Author_id),
            "Nationality" => $this->CommonModel->getNationality(),
        ]);
    }
    function add_author()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addAuthor'])) {
            $authorName = trim($_POST["author_name"]);
            $biography = trim($_POST["biography"]);
            $date_of_birth = trim($_POST["date_of_birth"]);
            $nationality = trim($_POST["nationality"]);
            $image = null;
            if (isset($_FILES["author_image"]) && $_FILES["author_image"]["error"] == 0) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/authors/";
                $fileName = basename($_FILES["author_image"]["name"]);
                $imagePath = $uploadDir . $fileName;
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    if (move_uploaded_file($_FILES["author_image"]["tmp_name"], $imagePath)) {
                        $image = $fileName;
                    } else {
                        $_SESSION['error-message'] = "Lỗi khi di chuyển ảnh!";
                    }
                } else {
                    $_SESSION['error-message'] = "Định dạng ảnh không hợp lệ!";
                }
            }

            $author_id = $this->AuthorModel->createAuthor($authorName, $biography, $date_of_birth, $nationality, $image);
            $_SESSION['message'] = $author_id ? "Thêm tác giả thành công!" : "Lỗi khi thêm tác giả.";
            header("Location: " . APP_PATH . "/admin/add_author");
            exit();
        }

        $this->CheckModel->checkAdminPermission();
        $this->view("main_layout", [
            "Title" => "Danh sách Tác Giả",
            "Page" => "admin/author/add_author",
            "Script" => ["auth/login"],
            "Nationality" => $this->CommonModel->getNationality(),
        ]);
    }
    function news_list()
    {
        //$this->CheckModel->checkAdminPermission();
        $this->view("main_layout", [
            "Title" => "Danh sách Tin Tức",
            "Page" => "admin/news/news_list",
            "Script" => ["news/news_list"],
            "News" => $this->NewsModel->getNewsAdmin(),
        ]);
    }
    function add_news()
    {
        if (isset($_POST['addNews'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $content1 = $_POST['content1'];
            $content2 = !empty($_POST['content2']) ? $_POST['content2'] : ""; // Nếu trống
            $current_date = $_POST['current_date'];
            $status = isset($_POST['status']) ? $_POST['status'] : 0;
            $user_id = $_SESSION['user_Info'][0];

            $targetDir = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/news/";

            // Xử lý image1
            $image1 = $_FILES['image1']['name'];
            $targetFile1 = $targetDir . basename($image1);
            $imageFileType1 = strtolower(pathinfo($targetFile1, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($imageFileType1, $allowed)) {
                $_SESSION['error-message'] = "Ảnh 1 không hợp lệ";
                header("Location: " . APP_PATH . "/admin/add_news");
                exit;
            }

            // Xử lý image2 (có thể trống)
            $image2 = !empty($_FILES['image2']['name']) ? $_FILES['image2']['name'] : "";
            if (!empty($image2)) {
                $targetFile2 = $targetDir . basename($image2);
                $imageFileType2 = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));
                if (!in_array($imageFileType2, $allowed)) {
                    $_SESSION['error-message'] = "Ảnh 2 không hợp lệ";
                    header("Location: " . APP_PATH . "/admin/add_news");
                    exit;
                }
            }

            // Upload ảnh
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
                header("Location: " . APP_PATH . "/admin/add_news");
                exit;
            } else {
                $_SESSION['error-message'] = "Lỗi khi thêm tin tức";
                header("Location: " . APP_PATH . "/admin/add_news");
            }
        }

        // Gọi view
        $this->CheckModel->checkAdminPermission();
        $this->view("main_layout", [
            "Title" => "Thêm Tin Tức",
            "Page" => "admin/news/add_news",
            "Script" => ["auth/login"]
        ]);
    }

    function new_detail($New_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateNews'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $content1 = $_POST['content1'];
            $content2 = !empty($_POST['content2']) ? $_POST['content2'] : "";
            $current_date = $_POST['current_date'];
            $status = isset($_POST['status']) ? $_POST['status'] : 0;

            $targetDir = $_SERVER['DOCUMENT_ROOT'] . APP_PATH . "/public/media/photos/news/";
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            // Lấy dữ liệu hiện tại từ DB
            $currentNews = $this->NewsModel->getNewByAdminId($New_id);
            $image1 = $currentNews['image_1'];
            $image2 = $currentNews['image_2'];

            // Xử lý image1 nếu có upload mới
            if (!empty($_FILES['image1']['name'])) {
                $image1_name = $_FILES['image1']['name'];
                $targetFile1 = $targetDir . basename($image1_name);
                $imageFileType1 = strtolower(pathinfo($targetFile1, PATHINFO_EXTENSION));

                if (!in_array($imageFileType1, $allowed)) {
                    $_SESSION['error-message'] = "Ảnh 1 không hợp lệ";
                    header("Location: " . APP_PATH . "/admin/new_detail/$New_id");
                    exit;
                }

                move_uploaded_file($_FILES['image1']['tmp_name'], $targetFile1);
                $image1 = $image1_name; // Cập nhật lại biến
            }

            // Xử lý image2 nếu có upload mới
            if (!empty($_FILES['image2']['name'])) {
                $image2_name = $_FILES['image2']['name'];
                $targetFile2 = $targetDir . basename($image2_name);
                $imageFileType2 = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));

                if (!in_array($imageFileType2, $allowed)) {
                    $_SESSION['error-message'] = "Ảnh 2 không hợp lệ";
                    header("Location: " . APP_PATH . "/admin/new_detail/$New_id");
                    exit;
                }

                move_uploaded_file($_FILES['image2']['tmp_name'], $targetFile2);
                $image2 = $image2_name;
            }

            // Gọi model cập nhật
            $result = $this->NewsModel->updateNews(
                $New_id,
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
                $_SESSION['message'] = "Cập nhật tin tức thành công";
                header("Location: " . APP_PATH . "/admin/new_detail/$New_id");
                exit;
            } else {
                $_SESSION['error-message'] = "Lỗi khi cập nhật tin tức";
                header("Location: " . APP_PATH . "/admin/new_detail/$New_id");
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteNews'])) {
            $this->NewsModel->deleteNews($New_id);
            $_SESSION['message'] = "Xóa tin tức thành công";
            header("Location: " . APP_PATH . "/admin/news_list");
            exit;
        }

        $this->CheckModel->checkAdminPermission();
        $this->view("main_layout", [
            "Title" => "Chi tiết Tin Tức",
            "Page" => "admin/news/new_detail",
            "Script" => ["news/news_list"],
            "NewById" => $this->NewsModel->getNewByAdminId($New_id),
        ]);
    }
}
?>