<?php
// Lưu thông báo vào biến tạm thời và xóa khỏi session
$errorMessage = isset($_SESSION['error-message']) ? $_SESSION['error-message'] : null;
$successMessage = isset($_SESSION['message']) ? $_SESSION['message'] : null;
unset($_SESSION['error-message']);
unset($_SESSION['message']);
?>

<?php if ($errorMessage || $successMessage): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <?php if ($errorMessage): ?>
            <div id="errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $errorMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <div id="successMessage" class="alert alert-info alert-dismissible fade show" role="alert">
                <?php echo $successMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                document.querySelectorAll('.alert').forEach(alert => {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
<?php endif; ?>