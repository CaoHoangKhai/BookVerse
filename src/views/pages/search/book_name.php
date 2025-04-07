<?php
$books = $data["BookHome"];
?>

<div class="container mt-4">
    <?php if (empty($books)): ?>
        <!-- Thông báo khi không tìm thấy sách -->
        <div class="alert alert-warning text-center" role="alert">
            Không tìm thấy sách nào.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($books as $book): ?>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="card h-100 shadow-sm border rounded-2 position-relative" style="border-width: 1px;">

                        <!-- Nút trạng thái -->
                        <button class="btn btn-light position-absolute top-0 end-0 m-2 shadow-sm rounded-pill px-3 py-1 small">
                            <?= htmlspecialchars($book["Status"]) ?>
                        </button>

                        <!-- Hình ảnh -->
                        <div class="d-flex align-items-center justify-content-center"
                            style="height: 180px; background-color: #f9f9f9; display: flex;">
                            <a href="<?= APP_PATH ?>/chi_tiet/<?= $book['Book_id'] ?>"
                                class="d-flex align-items-center justify-content-center w-100 h-100">
                                <img src="<?= $this->image_books($book["Category_type"], $book['Images'][0]) ?>"
                                    class="img-fluid" alt="<?= htmlspecialchars($book['Title']) ?>"
                                    style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            </a>
                        </div>

                        <!-- Thông tin sách -->
                        <div class="card-body text-center p-2">
                            <h6 class="card-title text-truncate"><?= htmlspecialchars($book['Title']) ?></h6>
                            <p class="card-text text-danger fw-bold mb-1">
                                <?= number_format($book['Price'], 0, ',', '.') ?> VND
                            </p>

                            <!-- Nút Xem Chi Tiết -->
                            <a href="<?= APP_PATH ?>/chi_tiet/<?= $book['Book_id'] ?>" class="btn btn-primary btn-sm w-100">
                                Xem Chi Tiết
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>