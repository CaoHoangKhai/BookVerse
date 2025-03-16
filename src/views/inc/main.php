<header class="bg-light border-bottom py-2 px-3">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo hoặc tiêu đề ở bên trái -->
        <div class="d-flex align-items-center">
            <a class="text-decoration-none text-dark d-flex align-items-center">
                <span class="fw-bold">📚 <?= htmlspecialchars(ltrim(APP_PATH, '/')) ?></span>
            </a>
        </div>
        <!-- Phần bên phải -->
        <div class="d-flex flex-column align-items-start">
            <!-- Kiểm tra và hiển thị thông tin người dùng -->
            <?php if (isset($_SESSION['user_Info']) && count($_SESSION['user_Info']) >= 4): ?>
                <span class="me-3 text-muted">Welcome, <?php echo htmlspecialchars($_SESSION['user_Info'][3]); ?></span>
                <span class="me-3 text-muted">Email: <?php echo htmlspecialchars($_SESSION['user_Info'][1]); ?></span>
            <?php else: ?>
                <span class="me-3 text-muted">Welcome, User</span>
            <?php endif; ?>
        </div>
    </div>
</header>