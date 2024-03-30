<?php 
     if(isset($_GET['action']) == "Update"){
        $id = $_GET['id'];
        // select data to show to text box 
        $c = new User();
        $data = $c->getUserSellerAndShopById($id);
            $shop = $data['shop_name'];
            $phone = $data['phoneNumber'];
            $region = $data['region'];
            $email = $data['email'];
            $country = $data['country'];
            $street = $data['street'];
        // update data
        if(isset($_POST['btnUpdateSeller'])){
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $img = $_FILES['img']['name'];
            $tmp = $_FILES['img']['tmp_name'];
            $path = '../Upload/';
            move_uploaded_file($tmp, $path . $img);
            $a = new User();
            $user = $a->updateUser($id , $firstName , $lastName , $email , $phone , $username , $password , $img);
                $_SESSION['msg-updated'] = "Data has been updated successfully.";
                ?>
                    <script>
                        window.location.href = "index.php?pageSeller=seller";
                    </script>
                <?php 
            }
        }
?>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container bg-light">
            <div class="row">
                <div class="col-xl-6">
                    <h1>
                        <!-- Update Admin -->
                    </h1>
                </div>
                <div class="col-xl-6">
                    <button type="submit" name="btnUpdateSeller" class="btn btn-success float-right m-2">Update <i class="fa-regular fa-pen-to-square"></i></button>
                    <a href="index.php?pageCustomer=customer" class="btn btn-info float-xl-right m-2 text-white"><i class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container mt-3 bg-light p-3">
            <div class="row">
                <div class="col-xl-6">
                    <label for="" class="mt-2">Shop Name</label>
                    <input type="text" class="form-control" name="firstName" id="" value="<?php echo $shop;?>">
                </div>
                <div class="col-xl-6">
                    <label for="" class="mt-2">Street</label>
                    <input type="text" class="form-control" name="lastName" id="" value="<?php echo $last;?>">
                </div>
                <div class="col-xl-6">
                    <label for="" class="mt-2">City</label>
                    <input type="number" class="form-control" name="phone" id="" value="<?php echo $phone;?>">
                </div>
                <div class="col-xl-6">
                    <label for="" class="mt-2">Region</label>
                    <input type="text" class="form-control" name="address" id="" value="<?php echo $address;?>">
                </div>
                <div class="col-xl-6">
                    <label for="" class="mt-2">Zipcode</label>
                    <input type="email" class="form-control" name="email" id="" value="<?php echo $email;?>">
                </div>
                <div class="col-xl-6">
                    <label for="" class="mt-2">Country</label>
                    <input type="text" class="form-control" name="username" id="" value="<?php echo $username;?>">
                </div>
                <div class="col-xl-6">
                    <label for="" class="mt-2">Id Card</label>
                    <input type="file" name="id_card" id="" class="form-control">
                </div>
            </div>
        </div>
    </form>

</body>

</html>