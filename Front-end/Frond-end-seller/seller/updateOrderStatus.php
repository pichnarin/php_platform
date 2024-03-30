<?php

include('../../../Admin/connection/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];
    $newStatusId = $_POST['statusId'];

    // Update order status
    $updateOrderSql = "UPDATE orders SET order_status_id = ? WHERE id = ?";
    $updateOrderStmt = $con->prepare($updateOrderSql);
    $updateOrderStmt->bind_param("ii", $newStatusId, $orderId);
    $updateOrderStmt->execute();

    // Update product stock if order is completed (statusId = 1)
    if ($newStatusId == 1) {
        $getOrderAmountSql = "SELECT product_id, amount FROM orders WHERE id = ?";
        $getOrderAmountStmt = $con->prepare($getOrderAmountSql);
        $getOrderAmountStmt->bind_param("i", $orderId);
        $getOrderAmountStmt->execute();
        $getOrderAmountResult = $getOrderAmountStmt->get_result();
        $orderData = $getOrderAmountResult->fetch_assoc();

        $productId = $orderData['product_id'];
        $amount = $orderData['amount'];

        $updateStockSql = "UPDATE products SET stock_amount = stock_amount - ? WHERE id = ?";
        $updateStockStmt = $con->prepare($updateStockSql);
        $updateStockStmt->bind_param("ii", $amount, $productId);
        $updateStockStmt->execute();
    }

    // Prepare response
    if ($updateOrderStmt->affected_rows > 0) {
        $_SESSION['order_status_update'] = array('success' => true, 'message' => 'Order status updated successfully');
    } else {
        $_SESSION['order_status_update'] = array('success' => false, 'message' => 'Failed to update order status');
    }

    echo json_encode($_SESSION['order_status_update']);

    unset($_SESSION['order_status_update']);
} else {
    $_SESSION['order_status_update'] = array('success' => false, 'message' => 'Invalid request method');

    echo json_encode($_SESSION['order_status_update']);

    unset($_SESSION['order_status_update']);
}
?>
