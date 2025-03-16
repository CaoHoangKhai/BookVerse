<h5>Thêm địa chỉ</h5>
<div class="mx-2">
    <div class="container card p-4">
        <form class="row g-3 needs-validation" method="POST" novalidate>

            <div class="col-md-6">
                <label for="validationCustom04" class="form-label"><strong>Tỉnh/Thành phố*</strong></label>
                <select class="form-select" name="city" id="city" required>
                    <option selected value="">Chọn Tỉnh/Thành phố của bạn</option>
                </select>
                <div class="invalid-feedback">
                    Hãy chọn một tỉnh/thành phố hợp lệ.
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom04" class="form-label"><strong>Quận/Huyện*</strong></label>
                <select class="form-select" name="district" id="district" required>
                    <option selected value="">Chọn Quận/Huyện của bạn</option>
                </select>
                <div class="invalid-feedback">
                    Hãy chọn một quận/huyện hợp lệ.
                </div>
            </div>
            <div class="col-md-12">
                <label for="inputAddress" class="form-label"><strong>Địa chỉ*</strong></label>
                <input type="text" class="form-control" name="address" id="inputAddress"
                    placeholder="Nhập địa chỉ của bạn VD: Số 20, ngõ 90"
                    value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required>
                <div class="invalid-feedback">
                    Địa chỉ không được bỏ trống.
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success me-2" name="addLocation">Thêm địa chỉ</button>
            </div>
        </form>
    </div>
</div>
<div class="mx-2">
    <h5>📍 Danh sách địa chỉ của tôi</h5>
    <ul class="list-group" id="address-list">
        <?php
        $addresses = $data["Location"]["Address"]; // Lấy danh sách địa chỉ từ dữ liệu người dùng
        if (!empty($addresses)) {
            foreach ($addresses as $address) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-center"
                    id="address-<?= $address['id'] ?>">
                    <div>
                        <strong>🏙 Thành phố:</strong> <?= htmlspecialchars($address['City_Name']); ?>,
                        <strong>📍 Quận/Huyện:</strong> <?= htmlspecialchars($address['District_Name']); ?>,
                        <strong>🏠 Địa chỉ:</strong> <?= htmlspecialchars($address['Address']); ?>
                    </div>
                    <form method="POST" action="" style="position: absolute; top: 2px; right: 2px;">
                        <input type="hidden" name="address_id" value="<?= $address['id'] ?>">
                        <button type="submit" name="deleteLocation"
                            style="border: none; background: transparent; font-size: 18px; font-weight: bold; color: black; cursor: pointer;">
                            ✖
                        </button>
                    </form>
                </li>
            <?php }
        } else { ?>
            <li class="list-group-item text-danger">🚫 Chưa có địa chỉ nào.</li>
        <?php } ?>
    </ul>
</div>