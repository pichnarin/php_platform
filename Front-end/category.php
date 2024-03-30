<?php
include("header.php");
if(isset($_SESSION['sellerId'])){
    $userID = $_SESSION['sellerId'];
}
if(isset($_SESSION['customerId'])){
    $userID = $_SESSION['customerId'];
}
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
<?php
if (isset($_GET['p1']) == 'menClothes') {
    ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-2 mt-3">
                <h2>Category</h2>
                <b>
                    <hr>
                </b>
                <li class="list-unstyled">
                    <a href="#men" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Men</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="men" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p1=menClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p2=menShoes" class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men
                            shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p3=menWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's wallet</a>
                    </li>
                </ul>


                <li class="list-unstyled">
                    <a href="#women" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Women</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="women" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p4=womenClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's Clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p5=womenShoes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p6=womenWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's bags</a>
                    </li>
                </ul>

            </div>
            <div class="col-xl-10 mt-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light pr-3">
                        Men Clothes</span>
                </h2>
                <div class="row px-xl-5">
                    <div class="col-zl-12">
                        <?php
                        if (isset($_SESSION['cart-exist'])) {
                            ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['cart-exist'];
                                unset($_SESSION['cart-exist']);
                                ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        } else if (isset($_SESSION['added-cart'])) {
                            ?>
                                <div class="alert alert-success">
                                    <?php
                                    echo $_SESSION['added-cart'];
                                    unset($_SESSION['added-cart']);
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    $p = new Cloth();
                    $pro = $p->getOnlyMenClothes();
                    foreach ($pro as $res) {
                        ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="./assets/img/<?php echo $res['product_image']; ?>" alt=""
                                        style="height: 300px;">
                                    <div class="product-action">
                                        <?php
                                        if (isset($_SESSION['customerId'])) {
                                            $userID = $_SESSION['customerId'];
                                            ?>
                                            <a class="btn btn-outline-info"
                                                href="./cart.php?p=<?php echo $res['product_id']; ?>&&customer=<?php echo $userID; ?>"><i
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
                                        <a class="btn btn-outline-info btn-square"
                                            href="./detail.php?p=<?php echo $res['product_id']; ?>"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="./detail.php?p=<?php echo $res['product_id']; ?>">
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
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if (isset($_GET['p2']) == 'menShoes') {
    ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-2 mt-3">
                <h2>Category</h2>
                <b>
                    <hr>
                </b>
                <li class="list-unstyled">
                    <a href="#men" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Men</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="men" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p1=menClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p2=menShoes" class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men
                            shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p3=menWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's wallet</a>
                    </li>
                </ul>


                <li class="list-unstyled">
                    <a href="#women" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Women</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="women" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p4=womenClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's Clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p5=womenShoes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p6=womenWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's bags</a>
                    </li>
                </ul>

            </div>
            <div class="col-xl-10 mt-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light pr-3">
                        Men Shoes</span>
                </h2>
                <div class="row px-xl-5">
                    <div class="col-zl-12">
                        <?php
                        if (isset($_SESSION['cart-exist'])) {
                            ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['cart-exist'];
                                unset($_SESSION['cart-exist']);
                                ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        } else if (isset($_SESSION['added-cart'])) {
                            ?>
                                <div class="alert alert-success">
                                    <?php
                                    echo $_SESSION['added-cart'];
                                    unset($_SESSION['added-cart']);
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    $p = new Cloth();
                    $pro = $p->getOnlyMenShoes();
                    foreach ($pro as $res) {
                        ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="./assets/img/<?php echo $res['product_image']; ?>" alt=""
                                        style="height: 300px;">
                                    <div class="product-action">
                                        <?php
                                        if (isset($_SESSION['userType'])) {
                                            ?>
                                            <a class="btn btn-outline-info"
                                                href="./cart.php?p=<?php echo $res['product_id']; ?>&&customer=<?php echo $userID; ?>"><i
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
                                        <a class="btn btn-outline-info btn-square"
                                            href="./detail.php?p=<?php echo $res['product_id']; ?>"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="./detail.php?p=<?php echo $res['product_id']; ?>">
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
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
if (isset($_GET['p3']) == 'menWallets') {
    ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-2 mt-3">
                <h2>Category</h2>
                <b>
                    <hr>
                </b>
                <li class="list-unstyled">
                    <a href="#men" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Men</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="men" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p1=menClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p2=menShoes" class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men
                            shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p3=menWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's wallet</a>
                    </li>
                </ul>


                <li class="list-unstyled">
                    <a href="#women" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Women</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="women" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p4=womenClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's Clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p5=womenShoes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p6=womenWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's bags</a>
                    </li>
                </ul>

            </div>
            <div class="col-xl-10 mt-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light pr-3">
                        Men Wallets</span>
                </h2>
                <div class="row px-xl-5">
                    <div class="col-zl-12">
                        <?php
                        if (isset($_SESSION['cart-exist'])) {
                            ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['cart-exist'];
                                unset($_SESSION['cart-exist']);
                                ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        } else if (isset($_SESSION['added-cart'])) {
                            ?>
                                <div class="alert alert-success">
                                    <?php
                                    echo $_SESSION['added-cart'];
                                    unset($_SESSION['added-cart']);
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    $p = new Cloth();
                    $pro = $p->getOnlyMenWallet();
                    foreach ($pro as $res) {
                        ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="./assets/img/<?php echo $res['product_image']; ?>" alt=""
                                        style="height: 300px;">
                                    <div class="product-action">
                                        <?php
                                        if (isset($_SESSION['userType'])) {
                                            ?>
                                            <a class="btn btn-outline-info"
                                                href="./cart.php?p=<?php echo $res['product_id']; ?>&&customer=<?php echo $userID; ?>"><i
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
                                        <a class="btn btn-outline-info btn-square"
                                            href="./detail.php?p=<?php echo $res['product_id']; ?>"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="./detail.php?p=<?php echo $res['product_id']; ?>">
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
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
if (isset($_GET['p4']) == 'womenClothes') {
    ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-2 mt-3">
                <h2>Category</h2>
                <b>
                    <hr>
                </b>
                <li class="list-unstyled">
                    <a href="#men" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Men</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="men" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p1=menClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p2=menShoes" class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men
                            shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p3=menWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's wallet</a>
                    </li>
                </ul>


                <li class="list-unstyled">
                    <a href="#women" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Women</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="women" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p4=womenClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's Clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p5=womenShoes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p6=womenWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's bags</a>
                    </li>
                </ul>

            </div>
            <div class="col-xl-10 mt-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light pr-3">
                        Women Clothes</span>
                </h2>
                <div class="row px-xl-5">
                    <div class="col-zl-12">
                        <?php
                        if (isset($_SESSION['cart-exist'])) {
                            ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['cart-exist'];
                                unset($_SESSION['cart-exist']);
                                ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        } else if (isset($_SESSION['added-cart'])) {
                            ?>
                                <div class="alert alert-success">
                                    <?php
                                    echo $_SESSION['added-cart'];
                                    unset($_SESSION['added-cart']);
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    $p = new Cloth();
                    $pro = $p->getOnlyWomenClothes();
                    foreach ($pro as $res) {
                        ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="./assets/img/<?php echo $res['product_image']; ?>" alt=""
                                        style="height: 300px;">
                                    <div class="product-action">
                                        <?php
                                        if (isset($_SESSION['userType'])) {
                                            ?>
                                            <a class="btn btn-outline-info"
                                                href="./cart.php?p=<?php echo $res['product_id']; ?>&&customer=<?php echo $userID; ?>"><i
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
                                        <a class="btn btn-outline-info btn-square"
                                            href="./detail.php?p=<?php echo $res['product_id']; ?>"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="./detail.php?p=<?php echo $res['product_id']; ?>">
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
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
if (isset($_GET['p5']) == 'womenShoes') {
    ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-2 mt-3">
                <h2>Category</h2>
                <b>
                    <hr>
                </b>
                <li class="list-unstyled">
                    <a href="#men" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Men</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="men" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p1=menClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p2=menShoes" class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men
                            shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p3=menWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's wallet</a>
                    </li>
                </ul>


                <li class="list-unstyled">
                    <a href="#women" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Women</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="women" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p4=womenClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's Clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p5=womenShoes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p6=womenWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's bags</a>
                    </li>
                </ul>

            </div>
            <div class="col-xl-10 mt-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light pr-3">
                        Women Shoes</span>
                </h2>
                <div class="row px-xl-5">
                    <div class="col-zl-12">
                        <?php
                        if (isset($_SESSION['cart-exist'])) {
                            ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['cart-exist'];
                                unset($_SESSION['cart-exist']);
                                ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        } else if (isset($_SESSION['added-cart'])) {
                            ?>
                                <div class="alert alert-success">
                                    <?php
                                    echo $_SESSION['added-cart'];
                                    unset($_SESSION['added-cart']);
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    $p = new Cloth();
                    $pro = $p->getOnlyWomenShoes();
                    foreach ($pro as $res) {
                        ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="./assets/img/<?php echo $res['product_image']; ?>" alt=""
                                        style="height: 300px;">
                                    <div class="product-action">
                                        <?php
                                        if (isset($_SESSION['userType'])) {
                                            ?>
                                            <a class="btn btn-outline-info"
                                                href="./cart.php?p=<?php echo $res['product_id']; ?>&&customer=<?php echo $userID; ?>"><i
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
                                        <a class="btn btn-outline-info btn-square"
                                            href="./detail.php?p=<?php echo $res['product_id']; ?>"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="./detail.php?p=<?php echo $res['product_id']; ?>">
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
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
if (isset($_GET['p6']) == 'womenWallets') {
    ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-2 mt-3">
                <h2>Category</h2>
                <b>
                    <hr>
                </b>
                <li class="list-unstyled">
                    <a href="#men" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Men</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="men" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p1=menClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p2=menShoes" class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men
                            shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p3=menWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Men's wallet</a>
                    </li>
                </ul>


                <li class="list-unstyled">
                    <a href="#women" class="border h3 btn w-100 text-start" id="subClick" data-toggle="collapse"
                        aria-expanded="false">
                        <span class="title">Women</span>
                        <!-- <i class="fa-solid fa-caret-right m-4" id="down"></i> -->
                        <span class="dropdown-toggle float-right"></span>
                    </a>
                </li>
                <ul id="women" class=" position-relative list-unstyled">
                    <li class="nav-item">
                        <a href="category.php?p4=womenClothes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's Clothes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p5=womenShoes"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's shoes</a>
                    </li>
                    <li class="nav-item">
                        <a href="category.php?p6=womenWallets"
                            class="nav-link ml-5 p-2 btn-sm btn-outline-info text-dark">Women's bags</a>
                    </li>
                </ul>

            </div>
            <div class="col-xl-10 mt-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-light pr-3">
                        Women Wallets</span>
                </h2>
                <div class="row px-xl-5">
                    <div class="col-zl-12">
                        <?php
                        if (isset($_SESSION['cart-exist'])) {
                            ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['cart-exist'];
                                unset($_SESSION['cart-exist']);
                                ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        } else if (isset($_SESSION['added-cart'])) {
                            ?>
                                <div class="alert alert-success">
                                    <?php
                                    echo $_SESSION['added-cart'];
                                    unset($_SESSION['added-cart']);
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    $p = new Cloth();
                    $pro = $p->getOnlyWomenWallet();
                    foreach ($pro as $res) {
                        ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="./assets/img/<?php echo $res['product_image']; ?>" alt=""
                                        style="height: 300px;">
                                    <div class="product-action">
                                        <?php
                                        if (isset($_SESSION['userType'])) {
                                            ?>
                                            <a class="btn btn-outline-info"
                                                href="./cart.php?p=<?php echo $res['product_id']; ?>&&customer=<?php echo $userID; ?>"><i
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
                                        <a class="btn btn-outline-info btn-square"
                                            href="./detail.php?p=<?php echo $res['product_id']; ?>"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="./detail.php?p=<?php echo $res['product_id']; ?>">
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
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>


<?php
include("footer.php");
?>