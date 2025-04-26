<!-- Button trigger modal -->
<div class="d-flex mb-3">
    <div class="dropdown me-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
            id="categoryDropdown">
            Tất cả
        </button>
        <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto; font-size: 18px;">
            <li><button class="dropdown-item category-filter" type="button" data-category="Tất cả">Tất cả</button></li>
            <?php
            if (!empty($data["OrdersStatus"])) {
                foreach ($data["OrdersStatus"] as $role) {
                    echo '<li><button class="dropdown-item category-filter" type="button" data-category="' . htmlspecialchars($role['Status_name']) . '">' . htmlspecialchars($role['Status_name']) . '</button></li>';
                }
            } else {
                echo '<li><button class="dropdown-item" type="button">Không có thông tin</button></li>';
            }
            ?>
        </ul>
    </div>
    <input type="text" id="searchBook" class="form-control me-2" placeholder="Tìm kiếm đơn hàng...">
</div>
<!-- Table -->
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="col">ID</th>
            <th scope="col" class="col-1 text-center">Mã đơn hàng</th>
            <th scope="col" class="col-3 text-center">Địa chỉ</th>
            <th scope="col" class="col text-center">Trạng thái</th>
            <th scope="col" class="col-3 text-center">Hình thức thanh toán</th>
            <th scope="col" class="col-1 text-center">Tổng tiền</th>
            <th scope="col" class="col text-center">Ngày đặt</th>
            <th scope="col" class="col text-center">Chỉnh</th>
        </tr>
    </thead>
    <tbody id="bookTable">
        <?php
        $counter = 1;
        foreach ($data["OrdersSeller"] as $orders): ?>
            <tr class="order-row" data-status="<?= $orders["Status_Name"] ?>">
                <td class="text-center align-middle"><?= $counter++ ?></td>
                <td class="text-center align-middle"><?= $orders["Item_code"] ?> </td>
                <td class="text-start align-middle">
                    <strong>Thành phố: </strong><?= $orders["City_Order"] ?><br>
                    <strong>Quận/Huyện: </strong><?= $orders["District_Order"] ?><br>
                    <strong>Địa chỉ: </strong><?= $orders["Address"] ?>
                </td>
                <td class="text-center align-middle">
                    <?php
                    $statusColors = [
                        1 => 'bg-warning',   // Đang chờ xác nhận (Giữ nguyên)
                        2 => 'bg-primary',   // Đang chuẩn bị (Chuyển từ xanh dương nhạt sang xanh đậm)
                        3 => 'bg-info',      // Đang vận chuyển (Chuyển từ xanh đậm sang xanh nhạt)
                        4 => 'bg-success',   // Đã giao hàng (Giữ nguyên)
                        5 => 'bg-secondary', // Đã hoàn thành (Chuyển từ đen sang xám nhạt)
                        6 => 'bg-danger',    // Đã hủy (Giữ nguyên)
                        7 => 'bg-dark',      // Vận chuyển thất bại (Chuyển từ xám sang đen)
                    ];
                    // Xác định màu dựa vào Status_id, nếu không có thì mặc định 'bg-secondary'
                    $badgeClass = isset($statusColors[$orders['Order_Status']]) ? $statusColors[$orders['Order_Status']] : 'bg-secondary';
                    ?>
                    <span class="badge <?= $badgeClass ?>">
                        <?= $orders['Status_Name'] ?>
                    </span>
                </td>
                <td class="text-center align-middle"><?= $orders["PaymentMethod_name"] ?></td>
                <td class="text-center align-middle"><?= number_format($orders["Sum"], 0, ',', '.') ?> đ</td>
                <td class="text-center align-middle"><?= !empty($orders['Order_date']) ? date("d/m/Y", strtotime($orders['Order_date'])) : 'Không có dữ liệu'; ?></td>
                <td class="text-center align-middle">
                    <div class="d-flex justify-content-center">
                        <a href="<?= APP_PATH ?>/seller/order_detail/<?= $orders["Order_id"]; ?>"
                            class="btn btn-primary me-2" style="width: 40px; height: 40px;">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <!-- <button class="btn btn-danger me-2" style="width: 40px; height: 40px;">
                            <i class="fa fa-trash"></i>
                        </button> -->
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    document.getElementById("searchBook").addEventListener("keyup", function () {
        let searchValue = this.value.trim().toUpperCase();
        let rows = document.querySelectorAll(".order-row");

        rows.forEach(row => {
            let orderCode = row.querySelector("td:nth-child(2)").textContent.trim().toUpperCase();
            let shortCode = orderCode.split("-").pop(); // Lấy phần sau dấu "-"

            if (orderCode.includes(searchValue) || shortCode.includes(searchValue)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

</script>