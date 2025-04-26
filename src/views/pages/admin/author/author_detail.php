<?php
$author = $data["Author"];
$countries = $data["Nationality"];
?>
<h2 class="mb-3 text-center">Thông Tin Tác Giả</h2>
<div class="container mt-4">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-3 text-center d-flex align-items-center justify-content-center p-3">
                <!-- Hiển thị hình ảnh tác giả hiện tại -->
                <a href="<?= APP_PATH ?>/tac_gia/<?= $author["Author_id"] ?>">
                    <img src="<?php echo $this->image_author($author["Img_Author"]); ?>" class="img-fluid rounded"
                        alt="<?= $author['Name'] ?>" style="max-width: 100%; height: auto; object-fit: contain;">
                </a>
            </div>

            <div class="col-md-9">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label for="author_name" class="form-label"><strong>Tác giả: </strong></label>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($author['Author_id']); ?>">
                            <input type="hidden" name="Img_Author" value="<?php echo $author['Img_Author']; ?>">
                            <input type="text" class="form-control" id="author_name" name="author_name"
                                value="<?= htmlspecialchars($author['Name']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="biography" class="form-label"><strong>Mô tả: </strong></label>
                            <textarea class="form-control" id="biography" name="biography" rows="15"
                                style="width: 440px; height: 320px;">
                                <?= htmlspecialchars(trim($author['Biography'])) ?>
                            </textarea>
                        </div>

                        <script>
                            tinymce.init({
                                selector: '#biography', // Áp dụng TinyMCE vào textarea này
                                height: 600,
                                width: 870,
                                plugins: 'advlist autolink lists link image charmap print preview anchor',
                                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
                            });
                        </script>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label"><strong>Năm sinh:</strong></label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    value="<?= !empty($author['Date_of_Birth']) ? date('Y-m-d', strtotime($author['Date_of_Birth'])) : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="nationality" class="form-label"><strong>Quốc tịch:</strong></label>
                                <select class="form-control" id="nationality" name="nationality">
                                    <option value="">Chọn quốc tịch</option>
                                    <?php
                                    foreach ($countries as $country) {
                                        $selected = ($author['Nationality'] == $country['id'] || $author['Nationality'] == $country['name']) ? 'selected' : '';
                                        echo "<option value='{$country['id']}' $selected>{$country['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="book_count" class="form-label">
                                <strong>
                                    Số lượng sách hiện có:
                                </strong>
                                <?= $author['book_count'] ?>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="author_image" class="form-label"><strong>Chọn hình ảnh mới: </strong></label>
                            <input type="file" name="author_image" class="form-control" id="author_image"
                                accept="image/*" />
                        </div>

                        <!-- Adjust the spacing between buttons -->
                        <div class="d-flex gap-3">
                            <a href="<?= APP_PATH ?>/admin/authors_list" class="btn btn-primary">
                                <i class="fa fa-reply" aria-hidden="true"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-warning" name="edit_author">
                                <i class="fa fa-pencil"></i> Chỉnh sửa
                            </button>
                            <!-- <button type="submit" class="btn btn-danger" name="delete_author">
                                <i class="fa fa-pencil"></i> Xóa tác giả
                            </button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<h3 class="mt-4 text-center">Danh Mục Sách Tác Giả</h3>


<div class="container">
    <div class="row" id="bookList">
        <?php
        $hasBooks = false;
        foreach ($data["Books"] as $book):
            // Kiểm tra nếu sách thiếu tiêu đề hoặc giá thì bỏ qua
            if (empty($book['Title']) || empty($book['Price'])) {
                continue;
            }

            $hasBooks = true;

            // Xử lý đường dẫn hình ảnh
            $imageUrl = !empty($book['Image_URL']) ? $this->image_books($book['Category_type'], $book['Image_URL']) : '/path/to/default-image.jpg';
            // Tạo đường dẫn chi tiết sản phẩm
            $productUrl = APP_PATH . '/admin/product_detail/' . $book['Book_id'];
            // Cắt mô tả nếu quá dài
            $shortDescription = !empty($book['Description']) ?
                ((mb_strlen($book['Description'], 'UTF-8') > 30) ?
                    mb_substr($book['Description'], 0, 30, 'UTF-8') . '...' :
                    $book['Description'])
                : 'Chưa có mô tả';
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4 book-item" data-title="<?= strtolower($book['Title']) ?>">
                <div class="card d-flex flex-column" style="width: 100%; height: 100%;">
                    <a href="<?= $productUrl ?>" style="text-decoration: none; color: inherit;">
                        <!-- Hình ảnh sách -->
                        <img src="<?= $imageUrl ?>" class="card-img-top" alt="<?= $book['Title'] ?>"
                            style="padding: 10px; display: block; margin: 0 auto; max-height: 200px; object-fit: contain;">
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <!-- Tiêu đề sách -->
                            <h4 class="card-title text-start" style="font-size: 14px; margin-bottom: 5px;">
                                <?= $book['Title'] ?>
                            </h4>
                            <!-- Mô tả sách -->
                            <p class="card-text" style="font-size: 12px; margin-bottom: 5px;">
                                <strong>Mô tả: </strong><?= $shortDescription ?>
                            </p>
                            <!-- Giá sách -->
                            <p class="card-text" style="font-size: 12px; flex-grow: 1;">
                                <strong>Giá: </strong> <?= number_format($book['Price'], 0, '.', '.') ?> VND
                            </p>
                            <!-- Nút Xem chi tiết -->
                            <a href="<?= $productUrl ?>" class="btn btn-primary btn-sm mt-auto d-block text-center">
                                Xem chi tiết
                            </a>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Hiển thị thông báo nếu không có sách hợp lệ -->
        <?php if (!$hasBooks): ?>
            <p class="text-center text-muted w-100">Hiện tại chưa có sách nào để hiển thị.</p>
        <?php endif; ?>
    </div>
</div>