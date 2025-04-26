<?php
$users = $data["User"];
// $orders = $data["Orders"];
$roles = $data["AllRole"];
$statusList = $data["Status"];
// print_r($orders);
// print_r($data["AllRole"]);
?>
<div class="container mt-4 border rounded">
    <h2 class="mb-3 text-center">Thông Tin Người Dùng</h2>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info"
                type="button" role="tab" aria-controls="nav-info" aria-selected="true">
                Thông Tin
            </button>
            <!-- <button class="nav-link" id="nav-orders-tab" data-bs-toggle="tab" data-bs-target="#nav-orders" type="button"
                role="tab" aria-controls="nav-orders" aria-selected="false">
                Đơn Hàng
            </button> -->
        </div>
    </nav>

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
                    <select class="form-select" name="role_id">
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= htmlspecialchars($role['Role_id']); ?>"
                                <?= $role['Role_id'] == $users['Role_id'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($role['Role_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Trạng Thái -->
                <div class="mb-3">
                    <label class="form-label"><strong>Trạng Thái</strong></label>
                    <select class="form-select" name="status">
                        <?php foreach ($statusList as $status): ?>
                            <option value="<?= $status['id']; ?>" <?= ($status['id'] == $users['Status']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($status['Status_Name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
                    <a href="<?= APP_PATH ?>/admin/users_list" class="btn btn-primary">
                        <i class="fa fa-reply" aria-hidden="true"></i> Quay lại
                    </a>

                    <button type="submit" class="btn btn-warning" name="edit_user">
                        <i class="fa fa-pencil"></i> Chỉnh sửa
                    </button>
                </div>

            </form>
        </div>

        <!-- Tab Đơn Hàng -->
        
    </div>
</div>

<!-- <div class="tab-pane fade rounded" id="nav-orders" role="tabpanel" aria-labelledby="nav-orders-tab"
            tabindex="0">
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Đơn Hàng</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders)): ?>
                            <?php
                            $counter = 1;
                            foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $counter++; ?></td>
                                    <td>
                                        <?php
                                        echo !empty($order['Order_date']) ? date("d/m/Y", strtotime($order['Order_date'])) : 'Không có dữ liệu';
                                        ?>
                                    </td>
                                    <td><?= number_format($order['Sum'], 0, ',', '.'); ?> đ</td>
                                    <td><?= htmlspecialchars($order['Status_name']); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-<?= $order['Order_id']; ?>">
                                            <i class="fa fa-eye"></i> Xem chi tiết
                                        </button>

                                       
                                        <div class="modal fade" id="exampleModal-<?= $order['Order_id']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel-<?= $order['Order_id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel-<?= $order['Order_id']; ?>">Chi Tiết Đơn Hàng
                                                            #<?= $order['Item_code']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <h5>THÔNG TIN KHÁCH HÀNG </h5>
                                                            <div class="col-6">
                                                                <p><strong>Khách hàng:</strong>
                                                                    <?= htmlspecialchars($order['Order_Name']); ?></p>
                                                                <p><strong>Số điện thoại:</strong>
                                                                    <?= htmlspecialchars($order['Phone_Number']); ?></p>
                                                                <p><strong>Email:</strong>
                                                                    <?= htmlspecialchars($order['Email']); ?></p>
                                                                <p><strong>Địa chỉ:</strong>
                                                                    <?= htmlspecialchars($order['City_Order'] . ' - ' . $order['District_Order'] . ' - ' . $order['User_Location_Address']); ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p><strong>Trạng thái:</strong>
                                                                    <?= htmlspecialchars($order['Status_name']); ?></p>
                                                                <p><strong>Phương thức thanh toán:</strong>
                                                                    <?= htmlspecialchars($order['PaymentMethod_name']); ?></p>
                                                                <p><strong>Tổng tiền:</strong>
                                                                    <?= number_format($order['Sum'], 0, ',', '.'); ?> VNĐ</p>
                                                                <p><strong>Ngày đặt hàng:</strong>
                                                                    <?php
                                                                    echo !empty($order['Order_date']) ? date("d-m-Y", strtotime($order['Order_date'])) : 'Không có dữ liệu';
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div>
                                                            <h5>CHI TIẾT ĐƠN HÀNG</h5>
                                                            <ul>
                                                                <?php
                                                                $books = explode("|", $order['Books']);
                                                                foreach ($books as $book) {
                                                                    echo "<li>" . htmlspecialchars($book) . "</li>";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Không có đơn hàng nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div> -->