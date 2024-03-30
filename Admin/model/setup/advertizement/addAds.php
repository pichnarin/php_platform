<?php
if (isset($_POST['btnAds'])) {
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $path = "../../Front-end/assets/img/";
    if (!empty($img)) {
        $ads_video = $_POST['ads_video'];
        $status = $_POST['status'];
        // $category_id = $_POST['category'];
        $ads_url = $_POST['ads_url'];
        $des = $_POST['des'];
        move_uploaded_file($tmp, $path . $img);
        $ads = new Advertizement();
        $ads->insertAds($img, $ads_video, $ads_url, $des , $status);
        $_SESSION['ads-inserted'] = "Ads inserted successfully.";
?>
        <script>
            window.location.href = "index.php?pageAds=ads";
        </script>
<?php
    } else {
        $_SESSION['ads-unselected'] = "No image selected";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ads</title>
</head>

<body>
    <div class="container mt-3">
        <?php
        if (isset($_SESSION['ads-unselected'])) {
            ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['ads-unselected'];
                    unset($_SESSION['ads-unselected']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        }
        ?>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container bg-light">
            <div class="row">
                <div class="col-xl-6">
                    <h1>
                        <!-- Admin -->
                    </h1>
                </div>
                <div class="col-xl-6">
                    <button type="submit" name="btnAds" class="btn btn-success m-2 float-right">Upload Ads</button>
                    <a href="index.php?pageAds=ads" class="btn btn-info float-right m-2 text-white"> <i class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container mt-3 bg-light p-3 rounded shadow-sm">
            <div class="row">
                <div class="col-xl-6">
                    <label for="">Ads Video</label>
                    <input type="text" class="form-control" name="ads_video" id="" required>
                </div>
                <div class="col-xl-6">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <!-- <div class="col-xl-6">
                    <label for="">Category</label>
                    <select name="category" class="form-control" id="">
                        <option selected>Choose Category</option>
                        <?php
                        $c = new Category();
                        $cate = $c->getAllCategory();
                        foreach ($cate as $res) {
                            
                        ?>
                            <option value="<?php echo $res['id']; ?>">
                                <?php echo $res['category_name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div> -->
                <div class="col-xl-6">
                    <label for="">Ads URL</label>
                    <textarea name="ads_url" id="" cols="30" rows="3" class="form-control">

                    </textarea>
                </div>
                <div class="col-xl-6">
                    <label for="">Description</label>
                    <textarea name="des" id="" cols="30" rows="3" class="form-control">

                    </textarea>
                </div>
                <div class="col-xl-6">
                    <label for="">Ads Image</label>
                    <input type="file" name="img" class="form-control" id="photo">
                </div>
                <div class="col-xl-6">
                    <img src="../assets/imgs/default_img.jpg" class="mt-3" alt="" id="preViewIMG" width="100%" height="90%">
                </div>
            </div>
        </div>
    </form>
</body>
<script>
    // load img
    const file = document.getElementById('photo');
    const imgPreview = document.getElementById('preViewIMG');

    file.addEventListener("change", function() {
        var srcfile = this.files[0];
        var reader = new FileReader();
        reader.addEventListener('load', function() {
            imgPreview.src = reader.result;
        })
        reader.readAsDataURL(srcfile);
    })
</script>

</html>