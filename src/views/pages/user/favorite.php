<?php
// print_r($data["Favourite"]);
?>
<div class="container mt-4">
    <h3>📚 Danh sách Sách Yêu Thích</h3>
    <?php if (!empty($data["Favourite"])) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>📖 Tiêu đề</th>
                    <th>💰 Giá</th>
                    <th>🖼️ Ảnh</th>
                    <th class="col-2">⚙️ Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data["Favourite"] as $book) { ?>
                    <tr>
                        <td><?= htmlspecialchars($book["Title"]); ?></td>
                        <td><?= number_format($book["Price"], 0, ',', '.'); ?> VNĐ</td>
                        <td>
                            <img src="<?= $this->image_books($book["Category_type"], $book['Image']) ?>" class="img-fluid"
                                alt="<?= htmlspecialchars($book['Title']) ?>" width="40">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info btn-sm">
                                <a href="<?= APP_PATH ?>/chi_tiet/<?= $book['Book_id'] ?>"
                                    class="text-dark link-offset-2 link-underline link-underline-opacity-0">
                                    <i class="fa fa-eye text-dark"></i> Xem chi tiết
                                </a>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-danger">🚫 Bạn chưa có sách yêu thích nào.</p>
    <?php } ?>
</div>