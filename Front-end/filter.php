<?php
include("./header.php");
?>
<style>
    .product-item {
        transition: .5s;
    }

    .product-action {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .5s;
    }

    .product-action a.btn {
        position: relative;
        margin: 0 3px;
        margin-top: 100px;
        opacity: 0;
    }

    .product-item:hover {
        box-shadow: 0 0 30px #DDDDDD;
    }

    .product-item:hover .product-action {
        background: rgba(255, 255, 255, 0.7);
    }

    .product-item:hover .product-action a.btn:first-child {
        opacity: 1;
        margin-top: 0;
        transition: .3s 0s;
    }

    .product-item:hover .product-action a.btn:nth-child(2) {
        opacity: 1;
        margin-top: 0;
        transition: .3s .05s;
    }

    .product-item:hover .product-action a.btn:nth-child(3) {
        opacity: 1;
        margin-top: 0;
        transition: .3s .1s;
    }

    .product-item:hover .product-action a.btn:nth-child(4) {
        opacity: 1;
        margin-top: 0;
        transition: .3s .15s;
    }

    .product-item .product-img img {
        transition: .5s;
    }

    .product-item:hover .product-img img {
        transform: scale(1.2);
    }

    .product-item .btn:hover {
        color: #FFD333 !important;
    }

    .banner-features {
        text-align: center;
        padding: 25px 15px;
        border-radius: 4px;
        border: 1px solid #cce7d0;
        -webkit-box-shadow: 20px 20px 54px rgba(0, 0, 0, 0.03);
        box-shadow: 20px 20px 54px rgba(0, 0, 0, 0.03);
        cursor: pointer;
    }

    .hover-up:hover {
        transition: .5s;
        transform: translateY(-.3rem);
    }

    .banner-features img {
        display: inline-block;
        margin-bottom: 15px;
    }

    .banner-features h5 {
        font-size: 13px;
        font-weight: 700;
        display: inline-block;
        padding: 9px 8px 6px 8px;
        line-height: 1;
        border-radius: 4px;
        color: #088178;
    }

    .bg-1 {
        background-color: #fddde4 !important;
    }

    .bg-2 {
        background-color: #cdebbc !important;
    }

    .bg-3 {
        background-color: #d1e8f2 !important;
    }

    .bg-4 {
        background-color: #fff2e5 !important;
    }

    .bg-5 {
        background-color: #f6dbf6 !important;
    }

    .bg-6 {
        background-color: #cdd4f8 !important;
    }
</style>
<div class="container-fluid mt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light pr-3">
            Result
    </h2>
</div>
<div class="container-fluid mt-3">
    <div class="row">

    <?php
    if (isset($_POST['filter'])) {

        $searchKeyword = $_POST['filter'];
        // Prepare SQL query
        $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchKeyword%' OR descriptions LIKE '%$searchKeyword%'";

        $exe = $con->query($sql);

        if ($exe->num_rows > 0) {
            while ($res = $exe->fetch_assoc()) {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="./assets/img/<?php echo $res['product_image']; ?>" alt=""
                                style="height: 300px;">
                            <div class="product-action">
                                <?php
                                if (isset($_SESSION['userType'])) {
                                    if (isset($_SESSION['customerId'])) {
                                        $userID = $_SESSION['customerId'];
                                    } else {
                                        $userID = $_SESSION['sellerId'];
                                    }
                                    ?>
                                    <a class="btn btn-outline-info"
                                        href="./cart.php?p=<?php echo $res['id']; ?>&&customer=<?php echo $userID; ?>"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="btn btn-outline-info btn-square" href="./login.php"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <?php
                                    $_SESSION['msg-login-first'] = "Login first";
                                }
                                ?>
                                <a class="btn btn-outline-info btn-square" href="./detail.php?p=<?php echo $res['id']; ?>"><i
                                        class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="./detail.php?p=<?php echo $res['id']; ?>">
                                <?php echo $res['product_name']; ?>
                            </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <?php
                                $dis_price = $res['price'] - ($res['price'] * $res['discount'] / 100);
                                ?>
                                <h5>
                                    <?php echo $dis_price . "$" ?>
                                </h5>
                                <h6 class="text-muted ml-2"><del>
                                        <?php echo $res['price'] . "$"; ?>
                                    </del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star fa-sm text-info mr-1"></small>
                                <small class="fa fa-star fa-sm text-info mr-1"></small>
                                <small class="fa fa-star fa-sm text-info mr-1"></small>
                                <small class="fa fa-star fa-sm text-info mr-1"></small>
                                <small class="fa fa-star fa-sm text-secondary mr-1"></small>
                                <!-- <small>(99)</small> -->
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
        } else {
            ?>
                <div class="container mb-5">
                    <div class="row">
                        <div class="col-xl-3">
                            <h3>No result found.</h3>
                        </div>
                        <div class="col-xl-4">
                            <img src="./assets/img/emty_cart.png" alt="">
                        </div>
                        <div class="col-xl-4"></div>
                    </div>
                </div>
            <?php 
        }
    }

    ?>
    </div>
</div>
<?php
include("./footer.php");
?>