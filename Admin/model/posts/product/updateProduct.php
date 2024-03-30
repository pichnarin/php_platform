<?php
// $cate = '';
// $desc = '';
if(isset($_GET['action']) == "Update") {
    $id = $_GET['id'];
    $c = new Product();
    $pro = $c->getProductById($id);
    $product = $pro['product_name'];
    $des = $pro['descriptions'];
    $discount = $pro['discount'];
    $price = $pro['price'];
    $cate = $pro['category_id'];
    $stock = $pro['stock_amount'];
    $product_url = $pro['product_image'];
    if (isset($_POST['btnProductUpdate'])) {
        $product_name = $_POST['product'];
        $prices = $_POST['price'];
        $cates = $_POST['category'];
        $stocks = $_POST['stock'];
        $dess = $_POST['des'];
        $dis = $_POST['discount'];
        // $admin_id = 'Admin';
        $img = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];
        $path = '../../Front-end/assets/img/';
        move_uploaded_file($tmp , $path.$img);
        if($cates != null && $dess != null && $product_name != null && $prices != null && $stocks != null && $img != null){
            $c->updateProduct($id  , $product_name , $dess , $prices , $cates , $stocks , $dis , $img);
            $_SESSION['product-updated'] = "Product updated successfully.";
            ?>
                <script>
                    window.location.href = "index.php?pageProduct=product";
                </script>
            <?php
        }
        else{
            $_SESSION['msg-fill'] = "Please fill all the form to update!";
        }
    }
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>

<body>
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Update Product</h1>
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
                    <button type="submit" name="btnProductUpdate"
                        class="btn btn-success m-2 float-right">Update</button>
                    <a href="index.php?pageProduct=product" class="btn btn-info float-right m-2 text-white"> <i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container mt-3 bg-light p-3 rounded shadow-sm">
            <div class="row">
                <div class="col-xl-6">
                    <label for="">Product </label>
                    <input type="text" class="form-control" name="product" id="" value="<?php echo $product;?>">
                </div>
                <div class="col-xl-6">
                    <label for="">Price </label>
                    <input type="text" class="form-control" name="price" id="" value="<?php echo $price;?>">
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
                    <input type="number" name="stock" id="" class="form-control" value="<?php echo $stock;?>">
                </div>
                <div class="col-xl-6">
                    <label for="">Discount </label>
                    <input type="text" name="discount" id="" class="form-control" value="<?php echo $discount;?>">
                </div>
                <div class="col-xl-6 mt-1">
                    <label for="">Product image</label>
                    <input type="file" name="img" id="photo" class="form-control">
                </div>
                <div class="col-xl-6">
                    <label for="">Description</label>
                    <textarea name="des" id="" cols="30" rows="2" class="form-control">
                            <?php echo $des;?>
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