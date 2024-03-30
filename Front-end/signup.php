<?php
include("./root/Header.php");
include("./header.php");
// session_start();
if (isset($_POST['btnSignup'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $type = 2;
    $img = $_FILES['profile']['name'];
    $tmp = $_FILES['profile']['tmp_name'];
    $path = './assets/img/customers/';
    $a = new User();
    $existingUser = $a->usernameExists($username);
    if ($existingUser) {
        $_SESSION['msg-invalid'] = "Username already exists.";
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($firstName) && !empty($lastName) && !empty($phone) && !empty($username) && !empty($password) && !empty($img)) {
            move_uploaded_file($tmp, $path . $img);

            $a = new User();
            $user = $a->insertUser($firstName, $lastName, $email, $phone, $username, $password, $img, $type);
            $_SESSION['msg-success'] = "Your account have been created successfully, you can log in now.";
            // header("location: ./login.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($firstName) && !empty($lastName) && !empty($phone) && !empty($username) && !empty($password) && !empty($img)) {
            $_SESSION['msg-invalid'] = "Your email address is invalid.";
        } else {
            $_SESSION['msg-invalid'] = "Please fill in all required fields.";
        }
    }
}
?>

<section class="p-3 p-md-4 p-xl-5">
    <form action="signup.php" method="post" enctype="multipart/form-data">
        <div class="container-fluid" style="margin-left: 7rem;">
            <div class="col-12 col-md-6">
                <?php
                if (isset($_SESSION['msg-success'])) {
                    ?>
                    <div class="alert alert-success">
                        <?php
                        echo $_SESSION['msg-success'];
                        unset( $_SESSION['msg-success']);
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <a href="./login.php">Go to login page.</a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="container">
            
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h3>Sign Up</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php
                                    if (isset($_SESSION['msg-invalid'])) {
                                        ?>
                                        <div class="alert alert-danger">
                                            <?php
                                            echo $_SESSION['msg-invalid'];
                                            unset( $_SESSION['msg-invalid']);
                                            ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-6">
                                    <label for="firstName" class="form-label">First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="firstName" id="email"
                                        placeholder="First name">
                                </div>
                                <div class="col-6">
                                    <label for="lastName" class="form-label">Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="lastName" id="email"
                                        placeholder="Last name">
                                </div>
                                <div class="col-6">
                                    <label for="phone" class="form-label">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="phone" id="" placeholder="Phone">
                                </div>
                                <!-- <div class="col-6">
                                        <label for="address" class="form-label"> <span
                                                class="text-danger">*</span></label>
                                                <label for="provinceSelect">Select a Province:</label>
                                                    <select id="provinceSelect" class="form-control" name="address">
                                                </select>
                                    </div> -->
                                <div class="col-6">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="name@example.com">
                                </div>
                                <div class="col-12">
                                    <label for="profile" class="form-label">Profile <span
                                            class="text-danger"></span></label>
                                    <input type="file" class="form-control" name="profile" id="">
                                </div>
                                <div class="col-12">
                                    <label for="username" class="form-label">Username <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="" value=""
                                        placeholder="Username">
                                </div>
                                <div class="col-12">
                                    <label for="password" class="form-label">Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" value=""
                                        placeholder="Password">
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button name="btnSignup" class="btn bsb-btn-xl btn-info" type="submit">Sign
                                            Up</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                        <a href="./login.php" class="link-secondary text-decoration-none">Sign in</a>
                                        <!-- <a href="#!" class="link-secondary text-decoration-none">Forgot password</a> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </form>
</section>
<?php
include("./footer.php");
?>
<script>
    var cambodiaProvinces = [
        "Banteay Meanchey",
        "Battambang",
        "Kampong Cham",
        "Kampong Chhnang",
        "Kampong Speu",
        "Kampong Thom",
        "Kampot",
        "Kandal",
        "Koh Kong",
        "Kratié",
        "Mondulkiri",
        "Oddar Meanchey",
        "Pailin",
        "Phnom Penh",
        "Preah Sihanouk",
        "Preah Vihear",
        "Prey Veng",
        "Pursat",
        "Ratanakiri",
        "Siem Reap",
        "Svay Rieng",
        "Takéo",
        "Tbong Khmum"
    ];

    function populateProvinceSelect() {
        var select = document.getElementById("provinceSelect");
        for (var i = 0; i < cambodiaProvinces.length; i++) {
            var option = document.createElement("option");
            option.text = cambodiaProvinces[i];
            select.add(option);
        }
    }
    populateProvinceSelect();
</script>
</script>