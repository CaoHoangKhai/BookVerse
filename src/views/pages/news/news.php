<div class="container mt-4">
    <span class="fw-bold d-block fs-4 text-center">TIN TỨC & SỰ KIỆN</span>
    <div class="d-flex align-items-center justify-content-center mt-2 mb-4">
        <div class="border-bottom" style="width: 100px;"></div>
        <i class="bi bi-book-half mx-3" style="font-size: 1.5rem;"></i>
        <div class="border-bottom" style="width: 100px;"></div>
    </div>
    <div class="row g-4">
        <?php foreach ($data["News"] as $news): ?>
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