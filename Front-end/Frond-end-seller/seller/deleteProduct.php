<?php
include('../../../Admin/connection/connect.php');

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);
    
    $deleteStmt = $con->prepare("DELETE FROM products WHERE id = ?");
    $deleteStmt->bind_param("i", $id);
    
    if ($deleteStmt->execute()) {
        $alertMessage = "Product with ID $id has been deleted.";
    } else {
        $alertMessage = "Error deleting product.";
    }
    
    // Close the delete statement
    header('location: inventory.php');
}
?>

