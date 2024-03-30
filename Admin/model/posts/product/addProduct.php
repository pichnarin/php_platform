<?php
if (isset($_POST['btnProduct'])) {
    $product = $_POST['product'];
    $price = $_POST['price'];
    $cate = $_POST['category'];
    $stock = $_POST['stock'];
    $des = $_POST['des'];
    $dis = $_POST['discount'];
    $shop = 1;  // PSN Shop
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $path = '../../Front-end/assets/img/';
    move_uploaded_file($tmp , $path.$img);

    if ($product != null && $price != null && !empty($cate) && $stock != null && $dis != null && $img != null && $des != null) {
        $p = new Product();
        $p->insertProduct($product , $shop , $des , $price , $cate , $stock , $dis , $img);
        $_SESSION['product-success'] = "Product inserted successfully.";
        ?>
        <script>
            window.location.href = "index.php?pageProduct=product";
        </script>
    <?php
    }
    else if(empty($cate)){
        $_SESSION['choose-opt'] = "Please choose category or create category first!";
    }
    else {
        $_SESSION['msg-fill'] = "Please fill all the form!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Add Product</h1>
    </div>
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
        else if (isset($_SESSION['choose-opt'])) {
            ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['choose-opt'];
                unset($_SESSION['choose-opt']);
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
                    <button type="submit" name="btnProduct" class="btn btn-success m-2 float-right">Submit</button>
                    <a href="index.php?pageProduct=Product" class="btn btn-info float-right m-2 text-white"> <i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container mt-3 bg-light p-3 rounded shadow-sm">
            <div class="row">
                <div class="col-xl-6">
                    <label for="">Product </label>
                    <input type="text" class="form-control" name="product" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Price </label>
                    <input type="text" class="form-control" name="price" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Category </label>
                    <select class="form-select" name="category" aria-label="Default select example">
                        <option selected value="">Choose category</option>
                        <?php
                            $c = new Category();
                            $cate = $c->getAllCategory();
                            foreach($cate as $res){
                                ?>
                                    <option value="<?php echo $res['id'];?>">
                                        <?php 
                                            echo $res['category_name'];
                                        ?>
                                    </option>
                                <?php 
                            }
                        ?>
                    </select>
                </div>
                <div class="col-xl-6">
                    <label for="">Stock </label>
                    <input type="number" name="stock" id="" class="form-control">
                </div>
                <div class="col-xl-6">
                    <label for="">Discount </label>
                    <input type="text" name="discount" id="" class="form-control">
                </div>
                <div class="col-xl-6 mt-1">
                    <label for="">Product image</label>
                    <input type="file" name="img" id="photo" class="form-control">
                </div>
                <div class="col-xl-6">
                    <label for="">Description</label>
                    <textarea name="des" id="" cols="30" rows="2" class="form-control">

                    </textarea>
                </div>
                <div class="col-xl-6">
                    <img src="../assets/imgs/default_img.jpg" id="preViewIMG" class="mt-3" alt="" width="100%">
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