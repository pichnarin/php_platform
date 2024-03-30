<?php
session_start();
include("header.php");
include('../../../Admin/connection/connect.php');


if (isset($_POST['btnProduct'])) {
    $product = $_POST['productName'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $discount = $_POST['discount'];
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $path = '../../assets/img/';
    $shopID = $_SESSION['shopID'];
    

    if (!empty($product) && $category != 'default' && !empty($description) && !empty($price) && !empty($stock) && !empty($discount) && !empty($image)) {
        $imgUrl = $path.$image;
        move_uploaded_file($tmp, $imgUrl);


        $stmt = $con->prepare("INSERT INTO products (shop_id, product_name, category_id, descriptions, price, stock_amount, discount, product_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $shopID, $product, $category, $description, $price, $stock, $discount, $imgUrl);
        $t = $stmt->execute();
        $stmt->close();
        if($t){
            $_SESSION['product-success'] = "Product inserted successfully.";
            header('location: inventory.php');
        }
    } else if ($category == 'default') {
        $_SESSION['choose-opt'] = "Please choose a valid category.";
    } else {
        $_SESSION['msg-fill'] = "Please fill in all the fields!";
    }
}
?>
