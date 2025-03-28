<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center mb-3 mt-3 ">THÊM TÁC GIẢ</h3>
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
                    <!-- Thêm từ file -->
                </button>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="userTabContent">
            <!-- Tab Thêm thủ công -->
            <div class="tab-pane fade show active" id="manual-add-pane" role="tabpanel" aria-labelledby="manual-add-tab"
                tabindex="0">
                <form class="row g-3 needs-validation" method="POST" action="" novalidate enctype="multipart/form-data">
                    <!-- Trường Tên tác giả -->
                    <div class="col-md-6">
                        <label class="form-label fs-6"><strong>Tên tác giả*</strong></label>
                        <input type="text" class="form-control" name="author_name" id="author_name"
                            placeholder="Nhập tên tác giả" required>
                        <div class="invalid-feedback">
                            Tên tác giả không được bỏ trống.
                        </div>
                    </div>

                    <!-- Trường Quốc tịch -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Quốc tịch</strong></label>
                        <select class="form-control select2" name="nationality" id="nationality" required>
                            <option value="">Chọn quốc tịch</option>
                            <?php foreach ($data["Nationality"] as $nation): ?>
                                <option value="<?= $nation['id'] ?>"><?= $nation['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Quốc tịch không được bỏ trống.</div>
                    </div>

                    <!-- Trường Ngày sinh -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Ngày sinh</strong></label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required>
                        <div class="invalid-feedback">
                            Ngày sinh không được bỏ trống.
                        </div>
                    </div>

                    <!-- Trường Hình ảnh tác giả -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Hình ảnh tác giả</strong></label>
                        <input type="file" class="form-control" name="author_image" id="author_image" accept="image/*"
                            required>
                        <div class="invalid-feedback">
                            Vui lòng chọn hình ảnh tác giả.
                        </div>
                    </div>

                    <!-- Trường Tiểu sử -->
                    <div class="col-md-12">
                        <label class="form-label"><strong>Tiểu sử</strong></label>
                        <textarea class="form-control" name="biography" id="biography" rows="4"
                            placeholder="Nhập tiểu sử của tác giả" required></textarea>
                        <div class="invalid-feedback">
                            Tiểu sử không được bỏ trống.
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-start">
                        <button type="reset" class="btn btn-secondary me-2">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary" name="addAuthor" value="Thêm Tác Giả">
                            Thêm Tác Giả
                        </button>
                    </div>
                </form>
            </div>
            <!-- Tab Thêm từ file -->
            <div class="tab-pane fade" id="auto-add-pane" role="tabpanel" aria-labelledby="auto-add-tab" tabindex="0">
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