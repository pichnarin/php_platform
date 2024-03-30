<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $l = new Menu();
        $l->deleteMenu($id);
        $_SESSION['logo-deleted'] = "Menu has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageMenu=menu";
                </script>
            <?php
    }
?>