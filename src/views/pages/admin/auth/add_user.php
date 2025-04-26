<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center mb-3 mt-3 ">THÊM NGƯỜI DÙNG</h3>
        <ul class="nav nav-tabs" id="userTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="manual-add-tab" data-bs-toggle="tab"
                    data-bs-target="#manual-add-pane" type="button" role="tab" aria-controls="manual-add-pane"
                    aria-selected="true">
                    Thêm thủ công
                </button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="auto-add-tab" data-bs-toggle="tab" data-bs-target="#auto-add-pane"
                    type="button" role="tab" aria-controls="auto-add-pane" aria-selected="false">
                    Thêm từ file
                </button>
            </li> -->
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="userTabContent">
            <!-- Tab Thêm thủ công -->
            <div class="tab-pane fade show active" id="manual-add-pane" role="tabpanel" aria-labelledby="manual-add-tab"
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

                    <div class="modal-footer d-flex justify-content-start">
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary ms-2" name="addUser" value="Thêm Người Dùng">
                            Thêm Người Dùng
                        </button>
                    </div>
                </form>
            </div>
            <!-- Tab Thêm từ file -->
            <div class="tab-pane fade" id="auto-add-pane" role="tabpanel" aria-labelledby="auto-add-tab" tabindex="0">
                <form class="row g-3 needs-validation" method="POST" novalidate>
                    <div class="col-md-12 mb-3">
                        <label for="inputPassword4" class="form-label"><strong>Mật khẩu của
                                Admin*</strong></label>
                        <input type="password" class="form-control" name="admin_password" id="inputPassword4"
                            placeholder="Nhập mật khẩu của bạn" required>
                        <div class="invalid-feedback">Mật khẩu không được bỏ trống.</div>
                    </div>
                    
                    <!-- Hiển thị giá trị từ session nếu có -->
                    <input type="hidden" class="form-control" name="email"
                        value="<?php echo isset($_SESSION['user_Info'][1]) ? $_SESSION['user_Info'][1] : ''; ?>"
                        readonly>


                    <div class="col-md-12 mb-3">
                        <label for="formFileMultiple" class="form-label"><strong>Nội dung*</strong></label>
                        <input class="form-control mt-2" type="file" id="formFileMultiple" name="files[]" multiple
                            accept=".xlsx, .xls" required>
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