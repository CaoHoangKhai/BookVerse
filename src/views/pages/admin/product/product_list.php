<div class="d-flex mb-3">
    <div class="dropdown me-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
            id="categoryDropdown">
            Tất cả
        </button>
        <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto; font-size: 18px;">
            <li><button class="dropdown-item category-filter" type="button" data-category="Tất cả">Tất cả</button></li>
            <?php
            if (!empty($data["Categories"])) {
                foreach ($data["Categories"] as $role) {
                    echo '<li><button class="dropdown-item category-filter" type="button" data-category="' . htmlspecialchars($role['Category_name']) . '">' . htmlspecialchars($role['Category_name']) . '</button></li>';
                }
            } else {
                echo '<li><button class="dropdown-item" type="button">Không có thông tin</button></li>';
            }
            ?>
        </ul>
    </div>
    <input type="text" id="searchBook" class="form-control me-2" placeholder="Tìm kiếm sách...">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
        style="white-space: nowrap;">
        THÊM SÁCH
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Sản Phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">
                            Thêm thủ công
                        </button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                            Thêm tự động
                        </button>
                    </div>
                </nav>
                <div class="tab-content mt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <form class="row g-3 needs-validation form-add-book" method="POST" enctype="multipart/form-data"
                            novalidate>
                            <!-- Tiêu đề tên sách -->
                            <div class="col-md-6">
                                <label class="form-label fs-6"><strong>Tiêu đề tên sách</strong></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Nhập tên sách" autofocus required>
                                <div class="invalid-feedback">
                                    Tiêu đề không được bỏ trống.
                                </div>
                            </div>

                            <!-- Giá -->
                            <div class="col-md-6">
                                <label class="form-label"><strong>Giá</strong></label>
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="Nhập giá sách" required min="0">
                                <div class="invalid-feedback">
                                    Giá không được bỏ trống và phải là số hợp lệ.
                                </div>
                            </div>
                            <!--Thể loại-->
                            <div class="col-md-6">
                                <label class="form-label"><strong>Thể loại</strong></label>
                                <select class="form-select" name="category" id="category" required>
                                    <option value="" selected>Chọn thể loại sách</option>
                                    <?php
                                    if (!empty($data["Categories"])) {
                                        foreach ($data["Categories"] as $category) {
                                            echo '<option value="' . htmlspecialchars($category["Category_id"]) . '">'
                                                . htmlspecialchars($category["Category_name"])
                                                . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Hãy chọn thể loại sách.
                                </div>
                            </div>

                            <!-- Trường ẩn để lưu Category_type -->
                            <input type="hidden" name="category_type" id="category_type">

                            <!-- Chọn Tác Giả -->
                            <div class="col-md-6">
                                <label class="form-label"><strong>Tác giả</strong></label>
                                <select class="form-select" name="author" id="author" required>
                                    <option value="" selected>Chọn tác giả</option>
                                    <?php
                                    if (!empty($data["Authors"])) {
                                        foreach ($data["Authors"] as $author) {
                                            echo '<option value="' . htmlspecialchars($author["Author_id"]) . '">' . htmlspecialchars($author["Name"]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Hãy chọn tác giả của sách.
                                </div>
                            </div>
                            <!-- Hình ảnh sách -->
                            <div class="col-md-6">
                                <label class="form-label"><strong>Hình ảnh sách</strong></label>
                                <input type="file" class="form-control" name="book_image" id="book_image"
                                    accept="image/*" required>
                                <div class="invalid-feedback">
                                    Hãy tải lên hình ảnh của sách.
                                </div>
                            </div>

                            <!-- Trạng thái sách -->
                            <div class="col-md-6">
                                <label class="form-label"><strong>Trạng thái</strong></label>
                                <select class="form-select" name="status" id="status" required>
                                    <?php
                                    if (!empty($data["BookStatus"])) {
                                        foreach ($data["BookStatus"] as $status) {
                                            echo '<option value="' . htmlspecialchars($status["Status_id"]) . '">' . htmlspecialchars($status["Status_name"]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Hãy chọn trạng thái sách.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><strong>Nhà xuất bản</strong></label>
                                <select class="form-select" name="publisher" id="publisher" required>
                                    <option value="" selected>Chọn nhà xuất bản</option>
                                    <?php
                                    if (!empty($data["Publishers"])) {
                                        foreach ($data["Publishers"] as $publisher) {
                                            echo '<option value="' . htmlspecialchars($publisher["User_id"]) . '">' . htmlspecialchars($publisher["Full_Name"]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Hãy chọn nhà xuất bản của sách.
                                </div>
                            </div>
                            <!-- Mô tả -->
                            <div class="col-md-12">
                                <label class="form-label"><strong>Mô tả</strong></label>
                                <input class="form-control" name="description" id="description"
                                    placeholder="Nhập mô tả sách" rows="8">
                                <?= trim(isset($book['Description']) ? $book['Description'] : '') ?>
                                </input>
                            </div>

                            <input type="hidden" id="current_date" name="current_date"
                                value="<?php echo date('Y-m-d'); ?>" readonly>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit" class="btn btn-primary" name="addBook" value="Thêm Sách">
                                    Thêm Sách
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Tab thêm từ file -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        <!-- Form để thêm từ file -->
                        <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                            <!-- Trường Mật khẩu của Admin -->
                            <div class="col-md-12 mb-2">
                                <label for="inputPassword4" class="form-label">
                                    <strong>
                                        Mật khẩu của Admin*
                                    </strong>
                                </label>
                                <input type="password" class="form-control" name="admin_password" id="inputPassword4"
                                    placeholder="Nhập mật khẩu của bạn" required>
                                <input type="hidden" class="form-control" name="email"
                                    value="<?php echo isset($_SESSION['user_Info'][1]) ? $_SESSION['user_Info'][1] : ''; ?>"
                                    readonly>
                                <div class="invalid-feedback">
                                    Mật khẩu không được bỏ trống.
                                </div>
                            </div>


                            <!-- Trường chọn file -->
                            <div class="col-md-12 mb-2">
                                <label for="formFileMultiple" class="form-label">Chọn Hình Ảnh</label>
                                <input class="form-control" type="file" id="formFileMultiple" name="files[]" multiple
                                    accept="image/*">
                            </div>
                            <!-- Khu vực hiển thị ảnh -->
                            <div id="previewContainer" class="d-flex flex-wrap mt-3"></div>
                            <div class="mb-4 link-hover">
                                <em>Vui lòng soạn người dùng theo đúng định dạng.
                                    <a href="/<?= APP_PATH ?>/public/sample_file/danh_sach_sp.xlsx"
                                        class="text-decoration-none">
                                        Tải về file mẫu Excel
                                    </a>
                                </em>
                            </div>
                            <!-- Nút lưu -->
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="uploadBooks" value="Tải lên">
                                    <i class="fa fa-cloud-arrow-up"></i>
                                    Thêm vào hệ thống
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Table-->
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="col">ID</th>
            <th scope="col" class="col-2">Tiêu đề sách</th>
            <th scope="col" class="col">Hình ảnh</th>
            <th scope="col" class="col">Tác giả</th>
            <th scope="col" class="col">Thể loại</th>
            <th scope="col" class="col">Số lượng</th>
            <th scope="col" class="col-1">Giá</th>
            <th scope="col" class="col-1">Ngày đăng</th>
            <th scope="col" class="col-1">Trạng thái</th>
            <th scope="col" class="col-1">Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody id="bookTable">
        <?php
        $counter = 1;
        foreach ($data["Books"] as $books):
            ?>
            <tr>
                <td><?= $counter++; ?></td>
                <td><?= (mb_strlen($books["Title"], 'UTF-8') > 30) ? mb_substr($books["Title"], 0, 30, 'UTF-8') . '...' : $books["Title"] ?>
                </td>
                <td>
                    <img src="<?php echo $this->image_books($books["Category_type"], $books["Images"][0]); ?>"
                        alt="<?= $books["Title"] ?>" width="60" height="80"
                        style="border: none; padding: 0; margin: 0; object-fit: cover; background-color: transparent;">
                </td>

                <td><?= $books["Author_Name"] ?></td>
                <td><?= $books["Category_name"] ?></td>
                <td><?= $books["quantity"] ?></td>
                <td><?= number_format($books["Price"], 0, ',', '.') ?> đ</td>
                <td>
                    <?php
                    $date = new DateTime($books['Date_added']);
                    echo $date->format('d/m/Y');
                    ?>
                </td>
                <td>
                    <span class="badge 
                        <?php
                        switch ($books['Status_id']) {
                            case 1:
                                echo 'bg-success'; // Còn hàng
                                break;
                            case 2:
                                echo 'bg-secondary'; // Hết hàng
                                break;
                            case 3:
                                echo 'bg-dark'; // Ngừng kinh doanh
                                break;
                            case 4:
                                echo 'bg-warning'; // Đang cập nhật
                                break;
                            default:
                                echo 'bg-secondary'; // Màu mặc định nếu không có trạng thái
                                break;
                        }
                        ?>
                    ">
                        <?= $books['Status'] ?>
                    </span>
                </td>
                <td style="white-space: nowrap;">
                    <a href="<?= APP_PATH ?>/admin/product_detail/<?= $books["Book_id"]; ?>"
                        class="btn btn-primary me-2 d-inline-flex align-items-center"
                        style="width: auto; padding: 8px 12px;">
                        <i class="fa fa-pencil fa-lg me-2"></i> Chỉnh Sửa
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>