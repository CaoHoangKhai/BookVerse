<div class="container d-flex justify-content-center align-items-start" style="min-height: 8vh;">
    <?php if (empty($data["Cart"])): ?>
        <div class="d-flex flex-column align-items-center">
            <img src="<?= APP_PATH ?>/public/media/photos/cart/ko_co_don_hang_1.png" alt="Giỏ hàng trống" style="width:200px;">
            <p class="mt-3">Giỏ hàng của bạn đang trống</p>
        </div>
    <?php else: ?>
        <div class="row w-100">
            <!-- Bên trái: Danh sách sản phẩm -->
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table text-center align-middle">
                        <thead>
                            <tr>
                                <th class="align-middle">Hình ảnh</th>
                                <th class="align-middle">Tên sách</th>
                                <th class="align-middle">Số lượng</th>
                                <th class="align-middle">Giá</th>
                                <th class="align-middle">Thành tiền</th>
                                <th class="align-middle"></th>
                            </tr>
                        </thead>
                        <?php
                        $totalPrice = 0;

                        foreach ($data["Cart"] as $publisher => $itemsGroup):
                        ?>
                            <tr>
                                <td colspan="6" class="text-start fw-bold bg-light">
                                    <i class="fas fa-store me-2"></i><?= htmlspecialchars($publisher) ?>
                                </td>
                            </tr>
                        <?php
                            foreach ($itemsGroup as $item):
                                $itemTotal = $item['Quantity'] * $item['Price'];
                                $status = (int) $item['Status_id'];

                                switch ($status) {
                                    case 2: $statusText = "Hết hàng"; break;
                                    case 3: $statusText = "Ngừng kinh doanh"; break;
                                    case 4: $statusText = "Đang cập nhật"; break;
                                    case 5: $statusText = "Bị ẩn"; break;
                                    default: $statusText = "Không xác định"; break;
                                }

                                if ($status === 1) {
                                    $totalPrice += $itemTotal;
                                }
                        ?>
                                <tr data-cart-id="<?= $item['Cart_id'] ?>" class="align-middle">
                                    <td class="align-middle">
                                        <a href="<?= APP_PATH ?>/chi_tiet/<?= $item['Book_id'] ?>">
                                            <img src="<?= $this->image_books($item['Category_type'], $item['Image']) ?>"
                                                alt="<?= htmlspecialchars($item['Title']) ?>" style="width: 100px;">
                                        </a>
                                    </td>
                                    <td class="align-middle"><?= htmlspecialchars($item['Title']) ?></td>

                                    <?php if ($status === 1): ?>
                                        <td class="align-middle text-center w-25">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <form action="" method="POST" class="update-form d-flex align-items-center">
                                                    <input type="hidden" name="Book_id" value="<?= $item['Book_id'] ?>">

                                                    <button type="submit" class="btn btn-sm btn-outline-secondary update-quantity"
                                                        data-action="decrease" name="reduceQuantityBook">−</button>

                                                    <input class="m-2 text-center quantity-input" value="<?= $item['Quantity'] ?>"
                                                        data-id="<?= $item['Book_id'] ?>" size="2">

                                                    <button type="submit" class="btn btn-sm btn-outline-primary update-quantity"
                                                        data-action="increase" name="addQuantityBook">+</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="align-middle"><?= number_format($item['Price'], 0, ',', '.') ?>đ</td>
                                        <td class="align-middle item-total"><?= number_format($itemTotal, 0, ',', '.') ?>đ</td>
                                        <td class="align-middle">
                                            <form action="" method="POST">
                                                <button class="btn btn-lg btn-danger remove-item" name="deleteCartBook">
                                                    <input type="hidden" name="book_id" value="<?= $item['Book_id'] ?>">
                                                    <input type="hidden" name="User_id" value="<?= $_SESSION['user_Info'][0] ?>">
                                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2rem;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    <?php else: ?>
                                        <td class="align-middle" colspan="3">
                                            <span class="text-danger fw-bold"><?= $statusText ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <form action="" method="POST">
                                                <button class="btn btn-lg btn-danger remove-item" name="deleteCartBook">
                                                    <input type="hidden" name="book_id" value="<?= $item['Book_id'] ?>">
                                                    <input type="hidden" name="User_id" value="<?= $_SESSION['user_Info'][0] ?>">
                                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2rem;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                        <?php
                            endforeach;
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>

            <!-- Bên phải: Tổng tiền -->
            <div class="col-md-3 d-flex flex-column">
                <div class="shadow-sm d-flex flex-column justify-content-between">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">TỔNG TIỀN</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Thành Tiền </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><b class="fs-4"><?= number_format($totalPrice, 0, ',', '.') ?>đ</b></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php if ($totalPrice > 0): ?>
                        <a href="<?= APP_PATH ?>/auth/order" class="btn btn-success text-light">
                            Thanh toán ngay
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary mt-auto" disabled>Không thể thanh toán</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
