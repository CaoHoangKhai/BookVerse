<?php
// print_r($data["BestSell"]);
?>

<div class="container">
    <div class="row mt-1">
        <!-- Khối Sản Phẩm -->
        <div class="col-3">
            <a class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="p-3 border bg-primary d-flex justify-content-between align-items-center rounded">
                    <div class="text-left text-white fs-5">
                        <div class="text-left text-white fs-3">
                            <?php echo $data["countBooksBySeller"]; ?>
                        </div>
                        <div>Sản Phẩm</div>
                    </div>
                    <div class="text-right">
                        <i class="fa fa-box-open fa-5x text-white"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Khối Tin Tức -->
        <div class="col-3">
            <div class="p-3 border bg-info d-flex justify-content-between align-items-center rounded">
                <div class="text-left text-white fs-5">
                    <div class="text-left text-white fs-3">
                        <?php echo $data["countNewsBySeller"]; ?>
                    </div>
                    <div>Tin Tức Đã Đăng</div>
                </div>
                <div class="text-right">
                    <i class="fa fa-newspaper fa-5x text-white"></i>
                </div>
            </div>
        </div>

        <!-- Khối Doanh Thu -->
        <div class="col-3">
            <a class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="p-3 border bg-success d-flex justify-content-between align-items-center rounded">
                    <div class="text-left text-white fs-5">
                        <div class="text-left text-white fs-3">
                            <?php echo number_format($data["totalRevenueBySeller"], 0, ',', '.'); ?>đ
                        </div>
                        <div>Doanh Thu</div>
                    </div>
                    <div class="text-right">
                        <i class="fa fa-dollar-sign fa-5x text-white"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Khối Tổng Đơn Hàng -->
        <div class="col-3">
            <a class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="p-3 border bg-warning d-flex justify-content-between align-items-center rounded">
                    <div class="text-left text-dark fs-5">
                        <div class="text-left text-dark fs-3"><?php echo $data["getTotalOrdersByPublisher"]; ?></div>
                        <div>Tổng Đơn Hàng</div>
                    </div>
                    <div class="text-right">
                        <i class="fa fa-shopping-cart fa-5x text-dark"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Biểu đồ đơn hàng theo ngày -->
    <div class="row mt-3">
        <?php
        $orders = $data["getTotalOrdersByPublisherByDate"];
        foreach ($orders as &$order) {
            $order['Order_date'] = date('d-m', strtotime($order['Order_date']));
            $order['total_orders'] = (int) $order['total_orders'];
        }

        usort($orders, function ($a, $b) {
            return strtotime($a['Order_date']) - strtotime($b['Order_date']);
        });

        $total_orders = array_sum(array_column($orders, 'total_orders'));
        ?>

        <div class="col-md-8">
            <div class="border border-2 p-3 mb-3">
                <h5>Biểu đồ số đơn hàng trong 28 ngày gần nhất</h5>
                <canvas id="orderBarChart"></canvas>

                <div class="mt-3">
                    <h6>Tổng số đơn hàng: <?php echo $total_orders; ?> đơn</h6>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const orders = <?php echo json_encode($orders); ?>;
                    const orderBarLabels = orders.map(order => order['Order_date']);
                    const orderBarData = orders.map(order => order['total_orders']);

                    const ctxOrder = document.getElementById('orderBarChart').getContext('2d');
                    const orderBarChart = new Chart(ctxOrder, {
                        type: 'bar',
                        data: {
                            labels: orderBarLabels,
                            datasets: [{
                                label: 'Số đơn hàng',
                                data: orderBarData,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
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
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Số đơn'
                                    },
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- Biểu đồ tròn trạng thái đơn hàng -->
        <?php
        $totalOrders = 0;
        foreach ($data["OrderPercentage"] as $status) {
            $totalOrders += $status['Total_orders'];
        }

        $orderPercentages = [];
        $statusLabels = [];

        foreach ($data["OrderPercentage"] as $status) {
            $statusId = $status['Order_Status'];
            $statusName = $status['Status_name'];
            $statusLabels[$statusId] = $statusName;

            $percentage = ($totalOrders > 0) ? ($status['Total_orders'] / $totalOrders) * 100 : 0;
            $orderPercentages[$statusId] = round($percentage, 2);
        }
        ?>

        <div class="col-md-4">
            <div class="border border-2 p-3 mb-3">
                <h5>Thống kê trạng thái đơn hàng</h5>

                <?php if (!empty($orderPercentages)): ?>
                    <canvas id="orderPieChart"></canvas>

                    <style>
                        #orderPieChart {
                            max-width: 250px;
                            max-height: 250px;
                            margin: auto;
                        }
                    </style>

                    <script>
                        var pieLabels = [];
                        var pieData = [];

                        <?php foreach ($orderPercentages as $status => $percent): ?>
                            pieLabels.push("<?php echo $statusLabels[$status]; ?>");
                            pieData.push(<?php echo $percent; ?>);
                        <?php endforeach; ?>

                        var ctxPie = document.getElementById('orderPieChart').getContext('2d');
                        var orderPieChart = new Chart(ctxPie, {
                            type: 'pie',
                            data: {
                                labels: pieLabels,
                                datasets: [{
                                    label: 'Phần trăm trạng thái đơn hàng',
                                    data: pieData,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
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


        <!-- Danh sách đơn hàng đang chờ xác nhận -->
        <div class="col-md-8">
            <div class="border border-2 p-3 mb-3">
                <h5>Danh sách đơn hàng đang chờ xác nhận</h5>
                <?php if (!empty($data["OrderNew"])): ?>
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
                            <?php foreach (array_slice($data["OrderNew"], 0, 5) as $order): ?>
                                <tr>
                                    <td><?php echo $order['Item_code']; ?></td>
                                    <td><?php echo $order['Full_Name']; ?></td>
                                    <td><?php echo !empty($order['Order_date']) ? date("d/m/Y", strtotime($order['Order_date'])) : 'Không có dữ liệu'; ?>
                                    </td>
                                    <td><?php echo number_format($order['Sum'], 0, ',', '.'); ?> đ</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm">
                                            <a href="<?= APP_PATH ?>/seller/order_detail/<?= $order['Order_id'] ?>"
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
                    <p class="text-center text-muted">Không có đơn hàng nào đang chờ xác nhận.</p>
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