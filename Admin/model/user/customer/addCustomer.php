<?php 
if (isset($_POST['btnAddCustomer'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $type = 2;
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    
    $a = new User();
    $existingUser = $a->usernameExists($username); 
    if ($existingUser) {
        $_SESSION['msg-invalid'] = "Username already exists. Please choose a different one.";
    } else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($firstName) && !empty($lastName) && !empty($phone) && !empty($username) && !empty($password)){
            $img = $_FILES['img']['name'];
            $tmp = $_FILES['img']['tmp_name'];
            $path = '../Upload/';
            move_uploaded_file($tmp, $path . $img);
            
            $a = new User();
            $user = $a->insertUser($firstName , $lastName , $email , $phone , $username , $password , $img , $type);
            $_SESSION['msg-success'] = "Data has been saved successfully.";
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?pageCustomer=customer";
                </script>
            <?php
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['msg-invalid'] = "Your email address is invalid.";
        }
        else {
            $_SESSION['msg-invalid'] = "Please fill in all required fields.";
        }
    }
}
?>
<title>Add Customer</title>

<body>
    <?php
    if (isset($_SESSION['msg-invalid'])) {
        ?>
        <div class="alert alert-danger">
            <?php
            echo $_SESSION['msg-invalid'];
            unset($_SESSION['msg-invalid']);
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container bg-light">
            <div class="row">
                <div class="col-xl-6">
                    <h1>
                        <!-- Admin -->
                    </h1>
                </div>
                <div class="col-xl-6">
                    <button type="submit" name="btnAddCustomer" class="btn btn-success float-right m-2">Submit <i
                            class="fa-solid fa-share"></i></button>
                    <a href="index.php?pageCustomer=customer" class="btn btn-info float-xl-right m-2 text-white"> <i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="container mt-3 bg-light p-3 rounded">
            <div class="row">
                <div class="col-xl-6">
                    <label for="">Firstname</label>
                    <input type="text" class="form-control" name="firstName" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Lastname</label>
                    <input type="text" class="form-control" name="lastName" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Phone number</label>
                    <input type="number" class="form-control" name="phone" id="">
                </div>
                <!-- <div class="col-xl-6">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" id="">
                </div> -->
                <div class="col-xl-6">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Password</label>
                    <input type="text" class="form-control" name="password" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Profile</label>
                    <input type="file" class="form-control" name="img" id="photo">
                </div>
                <div class="col-xl-6">
                    <img src="../assets/imgs/default_img.jpg" id="preViewIMG" class="mt-3" width="100%">
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