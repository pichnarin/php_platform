<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header("location: ../login.php");
    exit();
}
include("../connection/connect.php");
include("../model/class/CRUD.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Data Table -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');

    * {
        padding: 0px;
        margin: 0px
    }

    body {
        background: #8E24AA;
        color: #fff;
        font-family: 'Manrope', sans-serif
    }

    nav {
        display: flex;
        align-items: center;
        /* background: #AB47BC; */
        height: 60px;
        position: relative;
        border-bottom: 1px solid #495057;
        z-index: 1;
    }
    #bell{
        color: cadetblue;
        margin-left: 3rem;
    }

    .icon_icon {
        cursor: pointer;
        margin-right: 50px;
        line-height: 60px
    }

    .icon_icon span {
        background: #f00;
        padding: 7px;
        border-radius: 50%;
        color: #fff;
        vertical-align: top;
        margin-left: -25px
    }

    .icon_icon img {
        display: inline-block;
        width: 26px;
        margin-top: 4px
    }

    .icon_icon:hover {
        opacity: .7
    }

    .logo_noti {
        flex: 1;
        margin-left: 50px;
        color: #eee;
        font-size: 20px;
        font-family: monospace
    }

    .notifications {
        width: 300px;
        height: 0px;
        opacity: 0;
        position: absolute;
        top: 63px;
        right: 62px;
        border-radius: 5px 0px 5px 5px;
        background-color: #fff;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    }

    .notifications h2 {
        font-size: 14px;
        padding: 10px;
        border-bottom: 1px solid #eee;
        color: #999
    }

    .notifications h2 span {
        color: #f00
    }

    .notifications-item {
        display: flex;
        border-bottom: 1px solid #eee;
        padding: 6px 9px;
        margin-bottom: 0px;
        cursor: pointer
    }

    .notifications-item:hover {
        background-color: #eee
    }

    .notifications-item img {
        display: block;
        width: 50px;
        height: 50px;
        margin-right: 9px;
        border-radius: 50%;
        margin-top: 2px
    }

    .notifications-item .text h4 {
        color: #777;
        font-size: 16px;
        margin-top: 3px
    }

    .notifications-item .text p {
        color: #aaa;
        font-size: 12px
    }

    .navigation {
        background-image: url('../assets/imgs/chrismast.png');
        background-size: 130%;
    }


    .loading {
        display: none;
        position: fixed;
        top: 50%;
        left: 60%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        animation: spin 3s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }
</style>

<body style="background-color: whitesmoke;">

    <div class="loading">
        <img src="../assets/imgs/rotation.png" alt="" height="60">
    </div>


    <!-- ===== modal ===== -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="../login.php" class="btn btn-success">Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <!-- =============== Navigation ================ -->
    <div class="container-dash">
        <div class="navigation" style="overflow: auto; overflow-x: hidden;">
            <ul>
                <li>
                    <a href="">
                        <span class="icon">
                            <?php
                            $l = new Logo();
                            $path = '../../Front-end/assets/img/';
                            $true = $l->getActiveLogo();
                            if ($true) {
                                ?>
                                <img src="<?php echo $path . $l->getActiveLogo(); ?>" class="mt-2" height="60">
                                <?php
                            } else {
                                ?>
                                <img src="" class="mt-2" height="60" alt="">
                                <?php
                            }
                            ?>

                        </span>
                        <!-- <span class="title">Welcome, PSN Fashion</spans> -->
                    </a>
                </li>

                <li>
                    <a href="index.php?pageDashboard=dashboard">
                        <span class="icon">
                            <i class="fa-solid fa-gauge" style="font-size: 25px; transform: translateY(-3px);"></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#user" id="subClick" data-toggle="collapse" aria-expanded="false">
                        <span class="icon">
                            <i class="fa-solid fa-user" style="font-size: 25px; transform: translateY(-3px);"></i>
                        </span>
                        <span class="title">Manage Users </span>
                        <!-- <span class="dropdown-toggle ml-1 mt-3 p-1" id="down"></span> -->
                        <i class="fa-solid fa-caret-right m-4" id="down"></i>
                    </a>
                </li>
                <ul id="user" class="collapse position-relative">
                    <li class="nav-item">
                        <a href="" class="nav-link ml-5"></a>
                    </li>
                    <li class="nav-item" style="margin-top: -2rem;">
                        <a href="index.php?pageAdmin=admin" class=" ml-5 p-2">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?pageSeller=seller" class=" ml-5 p-2">Seller</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?pageCustomer=customer" class=" ml-5 p-2">Customer</a>
                    </li>
                </ul>

                <li>
                    <a href="#post" id="subClick1" data-toggle="collapse" aria-expanded="false">
                        <span class="icon">
                            <i class="fa-solid fa-list" style="font-size: 25px; transform: translateY(-3px);"></i>
                        </span>
                        <span class="title">Posts</span>
                        <i class="fa-solid fa-caret-right m-4" id="down1"></i>
                        <!-- <span class="dropdown-toggle ml-1 mt-3 p-1"></span> -->
                    </a>
                </li>
                <ul id="post" class="collapse position-relative">
                    <li class="nav-item">
                        <a href="" class="nav-link ml-5"></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="index.php?pageStock=stock" class="nav-link ml-5 p-2" style="margin-top: -2rem;">Stock</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="index.php?pageProduct=product" class="nav-link ml-5 p-2"
                            style="margin-top: -2rem;">Product</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?pageCategory=category" class="ml-5 p-2">Category</a>
                    </li>
                </ul>

                <li>
                    <a href="index.php?pageOrder=order">
                        <span class="icon">
                            <i class="fa-solid fa-bag-shopping"
                                style="font-size: 25px; transform: translateY(-3px);"></i>
                        </span>
                        <span class="title">Order</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="index.php?pagePayment=payment">
                        <span class="icon">
                            <i class="fa-solid fa-credit-card" style="font-size: 25px;transform: translateY(-3px);"></i>
                        </span>
                        <span class="title">Payment</span>
                    </a>
                </li> -->
                <li id="list">
                    <a href="#setup" id="subClick2" data-toggle="collapse" aria-expanded="false">
                        <span class="icon">
                            <i class="fa-solid fa-gear" style="font-size: 25px; transform: translateY(-3px);"></i>
                        </span>
                        <span class="title">Set Up </span>
                        <i class="fa-solid fa-caret-right m-4" id="down2"></i>
                    </a>
                </li>
                <ul id="setup" class="collapse position-relative">
                    <li class="nav-item">
                        <a href="" class="nav-link ml-5"></a>
                    </li>
                    <li class="nav-item" style="margin-top: -2rem;">
                        <a href="index.php?pageLogo=logo" class=" ml-5 p-2">Logo</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?pageMenu=menu" class=" ml-5 p-2">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?pageFooter=footer" class=" ml-5 p-2">Footer</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="index.php?pagePromotion=promotion" class=" ml-5 p-2">Promotion</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="index.php?pageAds=ads" class=" ml-5 p-2">Advertizement</a>
                    </li>
                </ul>
            </ul>
        </div>


        <!-- Header -->


        <div class="main">
            <div class="topbar shadow-sm">
                <div class="toggle">
                    <img src="../assets/imgs/menu (1).png" class="text-primary" alt="" width="35" height="35">
                </div>
                
                <nav>
                    <div class="icon_icon" id="bell"> <i class="fa-solid fa-bell"></i> </div>
                    <?php 
                        $sql = "SELECT * FROM `message`";
                        $exe = $con->query($sql);
                        if($exe->num_rows > 0){
                            while($res = $exe->fetch_assoc()){
                                ?>
                                <a href="mailto:<?php echo $res['email'];?>">
                                    <div class="notifications" id="box">
                                        <h2>Notifications - <span></span></h2>
                                        <div class="notifications-item"  alt="img">
                                            <div class="text">
                                                <h4><?php echo $res['name']?></h4>
                                                <p><?php echo $res['message'];?></p>
                                            </div>
                                        </div>
                                            
                                    </div>
                              </a>
                                <?php 
                            }
                        }
                    ?>
                </nav>
                <!-- </div> -->
                <?php
                if (isset($_SESSION['adminId'])) {
                    // echo $_SESSION['adminId'];
                    $adminId = $_SESSION['adminId'];
                    // var_dump($adminId);
                    $a = new User();
                    $data = $a->getUserAdminById($adminId);
                    $detailAdminId = $data['admin_id'];
                    $profile = $data['profile'];
                    ?>
                    <nav class="navbar navbar-expand-lg navbar-white bg-body-tertiary">
                        <div class="container-fluid">
                            <ul class="navbar-nav">
                                <!-- Avatar -->

                                <li class="nav-item dropdown">
                                    <a data-mdb-dropdown-init class="nav-link dropdown-toggle d-flex align-items-center"
                                        href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="../Upload/<?php echo $profile; ?>" class="rounded-circle" height="30"
                                            width="30" alt="Portrait of a Woman" loading="lazy">
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                                        style="transform: translateX(-5.4rem);">
                                        <li>
                                            <a class="dropdown-item"
                                                href="./profile.php?adminId=<?php echo $detailAdminId; ?>">Profile</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="../../Front-end/index.php">Client</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="../login.php">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <?php
                }
                ?>
            </div>

</body>

<script src="../assets/js/main.js"></script>
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
    crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
    crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>
<script>
    let a = 0;
    let b = 0;
    let c = 0;
    $("#subClick").click(function () {
        if (a == 0) {
            $("#down").css("transform", "rotate(90deg)");
            $("#down").css("transition", ".3s");
            a = 1;
        }
        else {
            $("#down").css("transform", "rotate(-1deg)");
            $("#down").css("transition", ".3s");
            a = 0;
        }
    });
    $("#subClick2").click(function () {
        if (b == 0) {
            $("#down2").css("transform", "rotate(90deg)");
            $("#down2").css("transition", ".3s");
            b = 1;
        }
        else {
            $("#down2").css("transform", "rotate(-1deg)");
            $("#down2").css("transition", ".3s");
            b = 0;
        }
    });
    $("#subClick1").click(function () {
        if (c == 0) {
            $("#down1").css("transform", "rotate(90deg)");
            $("#down1").css("transition", ".3s");
            c = 1;
        }
        else {
            $("#down1").css("transform", "rotate(-1deg)");
            $("#down1").css("transition", ".3s");
            c = 0;
        }
    });


    // loading when refresh page 
    window.addEventListener('beforeunload', function () {
        document.querySelector('.loading').style.display = 'block';
    });

    setTimeout(function () {
        document.querySelector('.loading').style.display = 'none';
    }, 6000);


    $(document).ready(function () {




        var down = false;

        $('#bell').click(function (e) {

            var color = $(this).text();
            if (down) {

                $('#box').css('height', '0px');
                $('#box').css('opacity', '0');
                down = false;
            } else {

                $('#box').css('height', 'auto');
                $('#box').css('opacity', '1');
                down = true;

            }

        });

    });
</script>

</html>