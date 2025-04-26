<!-- Banner Logo -->
<div class="w-100 text-center">
    <a href="<?= APP_PATH ?>/home">
        <img src="<?= APP_PATH ?>/public/media/photos/head/head_<?= rand(0, 1) ?>.webp?" alt="Logo"
            class="img-fluid w-100">
    </a>
</div>


<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container container-fluid">
            <div class="collapse navbar-collapse row w-100" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 col">
                    <!-- Cột đầu tiên (BookSwapHub) -->
                    <li class="nav-item">
                        <a class="navbar-brand"
                            href="<?= APP_PATH ?>/home"><?= htmlspecialchars(ltrim(APP_PATH, '/')) ?></a>
                    </li>
                </ul>

                <!-- Cột giữa với form tìm kiếm -->
                <div class="col-6">
                    <form class="d-flex align-items-center" action="/BookVerse/home" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Nhập tựa sách cần tìm...." name="search_name"
                            id="search_name">
                        <button class="btn btn-outline-success" type="submit" name="search" value="Tìm kiếm">Search</button>
                        <!-- <a class="btn btn-outline-success ms-2">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </a> -->
                    </form>
                </div>

                <!-- Các biểu tượng thông báo, giỏ hàng và người dùng -->
                <div class="d-flex align-items-center ms-4 gap-2 col">
                    <!-- <a class="btn btn-outline-success" href="#" data-bs-container="body" data-bs-toggle="popover"
                        data-bs-placement="left" data-bs-content="Left popover">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                    </a> -->
                    <!-- <a href="<?= APP_PATH ?>/auth/cart" class="btn btn-outline-success">
                        <i class="fas fa-shopping-cart"></i>
                    </a> -->

                    <?php
                    if (isset($_SESSION['user_Info']) && !empty($_SESSION['user_Info'])) {
                        $userInfo = $_SESSION['user_Info'];

                        // Kiểm tra vai trò của người dùng
                        if ($userInfo[2] == 0) {
                            // Người dùng thường
                            echo "<a href='" . APP_PATH . "//auth/cart' class='btn btn-outline-success'><i class='fas fa-shopping-cart'></i></a>";
                            echo "<a href='" . APP_PATH . "/user/profile' class='btn btn-outline-success'><i class='fas fa-user'></i></a>";
                        } elseif ($userInfo[2] == 1) {
                            // Người bán sách
                            echo "<a href='" . APP_PATH . "/seller/dashboard' class='btn btn-outline-success'><i class='fas fa-book'></i></a>";
                        } elseif ($userInfo[2] == 2) {
                            // Admin
                            //echo "<a href='" . APP_PATH . "//auth/cart' class='btn btn-outline-success'><i class='fas fa-shopping-cart'></i></a>";
                            echo "<a href='" . APP_PATH . "/admin/dashboard' class='btn btn-outline-success'><i class='fas fa-user-shield'></i> Quản Trị Viên</a>";
                        }
                    } else {
                        // Nếu người dùng chưa đăng nhập
                        echo "<a href='" . APP_PATH . "//auth/cart' class='btn btn-outline-success'><i class='fas fa-shopping-cart'></i></a>";
                        echo "<a href='" . APP_PATH . "/auth/login' class='btn btn-outline-success'><i class='fas fa-user'></i></a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container text-center ms-n3">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="d-flex">
                    <a class="link-offset-2 link-underline link-underline-opacity-0 text-secondary link-hover mx-2"
                        href="<?= APP_PATH ?>/gioi_thieu/">
                        Giới Thiệu
                    </a>
                    <span class="text-secondary mx-2">|</span>
                    <a class="link-offset-2 link-underline link-underline-opacity-0 text-secondary link-hover mx-2"
                        href="<?= APP_PATH ?>/tin_tuc/">
                        Tin Tức & Sự Kiện
                    </a>
                    <span class="text-secondary mx-2">|</span>
                    <a class="link-offset-2 link-underline link-underline-opacity-0 text-secondary link-hover mx-2"
                        href="<?= APP_PATH ?>/tac_gia/">
                        Tác Giả
                    </a>
                    <span class="text-secondary mx-2">|</span>
                    <a class="link-offset-2 link-underline link-underline-opacity-0 text-secondary link-hover mx-2"
                        href="<?= APP_PATH ?>/lien_he">
                        Liên Hệ
                    </a>
                    <!-- <span class="text-secondary mx-2">|</span>
                    <a class="link-offset-2 link-underline link-underline-opacity-0 text-secondary link-hover mx-2"
                        href="">
                        Tác Giả
                    </a> -->
                </div>
            </div>
        </div>

    </div>
</header>
<hr>