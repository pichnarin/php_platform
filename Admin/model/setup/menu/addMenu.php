<?php 
     if(isset($_POST['btnMenu'])){
        $menu_name = $_POST['menu_title'];
        $order_menu = $_POST['order_menu'];
        $status = $_POST['status'];
        // $category = $_POST['category'];
        $url = $_POST['menu_url'];
        $m = new Menu();
        $m->insertMenu($menu_name , $order_menu , $url , $status);
        $_SESSION['menu-inserted'] = "Menu inserted successfully.";
        ?>
            <script>
                window.location.href = "index.php?pageMenu=menu";
            </script>
        <?php 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
</head>

<body>
    <form action="" method="post">
        <div class="container bg-light">
                <div class="row">
                    <div class="col-xl-6">
                        <h1>
                            <!-- Admin -->
                        </h1>
                    </div>
                    <div class="col-xl-6">
                        <button type="submit" name="btnMenu" class="btn btn-success m-2 float-right">Upload logo</button>
                        <a href="index.php?pageMenu=menu" class="btn btn-info float-right m-2 text-white"> <i
                                class="fa-solid fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        <div class="container mt-3 bg-light p-3 rounded shadow-sm">
            <div class="row">
                <div class="col-xl-6">
                    <label for="">Menu Title</label>
                    <input type="text" class="form-control" name="menu_title" id="" required>
                </div>
                <div class="col-xl-6">
                    <label for="">Order_Menu</label>
                    <input type="number" class="form-control" name="order_menu" id="" required>
                </div>
                <div class="col-xl-6">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-xl-6">
                    <label for="">Menu_url</label>
                    <textarea name="menu_url" id="" cols="30" rows="5" class="form-control">

                    </textarea>
                </div>
            </div>
        </div>
    </form>
</body>

</html>