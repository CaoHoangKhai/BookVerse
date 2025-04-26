<?php
$pay = $data["Pay"];
$users = $data["User"];
$order = $data["Order"];
// print_r($users["Address"]);
?>
<main>
    <div class="container">
        <form class="row g-3 needs-validation" action="" method="POST" novalidate>
            <div class="row">
                <div class="col-7">
                    <br>
                    <div class="text-start fs-3">THÔNG TIN THANH TOÁN</div>
                    <br>
                    <div class="mx-2 row g-3 needs-validation">

                        <div class="col-md-6">
                            <label class="form-label fs-6"><strong>Họ và tên*</strong></label>
                            <input type="text" class="form-control" name="username" id="fullname"
                                placeholder="Họ tên của bạn" autofocus required value="<?= $users["Full_Name"] ?>">
                            <div class="invalid-feedback">
                                Họ và tên không được bỏ trống.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputNumber4" class="form-label"><strong>Số điện thoại*</strong></label>
                            <input type="text" class="form-control" name="phonenumber" id="inputNumber4"
                                placeholder="Số điện thoại của bạn" required value="<?= $users["Phone_Number"] ?>">
                            <div id="phoneFeedback" class="invalid-feedback">
                                <!-- Thông báo mặc định -->
                                Số điện thoại không hợp lệ. Hãy nhập số điện thoại theo định dạng chính xác.
                            </div>
                            <div id="phoneEmptyFeedback" class="invalid-feedback">
                                <!-- Thông báo khi trống -->
                                Số điện thoại không được bỏ trống.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fs-6"><strong>Phương Thức Thanh Toán</strong></label>
                            <select class="form-select" name="payment_method" required>
                                <option value="">-- Chọn phương thức --</option>
                                <?php foreach ($pay as $method): ?>
                                    <option value="<?= $method['PaymentMethod_id'] ?>">
                                        <?= htmlspecialchars($method['PaymentMethod_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Vui lòng chọn phương thức thanh toán.</div>
                        </div>


                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label"><strong>Email*</strong></label>
                            <input type="email" class="form-control" name="email" id="inputEmail4"
                                placeholder="Email của bạn" required value="<?= $users["Email"] ?>">
                            <div class="invalid-feedback">
                                Email không được bỏ trống.
                            </div>
                        </div>


                        <div class="col-md-12">
                            <label class="form-label fs-6"><strong>Địa chỉ</strong></label>
                            <select class="form-select" name="address" required>
                                <option value="">-- Chọn địa chỉ --</option>
                                <?php if (!empty($users["Address"]) && is_array($users["Address"])): ?>
                                    <?php foreach ($users["Address"] as $address): ?>
                                        <option value="<?= htmlspecialchars($address['id']) ?>">
                                            <?= htmlspecialchars($address['City_Name'] . " - " . $address['District_Name'] . " - " . $address['Address']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>Không có địa chỉ nào</option>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Vui lòng chọn địa chỉ.</div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label for="inputAddress" class="form-label">
                                <strong>
                                    Ghi chú đơn hàng (tuỳ chọn)
                                </strong>
                            </label>
                            <textarea class="form-control" name="note"
                                placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."
                                rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <br>
                    <table class="table">
                        <div class="fs-3">ĐƠN HÀNG CỦA BẠN</div>
                        <br>
                        <tbody>
                            <tr>
                                <td class="text-muted fs-6"><strong>SẢN PHẨM</strong></td>
                                <td class="text-muted text-end"><strong>TẠM TÍNH</strong></td>
                            </tr>
                        </tbody>

                        <tbody>
                            <?php
                            $total = 0;
                            if (!empty($order)):
                                foreach ($order as $nxb => $books): ?>
                                    <!-- Tên nhà xuất bản -->
                                    <tr>
                                        <td colspan="2" class="fw-bold text-primary"><?= htmlspecialchars($nxb) ?></td>
                                    </tr>
                                    <?php foreach ($books as $item):
                                        $subtotal = $item['Price'] * $item['Quantity'];
                                        $total += $subtotal;
                                        ?>
                                        <tr>
                                            <td class="text-muted">
                                                <?= htmlspecialchars($item['Title']) ?> x <?= (int) $item['Quantity'] ?>
                                            </td>
                                            <td class="text-end">
                                                <?= number_format($subtotal, 0, ',', '.') ?>&#8363;
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Giỏ hàng trống</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                        <!-- Tổng tiền -->
                        <tbody>
                            <tr>
                                <td class="text-muted"><strong>Tạm Tính</strong></td>
                                <td class="text-end"><b><?= number_format($total, 0, ',', '.') ?>&#8363;</b></td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Giao Hàng</strong></td>
                                <td class="text-end">Miễn phí giao hàng</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Tổng</strong></td>
                                <td class="text-end"><b><?= number_format($total, 0, ',', '.') ?>&#8363;</b></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Nút đặt hàng -->
                    <div>
                        <input type="hidden" name="sum" value="<?= $total ?>">
                        <input type="hidden" name="order_date" value="<?= date('Y-m-d') ?>">
                        <button class="btn btn-danger centered-btn" name="order_detail">ĐẶT HÀNG</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>