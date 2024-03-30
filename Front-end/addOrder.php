<?php
session_start();
// var_dump($_POST['customerId']);
include('../Admin/connection/connect.php');
include('../Admin/model/class/CRUD.php');
if (isset($_POST['customerId']) && isset($_GET['p'])) {

    $cus = new User();
    $prod = new Product();
    $productID = $_GET['p'];
    $productData = $prod->getProductById($productID);
    var_dump($product);
    $customerId = $_POST['customerId'];
    $amount = $_POST['amount'];
    $size = $_POST['size'];
    $location = $_POST['location'];
    $product = $productData['id'];
    $price = $productData['price']; 
    $total = $amount * $price;
    $img = $_FILES['paid']['name'];
    $tmp = $_FILES['paid']['tmp_name'];
    $path = './assets/img/';

    if ($productData) {
        $price = $productData['price'];
        $total = $amount * $price;
        if ($amount > $productData['stock_amount']) {
            $_SESSION['msg-buy-fail'] = "The requested quantity exceeds the available stock.";
            header('location: detail.php?p=' . $productID);
            exit;
        } else {
            $unique_id = uniqid();
    
            // Get the extension of the uploaded file
            $file_extension = pathinfo($_FILES['paid']['name'], PATHINFO_EXTENSION);
            $new_img_name = "INV_" . $customerId . "_" . $unique_id . "." . $file_extension;
            move_uploaded_file($_FILES['paid']['tmp_name'], $path . $new_img_name);
            $order = new Order();
            if ($order->insertToOrder($customerId, $product, $amount, $size, $new_img_name, $location, 2)) {
                $_SESSION['msg-buy-success'] = "Item bought successfully";
            } else {
                $_SESSION['msg-buy-fail'] = "Invalid input";
            }
            header('location: detail.php?p=' . $productID);
            exit;
        }
    } else {
        $_SESSION['msg-buy-fail'] = "Invalid product";
    }
    $c = $cus->getUserCustomerById($customerId);
    
}
    

