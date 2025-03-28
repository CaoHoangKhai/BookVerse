<?php
$order = $data["Order"];
print_r($data["Order"])
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
                <form action="" method="POST" class="d-flex align-items-center gap-3 mb-3">
                    <input type="hidden" name="order_id" value="<?= $order["Order_id"]; ?>">

                    <strong>Trạng thái:</strong>

                    <?php if (in_array($order["Order_Status"], [4, 5, 6, 7, 8])): ?>
                        <span class="fw-bold"><?= htmlspecialchars($order["Status_Name"]); ?></span>
                    <?php else: ?>
                        <select name="order_status" class="form-select w-auto">
                            <?php foreach ($data["Status"] as $status): ?>
                                <option value="<?= $status["Status_id"]; ?>" <?= ($status["Status_id"] == $order["Order_Status"]) ? "selected" : ""; ?>>
                                    <?= htmlspecialchars($status["Status_name"]); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit" class="btn btn-primary" name="updateOrderStatus">Cập nhật</button>
                    <?php endif; ?>
                </form>

                <div class="d-flex flex-column gap-2">
                    <p class="mb-0"><strong>Phương thức thanh toán: </strong>
                        <?= htmlspecialchars($order['PaymentMethod_name']); ?>
                        (
                        <?= $order['Payment_Status'] == 1 ? 'Đã thanh toán' : 'Chưa thanh toán'; ?>
                        )
                    </p>
                    <p class="mb-0"><strong>Ngày đặt hàng: </strong>
                        <?= !empty($order['Order_date']) ? date("d/m/Y", strtotime($order['Order_date'])) : 'Không có dữ liệu'; ?>
                    </p>
                    <p class="mb-0"><strong>Tổng tiền: </strong> <?= number_format($order['Sum'], 0, ',', '.'); ?> VNĐ
                    </p>
                </div>
            </div>
        </div>
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