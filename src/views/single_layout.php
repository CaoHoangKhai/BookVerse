<?php
require_once "inc/head.php";  // Đảm bảo file head.php được bao gồm ở đây
require_once "inc/header.php";
?>

<body>
    <div id="page-container">
        <main id="main-container">
            <?php include "inc/messages.php"; ?>
            <?php include "./src/views/pages/" . $data['Page'] . ".php"; ?>
        </main>
    </div>
    <?php require_once "inc/footer.php"; ?>
</body>

</html>