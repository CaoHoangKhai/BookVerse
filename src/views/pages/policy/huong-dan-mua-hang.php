<div class="container lh-base">
    <h5 class="fw-semibold fs-4 mb-3">Hướng Dẫn Mua Hàng</h5>
    <p class="mb-1">Quý khách có thể đặt hàng trực tuyến trên <?= htmlspecialchars(ltrim(APP_PATH, '/')) ?> thông qua 8 bước đặt hàng cơ bản.</p>
    <p class="mb-1">Vui lòng tham khảo thông tin chi tiết về từng bước đặt hàng như sau:</p>
    <!----->
    <p class="mb-1"><b>1. Tìm kiếm sản phẩm</b></p>
    <p class="mb-1">Quý khách có thể tìm sản phẩm theo 3 cách:</p>
    <ol class="ps-3 mb-3" style="list-style-type:lower-alpha">
        <li>Gõ tên sản phẩm vào thanh tìm kiếm</li>
        <li>Tìm theo danh mục để chọn sản phẩm theo từng loại</li>
        <!-- <li>Tìm theo sản phẩm mới nhất, bán chạy hoặc danh mục phổ biến</li> -->
    </ol>
    <!----->
    <p class="mb-1"><b>2. Thêm sản phẩm vào giỏ hàng</b></p>
    <p class="mb-1">Khi đã tìm được sản phẩm mong muốn, quý khách vui lòng bấm vào hình hoặc tên sản phẩm để vào được
        trang thông tin chi tiết của sản phẩm, sau đó:</p>
    <ol class="ps-3 mb-3" style="list-style-type:lower-alpha">
        <li>Kiểm tra thông tin sản phẩm: giá, trạng thái của sản phẩm.</li>
        <li>Chọn số lượng mong muốn.</li>
        <!-- <li>Thêm sản phẩm vào giỏ hàng.</li> -->
    </ol>
    <!----->
    <p class="mb-1"><b>3. Kiểm tra giỏ hàng và đặt hàng</b></p>
    <p class="mb-1">Để đặt nhiều sản phẩm khác nhau vào cùng 1 đơn hàng, vui lòng thực hiện theo các bước sau:</p>

    <ol class="ps-3 mb-3" style="list-style-type: lower-alpha;">
        <li>Chọn "Thanh toán ngay" hoặc click vào logo <?= htmlspecialchars(ltrim(APP_PATH, '/')) ?> để trở về trang chủ.</li>
        <li>Thêm sản phẩm vào giỏ hàng như ở Bước 2.</li>
    </ol>
    <p class="mb-1">*Quá trình này có thể lặp lại cho đến khi quý khách hoàn tất việc bỏ tất cả các sản phẩm cần đặt mua
        vào giỏ hàng.</p>
    <p class="mb-2">Sau khi quý khách đã có đủ sản phẩm cần đặt trong giỏ hàng, vui lòng sử dụng mã giảm giá (nếu có) và
        tiếp tục các bước sau để đặt hàng:</p>

    <ol class="ps-3 mb-3" style="list-style-type: lower-alpha;" start="3">
        <li>Điều chỉnh số lượng và cập nhật giỏ hàng.</li>
        <li>Bấm "Thanh toán ngay" để bắt đầu đặt hàng.</li>
    </ol>

    <p class="mb-1"><b> 4. Đăng nhập hoặc đăng ký tài khoản</b></p>
    <p class="mb-1">Quý khách vui lòng đăng nhập bằng tài khoản đã có ở <?= htmlspecialchars(ltrim(APP_PATH, '/')) ?>.</p>
    <p class="mb-1">Trong trường hợp chưa đăng ký tài khoản, quý khách có thể chọn dòng "Tạo tài khoản" để đăng ký tài
        khoản tại <?= htmlspecialchars(ltrim(APP_PATH, '/')) ?>.</p>
    <p class="mb-1">Sau khi đã hoàn tất, quý khách sẽ được quay về trang đăng nhập để quý khách tiến hành đăng nhập.</p>
    <p class="mb-1"><b>5.Điền địa chỉ giao hàng</b></p>
    <p class="mb-1"><b>6.Chọn phương thức thanh toán, và "Đặt Mua"</b></p>
    <!-- <p class="mb-1">
        <?= htmlspecialchars(ltrim(APP_PATH, '/')) ?> hỗ trợ giao hàng và thanh toán tận nơi cho các đơn hàng có tổng trị giá từ 200.000.000đ trở
        xuống trên toàn quốc. Quý khách vui lòng tham khảo thêm tại: Các Phương Thức Thanh Toán
    </p>
    <p class="mb-1">
        Sau khi hoàn tất quá trình chọn phương thức thanh toán, vui lòng kiểm tra lại các thông tin sau: xuất hóa đơn
        VAT (nếu có), địa chỉ nhận hàng, giá khuyến mãi, tổng tiền.
    </p> -->
    <p class="mb-1">
        Nếu các thông tin trên đã chính xác, quý khách vui lòng bấm "Đặt Mua", hệ thống sẽ bắt đầu tiến hành tạo đơn
        hàng dựa trên các thông tin quý khách đã đăng ký.
    </p>
    <p class="mb-1"><b>7. Kiểm tra và xác nhận đơn hàng</b></p>
    <p class="mb-1">Sau khi hoàn tất cả bước đặt mua, hệ thống sẽ gửi đến quý khách một mã số đơn hàng và thông báo thời
        gian giao hàng dự kiến, quý khách có thể kiểm tra lại đơn hàng bằng cách bấm vào dòng "đơn hàng của tôi".
    </p>
</div>