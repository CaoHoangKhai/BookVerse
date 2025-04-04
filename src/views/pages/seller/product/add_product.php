<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center mb-3 mt-3 ">THÊM SẢN PHẨM</h3>
        <ul class="nav nav-tabs" id="userTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="manual-add-tab" data-bs-toggle="tab"
                    data-bs-target="#manual-add-pane" type="button" role="tab" aria-controls="manual-add-pane"
                    aria-selected="true">
                    Thêm thủ công
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="auto-add-tab" data-bs-toggle="tab" data-bs-target="#auto-add-pane"
                    type="button" role="tab" aria-controls="auto-add-pane" aria-selected="false">
                    
                </button>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="userTabContent">
            <!-- Tab Thêm thủ công -->
            <div class="tab-pane fade show active" id="manual-add-pane" role="tabpanel" aria-labelledby="manual-add-tab"
                tabindex="0">
                <form class="row g-3 needs-validation form-add-book" method="POST" enctype="multipart/form-data"
                    novalidate>
                    <!-- Tiêu đề tên sách -->
                    <div class="col-md-6">
                        <label class="form-label fs-6"><strong>Tiêu đề tên sách</strong></label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Nhập tên sách"
                            autofocus required>
                        <div class="invalid-feedback">
                            Tiêu đề không được bỏ trống.
                        </div>
                    </div>

                    <!-- Giá -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Giá</strong></label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Nhập giá sách"
                            required min="0">
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
                        <input type="file" class="form-control" name="book_image" id="book_image" accept="image/*"
                            required>
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
                    <!-- <div class="col-md-6">
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
                    </div> -->
                    <!-- Mô tả -->
                    <div class="col-md-12">
                        <label class="form-label"><strong>Mô tả</strong></label>
                        <input class="form-control" name="description" id="description" placeholder="Nhập mô tả sách"
                            rows="8">
                        <?= trim(isset($book['Description']) ? $book['Description'] : '') ?>
                        </input>
                    </div>

                    <input type="hidden" id="current_date" name="current_date" value="<?php echo date('Y-m-d'); ?>"
                        readonly>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" name="addBook" value="Thêm Sách">
                            <i class="fas fa-plus-circle"></i>
                            Thêm Sách
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tab Thêm từ file -->
            <div class="tab-pane fade" id="auto-add-pane" role="tabpanel" aria-labelledby="auto-add-tab" tabindex="0">
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