<?php
    include('../../../Admin/model/class/CRUD.php');
    

?>

<nav class="navbar navbar-expand px-3 border-bottom">
    <button class="btn" id="sidebar-toggle" type="button">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <?php
                    $s = new User();
                    if(isset($_SESSION['sellerId'])){
                        $sellerId = $_SESSION['sellerId'];
                    }
                    $sel = $s->getUserSellerById($sellerId);
                ?>
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                <img src="../../assets/img/customers/<?php echo $sel['profile']; ?>" class="rounded-circle" height="40" width="40" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="profile.php" class="dropdown-item">Profile</a>
                    <a href="profile.php" class="dropdown-item">Setting</a>
                    <a href="../../index.php" class="dropdown-item">Homepage</a>
                    <a href="../../logout.php" class="dropdown-item">Logout</a>
                </div>
            </li>

        </ul>
    </div>

</nav>