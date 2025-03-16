<div class="mx-2">
    <div class="container">
        <!-- Form đăng ký -->
        <form class="row g-3 needs-validation" method="post" novalidate>
            <!-- Trường Họ và tên -->
            <div class="col-md-6">
                <label class="form-label fs-6"><strong>Họ và tên*</strong></label>
                <input type="text" class="form-control" name="username" id="fullname" placeholder="Họ tên của bạn"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                    autofocus required>
                <div class="invalid-feedback">
                    Họ và tên không được bỏ trống.
                </div>
            </div>

            <!-- Trường Mật khẩu -->
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label"><strong>Mật khẩu</strong></label>
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

            <!-- Trường Số điện thoại -->
            <div class="col-md-6">
                <label for="inputNumber4" class="form-label"><strong>Số điện thoại*</strong></label>
                <input type="text" class="form-control" name="phonenumber" id="inputNumber4"
                    placeholder="Số điện thoại của bạn"
                    value="<?php echo isset($_POST['phonenumber']) ? htmlspecialchars($_POST['phonenumber']) : ''; ?>"
                    required>
                <div id="phoneFeedback" class="invalid-feedback">
                    Số điện thoại không hợp lệ. Hãy nhập số điện thoại theo định dạng chính xác.
                </div>
                <div id="phoneEmptyFeedback" class="invalid-feedback">
                    Số điện thoại không được bỏ trống.
                </div>
            </div>

            <!-- Trường Email -->
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label"><strong>Email*</strong></label>
                <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email của bạn"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                <div class="invalid-feedback">
                    Email không được bỏ trống.
                </div>
            </div>

            <!-- Trường Tỉnh/Thành phố -->
            <div class="col-md-6">
                <label for="validationCustom04" class="form-label"><strong>Tỉnh/Thành phố*</strong></label>
                <select class="form-select" name="city" id="city" required>
                    <option selected value="">Chọn Tỉnh/Thành phố của bạn</option>
                    <!-- Thêm danh sách các tỉnh/thành phố -->
                </select>
                <div class="invalid-feedback">
                    Hãy chọn một tỉnh/thành phố hợp lệ.
                </div>
            </div>

            <!-- Trường Quận/Huyện -->
            <div class="col-md-6">
                <label for="validationCustom04" class="form-label"><strong>Quận/Huyện*</strong></label>
                <select class="form-select" name="district" id="district" required>
                    <option selected value="">Chọn Quận/Huyện của bạn</option>
                    <!-- Thêm danh sách các quận/huyện -->
                </select>
                <div class="invalid-feedback">
                    Hãy chọn một quận/huyện hợp lệ.
                </div>
            </div>

            <!-- Trường Địa chỉ -->
            <div class="col-md-6">
                <label for="inputAddress" class="form-label"><strong>Địa chỉ*</strong></label>
                <input type="text" class="form-control" name="address" id="inputAddress"
                    placeholder="Nhập địa chỉ của bạn VD:Số 20,ngõ 90"
                    value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required>
                <div class="invalid-feedback">
                    Địa chỉ không được bỏ trống.
                </div>
            </div>

            <!-- Nút đăng ký và reset -->
            <div class="col-12">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary" name="register" value="Đăng Ký">Đăng Ký</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>