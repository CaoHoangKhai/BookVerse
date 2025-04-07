<?php
// print_r($data["getTotalRevenueByDate"]);
print_r($data["OrderPercentage"]);
?>
<div class="container">
    <div class="row mt-1">
        <!-- Khối Khách Hàng -->
        <div class="col-3">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= APP_PATH ?>/admin/users_list">
                <div class="p-3 border bg-info d-flex justify-content-between align-items-center rounded">
                    <div class="text-left text-white fs-5">
                        <div class="text-left text-white fs-3"><?php echo $data["CountUser"]; ?></div>
                        <div>Khách Hàng</div>
                    </div>
                    <div class="text-right">
                        <i class="fa fa-users fa-5x text-black"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Khối Sản Phẩm -->
        <div class="col-3">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= APP_PATH ?>/admin/products_list">
                <div class="p-3 border bg-success d-flex justify-content-between align-items-center rounded">
                    <div class="text-left text-white fs-5">
                        <div class="text-left text-white fs-3"><?php echo $data["CountBook"]; ?></div>
                        <div>Sản Phẩm</div>
                    </div>
                    <div class="text-right">
                        <i class="fa fa-book fa-5x text-black"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Khối Doanh Thu -->
        <div class="col-3">
            <!-- <a class="link-offset-2 link-underline link-underline-opacity-0" href="/<?= APP_PATH ?>/orders/orders_list"> -->
            <div class="p-3 border bg-danger d-flex justify-content-between align-items-center rounded">
                <div class="text-left text-white fs-5">
                    <div class="text-left text-white fs-3">
                        <?php echo number_format($data["SumOrder"], 0, ',', '.'); ?>
                    </div>
                    <div>Doanh Thu</div>
                </div>
                <div class="text-right">
                    <i class="fa fa-credit-card-alt fa-5x text-black"></i> <!-- Thêm text-white -->
                </div>
            </div>
            <!-- </a> -->
        </div>


        <!-- Khối Tổng Đơn Hàng -->
        <div class="col-3">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= APP_PATH ?>/admin/orders_list">
                <div class="p-3 border bg-warning d-flex justify-content-between align-items-center rounded">
                    <div class="text-left text-white fs-5">
                        <div class="text-left text-white fs-3"><?php echo $data["CountOrder"]; ?></div>
                        <div>Tổng Đơn Hàng</div>
                    </div>
                    <div class="text-right">
                        <i class="fa fa-shopping-cart fa-5x text-black"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-3">
        <?php
        // Dữ liệu doanh thu đã được lấy từ database
        $revenues = $data["getTotalRevenueByDate"];

        // Xử lý và loại bỏ "VND" và các ký tự không phải số trong `total_revenue`
        foreach ($revenues as &$revenue) {
            $revenue['total_revenue'] = (float) str_replace(['.', ' VND'], '', $revenue['total_revenue']);

            // Lấy chỉ ngày và tháng từ Order_date
            $revenue['Order_date'] = date('d-m', strtotime($revenue['Order_date']));
        }

        // Sắp xếp mảng theo ngày giảm dần (Order_date)
        usort($revenues, function ($a, $b) {
            return strtotime($b['Order_date']) - strtotime($a['Order_date']);
        });

        // Tính tổng doanh thu
        $total_revenue = array_sum(array_column($revenues, 'total_revenue'));
        ?>

        <div class="col-md-8">
            <div class="border border-2 p-3 mb-3">
                <h5>Biểu đồ doanh thu theo tháng</h5>
                <canvas id="revenueChart"></canvas>

                <!-- Hiển thị tổng doanh thu -->
                <div class="mt-3">
                    <h6>Tổng doanh thu: <?php echo number_format($total_revenue, 0, ',', '.') . ' VND'; ?></h6>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Dữ liệu doanh thu được lấy từ PHP
                    const revenues = <?php echo json_encode($revenues); ?>;

                    if (revenues.length === 0) {
                        alert("Không có dữ liệu doanh thu.");
                    } else {
                        // Lấy các ngày và doanh thu từ mảng PHP
                        const labels = revenues.map(revenue => revenue['Order_date']);
                        const data = revenues.map(revenue => revenue['total_revenue']); // Đã được xử lý ở phía PHP

                        // Tạo biểu đồ đường
                        const ctx = document.getElementById('revenueChart').getContext('2d');
                        const revenueChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,  // Các ngày (ngày mới nhất sẽ ở cuối)
                                datasets: [{
                                    label: 'Doanh thu',
                                    data: data,  // Doanh thu
                                    fill: false,
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Ngày'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Doanh thu (VND)'
                                        },
                                        ticks: {
                                            callback: function (value) {
                                                return value.toLocaleString(); // Định dạng với dấu phân cách nghìn
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true, // Hiển thị legend
                                        position: 'top'
                                    }
                                }
                            }
                        });
                    }
                </script>
            </div>
        </div>

        <?php
        // Lấy tổng số đơn hàng
        $totalOrders = 0;
        foreach ($data["OrderPercentage"] as $status) {
            $totalOrders += $status['Total_orders'];
        }

        // Tính phần trăm cho mỗi trạng thái
        $orderPercentages = [];
        foreach ($data["OrderPercentage"] as $status) {
            $percentage = ($totalOrders > 0) ? ($status['Total_orders'] / $totalOrders) * 100 : 0;
            $orderPercentages[$status['Status_id']] = round($percentage, 2); // Làm tròn phần trăm
        }
        ?>

        <div class="col-md-4">
            <div class="border border-2 p-3 mb-3">
                <h5>Thống kê trạng thái đơn hàng</h5>
                <?php if (!empty($orderPercentages)): ?>
                    <canvas id="orderChart"></canvas>

                    <style>
                        #orderChart {
                            max-width: 250px;
                            max-height: 250px;
                            margin: auto;
                        }
                    </style>

                    <script>
                        var labels = [];
                        var data = [];

                        <?php
                        $statusLabels = [
                            1 => "Đang chờ xác nhận",
                            2 => "Đang chuẩn bị",
                            3 => "Đang vận chuyển",
                            4 => "Đã giao hàng",
                            5 => "Đã hoàn thành",
                            6 => "Đã hủy",
                            7 => "Vận chuyển thất bại",
                            8 => "Đang chờ xác nhận (Hủy)"
                        ];

                        foreach ($orderPercentages as $status => $percent):
                            $label = isset($statusLabels[$status]) ? $statusLabels[$status] : "Không xác định";
                            ?>
                            labels.push("<?php echo $label; ?>");
                            data.push(<?php echo $percent; ?>);
                        <?php endforeach; ?>

                        var ctx = document.getElementById('orderChart').getContext('2d');
                        var orderChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Phần trăm trạng thái đơn hàng',
                                    data: data,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 159, 64, 0.6)',
                                        'rgba(199, 199, 199, 0.6)',
                                        'rgba(100, 100, 255, 0.6)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            boxWidth: 15,
                                            padding: 10
                                        }
                                    }
                                }
                            }
                        });
                    </script>
                <?php else: ?>
                    <p class="text-center text-muted">Không có dữ liệu để hiển thị.</p>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-8">
            <div class="border border-2 p-3 mb-3">
                <h5>Danh sách đơn hàng đang chờ xác nhận</h5>
                <?php
                if (!empty($data["NewOrder"])):
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Người đặt</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Xem chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach (array_slice($data["NewOrder"], 0, 5) as $order):
                                ?>
                                <tr>
                                    <td><?php echo $order['Item_code']; ?></td>
                                    <td><?php echo $order['Full_Name']; ?></td>
                                    <td><?php echo !empty($order['Order_date']) ? date("d/m/Y", strtotime($order['Order_date'])) : 'Không có dữ liệu'; ?>
                                    </td>
                                    <td><?php echo number_format($order['Sum'], 0, ',', '.'); ?> đ</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm">
                                            <a href="<?= APP_PATH ?>/admin/order_detail/<?= $order['Order_id'] ?>"
                                                class="link-offset-2 link-underline link-underline-opacity-0 text-dark">
                                                <i class="fa fa-eye"></i> Xem chi tiết
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center text-muted">Bạn chưa có đơn hàng mới.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="border border-2 p-3 mb-3">
                <h5>📈 Top sản phẩm bán chạy</h5>
                <?php
                foreach ($data["BestSell"] as $book): ?>
                    <div class="d-flex align-items-center mb-3">
                        <!-- Hình ảnh -->
                        <img src="<?= $this->image_books($book["Category_type"], $book['Image_URL']) ?>"
                            alt="<?= htmlspecialchars($book['Book_Title']); ?>" class="me-3" width="50" height="50">

                        <!-- Thông tin sách -->
                        <div>
                            <p class="mb-1"><strong><?= htmlspecialchars($book['Book_Title']); ?></strong></p>
                            <p class="text-muted">📦 <?= $book['Total_Sold']; ?> đã bán</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>