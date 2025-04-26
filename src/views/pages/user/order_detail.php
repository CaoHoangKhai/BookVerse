<?php
$order = $data["OrderDetail"];
// print_r($order);
?>
<h1 class="text-center">Thông Tin Đơn Hàng</h1>
<div class="card mt-3 mb-3 p-4 shadow">
    <h5 class="text-primary">👤 Thông Tin Người dùng</h5>
    <hr>
    <div class="modal-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <p><strong>Khách hàng: </strong> <?= htmlspecialchars($order['Order_Name']); ?></p>
                <p><strong>Số điện thoại: </strong> <?= htmlspecialchars($order['Phone_Number']); ?></p>
                <p><strong>Email: </strong> <?= htmlspecialchars($order['Email']); ?></p>
                <p><strong>Địa chỉ: </strong>
                    <?= htmlspecialchars($order['City_Order']); ?>,<?= htmlspecialchars($order['District_Order']); ?>,<?= htmlspecialchars($order['User_Location_Address']); ?>
                </p>
            </div>
            <div class="col-12 col-md-6">
                <div class="d-flex flex-column gap-2">
                    <p class="mb-0"><strong>Trạng thái:</strong>
                        <?= htmlspecialchars($order['Status_Name']); ?>
                    </p>
                    <p class="mb-0"><strong>Phương thức thanh toán: </strong>
                        <?= htmlspecialchars($order['PaymentMethod_name']); ?>
                    </p>
                    <p class="mb-0"><strong>Ngày đặt hàng: </strong>
                        <?= !empty($order['Order_date']) ? date("d/m/Y", strtotime($order['Order_date'])) : 'Không có dữ liệu'; ?>
                    </p>
                    <p class="mb-0"><strong>Tổng tiền: </strong> <?= number_format($order['Sum'], 0, ',', '.'); ?> VNĐ
                    </p>
                </div>
            </div>
        </div>
        <?php if ($order['Status_Name'] === 'Đang chờ xác nhận'): ?>
            <div class="text-end mb-3">
                <form action="" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                    <button type="submit" class="btn btn-danger" name="cancelOrder" value="Hủy Đơn Hàng">
                        ❌ Hủy đơn hàng
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="card mt-3 mb-3 p-4 shadow">
    <h5 class="text-dark">📋 Chi Tiết Đơn Hàng #<?= $order["Item_code"] ?></h5>
    <?php if (!empty($order["Products"])): ?>
        <table class="table table-bordered text-center align-middle">
            <thead class="table-info">
                <tr>
                    <th>Tên sách</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order["Products"] as $item): ?>
                    <tr>
                        <td class="text-start"><?= htmlspecialchars($item['Title']) ?></td>
                        <td><?= $item['Quantity'] ?></td>
                        <td><?= number_format($item['Price'], 0, ',', '.') ?> VNĐ</td>
                        <td><?= number_format($item['Quantity'] * $item['Price'], 0, ',', '.') ?> VNĐ</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center text-danger">Không có sản phẩm nào trong đơn hàng.</p>
    <?php endif; ?>
</div>