<?php
include('../../../Admin/connection/connect.php');
session_start();

$shopID = $_SESSION['shopID'];
// var_dump($shopID);



$sql = "SELECT orders.id AS order_id,
        users.username AS customer,
        products.product_name AS product,
        categorys.category_name AS category,
        orders.payment_invoice as invoice,
        products.product_image AS image,
        orders.amount,
        order_status.status AS order_status
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.product_id = products.id
        JOIN categorys ON products.category_id = categorys.id
        JOIN order_status ON orders.order_status_id = order_status.id
        WHERE orders.order_status_id = 3
        AND products.shop_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $shopID);
$stmt->execute();
$result = $stmt->get_result();

$tableRows = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tableRows .= "<tr>";
        $tableRows .= "<th scope='row'>" . $row['order_id'] . "</th>";
        $tableRows .= "<td>" . $row['customer'] . "</td>";
        $tableRows .= "<td>" . $row['category'] . "</td>";
        $tableRows .= "<td>" . $row['product'] . "</td>";
        $tableRows .= "<td>" . $row['amount'] . "</td>";
        $tableRows .= "<td><a href='invoiceDetail.php?id=" . $row['order_id'] . "'><img src='../../assets/img/" . $row['invoice'] . "' alt='product image' height='80px'></a></td>";
        $tableRows .= "<td><img src='" . $row['image'] . "' alt='product image' height='80px' ></td>";
        $tableRows .= "<td>
        <select class='form-select' onchange='updateOrderStatus(this.value, " . $row['order_id'] . ")'>";

        $orderStatus = $row['order_status'];

        $sqlStatus = "SELECT * FROM order_status";
        $resultStatus = $con->query($sqlStatus);

        if ($resultStatus->num_rows > 0) {
            while ($rowStatus = $resultStatus->fetch_assoc()) {
                $selected = ($rowStatus['status'] == $orderStatus) ? "selected" : "";
                $tableRows .= "<option value='" . $rowStatus['id'] . "' $selected>" . $rowStatus['status'] . "</option>";
            }
        }

        $tableRows .= "</select></td>";
        $tableRows .= "</tr>";
    }
} else {
    $tableRows = "<tr><td colspan='7'>No orders found</td></tr>";
}

?>
<script src="orderStatusUpdate.js"></script>