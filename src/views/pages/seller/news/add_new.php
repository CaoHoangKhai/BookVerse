<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center mb-3 mt-3">THÊM TIN TỨC</h3>
        <ul class="nav nav-tabs" id="userTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="manual-add-tab" data-bs-toggle="tab"
                    data-bs-target="#manual-add-pane" type="button" role="tab" aria-controls="manual-add-pane"
                    aria-selected="true">
                    Thêm Tin Tức
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

                <div class="row">
                    <div class="col-md-6">
                        <!-- Form -->
                        <form class="row g-3 needs-validation" method="POST" action="" novalidate
                            enctype="multipart/form-data">

                            <!-- Tiêu đề -->
                            <div class="col-md-12">
                                <label class="form-label fs-6"><strong>Thêm tiêu đề*</strong></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Nhập tiêu đề" required>
                                <div class="invalid-feedback">Tiêu đề không được bỏ trống.</div>
                            </div>

                            <!-- Mô tả -->
                            <div class="col-md-12">
                                <label class="form-label fs-6"><strong>Nội dung mô tả</strong></label>
                                <textarea class="form-control" name="description" id="description" rows="3"
                                    placeholder="Nhập mô tả ngắn" required></textarea>
                                <div class="invalid-feedback">Mô tả không được bỏ trống.</div>
                            </div>

                            <!-- Ảnh 1 -->
                            <div class="col-md-12">
                                <label class="form-label"><strong>Hình ảnh</strong></label>
                                <input type="file" class="form-control" name="image1" id="image1" required>
                                <div class="invalid-feedback">Vui lòng chọn ảnh.</div>
                            </div>

                            <!-- Nội dung đầy đủ (Phần 1) -->
                            <div class="col-md-12">
                                <label class="form-label"><strong>Nội dung đầy đủ (Phần 1)</strong></label>
                                <textarea class="form-control" name="content1" id="content1" rows="4"
                                    placeholder="Nhập nội dung phần đầu" required></textarea>
                                <div class="invalid-feedback">Nội dung không được bỏ trống.</div>
                            </div>

                            <!-- Ảnh 2 -->
                            <div class="col-md-12">
                                <label class="form-label"><strong>Hình ảnh</strong></label>
                                <input type="file" class="form-control" name="image2" id="image2">
                            </div>

                            <!-- Nội dung đầy đủ (Phần 2) -->
                            <div class="col-md-12">
                                <label class="form-label"><strong>Nội dung đầy đủ (Phần 2)</strong></label>
                                <textarea class="form-control" name="content2" id="content2" rows="4"
                                    placeholder="Nhập nội dung phần tiếp theo"></textarea>
                            </div>

                            <div class="modal-footer d-flex justify-content-start">
                                <button type="reset" class="btn btn-secondary me-2">Reset</button>
                                <button type="submit" class="btn btn-primary" name="addSellerNew" value="Thêm Tin Tức">
                                    <input type="hidden" id="current_date" name="current_date"
                                        value="<?php echo date('Y-m-d'); ?>" readonly>
                                    Thêm Tin Tức
                                </button>
                            </div>

                        </form>
                    </div>

                    <!-- Preview -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <strong>Xem Trước Bài Viết</strong>
                            </div>
                            <div class="card-body">
                                <h4 id="preview-title" class="text-dark"></h4>
                                <p id="preview-description"></p>
                                <img id="preview-image1" src="" class="img-fluid mb-2 d-block mx-auto"
                                    style="display:none;">
                                <p id="preview-content1"></p>
                                <img id="preview-image2" src="" class="img-fluid mb-2 d-block mx-auto"
                                    style="display:none;">
                                <p id="preview-content2"></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tab Thêm từ file -->
            <div class="tab-pane fade" id="auto-add-pane" role="tabpanel" aria-labelledby="auto-add-tab" tabindex="0">
                <!-- Nội dung tự thêm từ file sau -->
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Hiển thị preview cho title & description
    $("#title").on("input", function () {
        $("#preview-title").text($(this).val());
    });

    $("#description").on("input", function () {
        $("#preview-description").text($(this).val());
    });

    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(previewId).attr("src", e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image1").on("change", function () {
        previewImage(this, "#preview-image1");
    });

    $("#image2").on("change", function () {
        previewImage(this, "#preview-image2");
    });

    // TinyMCE content preview
    tinymce.init({
        selector: '#content1, #content2',
        height: 400,
        plugins: 'advlist autolink lists link image charmap print preview anchor fullscreen',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | fullscreen | help',
        setup: function (editor) {
            editor.on('Change KeyUp', function () {
                var content = editor.getContent();
                if (editor.id === "content1") {
                    $("#preview-content1").html(content);
                }
                if (editor.id === "content2") {
                    $("#preview-content2").html(content);
                }
            });
        }
    });
</script>