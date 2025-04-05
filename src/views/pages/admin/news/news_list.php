<div id="filterContainer" class="d-flex mb-3">
    <div class="dropdown me-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
            id="categoryDropdown">
            Tất cả
        </button>
        <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto; font-size: 18px;">
            <li>
                <button class="dropdown-item category-filter" type="button" data-action="none">Tất cả</button>
            </li>
            <li>
                <button class="dropdown-item category-filter" type="button" data-action="pending">Chờ duyệt</button>
            </li>
            <li>
                <button class="dropdown-item category-filter" type="button" data-action="hide">Ẩn</button>
            </li>
            <li>
                <button class="dropdown-item category-filter" type="button" data-action="show">Hiển thị</button>
            </li>
        </ul>
    </div>
    <input type="text" id="searchBook" class="form-control me-2" placeholder="Tìm kiếm sách...">
    <button type="button" class="btn btn-primary" style="white-space: nowrap;"
        onclick="window.location.href='<?= APP_PATH ?>/admin/add_news'">
        THÊM TIN TỨC
    </button>

</div>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Ngày đăng</th>
            <th>Trạng thái</th>
            <th>Mô tả</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($data["News"] as $news):
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $news["title"] ?></td>
                <td><?= $news["date"] ?></td>
                <td>
                    <?php
                    if ($news["status"] == 1) {
                        echo "<span class='badge bg-success'>Hiển thị</span>";
                    } elseif ($news["status"] == 0) {
                        echo "<span class='badge bg-secondary'>Ẩn</span>";
                    } elseif ($news["status"] == 2) {
                        echo "<span class='badge bg-warning text-dark'>Chờ duyệt</span>";
                    }
                    ?>
                </td>
                <td><?= $news["description"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>