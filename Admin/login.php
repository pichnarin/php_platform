<?php
    session_start();
    include("./connection/connect.php");
    include("./model/class/CRUD.php");
    include("./root/Header.php");
    if(isset($_POST['btnLogin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $a = new User();
        $admin = $a->getUserAdmin();
        foreach($admin as $data){
                $adminId = $data['admin_id'];
                $adminUsername = $data['username'];
                $adminPassword = $data['password'];
                if($username == $adminUsername && md5($password) == $adminPassword){
                    $_SESSION['adminId'] = $adminId;
                    header("location: ./view/index.php");  
                }
                else{
                    $_SESSION['msg-wrong'] = "Username or password is incorrect!";
                }
            }
        }
?>

    <title>Login</title>
</head>
<style>
    body{
        background-image: url('./assets/imgs/LoginBG.jpg');
        background-repeat: no-repeat;
        background-size: 100%;
    }
    .container{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        background-color: white;
        box-shadow: 1px 1px 1px 1px lightyellow;
    }
    label, .btn , .form-check-input{
        margin-left: 12%;
    }
</style>
<body>
        <div class="container rounded">
            <div class="row">
                <div class="col-xl-6">
                    <img src="./assets/imgs/fashion shop-amico.png" class="m-4" width="90%" height="98%">
                </div>
                <div class="col-xl-6">
                    <h1 class="mt-5 mb-3" style="margin-left: 12%;"> 
                        Login
                    </h1>
                    <div class="col-xl-10 mx-auto">
                        <?php 
                            if(isset($_SESSION['msg-wrong'])){
                                ?>
                                    <div class="alert alert-danger">
                                        <?php 
                                            echo $_SESSION['msg-wrong'];
                                            unset($_SESSION['msg-wrong']);
                                        ?>
                                    </div>
                                <?php 
                            }
                        ?>
                    </div>
                    <form action="login.php" method="post">
                        <label for="" class="mt-2">Username</label>
                        <input type="text" class="form-control w-75 mx-auto rounded-pill p-2" name="username" id="" required>
                        <label for="" class="mt-3">Password</label>
                        <input type="password" class="form-control w-75 mx-auto p-2" name="password" id="" required>
                        <input type="checkbox" class="form-check-input mt-2" name="" id="">
                        <label for="" style="margin-left: 16%; margin-top: 2px;">Save Password</label>
                        <button type="submit" class="btn btn-primary w-75 mt-4 p-2" name="btnLogin">Login</button>
                    </form>
                </div>
                
            </div>
        </div>
</body>
</html>