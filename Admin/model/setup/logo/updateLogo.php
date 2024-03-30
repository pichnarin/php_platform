<?php
if (isset($_POST['btnUpdateLogo'])) {
    if(isset($_GET['action']) == "Update"){
    $id = $_GET['id'];
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $path = '../../Front-end/assets/img/';
    move_uploaded_file($tmp, $path . $img);
    $des = $_POST['des'];
    $status = $_POST['status'];
    $l = new Logo();
    $l->updateLogo($id, $img , $des , $status);
    $_SESSION['logo-updated'] = "Logo uploaded successfully.";
    ?>
            <script type="text/javascript">
                window.location.href = "index.php?pageLogo=logo";
            </script>
    <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Logo</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container bg-light shadow-sm">
            <div class="row">
                <div class="container bg-light">
                    <div class="row">
                        <div class="col-xl-6">
                            <h1>
                                <!-- Admin -->
                            </h1>
                        </div>
                        <div class="col-xl-6">
                            <button type="submit" name="btnUpdateLogo" class="btn btn-success m-2 float-right">Update logo</button>
                            <a href="index.php?pageLogo=logo" class="btn btn-info float-right m-2 text-white"> <i
                                    class="fa-solid fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 m-xl-3 m-sm-2 m-md-2">
                    <label for="" class="font-weight-bold">New Logo</label>
                    <input type="file" name="img" id="photo" class="form-control" required>
                    <textarea name="des" id="" cols="30" rows="3" class="form-control mt-3" placeholder="Description">

                    </textarea>
                    <select class="form-select mt-2 w-25" name="status" required>
                        <?php
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM `logo` WHERE `id` = '$id'";
                            $exe = $con->query($sql);
                            if($exe->num_rows > 0){
                                while($data = $exe->fetch_assoc()){
                                    $status = $data['status'];
                                }
                                if($status == 'Active'){
                                    ?>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    <?php
                                }
                                else{
                                    $sql = "SELECT * FROM `logo` WHERE `status` = 'Active'";
                                    $exe = $con->query($sql);
                                    if($exe->num_rows > 0){
                                        ?>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Active" disabled>Active</option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        <?php
                                    }
                                }
                            }
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
</body>

</html>