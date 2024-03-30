<?php 
    if(isset($_POST['btnMenu'])){
        if(isset($_GET['action']) == "Update"){
            $id = $_GET['id'];
            $sql = "SELECT * FROM `menu_setup` WHERE `id` = '$id'";
            $exe = $con->query($sql);
            if($exe->num_rows > 0){
                while($data = $exe->fetch_assoc()){
                    $title = $data['title'];
                    $order = $data['order_menu'];
                }
            }
            $menu_name = $_POST['menu_title'];
            $order_menu = $_POST['order_menu'];
            $status = $_POST['status'];
            $url = $_POST['menu_url'];
            $m = new Menu();
            $m->updateMenu($id , $menu_name , $order_menu , $url , $status);
            $_SESSION['menu-updated'] = "Menu updated successfully.";
        ?>
            <script>
                window.location.href = "index.php?pageMenu=menu";
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
    <title>Update Menu</title>
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
                        <button type="submit" name="btnMenu" class="btn btn-success m-2 float-right">Update Menu</button>
                        <a href="index.php?pageMenu=menu" class="btn btn-info float-right m-2 text-white"> <i
                                class="fa-solid fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        <div class="container mt-3 bg-light p-3 rounded shadow-sm">
            <div class="row">
                <div class="col-xl-6">
                    <label for="">Menu Title</label>
                    <input type="text" class="form-control" name="menu_title" id="" required value="<?php $title;?>">
                </div>
                <div class="col-xl-6">
                    <label for="">Order_Menu</label>
                    <input type="number" class="form-control" name="order_menu" id="" required value="<?php $order;?>">
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