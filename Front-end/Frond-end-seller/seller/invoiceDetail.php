

<?php
    include('../../../Admin/connection/connect.php');
    if(isset($_GET['id'])){
        $orderId = $_GET['id'];

        $sql = "SELECT payment_invoice as invoice FROM orders WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $invoice = $row['invoice'];
            echo "<div style='text-align: center;'>"; // Center the image
            echo "<img src='../../assets/img/$invoice' alt='Invoice Image' style='width: 80%; height: 80vh; object-fit: contain;'>"; // Set width, height, and object-fit
            echo "</div>";
        } else {
            echo "No invoice found for Order ID $orderId";
        }
    } else {
        echo "Order ID not provided in the URL";
    }
?>