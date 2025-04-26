<div class="card-body">
    <div class="tab-content" id="userTabContent">
        <!-- Tab Thêm thủ công -->
        <div class="tab-pane fade show active" id="manual-add-pane" role="tabpanel" aria-labelledby="manual-add-tab"
            tabindex="0">

            <div class="row">
                <?php if (!empty($data["NewById"])): ?>
                    <?php $news = $data["NewById"]; ?>
                    <div class="card-body">
                        <div class="tab-content" id="userTabContent">
                            <div class="tab-pane fade show active" id="manual-add-pane" role="tabpanel"
                                aria-labelledby="manual-add-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Form -->
                                        <form class="row g-3 needs-validation" method="POST" action="" novalidate
                                            enctype="multipart/form-data">
                                            <!-- Tiêu đề -->
                                            <div class="col-md-12">
                                                <label class="form-label fs-6"><strong>Thêm tiêu đề*</strong></label>
                                                <input type="text" class="form-control" name="title" id="title"
                                                    value="<?php echo htmlspecialchars($news['title']); ?>" required>
                                                <div class="invalid-feedback">Tiêu đề không được bỏ trống.</div>
                                            </div>

                                            <!-- Mô tả -->
                                            <div class="col-md-12">
                                                <label class="form-label fs-6"><strong>Nội dung mô tả</strong></label>
                                                <textarea class="form-control" name="description" id="description" rows="3"
                                                    required><?php echo htmlspecialchars($news['description']); ?></textarea>
                                                <div class="invalid-feedback">Mô tả không được bỏ trống.</div>
                                            </div>

                                            <!-- Ảnh 1 -->
                                            <div class="col-md-12">
                                                <label class="form-label"><strong>Hình ảnh</strong></label>
                                                <input type="file" class="form-control" name="image1" id="image1">
                                                <div class="invalid-feedback">Vui lòng chọn ảnh.</div>
                                            </div>

                                            <!-- Nội dung đầy đủ (Phần 1) -->
                                            <div class="col-md-12">
                                                <label class="form-label"><strong>Nội dung đầy đủ (Phần 1)</strong></label>
                                                <textarea class="form-control" name="content1" id="content1" rows="4"
                                                    required><?php echo htmlspecialchars_decode($news['content_1']); ?></textarea>
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
                                                <textarea class="form-control" name="content2" id="content2"
                                                    rows="4"><?php echo htmlspecialchars_decode($news['content_2']); ?></textarea>
                                            </div>

                                            <!-- Trạng thái -->
                                            <div class="col-md-12">
                                                <label class="form-label fs-6"><strong>Trạng thái</strong></label>
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="" disabled>-- Chọn trạng thái --</option>
                                                    <option value="1" <?php echo ($news['status'] == 1) ? 'selected' : ''; ?>>
                                                        Hiển thị</option>
                                                    <option value="2" <?php echo ($news['status'] == 2) ? 'selected' : ''; ?>>
                                                        Đã ẩn</option>
                                                </select>
                                                <div class="invalid-feedback">Vui lòng chọn trạng thái.</div>
                                            </div>

                                            <div class="modal-footer d-flex justify-content-start mb-5">
                                                <button type="submit" class="btn btn-primary" name="updateNews"
                                                    value="Thêm Tin Tức">
                                                    <input type="hidden" id="current_date" name="current_date"
                                                        value="<?php echo date('Y-m-d'); ?>" readonly>
                                                    Cập Nhật Tin Tức
                                                </button>
                                                <button type="submit" class="btn btn-danger ms-2" name="deleteNews"
                                                    value="Xóa Tin Tức">
                                                    Xóa Tin Tức
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
                                                <h4 id="preview-title" class="text-dark">
                                                    <?php echo htmlspecialchars($news['title']); ?>
                                                </h4>
                                                <p id="preview-description">
                                                    <?php echo htmlspecialchars($news['description']); ?>
                                                </p>
                                                <?php if (!empty($news['image_1'])): ?>
                                                    <img id="preview-image1"
                                                        src="<?= APP_PATH ?>/public/media/photos/news/<?php echo htmlspecialchars($news['image_1']); ?>"
                                                        class="img-fluid mb-2 d-block mx-auto" style="display:block;">
                                                <?php endif; ?>
                                                <p id="preview-content1">
                                                    <?php echo htmlspecialchars_decode($news['content_1']); ?>
                                                </p>
                                                <?php if (!empty($news['image_2'])): ?>
                                                    <img id="preview-image2"
                                                        src="<?= APP_PATH ?>/public/media/photos/news/<?php echo htmlspecialchars($news['image_2']); ?>"
                                                        class="img-fluid mb-2 d-block mx-auto" style="display:block;">
                                                <?php endif; ?>
                                                <p id="preview-content2">
                                                    <?php echo htmlspecialchars_decode($news['content_2']); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tab Thêm từ file -->
        <div class="tab-pane fade" id="auto-add-pane" role="tabpanel" aria-labelledby="auto-add-tab" tabindex="0">
            <!-- Nội dung tự thêm từ file sau -->
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