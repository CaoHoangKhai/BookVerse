<div class="container-fluid mt-4" style="max-width: 1400px;">
    <div class="row justify-content-center">
        <!-- Cột Nội dung chính (8 cột, căn giữa) -->
        <div class="col-md-8">
            <div class="card bg-light shadow-sm p-4">
                <h5 class="fw-bold text-uppercase"><?= $data["NewsDetail"]["title"] ?></h5>
                <small class="text-muted d-block mb-3">
                    Cập nhật ngày: <?= date('d/m/Y', strtotime($data["NewsDetail"]["date"])) ?>
                </small>
                <p><?= $data["NewsDetail"]["description"] ?></p>

                <div class="small">
                    <?php if (!empty($data["NewsDetail"]["image_1"])): ?>
                        <img src="<?= APP_PATH ?>/public/media/photos/news/<?= $data["NewsDetail"]["image_1"] ?>"
                            class="img-fluid rounded mb-3 mx-auto d-block">
                    <?php endif; ?>
                    <p><?= $data["NewsDetail"]["content_1"] ?></p>

                    <?php if (!empty($data["NewsDetail"]["image_2"])): ?>
                        <img src="<?= APP_PATH ?>/public/media/photos/news/<?= $data["NewsDetail"]["image_2"] ?>"
                            class="img-fluid rounded mb-3 mx-auto d-block">
                        <p><?= $data["NewsDetail"]["content_2"] ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <!-- Cột Sidebar (4 cột) -->
        <div class="col-md-4">
            <h5 class="fw-bold text-center">CÁC TIN TỨC KHÁC</h5>
            <ul class="list-group" id="news-list">
                <?php foreach ($data["NewsList"] as $news): ?>
                    <li class="list-group-item">
                        <a href="<?= isset($news['link']) ? $news['link'] : '#' ?>"
                            class="text-reset link-offset-2 link-underline link-underline-opacity-0">
                            <small><strong><?= htmlspecialchars($news["title"]) ?></strong></small>
                        </a> -
                        <small class="text-muted"><?= date('d/m/Y', strtotime($news["date"])) ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>


            <!-- Nút điều hướng -->
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-outline-primary" id="prev-btn">← Trước</button>
                <button class="btn btn-outline-primary" id="next-btn">Sau →</button>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let currentIndex = 0;
        const itemsPerPage = 4;
        const newsItems = $("#news-list .list-group-item");
        const totalItems = newsItems.length;

        function showNews() {
            newsItems.hide().slice(currentIndex, currentIndex + itemsPerPage).fadeIn();
        }

        $("#prev-btn").click(function () {
            if (currentIndex > 0) {
                currentIndex -= itemsPerPage;
                showNews();
            }
        });

        $("#next-btn").click(function () {
            if (currentIndex + itemsPerPage < totalItems) {
                currentIndex += itemsPerPage;
                showNews();
            }
        });

        // Hiển thị tin tức ban đầu
        showNews();
    });
</script>