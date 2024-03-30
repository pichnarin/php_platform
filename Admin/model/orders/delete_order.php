<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete_order_by_id = new Order();
        $delete_order_by_id->delete_order_by_id($id);
        $_SESSION['order-deleted'] = "Order has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageOrder=order";
                </script>
            <?php
    }
    if(isset($_GET['action']) == "Delete"){
        $delete = new Order();
        $delete->delete_all_order();
        $_SESSION['allOrder-deleted'] = "All order has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageOrder=order";
                </script>
            <?php
    }
?>