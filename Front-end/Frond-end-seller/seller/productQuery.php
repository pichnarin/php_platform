<?php
include('../../../Admin/connection/connect.php');

// Check if $_SESSION['shopID'] is set to avoid errors
if(isset($_SESSION['shopID'])) {
    $shop_id = $_SESSION['shopID'];

    $stmt = $con->prepare("SELECT p.id, p.shop_id, p.product_name, p.descriptions, p.price, p.stock_amount, p.discount, p.product_image, categorys.category_name as category_name
                            FROM products p LEFT JOIN categorys on categorys.id = p.category_id
                            WHERE shop_id = ?");
    $stmt->bind_param("i", $shop_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = []; 

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

}
?>