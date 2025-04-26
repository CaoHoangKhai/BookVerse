<?php
// navbar.php
include('config.php');
$current_role = $_SESSION['user_Info'][2] ?? null;

// Xác định menu theo vai trò
$menu = match ($current_role) {
    0 => $user_links,
    1 => $seller_links,
    2 => $admin_links,
    default => []
};
?>

<!-- Link CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<div class="row">
    <!-- Tiêu đề -->
    <div class="p-3 mb-2 bg-info d-flex justify-content-center align-items-center">
        <h4 class="mb-0">
            <a href="<?= APP_PATH ?>/home" class="text-dark text-decoration-none d-flex align-items-center">
                📚 <strong><?= htmlspecialchars(ltrim(APP_PATH, '/')) ?></strong>
            </a>
        </h4>
    </div>

    <!-- Sidebar -->
    <nav class="bg-white shadow-sm d-flex flex-column">
        <ul class="nav flex-column">

            <!-- Home -->
            <li class="nav-item mb-2">
                <a class="nav-link d-flex align-items-center text-dark fw-bold text-nowrap p-2 rounded"
                   href="<?= APP_PATH ?>/home">
                    <i class="fas fa-home me-2"></i> Trang Chủ
                </a>
                <hr class="my-2">
            </li>

            <!-- Menu theo role -->
            <?php foreach ($menu as $group): ?>
                <!-- Tiêu đề nhóm -->
                <li class="nav-item mb-0 px-3 mt-2">
                    <span class="fw-bold text-dark"><?= $group['label_parent'] ?></span>
                </li>

                <!-- Các mục con -->
                <?php foreach ($group['children'] as $item): ?>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center text-dark text-nowrap py-2 px-3 rounded"
                           href="<?= $item['url'] ?>">
                            <i class="<?= $item['icon'] ?> me-2"></i> <?= $item['label'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>

                <li class="nav-item">
                    <hr class="my-3">
                </li>
            <?php endforeach; ?>

            <!-- Đăng xuất -->
            <li class="nav-item mb-2">
                <a class="nav-link d-flex align-items-center text-dark fw-bold text-nowrap rounded"
                   href="<?= APP_PATH ?>/auth/logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Đăng Xuất
                </a>
            </li>

        </ul>
    </nav>
</div>
