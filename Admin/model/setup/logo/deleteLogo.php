<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $l = new Logo();
        $l->deleteLogo($id);
        $_SESSION['logo-deleted'] = "Logo has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageLogo=logo";
                </script>
            <?php
    }
?>