<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dashboard/style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Dashboard</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-blue rounded">
                    <div class="inner">
                        <?php 
                            $shop = new Shop();
                            ?>
                                <h3><?php echo $shop->getAmountOfShop();?></h3>
                                <p> Shops </p>
                            <?php 
                        ?>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-shop" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-green rounded">
                    <div class="inner">
                        <h3> <?php 
                            $p = new Product();
                            echo $p->getAmountOfProduct();
                        ?> </h3>
                        <p> Products</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-orange rounded">
                    <div class="inner">
                        <?php 
                            $o = new TotalOrder();
                            ?>
                                <h3><?php echo $o->getTotalOrder();?></h3>
                            <?php 
                        ?>
                        <p> Orders </p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-red rounded">
                    <div class="inner">
                        <?php 
                            $result = new TotalCustomer();
                            ?>
                                <h3><?php echo $result->getTotalCustomer();?></h3>
                                <p> Customer </p>
                            <?php 
                        ?>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
