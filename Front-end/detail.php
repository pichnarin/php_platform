<?php
include("./header.php");
// var_dump($_SESSION);
// var_dump($_GET);
if(isset($_GET['p'])){
    $proid = $_GET['p'];
}
if(isset($_SESSION['msg-buy-fail'])){
    echo "<div class='alert alert-danger'>" . $_SESSION['msg-buy-fail'] . "</div>";
    unset($_SESSION['msg-buy-fail']);
}
elseif (isset($_SESSION['msg-buy-success'])){
    echo "<div class='alert alert-success'>" . $_SESSION['msg-buy-success'] . "</div>";
    unset($_SESSION['msg-buy-success']);
}
if (isset($_GET['cartId'])) {
    $cartId = $_GET['cartId'];
    $sql = "DELETE FROM `cart` WHERE id = $cartId";
    $exe = $con->query($sql);
    if ($exe) {
        $_SESSION['cart-deleted'] = "This item have been deleted from cart.";
    }
}
// delete all cart of a customer
if (isset($_GET['dCart'])) {
    $dCart = $_GET['dCart'];
    $sql = "DELETE FROM `cart` WHERE `customer_id` = $dCart";
    $exe = $con->query($sql);
    if ($exe) {
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
    } else {
        $sql = "INSERT INTO `cart` (`product_name`, `price`, `product_url`, `qty`, `total_price`, `customer_id`)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sdsidi", $p_name, $discount_price, $p_url, $p_qty, $total_price, $cusId);
        $stmt->execute();
        $_SESSION['added-cart'] = "This item has been added to your cart.";
    }
    // exit();
}
?>
<style>
    body {
        background-color: #ecedee
    }

    .card {
        border: none;
        overflow: hidden
    }

    .thumbnail_images ul {
        list-style: none;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-top: 10px
    }

    .thumbnail_images ul li {
        margin: 5px;
        padding: 10px;
        border: 2px solid #eee;
        cursor: pointer;
        transition: all 0.5s
    }

    .thumbnail_images ul li:hover {
        border: 2px solid #000
    }

    .main_image {
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #eee;
        height: 400px;
        width: 100%;
        overflow: hidden
    }

    .heart {
        height: 29px;
        width: 29px;
        background-color: #eaeaea;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .content p {
        font-size: 12px
    }

    .ratings span {
        font-size: 14px;
        margin-left: 12px
    }

    .colors {
        margin-top: 5px
    }

    .colors ul {
        list-style: none;
        display: flex;
        padding-left: 0px
    }

    .colors ul li {
        height: 20px;
        width: 20px;
        display: flex;
        border-radius: 50%;
        margin-right: 10px;
        cursor: pointer
    }

    .colors ul li:nth-child(1) {
        background-color: #6c704d
    }

    .colors ul li:nth-child(2) {
        background-color: #96918b
    }

    .colors ul li:nth-child(3) {
        background-color: #68778e
    }

    .colors ul li:nth-child(4) {
        background-color: #263f55
    }

    .colors ul li:nth-child(5) {
        background-color: black
    }

    .right-side {
        position: relative
    }

    .search-option {
        position: absolute;
        background-color: #000;
        overflow: hidden;
        align-items: center;
        color: #fff;
        width: 200px;
        height: 200px;
        border-radius: 49% 51% 50% 50% / 68% 69% 31% 32%;
        left: 30%;
        bottom: -250px;
        transition: all 0.5s;
        cursor: pointer
    }

    .search-option .first-search {
        position: absolute;
        top: 20px;
        left: 90px;
        font-size: 20px;
        opacity: 1000
    }

    .search-option .inputs {
        opacity: 0;
        transition: all 0.5s ease;
        transition-delay: 0.5s;
        position: relative
    }

    .search-option .inputs input {
        position: absolute;
        top: 200px;
        left: 30px;
        padding-left: 20px;
        background-color: transparent;
        width: 300px;
        border: none;
        color: #fff;
        border-bottom: 1px solid #eee;
        transition: all 0.5s;
        z-index: 10
    }

    .search-option .inputs input:focus {
        box-shadow: none;
        outline: none;
        z-index: 10
    }

    .search-option:hover {
        border-radius: 0px;
        width: 100%;
        left: 0px
    }

    .search-option:hover .inputs {
        opacity: 1
    }

    .search-option:hover .first-search {
        left: 27px;
        top: 25px;
        font-size: 15px
    }

    .search-option:hover .inputs input {
        top: 20px
    }

    .search-option .share {
        position: absolute;
        right: 20px;
        top: 22px
    }

    .buttons .btn {
        height: 50px;
        width: 150px;
        border-radius: 0px !important
    }
</style>
<div class="container mt-3">
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
<div class="container mt-5 mb-5">
    <?php
    if (isset($_GET['p'])) {
        $id = $_GET['p'];
        $p = new Product();
        $pro = $p->getProductById($id);
        ?>

        <div class="card">
            <div class="row g-0">
                <div class="col-md-6 border-end">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="main_image"> <img src="./assets/img/<?php echo $pro['product_image']; ?>"
                                id="main_product_image" width="350"> </div>
                        <div class="thumbnail_images">
                            <ul id="thumbnail">
                                <li><img onclick="changeImage(this)" src="./assets/img/<?php echo $pro['product_image']; ?>"
                                        width="70"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 right-side">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>
                                <?php echo $pro['product_name']; ?>
                            </h2>
                            <span class="heart">
                                <i class='fa-solid fa-heart' style="color: cadetblue;"></i>
                            </span>
                        </div>
                        <div class="mt-2 pr-3 content">
                            <p style="font-size: 16px;">
                                <?php echo $pro['descriptions']; ?>
                            </p>
                        </div>
                        <label class="mt-3">Price: <span class="h4 m-5" id="getPrice"
                                data-price="<?php echo $pro['price']; ?>">
                                <?php echo $pro['price'] . "$"; ?>
                            </span>
                        </label> <br>

                        <div class="ratings d-flex flex-row align-items-center">
                            <div class="d-flex flex-row"> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i
                                    class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bx-star'></i>
                            </div>

                            <label class="mt-3">
                                Quantity:
                            </label>
                            <button class="btn btn-light rounded-pill m-3" id="btnMinus" disabled>
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input type="number" id="incQuantity" class="ml-2" value="0"
                                style="border:none; width: 2.5rem;">
                            <button class="btn btn-light rounded-pill m-2" id="btnPlus">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <label class="mt-3">
                            Total Price: <span class="h4 m-5" id="total">0$</span>
                        </label> <br>
                        <?php
                        if (isset($_SESSION['customerId'])) {
                            $customerId = $_SESSION['customerId'];
                            ?>
                            <form action="addOrder.php?p=<?=$proid?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="customerId" value="<?=$customerId?>">
                                <div class="buttons d-flex flex-row mt-5 gap-3">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        BUY
                                    </button>
                                    <a href="detail.php?p=<?php echo $pro['id']; ?>&&customer=<?php echo $customerId; ?>"
                                        class="btn btn-info p-2">Add to cart</a>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">PSN
                                                    BUY PRODUCT</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-outline" data-mdb-input-init>
                                                                <label for="">Amount</label>
                                                                <input type="number" id="quantity" name="amount" min="1"
                                                                    value="1" class="form-control" placeholder="Amount"
                                                                    required />
                                                                
                                                            </div>

                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-outline" data-mdb-input-init>
                                                                <label for="">Size</label>
                                                                <select name="size" class="form-select" id="">
                                                                    <option value="XXL">XXL</option>
                                                                    <option value="XL">XL</option>
                                                                    <option value="L">L</option>
                                                                    <option value="M">M</option>
                                                                    <option value="S">S</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-outline mt-4" data-mdb-input-init>
                                                                <label for="">Location</label>
                                                                <input type="text" name="location" class="form-control"
                                                                    placeholder="Location" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="form-outline mt-4" data-mdb-input-init>
                                                                <label for="">Screenshot your paid</label>
                                                                <input type="file" name="paid" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="container-fluid mt-4">
                                                            <h5>Total pay: <span id="totalPrice">0</span>$</h5>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container-fluid mt-3">
                                                    <img src="./assets/img/ABA_QR.jpg" class="object-fit-contain ml-3" alt=""
                                                        width="90%" height="80%">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="order" class="btn btn-outline-dark">PAYMENT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                        } else {
                            ?>
                            <div class="buttons d-flex flex-row mt-5 gap-3">
                                <!-- Button trigger modal -->
                                <a href="./login.php" class="btn btn-outline-info p-2">Buy</a>
                                <a href="./login.php" class="btn btn-info p-2">Add to cart</a>
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
</div>

<?php
include("./footer.php");
?>
<script>
    function changeImage(element) {
        var main_prodcut_image = document.getElementById('main_product_image');
        main_prodcut_image.src = element.src;
    }
    $(document).ready(function () {
        let quantity = 0;
        $("#btnPlus").click(() => {
            $("#btnMinus").removeAttr('disabled');
            if (quantity < 20) {
                quantity++;
                $("#incQuantity").val(quantity);
                const price = parseFloat($("#getPrice").text());
                const total = quantity * price;
                $("#total").text(total + "$");
                if (quantity >= 20) {
                    $("#btnPlus").attr('disabled', 'disabled');
                }
            }
        });
        $("#btnMinus").click(() => {
            $("#btnPlus").removeAttr('disabled');
            if (quantity > 0) {
                quantity--;
                $("#incQuantity").val(quantity);
                const price = parseFloat($("#getPrice").text());
                const total = quantity * price;
                $("#total").text(total + "$");
                if (quantity <= 0) {
                    $("#btnMinus").attr('disabled', 'disabled');
                }
            }
        });
    });

    const quantityInput = document.getElementById('quantity');
    const priceSpan = document.getElementById('getPrice');
    const totalPriceSpan = document.getElementById('totalPrice');

    // Function to calculate 
    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value);
        const price = parseFloat(priceSpan.getAttribute('data-price'));
        const totalPrice = quantity * price;
        totalPriceSpan.textContent = totalPrice.toFixed(2);
    }

    quantityInput.addEventListener('input', updateTotalPrice);
</script>