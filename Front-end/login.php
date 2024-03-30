<?php
include("./root/Header.php");
require_once("./header.php");
?>

<?php


if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $c = new User();
    $customers = $c->getUserCustomer(); // Assuming this returns all customer users
    $sellers = $c->getUserSeller(); // Assuming this returns all seller users

    $userFound = false; // Flag to determine if the user was found either as a customer or a seller

    // Check among customers
    foreach ($customers as $customer) {
        if ($username == $customer['username'] && md5($password) == $customer['password']) {
            $_SESSION['customerId'] = $customer['customer_id']; // Generalized session key
            $_SESSION['userType'] = 'customer';
            $userFound = true;
            break; // Exit the loop if user is found
        }
    }

    // Check among sellers if not found in customers
    if (!$userFound) {
        foreach ($sellers as $seller) {
            if ($username == $seller['username'] && md5($password) == $seller['password']) {
                $_SESSION['sellerId'] = $seller['seller_id']; // Generalized session key
                $_SESSION['userType'] = 'seller'; // Additional info about user type
                $userFound = true;
                break; // Exit the loop if user is found
            }
        }
    }

    if ($userFound) {
        // Redirect to index.php if user is found
        echo '<script>window.location.href = "./index.php";</script>';
    } else {
        // If no user is found
        $_SESSION['msg-wrong'] = "Username or password is incorrect!";
    }
}
?>


<section class="p-3 p-md-4 p-xl-5">
    <div class="container">

        <?php
        if (isset($_SESSION['msg-login-first'])) {
            ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['msg-login-first'];
                unset($_SESSION['msg-login-first']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?>
    </div>
    <form action="login.php" method="post">
        <div class="container">
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6">
                        <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                            src="./assets/img/customer.png" alt="BootstrapBrain Logo">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h3>Log in</h3>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <?php
                                    if (isset($_SESSION['msg-wrong'])) {
                                        ?>
                                        <div class="alert alert-danger">
                                            <?php
                                            echo $_SESSION['msg-wrong'];
                                            unset($_SESSION['msg-wrong']);
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
                            <form action="#!">
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Username <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="username" id="email"
                                            placeholder="Username">
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="" placeholder="Password">
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button name="btnLogin" class="btn bsb-btn-xl btn-info" type="submit">Log
                                                in now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                        <a href="./signup.php" class="link-secondary text-decoration-none">Sign Up</a>
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