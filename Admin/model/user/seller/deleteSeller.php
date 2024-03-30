<?php 

     if(isset($_GET['id'])){
        $id = $_GET['id'];
        $a = new User();
        $admin = $a->deleteUser($id);
            $_SESSION['msg-deleted'] = "Data has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageSeller=seller";
                </script>
            <?php
        }
?>