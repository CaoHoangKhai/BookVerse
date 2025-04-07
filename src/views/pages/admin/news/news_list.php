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


<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="col">STT</th>
            <th scope="col" class="col">Tiêu đề</th>
            <th scope="col" class="col">Ngày đăng</th>
            <th scope="col" class="col">Trạng thái</th>
            <th scope="col" class="col">Mô tả</th>
            <th scope="col" class="col">Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($data["News"] as $news):
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td>
                    <?php
                    $bio = htmlspecialchars_decode($news["title"]); // Chuyển HTML Entities thành ký tự thường
                
                    $maxLength = 30;
                    if (mb_strlen($bio, 'UTF-8') > $maxLength) {
                        $shortBio = mb_substr($bio, 0, mb_strrpos(mb_substr($bio, 0, $maxLength, 'UTF-8'), ' '), 'UTF-8') . '...';
                    } else {
                        $shortBio = $bio;
                    }
                    echo $shortBio;
                    ?>
                </td>
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
                <td>
                    <?php
                    $bio = htmlspecialchars_decode($news["description"]); // Chuyển HTML Entities thành ký tự thường
                
                    $maxLength = 50;
                    if (mb_strlen($bio, 'UTF-8') > $maxLength) {
                        $shortBio = mb_substr($bio, 0, mb_strrpos(mb_substr($bio, 0, $maxLength, 'UTF-8'), ' '), 'UTF-8') . '...';
                    } else {
                        $shortBio = $bio;
                    }
                    echo $shortBio;
                    ?>
                </td>
                <td>
                    <div class="d-flex align-items-center" style="white-space: nowrap;">
                        <a href="<?= APP_PATH ?>/admin/new_detail/<?= $news["new_id"]; ?>"
                            class="btn btn-primary d-flex justify-content-center align-items-center">
                            <i class="fa fa-pencil me-2"></i> Chỉnh sửa
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>