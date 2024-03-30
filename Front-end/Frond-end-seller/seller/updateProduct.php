<?php
session_start();
include('../../../Admin/connection/connect.php');

if (isset($_POST['btnUpdateProduct'])) {

    // Retrieve form data
    $productID = $_POST['productId']; 
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

    if (!empty($product) && !empty($category) && !empty($description) && !empty($price) && !empty($stock) && !empty($discount)) {
        if (!empty($image)) {
            $imgUrl = $path . $image;
            move_uploaded_file($tmp, $imgUrl);
            $stmt = $con->prepare("UPDATE products SET product_name=?, category_id=?, descriptions=?, price=?, stock_amount=?, discount=?, product_image=? WHERE id=? AND shop_id=?");
            $stmt->bind_param("ssssssssi", $product, $category, $description, $price, $stock, $discount, $imgUrl, $productID, $shopID);
        } else {
            $stmt = $con->prepare("UPDATE products SET product_name=?, category_id=?, descriptions=?, price=?, stock_amount=?, discount=? WHERE id=? AND shop_id=?");
            $stmt->bind_param("ssssssii", $product, $category, $description, $price, $stock, $discount, $productID, $shopID);
        }
        
        $stmt->execute();
        $stmt->close();

        $_SESSION['product-success'] = "Product updated successfully.";
        header('location: inventory.php');
    } else if (empty($category)) {
        $_SESSION['choose-opt'] = "Please choose a category or create a category first!";
    } else {
        $_SESSION['msg-fill'] = "Please fill in all the fields!";
    }
}
?>
