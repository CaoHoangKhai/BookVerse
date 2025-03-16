<?php
require_once "inc/head.php";
require_once "inc/header.php";
?>

<body>
    <?php
    require_once "inc/messages.php";
    print_r($_SESSION['user_Info']);
    ?>

</body>
<?php
require_once "inc/footer.php";
?>