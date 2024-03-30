<?php
include("./header.php");
?>

<style>
    /* .card h3,h6,p{
        color: cadetblue;
    } */
    .card{
        background-color: white;
        transition: .4;
        cursor: pointer;
    }
    .card:hover{
        box-shadow: 2px 2px 2px 2px cadetblue;
    }
    .card:hover h3,h6,p{
        color: cadetblue;
    }
</style>
<div class="container-fluid mt-5">
    <div class="row">
        <h2 class="text-center">All shops</h2>

    </div>
</div>

   
    <div class="container-fluid">
        <div class="row">
            <?php 
                $s = new Shop();
                $shops = $s->getAllShops();
                foreach ($shops as $shop) {
            ?>
            <div class="col-xl-4">
                <div class="card m-3 ml-3 border border-info" style="width: 28rem; height: 22rem;">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $shop['shop_name']; ?></h3>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $shop['country'] . "<br>"; ?></h6>
                        <p class="">
                        <?php echo "City: " . $shop['city'] . "<br><br>"; ?>
                        <?php echo "Street: " . $shop['street'] . "<br><br>"; ?>
                        <?php echo "Region: " . $shop['region'] . "<br><br>"; ?>
                        <?php echo "County: " . $shop['country'] . "<br><br>"; ?>
                        </p>
                        <a href="./index.php#pro" class="btn btn-outline-info">Shopping</a>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

        </div>
    </div>
    <!-- </div> -->



<?php
include("./footer.php");
?>