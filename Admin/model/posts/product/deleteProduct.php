<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $c = new Product();
        $c->deleteProduct($id);
        $_SESSION['product-deleted'] = "Product has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageProduct=product";
                </script>
            <?php
    }
    if(isset($_GET['action']) == "Delete"){
        $c = new Product();
        $c->deleteAllProduct();
        $_SESSION['allProduct-deleted'] = "All products has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageproduct=product";
                </script>
            <?php
    }
?>