<div id="filterContainer" class="d-flex mb-3">
    <div class="dropdown me-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="categoryDropdown">
            Tất cả
        </button>
        <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto; font-size: 18px;">
            <li><button class="dropdown-item category-filter" type="button" data-action="none">Tất cả</button></li>
            <li><button class="dropdown-item category-filter" type="button" data-action="pending">Chờ duyệt</button></li>
            <li><button class="dropdown-item category-filter" type="button" data-action="hide">Ẩn</button></li>
            <li><button class="dropdown-item category-filter" type="button" data-action="show">Hiển thị</button></li>
        </ul>
    </div>
    <input type="text" id="searchBook" class="form-control me-2" placeholder="Tìm kiếm sách...">
    <button type="button" class="btn btn-primary" style="white-space: nowrap;"
        onclick="window.location.href='<?= APP_PATH ?>/seller/add_new'">
        THÊM TIN TỨC
    </button>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th class="col-4">Tiêu đề</th>
            <th>Ngày đăng</th>
            <th>Trạng thái</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data["NewsSeller"] as $news): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($news['title']) ?></td>
                <td><?= htmlspecialchars($news['date']) ?></td>
                <td>
                    <?php
                    switch ($news['status']) {
                        case 1:
                            echo "<span class='badge bg-success'>Hiển thị</span>";
                            break;
                        case 0:
                            echo "<span class='badge bg-secondary'>Ẩn</span>";
                            break;
                        case 2:
                            echo "<span class='badge bg-warning text-dark'>Chờ duyệt</span>";
                            break;
                    }
                    ?>
                </td>
                <td>
                    <?= (mb_strlen($news['description'], 'UTF-8') > 30)
                        ? htmlspecialchars(mb_substr($news['description'], 0, 30, 'UTF-8')) . '...'
                        : htmlspecialchars($news['description']); ?>
                </td>
                <td>
                    <a href="<?= APP_PATH ?>/seller/new_detail/<?= $news["new_id"]; ?>" class="btn btn-info">
                        <i class="fas fa-eye me-1"></i> Xem chi tiết
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
