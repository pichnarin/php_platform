<?php
include('../../../Admin/connection/connect.php');
session_start();
$shopID = $_SESSION['shopID'];

$query = "
    SELECT DATE(o.order_time) AS order_date, COUNT(*) AS total_orders
    FROM orders o
    JOIN products p ON o.product_id = p.id
    WHERE p.shop_id = ?
      AND o.order_status_id = 1
    GROUP BY DATE(o.order_time)
    ORDER BY order_date ASC
";


$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $shopID); 
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$ordersData = [];
while ($row = $result->fetch_assoc()) {
    $ordersData[] = $row;
}

$dates = [];
$orders = [];

foreach ($ordersData as $data) {
    $dates[] = $data['order_date'];
    $orders[] = $data['total_orders'];
}
?>
