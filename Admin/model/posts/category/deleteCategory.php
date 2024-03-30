<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $c = new Category();
        $c->deleteCategory($id);
        $_SESSION['category-deleted'] = "Category has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageCategory=Category";
                </script>
            <?php
    }
    if(isset($_GET['action']) == "Delete"){
        $c = new Category();
        $c->deleteAllCategory();
        $_SESSION['allCategory-deleted'] = "All Category has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageCategory=Category";
                </script>
            <?php
    }
?>