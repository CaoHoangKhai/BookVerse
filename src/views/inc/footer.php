<?php require_once 'config.php' ?>
<footer class="text-center text-lg-start bg-body-tertiary text-muted mx-2 mt-3 mb-3">
    <div class="container">
        <div class="container text-center">
            <div class="row row-cols-4">
                <?php
                $footer_policies = [
                    ["DỊCH VỤ TẬN TÂM", "hpolicy_img1.webp"],
                    ["SẢN PHẨM ĐA DẠNG", "hpolicy_img2.webp"],
                    ["VẬN CHUYỂN CHU ĐÁO", "hpolicy_img3.webp"],
                    ["GIÁ CẢ HỢP LÝ", "hpolicy_img4.webp"]
                ];
                foreach ($footer_policies as $policy): ?>
                    <div class="col">
                        <img src="<?= APP_PATH ?>/public/media/photos/foot/<?= $policy[1] ?>" alt="">
                        <strong><?= $policy[0] ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row flex-container mt-3 text-start">
            <?php foreach ($footer_links as $title => $links): ?>
                <div class="col-md-3 mb-2"> <!-- Chỉnh từ col-md-4 thành col-md-3 -->
                    <b><?= $title ?></b>
                    <ul class="list-unstyled">
                        <?php foreach ($links as $link): ?>
                            <li><a href="<?= $link[1] ?>"
                                    class="text-decoration-none quick-link text-secondary"><?= $link[0] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</footer>