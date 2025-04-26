<?php
$author = $data["Author"];
// print_r($data["Books"])
?>

<div class="card">
    <div class="row g-0">
        <div class="col-md-4 text-center d-flex align-items-center justify-content-center p-2">
            <a href="https://vi.wikipedia.org/wiki/<?= urlencode($author["Name"]) ?>" target="_blank">
                <img src="<?= $this->image_author($author["Img_Author"]) ?>" class="img-fluid rounded"
                    alt="<?= htmlspecialchars($author['Name']) ?>"
                    style="width: 400px; height: auto; object-fit: cover; border-radius: 10px;">
            </a>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title mb-2"><?= htmlspecialchars($author['Name']) ?></h5>
                <p><?= htmlspecialchars_decode($author['Biography']) ?></p>

            </div>
        </div>
    </div>
</div>

<h3 class="mt-4 text-center">Sách của Tác Giả <?= htmlspecialchars($author['Name']) ?></h3>
<div class="container">
    <div class="row" id="bookList">
        <?php foreach ($data["Books"] as $book): ?>
            <?php if (empty($book['Title']))
                continue;
            $imageUrl = $this->image_books($book['Category_type'], $book['Image_URL']);
            $productUrl = APP_PATH . "/chi_tiet/" . urlencode($book['Book_id']);
            $shortDescription = (mb_strlen($book['Description'], 'UTF-8') > 36)
                ? mb_substr($book['Description'], 0, 36, 'UTF-8') . '...'
                : $book['Description'];
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3 book-item" data-title="<?= strtolower($book['Title']) ?>">
                <div class="card d-flex flex-column" style="width: 100%; height: 100%;">
                    <a href="<?= $productUrl ?>" style="text-decoration: none; color: inherit;">
                        <img src="<?= $imageUrl ?>" class="card-img-top" alt="<?= htmlspecialchars($book['Title']) ?>"
                            style="padding: 8px; display: block; margin: 0 auto; max-height: 200px; object-fit: contain;">
                        <div class="card-body d-flex flex-column flex-grow-1 p-2">
                            <h6 class="card-title text-start mb-1" style="font-size: 14px;">
                                <?= htmlspecialchars($book['Title']) ?>
                            </h6>
                            <p class="card-text" style="font-size: 12px; margin-bottom: 3px;">
                            <p><strong>Giới thiệu tóm tắt tác phẩm:</strong> <?= strip_tags($shortDescription) ?></p>
                            <p class="card-text" style="font-size: 12px; flex-grow: 1;">
                                <strong>Giá: </strong> <?= number_format($book['Price'], 0, '.', '.') ?> VND
                            </p>
                            <a href="<?= $productUrl ?>" class="btn btn-primary btn-sm mt-auto d-block text-center">
                                Xem chi tiết
                            </a>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>