<?php
$book = $data["Book"];
// print_r($book);
$checkFavourite = $data["checkFavourite"];
// print_r($data["checkFavourite"]);
?>
<div class="container mt-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= APP_PATH ?>/home"
                    class="link-offset-2 link-underline link-underline-opacity-0 text-dark">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="<?= APP_PATH ?>/danh_muc/<?= $book["Category_type"] ?>"
                    class="link-offset-2 link-underline link-underline-opacity-0 text-dark"><?= $book["Category_name"] ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a class="link-offset-2 link-underline link-underline-opacity-0 text-dark"><?= $book['Title']; ?></a>
            </li>
        </ol>
    </nav>
    <div class="card shadow-sm">
        <div class="row g-0">
            <!-- Hình ảnh sách -->
            <div class="col-md-4 text-center d-flex align-items-center justify-content-center p-3">
                <?php if (!empty($book["Images"])):
                    $firstImage = $book["Images"][0]; ?>
                    <img id="mainImage" src="<?= $this->image_books($book["Category_type"], $firstImage); ?>"
                        class="img-fluid rounded shadow-sm" alt="<?= $book['Title']; ?>"
                        style="width: 100%; max-width: 400px; height: 450px; object-fit: contain;">
                <?php else: ?>
                    <p>Không có hình ảnh cho sách này.</p>
                <?php endif; ?>
            </div>

            <!-- Thông tin sách -->
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title"><?= $book['Title']; ?></h4>
                    <p class="card-text"><strong>Tác giả:</strong>
                        <a href="<?= APP_PATH ?>/tac_gia/<?= $book["Author_id"] ?>"
                            class="text-decoration-none text-primary fw-bold text-dark link-offset-2 link-underline link-underline-opacity-0">
                            <?= $book["Author_Name"]; ?>
                        </a>
                    </p>
                    <p class="card-text"><strong>Giá:</strong>
                        <?= number_format($book['Price'], 0, ',', '.'); ?> VNĐ
                    </p>
                    <p class="card-text"><strong>Số lượng:</strong>
                        <?= $book["Quantity"] ?>
                    </p>
                    <p class="card-text">
                        <strong>Tình trạng:</strong>
                        <span class="badge 
                    <?php
                    switch ($book['Status_id']) {
                        case 1:
                            echo 'bg-success';
                            break; // Còn hàng
                        case 2:
                            echo 'bg-secondary';
                            break; // Hết hàng
                        case 3:
                            echo 'bg-dark';
                            break; // Ngừng kinh doanh
                        case 4:
                            echo 'bg-warning';
                            break; // Đang cập nhật
                        default:
                            echo 'bg-secondary';
                            break;
                    }
                    ?>">
                            <?= $book['Status']; ?>
                        </span>
                    </p>
                    <p class="card-text"><strong>Nhà xuất bản:</strong>
                        <?= $book['Full_Name']; ?>
                    </p>
                    <div class="mt-3 d-flex align-items-center">
                        <form action="" method="POST">
                            <input type="hidden" name="Book_id" value="<?= $book["Book_id"] ?>">
                            <button id="favoriteButton" class="btn btn-outline-danger btn-lg me-3" name="addFavorite">
                                <i id="heartIcon"
                                    class="<?= ($checkFavourite == 1) ? 'fas fa-heart' : 'far fa-heart'; ?>"></i>
                            </button>
                        </form>
                        <form action="" method="POST">
                            <input type="hidden" name="Book_id" value="<?= $book["Book_id"] ?>">
                            <button type="submit" class="btn btn-success btn-lg" name="addBookCart">
                                <i class="fas fa-shopping-cart"></i> Thêm giỏ hàng
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Danh sách các ảnh nhỏ -->
        <div class="d-flex flex-wrap mt-3 px-3">
            <?php if (count($book["Images"]) > 4): ?>
                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $first = true;
                        foreach ($book["Images"] as $image): ?>
                            <div class="carousel-item <?= $first ? 'active' : ''; ?>">
                                <img src="<?= $this->image_books($book["Category_type"], $image); ?>"
                                    class="d-block w-100 img-thumbnail shadow-sm" alt="<?= $book['Title']; ?>"
                                    style="height: 80px; object-fit: cover;">
                            </div>
                            <?php $first = false; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($book["Images"] as $image): ?>
                    <div class="p-1">
                        <img src="<?= $this->image_books($book["Category_type"], $image); ?>" class="img-thumbnail shadow-sm"
                            alt="<?= $book['Title']; ?>" style="width: 80px; height: 80px; cursor: pointer;"
                            onclick="changeImage('<?= $this->image_books($book["Category_type"], $image); ?>')">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info"
                        type="button" role="tab" aria-controls="nav-info" aria-selected="true">
                        GIỚI THIỆU SÁCH
                    </button>
                    <button class="nav-link" id="nav-orders-tab" data-bs-toggle="tab" data-bs-target="#nav-orders"
                        type="button" role="tab" aria-controls="nav-orders" aria-selected="false">
                        NHẬN XÉT CỦA KHÁCH HÀNG
                    </button>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <br>
                <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab"
                    tabindex="0">
                    <p class="card-text"><strong>Giới thiệu tóm tắt tác phẩm:</strong>
                        <?= $book['Description']; ?>
                    </p>
                    <p class="card-text"><strong>Thể loại:</strong>
                        <?= $book['Category_name']; ?>
                    </p>
                    <p class="card-text"><strong>Nhà xuất bản:</strong>
                        <?= $book['Full_Name']; ?>
                    </p>
                </div>


                <div class="tab-pane fade rounded" id="nav-orders" role="tabpanel" aria-labelledby="nav-orders-tab"
                    tabindex="0">
                    <div class="table-responsive mt-3">
                        <div class="table-responsive mt-3">
                            <?php if (!empty($data["Comments"])): ?>
                                <?php foreach ($data["Comments"] as $comment): ?>
                                    <div class="border p-3 mb-2 rounded shadow-sm">
                                        <p class="mb-1"><strong><?= htmlspecialchars($comment["FullName"]); ?></strong></p>
                                        <p class="mb-1"><?= nl2br(htmlspecialchars($comment["Comment"])); ?></p>
                                        <small
                                            class="text-muted"><?= date("d/m/Y H:i", strtotime($comment["Created_at"])); ?></small>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">Chưa có nhận xét nào.</p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
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