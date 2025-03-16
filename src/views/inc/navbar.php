<?php
// navbar.php
include('config.php');
$current_role = isset($_SESSION['user_Info'][2]) ? $_SESSION['user_Info'][2] : null;
?>
<!-- Link CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<div class="container-fluid">
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
        <nav class="col-12 col-md-3 col-lg-3 sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <?php
                    $menu = array_merge(
                        [['url' => APP_PATH . "/home", 'icon' => 'fas fa-home', 'label' => 'Home']],
                        $current_role === 0 ? $user_links : ($current_role === 1 ? $seller_links : ($current_role === 2 ? $admin_links : [])),
                        [['url' => APP_PATH . "/auth/logout", 'icon' => 'fas fa-sign-out-alt text-danger', 'label' => 'Đăng xuất']]
                    );

                    foreach ($menu as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-dark ps-0" href="<?= $item['url'] ?>">
                                <i class="<?= $item['icon'] ?> me-2"></i>
                                <span style="white-space: nowrap;"><?= $item['label'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
    </div>
</div>