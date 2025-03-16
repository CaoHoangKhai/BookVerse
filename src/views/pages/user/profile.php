<?php
$users = $data["User"];
?>
<div class="container mt-4 border rounded">
    <br>
    <h2 class="mb-3 text-center">Thông Tin Người Dùng</h2>
    <div class="tab-content" id="nav-tabContent">
        <!-- Tab Thông Tin -->
        <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab"
            tabindex="0">
            <form class="border p-4 rounded shadow bg-light mt-3" method="POST">
                <div class="mb-3">
                    <label class="form-label"><strong>ID Người Dùng</strong></label>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($users['User_id']); ?>">
                    <input type="text" class="form-control" value="<?= htmlspecialchars($users['User_id']); ?>"
                        disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Họ và Tên</strong></label>
                    <input type="text" class="form-control" name="username"
                        value="<?= htmlspecialchars($users['Full_Name']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Số Điện Thoại</strong></label>
                    <input type="text" class="form-control" name="phonenumber"
                        value="<?= htmlspecialchars($users['Phone_Number']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Email</strong></label>
                    <input type="email" class="form-control" name="email"
                        value="<?= htmlspecialchars($users['Email']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Vai Trò</strong></label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($users['Role_Name']); ?>"
                        disabled>
                </div>

                <!-- Trạng Thái -->
                <div class="mb-3">
                    <label class="form-label"><strong>Trạng Thái</strong></label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($users['Status_Name']); ?>"
                        disabled>
                </div>

                <?php if (!empty($users['Address'])): ?>
                    <div class="mb-3">
                        <label class="form-label"><strong>Địa Chỉ</strong></label>
                        <select class="form-select" id="addressDropdown">
                            <option value="">Địa Chỉ Của Người Dùng</option>
                            <?php foreach ($users['Address'] as $address): ?>
                                <option value="<?= htmlspecialchars(json_encode($address)); ?>">
                                    <?= htmlspecialchars($address['City_Name'] . ' - ' . $address['District_Name'] . ' - ' . $address['Address']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php else: ?>
                    <p>Người dùng chưa có địa chỉ.</p>
                <?php endif; ?>
                <div class="text-center">
                    <button type="submit" class="btn btn-warning" name="edit_user">
                        <i class="fa fa-pencil"></i> Chỉnh sửa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>