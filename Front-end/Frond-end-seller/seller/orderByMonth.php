<?php
// include("header.php");
$shopID = $_SESSION['shopID'];
include('../../../Admin/connection/connect.php');
// Get the current month's orders
$currentMonthQuery = "SELECT COUNT(*) AS current_month_orders
                      FROM orders o
                      JOIN products p ON o.product_id = p.id
                      WHERE MONTH(o.order_time) = MONTH(NOW()) AND YEAR(o.order_time) = YEAR(NOW())
                      AND o.order_status_id = 1
                      AND p.shop_id = ?";
$currentMonthStmt = mysqli_prepare($con, $currentMonthQuery);
mysqli_stmt_bind_param($currentMonthStmt, "i", $shopID);
mysqli_stmt_execute($currentMonthStmt);
$currentMonthResult = mysqli_stmt_get_result($currentMonthStmt);
$currentMonthData = mysqli_fetch_assoc($currentMonthResult);
$currentMonthOrders = $currentMonthData['current_month_orders'];

// Get the previous month's orders
$previousMonthQuery = "SELECT COUNT(*) AS previous_month_orders
                       FROM orders o
                       JOIN products p ON o.product_id = p.id
                       WHERE MONTH(o.order_time) = MONTH(NOW() - INTERVAL 1 MONTH) AND YEAR(o.order_time) = YEAR(NOW() - INTERVAL 1 MONTH)
                       AND o.order_status_id = 1
                       AND p.shop_id = ?";
$previousMonthStmt = mysqli_prepare($con, $previousMonthQuery);
mysqli_stmt_bind_param($previousMonthStmt, "i", $shopID);
mysqli_stmt_execute($previousMonthStmt);
$previousMonthResult = mysqli_stmt_get_result($previousMonthStmt);
$previousMonthData = mysqli_fetch_assoc($previousMonthResult);
$previousMonthOrders = $previousMonthData['previous_month_orders'];

// Calculate the percentage change
$percentageChange = 0;
if ($previousMonthOrders > 0) {
    $percentageChange = (($currentMonthOrders - $previousMonthOrders) / $previousMonthOrders) * 100;
}

?>
