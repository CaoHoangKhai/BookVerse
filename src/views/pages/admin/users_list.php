<div class="d-flex mb-3">
    <input type="text" id="searchInput" class="form-control me-2" placeholder="Tìm kiếm người dùng...">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
        style="white-space: nowrap;">
        THÊM NGƯỜI DÙNG
    </button>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Người Dùng</h5>
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
                            Thêm từ file
                        </button>
                    </div>
                </nav>
                <div class="tab-content mt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <form class="row g-3 needs-validation form-add-user" method="POST" novalidate>
                            <!-- Trường Họ và tên -->
                            <div class="col-md-6">
                                <label class="form-label fs-6 mb-1"><strong>Họ và tên*</strong></label>
                                <input type="text" class="form-control mb-2" name="username" id="fullname"
                                    placeholder="Họ tên của bạn" autofocus required>
                                <div class="invalid-feedback">
                                    Họ và tên không được bỏ trống.
                                </div>
                            </div>

                            <!-- Trường Mật khẩu -->
                            <div class="col-md-6">
                                <label class="form-label mb-1"><strong>Password</strong></label>
                                <input type="password" class="form-control mb-2" name="password" id="inputPassword4"
                                    placeholder="Nhập mật khẩu của bạn" required>
                                <div class="invalid-feedback">
                                    Password không được bỏ trống.
                                </div>
                            </div>

                            <!-- Trường Số điện thoại -->
                            <div class="col-md-6">
                                <label class="form-label mb-1"><strong>Số điện thoại*</strong></label>
                                <input type="text" class="form-control mb-2" name="phonenumber" id="inputNumber4"
                                    placeholder="Số điện thoại của bạn" required>
                                <div id="phoneFeedback" class="invalid-feedback">
                                    Số điện thoại không hợp lệ. Hãy nhập số điện thoại theo định dạng chính xác.
                                </div>
                                <div id="phoneEmptyFeedback" class="invalid-feedback">
                                    Số điện thoại không được bỏ trống.
                                </div>
                            </div>

                            <!-- Trường Email -->
                            <div class="col-md-6">
                                <label class="form-label mb-1"><strong>Email*</strong></label>
                                <input type="email" class="form-control mb-2" name="email" id="inputEmail4"
                                    placeholder="Email của bạn" required>
                                <div class="invalid-feedback">
                                    Email không được bỏ trống.
                                </div>
                            </div>

                            <!-- Trường Tỉnh/Thành phố -->
                            <div class="col-md-6">
                                <label class="form-label mb-1"><strong>Tỉnh/Thành phố*</strong></label>
                                <select class="form-select mb-2" name="city" id="city" required>
                                    <option selected value="">Chọn Tỉnh/Thành phố của bạn</option>
                                    <!-- Thêm danh sách các tỉnh/thành phố -->
                                </select>
                                <div class="invalid-feedback">
                                    Hãy chọn một tỉnh/thành phố hợp lệ.
                                </div>
                            </div>

                            <!-- Trường Quận/Huyện -->
                            <div class="col-md-6">
                                <label class="form-label mb-1"><strong>Quận/Huyện*</strong></label>
                                <select class="form-select mb-2" name="district" id="district" required>
                                    <option selected value="">Chọn Quận/Huyện của bạn</option>
                                    <!-- Thêm danh sách các quận/huyện -->
                                </select>
                                <div class="invalid-feedback">
                                    Hãy chọn một quận/huyện hợp lệ.
                                </div>
                            </div>

                            <!-- Trường Địa chỉ -->
                            <div class="col-md-6">
                                <label class="form-label mb-1"><strong>Địa chỉ*</strong></label>
                                <input type="text" class="form-control mb-2" name="address" id="inputAddress"
                                    placeholder="Nhập địa chỉ của bạn VD:Số 20, ngõ 90" required>
                                <div class="invalid-feedback">
                                    Địa chỉ không được bỏ trống.
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit" class="btn btn-primary" name="addUser" value="Thêm Người Dùng">
                                    Thêm Người Dùng
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tab thêm từ file -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        <!-- Form để thêm từ file -->
                        <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                            <div class="col-md-12 mb-3">
                                <label for="inputPassword4" class="form-label"><strong>Mật khẩu của
                                        Admin*</strong></label>
                                <input type="password" class="form-control" name="admin_password" id="inputPassword4"
                                    placeholder="Nhập mật khẩu của bạn" required>

                                <div class="invalid-feedback">Mật khẩu không được bỏ trống.</div>
                            </div><!-- Hiển thị giá trị từ session nếu có -->
                            <input type="hidden" class="form-control" name="email"
                                value="<?php echo isset($_SESSION['user_Info'][1]) ? $_SESSION['user_Info'][1] : ''; ?>"
                                readonly>


                            <div class="col-md-12 mb-3">
                                <label for="formFileMultiple" class="form-label"><strong>Nội dung*</strong></label>
                                <input class="form-control mt-2" type="file" id="formFileMultiple" name="files[]"
                                    multiple accept=".xlsx, .xls" required>
                                <div class="invalid-feedback">Bạn phải chọn ít nhất một file để tải lên.</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <em>Vui lòng soạn người dùng theo đúng định dạng. <a
                                        href="<?= APP_PATH ?>/public/sample_file/danh_sach_kh.xlsx"
                                        class="text-decoration-none">Tải về file mẫu XLSX</a></em>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="uploadUsers">
                                    <i class="fa fa-cloud-arrow-up"></i> Thêm vào hệ thống
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_SESSION['parsed_data'])): ?>
    <div id="result-container" class="mt-3">
        <?php
        echo $_SESSION['parsed_data'];
        unset($_SESSION['parsed_data']); // Xóa session sau khi hiển thị
        ?>
    </div>

    <script>
        // Sau 10 giây (10000ms) ẩn div kết quả
        setTimeout(function () {
            document.getElementById("result-container").style.display = "none";
        }, 10000);
    </script>
<?php endif; ?>
<!-- Table -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ và Tên</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Chỉnh Sửa</th>
        </tr>
    </thead>
    <tbody id="list-user">
        <?php $counter = 1;
        foreach ($data["Users"] as $users): ?>
            <tr>
                <td><?= $counter++; ?></td>
                <td class="searchable"><?= $users["Full_Name"] ?> </td> <!-- Thêm class này -->
                <td><?= $users["Phone_Number"] ?></td>
                <td><?= $users["Email"] ?></td>
                <td><?= $users["Status_Name"] ?></td>
                <td>
                    <a href="<?= APP_PATH ?>/admin/user_detail/<?= $users['User_id']; ?>" class="btn btn-primary me-2">
                        <i class="fa fa-pencil"></i> Chỉnh sửa
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>