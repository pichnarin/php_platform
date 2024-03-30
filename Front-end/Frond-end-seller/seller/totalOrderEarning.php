<?php

$shopID = $_SESSION['shopID'];
include('../../../Admin/connection/connect.php');

// Get the total number of orders
$totalOrdersQuery = "SELECT COUNT(*) AS total_orders
                     FROM orders o
                     JOIN products p ON o.product_id = p.id
                     WHERE o.order_status_id = 1
                     AND p.shop_id = ?";
$totalOrdersStmt = mysqli_prepare($con, $totalOrdersQuery);
mysqli_stmt_bind_param($totalOrdersStmt, "i", $shopID);
mysqli_stmt_execute($totalOrdersStmt);
$totalOrdersResult = mysqli_stmt_get_result($totalOrdersStmt);
$totalOrdersData = mysqli_fetch_assoc($totalOrdersResult);
$totalOrders = $totalOrdersData['total_orders'];

// Get the total earnings
$totalEarningsQuery = "SELECT SUM(o.amount * p.price ) AS total_earnings
                       FROM orders o
                       JOIN products p ON o.product_id = p.id
                       WHERE o.order_status_id = 1
                       AND p.shop_id = ?";
$totalEarningsStmt = mysqli_prepare($con, $totalEarningsQuery);
mysqli_stmt_bind_param($totalEarningsStmt, "i", $shopID);
mysqli_stmt_execute($totalEarningsStmt);
$totalEarningsResult = mysqli_stmt_get_result($totalEarningsStmt);
$totalEarningsData = mysqli_fetch_assoc($totalEarningsResult);
$totalEarnings = $totalEarningsData['total_earnings'];

?>
