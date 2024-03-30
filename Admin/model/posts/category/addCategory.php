<?php
if (isset($_POST['btnCategory'])) {
    $cate = $_POST['category'];
    $des = $_POST['des'];
    if ($cate != null && $des != null) {
        $m = new Category();
        $m->insertCategory($cate, $des);
        $_SESSION['category-inserted'] = "Category inserted successfully.";
        ?>
        <script>
            window.location.href = "index.php?pageCategory=category";
        </script>
    <?php
    } else {
        $_SESSION['msg-fill'] = "Please fill the from!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION['msg-fill'])) {
            ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['msg-fill'];
                unset($_SESSION['msg-fill']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        ?>
    </div>
    <form action="" method="post">
        <div class="container bg-light">
            <div class="row">
                <div class="col-xl-6">
                    <h1>
                        <!-- Admin -->
                    </h1>
                </div>
                <div class="col-xl-6">
                    <button type="submit" name="btnCategory" class="btn btn-success m-2 float-right">Submit</button>
                    <a href="index.php?pageCategory=category" class="btn btn-info float-right m-2 text-white"> <i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container mt-3 bg-light p-3 rounded shadow-sm">
            <div class="row">
                <div class="col-xl-12">
                    <label for="">Category </label>
                    <input type="text" class="form-control" name="category" id="">
                </div>
                <div class="col-xl-12">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="des" id="">
                </div>
            </div>
        </div>
    </form>
</body>

</html>