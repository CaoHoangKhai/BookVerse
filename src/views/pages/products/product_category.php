<?php
$books = $data["Books"];
?>
<div class="container mt-4">
    <!-- <div class="input-group">
        <input type="text" class="form-control" placeholder="Tìm kiếm sách..." name="query" aria-label="Tìm kiếm sách">
        <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
    </div> -->

    <!-- Hiển thị danh sách sách -->
    <div class="row row-cols-2 row-cols-md-5 g-4">
        <?php foreach ($books as $book): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <!-- Ảnh có thể click để xem chi tiết -->
                    <a href="<?= APP_PATH ?>/chi_tiet/<?= $book['Book_id']; ?>" class="d-block ratio ratio-4x3">
                        <img src="<?= $this->image_books($book["Category_type"], $book['Images'][0]) ?>"
                            class="card-img-top img-fluid rounded" alt="<?= $book['Title']; ?>"
                            style="object-fit: contain;">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title"><?= $book['Title']; ?></h6>
                        <p class="card-text text-muted"><strong>Tác giả:</strong> <?= $book['Author_Name']; ?></p>
                        <p class="card-text"><strong>Giá:</strong>
                            <?= number_format($book['Price'], 0, ',', '.'); ?> VNĐ
                        </p>

                        <!-- Form cho "Đặt hàng" -->
                        <form action="" method="POST">
                            <!-- Giữ ID của sách khi gửi form -->
                            <input type="hidden" name="Book_id" value="<?= $book['Book_id']; ?>">
                            <div class="mt-auto d-flex justify-content-between">
                                <a href="<?= APP_PATH ?>/chi_tiet/<?= $book['Book_id']; ?>" class="btn btn-primary btn-sm">
                                    Xem chi tiết
                                </a>
                                <button type="submit" class="btn btn-success btn-sm" name="addCartCategory">Add Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>