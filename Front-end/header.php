<?php
session_start();
include("../Admin/connection/connect.php");
include("./root/Header.php");
include("../Admin/model/class/CRUD.php");
include("../Admin/model/class/search_category.php");

?>
<link rel="stylesheet" href="./assets/style.css">
<link rel="stylesheet" href="./style.css">
<title>PSN~Fashion</title>
</head>

<body>
    <div class="container-fluid text-white campaign p-2" style="background-color: cadetblue;">
        <marquee behavior="" direction="">
            <span class="h6">
                Welcome to PSN Fashion platform, Enjoy here for yourself confident.
            </span>
        </marquee>
    </div>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-8 col-sm-6 col-md-6 col-6">
                <form action="./filter.php" method="post">
                    <div class="ms-auto d-none d-lg-block w-50 float-right">
                        <div class="input-group">
                            
                                <span class=" input-group-text text-white" style="background-color: cadetblue; border: 1px solid cadetblue;"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" name="filter" class="form-control " style="color: cadetblue; border: 1px solid cadetblue;">
                                <button class="btn text-white" style="background-color: cadetblue;">Search</button>
                            
                        </div>
                    </div>
                </div>
                </form>
            
            <div class="col-xl-4 col-sm-6 col-7 col-md-6 mb-2">
                <a href="./cart.php" class="">
                    <div
                        class="icon mt-xl-1 m-2 float-right text-dark d-flex justify-content-center align-items-center shadow-lg">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </a>
                
                <?php if (!isset($_SESSION['userType'])) : ?>
                    
                    <a href="./login.php" class="">
                        <div class="icon mt-xl-1 m-2 float-right text-dark d-flex justify-content-center align-items-center shadow-lg" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="fa-solid fa-circle-user fa-lg"></i>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-white sticky-top navbar-light p-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-shop me-2" style="color: cadetblue;"></i>
                <strong>
                    <?php
                    $l = new Logo();
                    $path = './assets/img/';
                    $true = $l->getActiveLogo();
                    ?>
                    <img src="<?php echo $path . $true; ?>" height="60">
                    <?php
                    ?>
                </strong>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ml-xl-5" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php
                    $m = new Menu();
                    $result = $m->getActiveMenu();
                    foreach ($result as $res) :
                    ?>
                        <li class="nav-item">
                            <a class="nav-link mx-1 text-uppercase mr-xl-3" aria-current="page" href="<?php echo $res['menu_url']; ?>">
                                <?php echo $res['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if (isset($_SESSION['userType'])) : ?>
                    <?php if ($_SESSION['userType'] === 'customer') : ?>
                        <ul class="navbar-nav ms-auto ml-xl-5 m-1">
                            
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="./Register.php">
                                    <i class="fa-solid fa-circle-user "></i>
                                    Become seller
                                </a>
                            </li>
                        </ul>
                        <?php
                        if (isset($_SESSION['customerId'])) {
                            $userID = $_SESSION['customerId'];
                        } else {
                            $userID = $_SESSION['sellerId'];
                        }
                        $c = new User();
                        $cus = $c->getUserById($userID);
                        ?>
                        <nav class="navbar navbar-expand-lg bg-white bg-body-tertiary ml-5">
                            <div class="container-fluid">
                                <ul class="navbar-nav">
                                    <!-- Avatar -->
                                    <li class="nav-item dropdown">
                                        <a data-mdb-dropdown-init class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="./assets/img/customers/<?php echo $cus['profile']; ?>" class="rounded-circle" height="40" width="40" alt="">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li>
                                                <a class="dropdown-item" href="profile.php?customer=<?php echo $userID; ?>">My profile</a>
                                            </li>
                                            <!-- <li>
                                            <a href="" class="dropdown-item">Dashboard</a>
                                        </li> -->

                                            <li>

                                                <button class="dropdown-item" data-toggle="modal" data-target="#logout">Logout</button>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    <?php elseif ($_SESSION['userType'] === 'seller') : ?>
                        <?php
                        $sellerId = $_SESSION['sellerId'];
                        $s = new User();
                        $sel = $s->getUserSellerById($sellerId);
                        $_SESSION['shopID'] = $sel['shop_id'];
                        ?>
                        <nav class="navbar navbar-expand-lg bg-white bg-body-tertiary ml-5">
                            <div class="container-fluid">
                                
                                <ul class="navbar-nav">
                                    <!-- Avatar -->
                                    <li class="nav-item dropdown">
                                        <a data-mdb-dropdown-init class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="./assets/img/customers/<?php echo $sel['profile']; ?>" class="rounded-circle" height="40" width="40" alt="">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li>
                                                <a class="dropdown-item" href="profile.php?seller=<?php echo $sellerId; ?>">My profile</a>
                                            </li>
                                            <li>
                                                <a href="./Frond-end-seller/seller/index.php?seller=<?=$sellerId?>" class="dropdown-item">Shop</a>
                                            </li>
                                            <li>

                                                <button class="dropdown-item" data-toggle="modal" data-target="#logout">Logout</button>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-info" href="./logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    // JavaScript code can go here if needed
</script>

</html>