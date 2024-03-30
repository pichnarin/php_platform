<?php 
     if(isset($_POST['btnMenu'])){
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];
        $des = $_POST['des'];
        $icon = $_POST['icon'];
        $url = $_POST['url'];
        $status = $_POST['status'];
        if($email != null && $phone != null && $location != null && $des != null && $icon != null && $url != null && $status != null){
            $f = new Footer();
            $f->insertFooter($email , $phone , $location , $des , $icon , $url , $status);
            $_SESSION['footer-inserted'] = "Footer inserted successfully.";
            ?>
                <script>
                    window.location.href = "index.php?pageFooter=footer";
                </script>
            <?php 
        }
        else{
            $_SESSION['msg-fill'] = "Please fill all the from!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Footer</title>
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
    <div class="container">
        <h1 style="font-weight: 600; opacity: .8;">Add Footer</h1>
    </div>
    <form action="" method="post">
        <div class="container bg-light">
                <div class="row">
                    <div class="col-xl-6">
                        <h1>
                        </h1>
                    </div>
                    <div class="col-xl-6">
                        <button type="submit" name="btnMenu" class="btn btn-success m-2 float-right">Setup</button>
                        <a href="index.php?pageFooter=footer" class="btn btn-info float-right m-2 text-white"> <i
                                class="fa-solid fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        <div class="container mt-3 bg-light p-3 rounded shadow-sm">
            <div class="row">
                <div class="col-xl-6">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Phone Contact</label>
                    <input type="number" class="form-control" name="phone" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Location</label>
                    <input type="text" class="form-control" name="location" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="des" id="">
                </div>
                <div class="col-xl-6">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-xl-6">
                    <label for="">Status</label>
                    <select name="icon" class="form-control" id="">
                        <option value="fa-brands fa-facebook">Facebook</option>
                        <option value="fa-brands fa-instagram">Instagram</option>
                        <option value="fa-brands fa-facebook-messenger">Messenger</option>
                        <option value="fa-brands fa-telegram">Telegram</option>
                        <option value="fa-brands fa-linkedin">Linkedin</option>
                        <option value="fa-brands fa-twitter">Twitter</option>
                        <!-- <option value=""></option>
                        <option value="">Telegram</option> -->
                    </select>
                </div>
                <div class="col-xl-6">
                    <label for="">Social Url</label>
                    <textarea name="url" class="form-control" id="" cols="30" rows="5">

                    </textarea>
                </div>
            </div>
        </div>
    </form>
</body>

</html>