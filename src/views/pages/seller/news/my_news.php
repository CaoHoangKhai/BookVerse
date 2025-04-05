<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Ngày đăng</th>
            <th>Trạng thái</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1; // Đếm số thứ tự tin tức
        foreach ($data["NewsSeller"] as $news):
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($news['title']) ?></td>
                <td><?= htmlspecialchars($news['date']) ?></td>
                <td>
                    <?php
                    // Hiển thị trạng thái của tin tức
                    if ($news['status'] == 1) {
                        echo "<span class='badge bg-success'>Hiển thị</span>";
                    } elseif ($news['status'] == 0) {
                        echo "<span class='badge bg-secondary'>Ẩn</span>";
                    } elseif ($news['status'] == 2) {
                        echo "<span class='badge bg-warning text-dark'>Chờ duyệt</span>";
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars($news['description']) ?></td>

                <td>
                    <button type="button" class="btn btn-info">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>