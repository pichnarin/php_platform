<?php
include('../../../Admin/connection/connect.php');
include("header.php");
$shopID = $_SESSION['shopID'];

// Get current month's earnings for completed orders
$currentMonthQuery = "SELECT SUM(p.price * o.amount) AS current_month_earnings
                    FROM orders o
                    JOIN products p ON o.product_id = p.id
                    WHERE MONTH(o.order_time) = MONTH(NOW()) 
                    AND YEAR(o.order_time) = YEAR(NOW())
                    AND o.order_status_id = 1
                    AND p.shop_id = ?";
$currentMonthStmt = mysqli_prepare($con, $currentMonthQuery);
mysqli_stmt_bind_param($currentMonthStmt, "i", $shopID);
mysqli_stmt_execute($currentMonthStmt);
$currentMonthResult = mysqli_stmt_get_result($currentMonthStmt);
$currentMonthData = mysqli_fetch_assoc($currentMonthResult);
$currentMonthEarnings = $currentMonthData['current_month_earnings'];

// Get previous month's earnings for completed orders
$previousMonthQuery = "SELECT SUM(p.price * o.amount) AS previous_month_earnings
                    FROM orders o
                    JOIN products p ON o.product_id = p.id
                    WHERE MONTH(o.order_time) = MONTH(NOW() - INTERVAL 1 MONTH) 
                    AND YEAR(o.order_time) = YEAR(NOW() - INTERVAL 1 MONTH)
                    AND o.order_status_id = 1
                    AND p.shop_id = ?";
$previousMonthStmt = mysqli_prepare($con, $previousMonthQuery);
mysqli_stmt_bind_param($previousMonthStmt, "i", $shopID);
mysqli_stmt_execute($previousMonthStmt);
$previousMonthResult = mysqli_stmt_get_result($previousMonthStmt);
$previousMonthData = mysqli_fetch_assoc($previousMonthResult);
$previousMonthEarnings = $previousMonthData['previous_month_earnings'];

// Calculate the percentage change in earnings
$percentageChange = 0;
if ($previousMonthEarnings > 0) {
    $percentageChange = (($currentMonthEarnings - $previousMonthEarnings) / $previousMonthEarnings) * 100;
}
