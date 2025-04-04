<div class="d-flex mb-3">
    <div class="dropdown me-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
            id="categoryDropdown">
            Tất cả
        </button>
        <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto; font-size: 18px;">
            <li><button class="dropdown-item category-filter" type="button" data-category="Tất cả">Tất cả</button></li>
            <?php
            if (!empty($data["Categories"])) {
                foreach ($data["Categories"] as $role) {
                    echo '<li><button class="dropdown-item category-filter" type="button" data-category="' . htmlspecialchars($role['Category_name']) . '">' . htmlspecialchars($role['Category_name']) . '</button></li>';
                }
            } else {
                echo '<li><button class="dropdown-item" type="button">Không có thông tin</button></li>';
            }
            ?>
        </ul>
    </div>
    <input type="text" id="searchBook" class="form-control me-2" placeholder="Tìm kiếm sách...">
    <button type="button" class="btn btn-primary" style="white-space: nowrap;"
        onclick="window.location.href='<?= APP_PATH ?>/seller/add_book'">
        THÊM SÁCH
    </button>
</div>
<!--Table-->
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="col">ID</th>
            <th scope="col" class="col-2">Tiêu đề sách</th>
            <th scope="col" class="col">Hình ảnh</th>
            <th scope="col" class="col">Tác giả</th>
            <th scope="col" class="col">Thể loại</th>
            <th scope="col" class="col">Số lượng</th>
            <th scope="col" class="col-1">Giá</th>
            <th scope="col" class="col-1">Ngày đăng</th>
            <th scope="col" class="col-1">Trạng thái</th>
            <th scope="col" class="col-1">Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody id="bookTable">
        <?php
        $counter = 1;
        foreach ($data["SellerBooks"] as $books):
            ?>
            <tr>
                <td><?= $counter++; ?></td>
                <td><?= (mb_strlen($books["Title"], 'UTF-8') > 30) ? mb_substr($books["Title"], 0, 30, 'UTF-8') . '...' : $books["Title"] ?>
                </td>
                <td>
                    <img src="<?php echo $this->image_books($books["Category_type"], $books["Images"][0]); ?>"
                        alt="<?= $books["Title"] ?>" width="60" height="80"
                        style="border: none; padding: 0; margin: 0; object-fit: cover; background-color: transparent;">
                </td>

                <td><?= $books["Author_Name"] ?></td>
                <td><?= $books["Category_name"] ?></td>
                <td><?= $books["quantity"] ?></td>
                <td><?= number_format($books["Price"], 0, ',', '.') ?> đ</td>
                <td>
                    <?php
                    $date = new DateTime($books['Date_added']);
                    echo $date->format('d/m/Y');
                    ?>
                </td>
                <td>
                    <span class="badge 
                        <?php
                        switch ($books['Status_id']) {
                            case 1:
                                echo 'bg-success'; // Còn hàng
                                break;
                            case 2:
                                echo 'bg-secondary'; // Hết hàng
                                break;
                            case 3:
                                echo 'bg-dark'; // Ngừng kinh doanh
                                break;
                            case 4:
                                echo 'bg-warning'; // Đang cập nhật
                                break;
                            default:
                                echo 'bg-secondary'; // Màu mặc định nếu không có trạng thái
                                break;
                        }
                        ?>
                    ">
                        <?= $books['Status'] ?>
                    </span>
                </td>
                <td style="white-space: nowrap;">
                    <a href="<?= APP_PATH ?>/seller/product_detail/<?= $books["Book_id"]; ?>"
                        class="btn btn-primary me-2 d-inline-flex align-items-center"
                        style="width: auto; padding: 8px 12px;">
                        <i class="fa fa-pencil fa-lg me-2"></i> Chỉnh Sửa
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>