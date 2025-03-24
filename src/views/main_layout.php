<?php 
// Include necessary files
include "inc/config.php";
include "inc/head.php";
?>

<body>
    <!-- Page Container -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 position-sticky top-0 vh-100" style="overflow-y: auto; background-color: #fff;">
                <?php
                include "inc/navbar.php";
                ?>
            </aside>
            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 px-md-4">
                <?php include "inc/main.php"; ?>
                <div class="mt-3">
                    <?php include "inc/messages.php"; ?>
                    <?php include "./src/views/pages/" . $data['Page'] . ".php"; ?>
                </div>
            </main>
        </div>
    </div>
</body>
