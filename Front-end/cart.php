<?php
include("./header.php");
?>
<style>
    .table.table-borderless thead tr,
    .table.table-borderless tbody tr:not(:last-child) {
        border-bottom: 15px solid #F5F5F5;
    }

    /* .text-center {
        text-align: center !important;
    } */
</style>
<?php
// update qty
if(isset($_GET['cartP']) && isset($_GET['price'])){
    $cartP = $_GET['cartP'];
    $price = $_GET['price'];
    if(isset($_POST['btnQty'])){
        $qty = $_POST['qty'];
        $total = $price * $qty;
        if($qty > 0){
            $sql = "UPDATE `cart` SET `qty` = ? , `total_price` = ? WHERE id = $cartP";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("id" , $qty , $total);
            $stmt->execute();
            $_SESSION['updated-qty'] = "Quantity updated";
        }
        else{
            $_SESSION['qty-error'] = "Quantity need to be more than 1";
        }
    }
}
// delete qty by id
if(isset($_GET['cartId'])){
    $cartId = $_GET['cartId'];
    $sql = "DELETE FROM `cart` WHERE id = $cartId";
    $exe = $con->query($sql);
    if($exe){
        $_SESSION['cart-deleted'] = "This item have been deleted from cart.";
    }
}
// delete all cart of a customer
if(isset($_GET['dCart'])){
    $dCart = $_GET['dCart'];
    $sql = "DELETE FROM `cart` WHERE `customer_id` = $dCart";
    $exe = $con->query($sql);
    if($exe) {
        $_SESSION['delete-all-cart'] = "Your all cart have been deleted.";
    }
}

// add to cart
if (isset($_GET['p']) && isset($_GET['customer'])) {
    $pId = $_GET['p'];
    $cusId = $_GET['customer'];
    $p = new Product();
    $pro = $p->getProductById($pId);
    $p_name = $pro['product_name'];
    // var_dump($p_name);
    $p_discount = $pro['discount'];
    $p_price = $pro['price'];
    $discount_price = $p_price - ($p_price * $p_discount / 100);
    $p_stock = $pro['stock_amount'];
    $p_qty = 1;
    $total_price = $discount_price * $p_qty;
    $p_url = $pro['product_image'];

    // Check if the product is already in the cart
    $sql1 = "SELECT * FROM `cart` WHERE `product_name` = ? AND `customer_id` = ?";
    $stmt1 = $con->prepare($sql1);
    $stmt1->bind_param("si", $p_name, $cusId);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if ($result1->num_rows > 0) {
        $_SESSION['cart-exist'] = "This item is already in your cart.";
        ?>
            <script>
                window.location.href = "./index.php#pro";
            </script>
        <?php 
    } else {
        $sql = "INSERT INTO `cart` (`product_name`, `price`, `product_url`, `qty`, `total_price`, `customer_id`)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sdsidi", $p_name, $discount_price, $p_url, $p_qty, $total_price, $cusId);
        $stmt->execute();
        $_SESSION['added-cart'] = "This item has been added to your cart.";
        ?>
            <script>
                window.location.href = "./index.php#pro";
            </script>
        <?php 
    }
    // exit();
}
?>


<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-xl-12 ">
                <h3><i class="fa-solid fa-cart-shopping ml-xl-5"></i> Shopping Cart</h3>
                <hr>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
                <div class="col-xl-6 ml-xl-5">
                    <?php
                    if(isset($_SESSION['cart-deleted'])) {
                        ?>
                        <div class="alert alert-success">
                            <?php
                            echo $_SESSION['cart-deleted'];
                            unset($_SESSION['cart-deleted']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
                    else if(isset($_SESSION['updated-qty'])) {
                        ?>
                        <div class="alert alert-success">
                            <?php
                            echo $_SESSION['updated-qty'];
                            unset($_SESSION['updated-qty']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
                    else if(isset($_SESSION['qty-error'])) {
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['qty-error'];
                            unset($_SESSION['qty-error']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
                    else if(isset($_SESSION['delete-all-cart'])) {
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['delete-all-cart'];
                            unset($_SESSION['delete-all-cart']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($_SESSION['userType'])) {
                if(!isset($_SESSION['customerId'])){
                    $cusId = $_SESSION['sellerId'];
                }
                else{
                    $cusId = $_SESSION['customerId'];   
                }
                
                $sql = "SELECT COUNT(id) as `count` FROM `cart` WHERE `customer_id` =  $cusId";
                $exe = $con->query($sql);
                $row = $exe->fetch_assoc();
                if ($row['count'] > 0) {
                    ?>
                    <div class="col-xl-8">
                        <table class="table table-responsive ml-xl-5">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `cart` WHERE `customer_id` = $cusId";
                                $exe = $con->query($sql);
                                if ($exe->num_rows > 0) {
                                    while ($data = $exe->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td class="image product-thumbnail">
                                                <img src="./assets/img/<?php echo $data['product_url']; ?>" alt="Image" height="80">
                                            </td>
                                            <td class="product-des product-name">
                                                <h5 class="product-name font-xs">
                                                    <?php echo $data['product_name']; ?>
                                                </h5>
                                                <!-- <p class="font-xs">Maboriosam in a tonto nesciung eget<br> distingy magndapibus.</p> -->
                                            </td>
                                            <td class="price" data-title="Price"><span>
                                                    <?php 
                                                        echo "$" . $data['price']; 
                                                    ?>
                                                </span></td>
                                            <td class="text-center" data-title="Stock">
                                                <form action="cart.php?cartP=<?php echo $data['id'];?>&&price=<?php echo $data['price'];?>" method="post">
                                                    <input type="number" name="qty" class="form-control w-75"
                                                        value="<?php echo $data['qty']; ?>">
                                                    <button type="submit" name="btnQty" class="btn btn-sm btn-info ml-5" style="margin-top: -4rem;">Edit</button>
                                                </form>
                                            </td>
                                            <td class="text-right" data-title="Cart"><span>
                                                    <?php echo "$" . $data['total_price']; ?>
                                                </span></td>
                                            <td class="action" data-title="Remove">
                                                <a href="cart.php?cartId=<?php echo $data['id'];?>" class="btn-sm btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="6" class="text-end">
                                        <a href="cart.php?dCart=<?php echo $cusId;?>" class="text-muted"><i class="fi-rs-cross-small"></i> Clear Cart</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- <div class="col xl-1">

                    </div> -->
                    <br>
                    <br>
                    <?php
                } else {
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6"></div>
                            <img src="./assets/img/emty_cart.png" class="ml-xl-5 float-right" alt="" height="400" style="width: 70%; margin: auto;">
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6">
                                <p style='font-size: 40px;' class="mt-xl-5 ml-xl-5">Please log in to view your cart.</p>
                            </div>
                            <div class="col-xl-6">
                                <img src="./assets/img/login_please.jpg" alt="" height="450">
                                
                            </div>
                        </div>
                    </div>
                <?php 
            }
            ?>
        </div>
    </div>

</body>
<?php
include("./footer.php");
?>
<script>
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });



</script>

</html>