<div class="container text-center">
    <span class="fw-bold d-block fs-4">TÁC GIẢ</span>
    <div class="d-flex align-items-center justify-content-center mt-2">
        <div class="border-bottom" style="width: 80px;"></div>
        <i class="bi bi-book-half mx-3" style="font-size: 1.5rem;"></i>
        <div class="border-bottom" style="width: 80px;"></div>
    </div>
    <p class="text-uppercase">
        Những cây bút đặc sắc, nhạy bén tạo nên nhiều tác phẩm hay, độc đáo góp phần làm giàu kiến thức cho xã hội
    </p>
</div>
<div class="container text-center mt-3">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 justify-content-center">
        <?php foreach ($data["Authors"] as $author): ?>
            <div class="col d-flex flex-column align-items-center mb-3">
                <!-- Hình tròn chứa ảnh -->
                <a href="<?= APP_PATH ?>/tac_gia/<?= $author["Author_id"] ?>">
                    <div class="rounded-circle border d-flex align-items-center justify-content-center overflow-hidden"
                        style="width: 140px; height: 140px;" data-bs-toggle="tooltip"
                        title="<?= htmlspecialchars($author['Name']) ?>">
                        <img src="<?= $this->image_author(htmlspecialchars($author['Img_Author'])) ?>"
                            alt="<?= htmlspecialchars($author['Name']) ?>" class="rounded-circle"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </a>

                <!-- Tên tác giả bên dưới -->
                <span class="mt-2 fw-bold"><?= htmlspecialchars($author['Name']) ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</div>