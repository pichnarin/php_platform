<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $f = new Footer();
        $f->deleteFooter($id);
        $_SESSION['footer-deleted'] = "Footer has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageFooter=footer";
                </script>
            <?php
    }
    if(isset($_GET['action']) == "Delete"){
        $f = new Footer();
        $f->deleteAllFooter();
        $_SESSION['allFooter-deleted'] = "All footer has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageFooter=footer";
                </script>
            <?php
    }
?>