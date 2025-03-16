<div class="container">
    <form class="row g-3 needs-validation" method="post" novalidate>
        <div class="col-md-6 mb-2"> <!-- Thêm mb-2 để tạo margin-bottom 10px -->
            <label for="inputEmail4" class="form-label"><strong>Email*</strong></label>
            <input type="email" class="form-control" name="email" id="inputEmail4 email" placeholder="Email của bạn"
                required>
            <div class="invalid-feedback">
                Email không được bỏ trống.
            </div>
        </div>

        <div class="col-md-6 mb-2 position-relative">
            <label for="inputPassword4" class="form-label"><strong>Mật khẩu*</strong></label>
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="inputPassword4"
                    placeholder="Nhập mật khẩu của bạn" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div class="invalid-feedback">
                Mật khẩu không được bỏ trống.
            </div>
        </div>


        <div class="mb-2"> <!-- Thêm mb-2 để tạo margin-bottom 10px -->
            Bạn chưa có <a href="<?= APP_PATH; ?>/auth/register"
                class="link-offset-2 link-underline link-underline-opacity-0">tài khoản?</a>
        </div>

        <div class="col-12 mb-2"> <!-- Thêm mb-2 để tạo margin-bottom 10px -->
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary" name="login" value="Đăng Nhập">Đăng Nhập</button>
            </div>
        </div>

    </form>
</div>