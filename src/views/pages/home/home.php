<?php
$books = $data["BookHome"];
?>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= APP_PATH ?>/public/media/photos/body/ms_banner_img1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= APP_PATH ?>/public/media/photos/body/ms_banner_img3.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= APP_PATH ?>/public/media/photos/body/ms_banner_img4.webp" class="d-block w-100" alt="...">
        </div>
    </div>
</div>
<div class="container mt-4">
    <?php
    // Nhóm sách theo thể loại
    $categories = [];
    foreach ($books as $book) {
        $categories[$book["Category_name"]][] = $book;
    }

    foreach ($categories as $category => $books_list):
        ?>
        <!-- Card Thể Loại -->
        <div class="border rounded-3 p-3 mb-4 shadow-sm">
            <!-- Tiêu đề Thể Loại -->
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <h5 class="m-0 text-uppercase"><?= htmlspecialchars($category) ?></h5>
                <a href="<?= APP_PATH ?>/danh_muc/<?= urlencode($books_list[0]["Category_type"]) ?>"
                    class="text-dark link-offset-2 link-underline link-underline-opacity-0">
                    Xem Tất Cả >
                </a>
            </div>

            <!-- Danh sách sách -->
            <div class="row">
                <?php foreach (array_slice($books_list, 0, 6) as $book): ?>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card h-100 shadow-sm border rounded-2 position-relative" style="border-width: 1px;">

                            <!-- Nút trạng thái (hiển thị "Còn hàng" hoặc "Hết hàng") -->
                            <button
                                class="btn btn-light position-absolute top-0 end-0 m-2 shadow-sm rounded-pill px-3 py-1 small">
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
                            <!-- Thông tin -->
                            <div class="card-body text-center p-2">
                                <h6 class="card-title text-truncate"><?= htmlspecialchars($book['Title']) ?></h6>
                                <p class="card-text text-danger fw-bold mb-1">
                                    <?= number_format($book['Price'], 0, ',', '.') ?> VND
                                </p>

                                <!-- Nút Xem Chi Tiết -->
                                <a href="<?= APP_PATH ?>/chi_tiet/<?= $book['Book_id'] ?>"
                                    class="btn btn-primary btn-sm w-100">
                                    Xem Chi Tiết
                                </a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<div class="container mt-4">
    <span class="fw-bold d-block fs-4 text-center">TIN TỨC & SỰ KIỆN</span>
    <div class="d-flex align-items-center justify-content-center mt-2 mb-4">
        <div class="border-bottom" style="width: 100px;"></div>
        <i class="bi bi-book-half mx-3" style="font-size: 1.5rem;"></i>
        <div class="border-bottom" style="width: 100px;"></div>
    </div>
    <div class="row g-4">
        <?php foreach (array_slice($data["NewsHome"], 0, 4) as $news): ?>
            <div class="col-md-3">
                <a href="<?= APP_PATH ?>/tin_tuc/detail/<?= $news['link'] ?>" class="text-decoration-none text-dark">
                    <div class="border rounded shadow-sm h-100 overflow-hidden">
                        <div class="d-flex justify-content-center p-2">
                            <img src="<?= APP_PATH ?>/public/media/photos/news/<?= $news['image_1'] ?>" class="w-100"
                                style="height: 150px; object-fit: cover; border-radius: 5px;">
                        </div>

                        <div class="p-1 text-start">
                            <h6 class="fw-bold mb-1" style="font-size: 0.95rem;">
                                <?= $news['title'] ?>
                            </h6>
                            <small class="text-muted d-block mb-1" style="font-size: 0.8rem;">
                                Cập nhật ngày: <?= date('d/m/Y', strtotime($news['date'])) ?>
                            </small>
                            <p class="mb-1" style="font-size: 0.85rem; line-height: 1.2;">
                                <?= $news['description'] ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>