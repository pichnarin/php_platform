<?php
include("./main.php");
?>
<div class="container mt-3">
            <h1 style="font-weight: 600; opacity: .8;">Profile</h1>
        </div>
<div class="container mt-5">
    <main class="content">
        <div class="container p-0">
            <div class="row">
                <div class="col-md-3 col-xl-3">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Settings</h5>
                        </div>

                        <div class="list-group list-group-flush" role="tablist">
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#profile"
                            role="tab" aria-selected="false" tabindex="-1">
                            Your profile
                        </a>
                        <!-- <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                            href="#account" role="tab" aria-selected="true">
                            Edit profile
                        </a> -->
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xl-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                            <div class="card">
                                <div class="card-header">
<!-- 
                                    <h5 class="card-title mb-0">Edit Profile</h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputFirstName">First
                                                            name</label>
                                                        <input type="text" class="form-control" id="inputFirstName"
                                                            placeholder="First name">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="inputLastName">Last name</label>
                                                        <input type="text" class="form-control" id="inputLastName"
                                                            placeholder="Last name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" id="inputEmail4"
                                                            placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputUsername">Username</label>
                                                    <input type="text" class="form-control" name="username"
                                                        id="username" placeholder="Username">
                                                </div>
                                                <div class="mb-3" data-quillbot-parent="pWnaWkIZ-fPNNCOrGJ1xJ">
                                                    <label class="form-label" for="inputUsername">Password</label>
                                                    <input type="text" class="form-control" name="password"
                                                        id="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <img alt="Charles Hall" src="img/avatars/avatar.jpg"
                                                        class="rounded-circle img-responsive mt-2" width="128"
                                                        height="128">
                                                    <div class="mt-2">
                                                        <span class="btn btn-info"><i class="fas fa-upload"></i>
                                                            Upload</span>
                                                    </div>
                                                    <small>For best results, use an image at least 128px by 128px in
                                                        .jpg format</small>
                                                </div>
                                            </div>
                                        </div>


                                        a -->
                                    </form>

                                </div>
                            </div>



                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel">

                            <?php
                            if (isset($_SESSION['adminId'])) {
                                $adminId = $_SESSION['adminId'];
                                // var_dump($adminId); 
                                $a = new User();
                                $admin = $a->getUserAdminById($adminId);
                                ?>
                                <div class="container bg-white shadow-sm">
                                    <div class="container emp-profile">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="profile-img">
                                                        <img src="../Upload/<?php echo $admin['profile']; ?>" alt="" />

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="profile-head">
                                                        <h5>
                                                            <?php echo $admin['firstname'] . " " . $admin['lastname']; ?>
                                                        </h5>
                                                        <h6>
                                                            Web Developer and CEO Of PSN Fashion Platform
                                                        </h6>
                                                        <!-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> -->
                                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="home-tab" data-toggle="tab"
                                                                    href="#home" role="tab" aria-controls="home"
                                                                    aria-selected="true">About</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <!-- <a class="btn btn-outline-info" data-bs-toggle="list" href="#account"
                                                        role="tab" aria-selected="true">
                                                        <i class="fa-regular fa-pen-to-square"></i> Edit Profile
                                                    </a> -->

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="profile-work">
                                                        <p>SKILLS</p>
                                                        <a href="">Web Design</a><br />
                                                        <a href="">Web Developer</a><br />
                                                        <a href="">Web Application</a><br />
                                                        <a href="">HTML, CSS, BOOTSTRAP, JQUARY, PHP, Laravel, ...</a><br />
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="tab-content profile-tab" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                            aria-labelledby="home-tab">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>ID</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>
                                                                        <?php echo $admin['admin_id']; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Name</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>
                                                                        <?php echo $admin['firstname'] . " " . $admin['lastname']; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Email</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>
                                                                        <?php echo $admin['email'] ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Phone</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>
                                                                        <?php echo $admin['phoneNumber']; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Profession</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>Web Developer</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                                            aria-labelledby="profile-tab">
                                                            <div class="row">
                                                                <p>I am a Web Developer and CEO Of PSN Fashion Ecommerce
                                                                    Platform.</p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>
        body {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        }

        .emp-profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }

        .profile-img {
            text-align: center;
        }

        .profile-img img {
            width: 70%;
            height: 100%;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: cadetblue;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .profile-head h5 {
            color: #333;
        }

        .profile-head h6 {
            color: #0062cc;
        }

        .profile-edit-btn {
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }

        .proile-rating {
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }

        .proile-rating span {
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-head .nav-tabs {
            margin-bottom: 5%;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .profile-work {
            padding: 14%;
            margin-top: -15%;
        }

        .profile-work p {
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }

        .profile-work a {
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }

        .profile-work ul {
            list-style: none;
        }

        .profile-tab label {
            font-weight: 600;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
        }
    </style>