<?php
if (isset($_POST['btnUpload'])) {
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $path = '../../Front-end/assets/img/';
    // $path1 = '../Upload/';
    if(!empty($img)) {
        move_uploaded_file($tmp, $path . $img);
        // move_uploaded_file($tmp, $path1 . $img);
        $des = $_POST['des'];
        $status = $_POST['status'];
        $l = new Logo();
        $l->insertLogo($img, $des , $status);
        $_SESSION['logo-inserted'] = "Logo uploaded successfully.";
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?pageLogo=logo";
            </script>
        <?php
    }
    else{
        $_SESSION['no-logo'] = "No file selected. Please try again!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Logo</title>
</head>

<body>
    <div class="container mt-3">
        <?php 
            if (isset($_SESSION['no-logo'])) {
                ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['no-logo'];
                    unset($_SESSION['no-logo']);
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
                    <button type="submit" name="btnUpload" class="btn btn-success m-2 float-right">Upload logo</button>
                    <a href="index.php?pageLogo=logo" class="btn btn-info float-right m-2 text-white"> <i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container bg-light shadow-sm mt-3">
            <div class="row">
                <div class="col-xl-6 m-xl-3 m-sm-2 m-md-2">
                    <label for="" class="font-weight-bold">New Logo</label>
                    <input type="file" name="img" id="photo" class="form-control">
                    <textarea name="des" id="" cols="30" rows="3" class="form-control mt-3" placeholder="Description">

                    </textarea>
                    <select class="form-select mt-2 w-25" name="status" required>
                        <?php
                        $sql = "SELECT * FROM `logo` WHERE `status` = 'Active'";
                        $exe = $con->query($sql);
                        if ($exe->num_rows > 0) {
                            ?>
                            <option value="Inactive">Inactive</option>
                            <option value="Active" disabled>Active</option>
                            <?php
                        } else {
                            ?>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xl-5 mt-xl-3 mt-3 mb-3">
                    <img src="../assets/imgs/default_img.jpg" id="preViewIMG" height="200">
                </div>
            </div>
        </div>
    </form>
    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-6">
                <label for="" class="font-weight-bold">Current Logo</label>
                <?php
                $l = new Logo();
                $path = '../../Front-end/assets/img/';
                ?>
                <img src="<?php echo $path . $l->getActiveLogo(); ?>" alt="" height="250" width="500">
            </div>
        </div>
    </div>
</body>
<script>
    // load img
    const file = document.getElementById('photo');
    const imgPreview = document.getElementById('preViewIMG');

    file.addEventListener("change", function () {
        var srcfile = this.files[0];
        var reader = new FileReader();
        reader.addEventListener('load', function () {
            imgPreview.src = reader.result;
        })
        reader.readAsDataURL(srcfile);
    })
</script>

</html>