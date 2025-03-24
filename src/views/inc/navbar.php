<?php
// navbar.php
include('config.php');
$current_role = isset($_SESSION['user_Info'][2]) ? $_SESSION['user_Info'][2] : null;
?>
<!-- Link CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<div class="row">
    <!-- Tiêu đề BOOKSTORE -->
    <div class="p-3 mb-2 bg-info d-flex justify-content-center align-items-center">
        <h4 class="mb-0">
            <a href="<?= APP_PATH ?>/home" class="text-dark text-decoration-none d-flex align-items-center">
                📚 <b><?= htmlspecialchars(ltrim(APP_PATH, '/')) ?></b>
            </a>
        </h4>
    </div>

    <!-- Sidebar -->
    <nav class="bg-white shadow-sm d-flex flex-column" style="width: 250px; height: 90vh; overflow-y: auto;">
        <ul class="nav flex-column flex-grow-1" style="flex-grow: 1;">
            <!-- 🌟 Home -->
            <li class="nav-item mb-2">
                <a class="nav-link d-flex align-items-center text-dark fw-bold text-nowrap p-2 rounded"
                    href="<?= APP_PATH ?>/home">
                    <i class="fas fa-home me-2"></i> Trang Chủ
                </a>
                <hr class="my-2">
            </li>
            <?php
            // Xử lý menu dựa trên vai trò người dùng
            $menu = $current_role === 0 ? $user_links :
                ($current_role === 1 ? $seller_links :
                    ($current_role === 2 ? $admin_links : []));

            foreach ($menu as $group): ?>
                <!-- 🌟 Tiêu đề nhóm -->
                <li class="nav-item mb-0">
                    <div class="p-1">
                        <span class="fw-bold text-nowrap text-dark"><?= $group['label_parent'] ?></span>
                    </div>
                </li>

                <?php foreach ($group['children'] as $item): ?>
                    <!-- 🌟 Mục con -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark text-nowrap py-2 px-3 rounded border-0"
                            href="<?= $item['url'] ?>">
                            <i class="<?= $item['icon'] ?> me-2"></i> <?= $item['label'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>

                <!-- 🌟 Đường phân cách -->
                <li class="nav-item mb-0">
                    <hr class="my-3">
                </li>
            <?php endforeach; ?>

            <!-- 🌟 Đăng Xuất (luôn ở dưới cùng) -->
            <li class="nav-item mb-2">
                <a class="nav-link d-flex align-items-center text-dark fw-bold text-nowrap p-2 rounded"
                    href="<?= APP_PATH ?>/auth/logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Đăng Xuất
                </a>
            </li>
        </ul>


    </nav>
</div>