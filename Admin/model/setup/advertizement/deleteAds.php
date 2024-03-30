<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $ads = new Advertizement();
        $ads->deleteAds($id);
        $_SESSION['ads-deleted'] = "Ads has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageAds=ads";
                </script>
            <?php
    }
    if(isset($_GET['action']) == "Delete"){
        $ads = new Advertizement();
        $ads->deleteAdsAll();
        $_SESSION['adsAll-deleted'] = "All Ads has been deleted successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href="index.php?pageAds=ads";
                </script>
            <?php
    }
?>