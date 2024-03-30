<?php
// $cate = '';
// $desc = '';
if (isset($_GET['action']) == "Update") {
    $id = $_GET['id'];
    $orders = new Order();
    $get_order = $orders->get_all_order_by_id($id);
    // $order_id = $get_order['id'];
    // $user_id = $get_order['user_id'];
    // $product_id = $get_order['product_id'];
    $amount = $get_order['amount'];
    $payment_invoice = $get_order['payment_invoice'];
    $location = $get_order['location'];
    // $order_time = $get_order['order_time'];
    $size = $get_order['size'];
    if (isset($_POST['button_update_order'])) {
        $get_amount = $_POST['amount'];
        $get_payment_invoice = $_POST['payment_invoice'];
        $get_location = $_POST['location'];
        $get_size = $_POST['size'];
        if ($get_amount != null && $get_payment_invoice != null && $get_location != null && $get_size != null) {
            $update = new Order();
            $updates = $update->update_order_by_id($id, $get_amount, $get_payment_invoice, $get_location, $get_size);
            $_SESSION['category-updated'] = "Category updated successfully.";
            ?>
            <script>
                window.location.href = "index.php?pageOrder=order";
            </script>
            <?php
        } else {
            $_SESSION['msg-fill'] = "Please fill the form to update!";
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION['msg-fill'])) {
            ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['msg-fill'];
                unset($_SESSION['msg-fill']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        ?>
    </div>
    <form action="" method="post">
        <div class="container bg-light">
            <div class="row">
                <div class="col-xl-6">
                    <h1>
                        <!-- Admin -->
                    </h1>
                </div>
                <div class="col-xl-6">
                    <button type="submit" name="button_update_order"
                        class="btn btn-success m-2 float-right">Update</button>
                    <a href="index.php?pageOrder=order" class="btn btn-info float-right m-2 text-white"> <i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container mt-3 bg-light p-3 rounded shadow-sm">
            <div class="row">
                <div class="col-xl-12">
                    <label for="">Amount </label>
                    <input type="number" class="form-control" name="amount" id="" value="<?php echo $amount; ?>">
                </div>
                <div class="col-xl-12">
                    <label for="">Payment Invoice </label>
                    <input type="text" class="form-control" name="payment_invoice" id=""
                        value="<?php echo $payment_invoice; ?>">
                </div>
                <div class="col-xl-12">
                    <label for="">Location </label>
                    <input type="text" class="form-control" name="location" id="" value="<?php echo $location; ?>">
                </div>
                <div class="col-xl-12">
                    <label for="">Size </label>
                    <input type="text" class="form-control" name="size" id="" value="<?php echo $size; ?>">
                </div>
            </div>
        </div>

    </form>
</body>

</html>