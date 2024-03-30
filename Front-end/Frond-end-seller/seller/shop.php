<?php
session_start();
include('header.php');

include('../../../Admin/connection/connect.php');


?>
<div class="wrapper">
    <!-- side bar -->
    <?php
    include('sidebar.php');
    ?>

    <div class="main">
        <!-- slider for the side bar -->
        <?php
        include('sidebarSlider.php');
        ?>
        <div class="container">
            <h1>UNDER DEVELOPMENT</h1>
            <i class="fa-regular fa-face-frown face"></i>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>
    <style>
        .container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .btn-custom {
            background-color: cadetblue;
        }

        .btn-custom:hover {
            background-color: cadetblue;
        }
        .face {
            font-size: 4rem; 
        }
    </style>