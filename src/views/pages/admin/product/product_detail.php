<?php
$book = $data["Book"];
// print_r($book);
?>
<div class="container mt-4">
    <div class="card">
        <div class="row g-0">
            <!-- Hình ảnh sách (Ảnh lớn ban đầu) -->
            <div class="col-md-4 text-center d-flex align-items-center justify-content-center p-3">
                <?php
                // Kiểm tra nếu có hình ảnh
                if (!empty($book["Images"])) {
                    $firstImage = $book["Images"][0]; // Lấy ảnh đầu tiên làm ảnh lớn
                    ?>
                    <img id="mainImage" src="<?php echo $this->image_books($book["Category_type"], $firstImage); ?>"
                        class="img-fluid rounded" alt="<?= $book['Title'] ?>"
                        style="width: 100%; max-width: 450px; height: 450px; object-fit: contain;">
                <?php } else { ?>
                    <p>Không có hình ảnh cho sách này.</p>
                <?php } ?>
            </div>

            <!-- Thông tin sách -->
            <div class="col-md-8">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- Thông tin cơ bản -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="hidden" name="Book_id" value="<?= $book["Book_id"] ?>">
                            <input type="text" class="form-control" id="title" name="title"
                                value="<?= $book['Title'] ?>" required>
                        </div>

                        <!-- Tác giả & Thể loại -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="author" class="form-label">Tác giả</label>
                                <select class="form-control" id="author" name="author" required>
                                    <option value="" disabled selected>Chọn tác giả</option>
                                    <?php foreach ($data["Authors"] as $author): ?>
                                        <option value="<?= $author['Author_id'] ?>"
                                            <?= $author['Author_id'] == $book['Author_id'] ? 'selected' : '' ?>>
                                            <?= $author['Name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="category" class="form-label">Thể loại</label>
                                <select class="form-select" id="category" name="category" required>
                                    <?php
                                    foreach ($data["Categories"] as $category) {
                                        $selected = ($book['Category_name'] == $category['Category_name']) ? 'selected' : '';
                                        echo "<option value='{$category['Category_id']}' $selected>{$category['Category_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="10"><?= htmlspecialchars($book['Description']) ?></textarea>
                        </div>
                        <script>
                            tinymce.init({
                                selector: '#description',
                                height: 400,
                                plugins: 'advlist autolink lists link image charmap print preview anchor',
                                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
                            });
                        </script>
                        <!-- Nhà xuất bản & Tình trạng -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="publisher" class="form-label">Nhà xuất bản</label>
                                <select class="form-select" id="publisher" name="publisher" required>
                                    <?php
                                    foreach ($data["Publishers"] as $publisher) {
                                        $selected = ($book['User_id'] == $publisher['User_id']) ? 'selected' : '';
                                        echo "<option value='{$publisher['User_id']}' $selected>{$publisher['Full_Name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Tình trạng</label>
                                <select class="form-select" id="status" name="status">
                                    <?php
                                    foreach ($data["BookStatus"] as $status) {
                                        $selected = ($book['Status_id'] == $status['Status_id']) ? 'selected' : '';
                                        echo "<option value='{$status['Status_id']}' $selected>{$status['Status_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Giá & Ngày thêm -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" class="form-control" id="price" name="price" min="0"
                                    value="<?= $book['Price'] ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="date_added" class="form-label">Ngày thêm</label>
                                <input type="date" class="form-control" id="date_added" name="date_added"
                                    value="<?= $book['Date_added'] ?>" disabled>
                            </div>

                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Số lượng hiện có</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    value="<?= $book['Quantity'] ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="add_quantity" class="form-label">Thêm số lượng sản phẩm</label>
                                <input type="number" class="form-control" id="add_quantity" name="add_quantity" min="0"
                                    value="0"> <!-- Để mặc định là 0 hoặc rỗng -->
                            </div>
                        </div>

                        <!-- Hình ảnh sách -->
                        <div class="mb-3">
                            <label class="form-label"><strong> Thêm hình ảnh sách</strong></label>
                            <input type="file" class="form-control" name="book_image" id="book_image" accept="image/*">
                        </div>

                        <!-- Nút dành cho Admin -->
                        <div class="d-flex mt-3">
                            <a href="<?= APP_PATH ?>/admin/products_list" class="btn btn-secondary me-2">
                                <i class="fa fa-reply" aria-hidden="true"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-warning me-2" name="editBook">
                                <i class="fa fa-save"></i> Lưu thay đổi
                            </button>
                            <button type="submit" class="btn btn-danger me-2" name="deleteBook">
                                <i class="fa fa-trash"></i> Xóa sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Danh sách các ảnh nhỏ (Di chuyển xuống dưới ảnh lớn) -->
        <div class="d-flex flex-wrap mt-3">
            <?php
            // Kiểm tra số lượng ảnh để quyết định cách hiển thị
            if (count($book["Images"]) > 4) {
                // Hiển thị ảnh dưới dạng carousel nếu có nhiều hơn 4 ảnh
                ?>
                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $first = true;
                        foreach ($book["Images"] as $index => $image) {
                            $isActive = $first ? 'active' : ''; // Đánh dấu ảnh đầu tiên là active
                            $first = false;
                            ?>
                            <div class="carousel-item <?= $isActive ?>">
                                <img src="<?php echo $this->image_books($book["Category_type"], $image); ?>"
                                    class="d-block w-100 img-thumbnail" alt="<?= $book['Title'] ?>"
                                    style="height: 120px; object-fit: cover;">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } else {
                foreach ($book["Images"] as $image) { ?>
                    <div class="p-1">
                        <div class="image-container" style="position: relative; display: inline-block; margin: 5px;">
                            <img src="<?php echo $this->image_books($book["Category_type"], $image); ?>" class="img-thumbnail"
                                alt="<?= $book['Title'] ?>" style="width: 100px; height: 100px; cursor: pointer;"
                                onclick="changeImage('<?php echo $this->image_books($book['Category_type'], $image); ?>')">

                            <!-- Form để xóa ảnh -->
                            <form method="POST" action="" style="position: absolute; top: 2px; right: 2px;">
                                <input type="hidden" name="book_id" value="<?= $book['Book_id'] ?>">
                                <input type="hidden" name="image" value="<?= $image ?>">
                                <button type="submit" class="delete-image" name="deleteImage"
                                    style="border: none; background: transparent; font-size: 18px; font-weight: bold; color: black; cursor: pointer;">
                                    ✖
                                </button>
                            </form>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>

    </div>
</div>

<script>
    // Hàm thay đổi ảnh lớn khi người dùng click vào ảnh nhỏ
    function changeImage(imageUrl) {
        var mainImage = document.getElementById('mainImage');
        mainImage.src = imageUrl;

        // Đảm bảo ảnh lớn luôn có kích thước cố định và phù hợp
        mainImage.style.width = "100%";
        mainImage.style.maxWidth = "450px"; // Giới hạn chiều rộng tối đa
        mainImage.style.height = "450px";    // Chiều cao cố định
        mainImage.style.objectFit = "contain"; // Đảm bảo ảnh không bị méo và không bị cắt xén
    }
</script>