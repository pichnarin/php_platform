<?php
include("./header.php");
if(isset($_POST['btnSubmit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  if(!empty($name) && !empty($email) && !empty($message)){
    $sql = "INSERT INTO `message` (`name` , `email` , `message`)
            VALUES (? , ? , ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss" , $name , $email , $message);
    $success = $stmt->execute();
    if($success){
      $_SESSION['msg-success'] = "Your message submitted, we will send you email soon.";
    }
  }
  else if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
    $_SESSION['msg-email'] = "Invalid email.";
  }
  else{
    $_SESSION['msg-fill'] = "Please write down your problems.";
  }
}
?>

<style>
    body {
  font-family: "Roboto", sans-serif;
  background-color: #fff;
  line-height: 1.9;
  color: #8c8c8c; }

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  font-family: "Roboto", sans-serif;
   }

a {
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease; }
  a, a:hover {
    text-decoration: none !important; }

.text-black {
  color: #000; }

.content {
  padding: 7rem 0; }

.heading {
  font-size: 2.5rem;
  font-weight: 900; }

.form-control {
  border: none;
  background: #f3f3f3; }
  .form-control:active, .form-control:focus {
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-color: #000;
    background: #f3f3f3; }

.col-form-label {
  color: #000; }

.btn, .form-control, .custom-select {
  height: 50px; }

.custom-select:active, .custom-select:focus {
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-color: #000; }

.btn {
  border: none;
  border-radius: 4px !important; }
  .btn.btn-primary {
    background: #000;
    color: #fff;
    padding: 15px 20px; }
  .btn:hover {
    color: #fff; }
  .btn:active, .btn:focus {
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none; }

.box {
  padding: 40px;
  background: #fff;
  -webkit-box-shadow: -30px 30px 0px 0 rgba(0, 0, 0, 0.08);
  box-shadow: -30px 30px 0px 0 rgba(0, 0, 0, 0.08); }
  .box h3 {
    font-size: 14px;
    margin-bottom: 30px;
    text-align: center; }

label.error {
  font-size: 12px;
  color: red; }

#message {
  resize: vertical; }

#form-message-warning, #form-message-success {
  display: none; }

#form-message-warning {
  color: #B90B0B; }

#form-message-success {
  color: #55A44E;
  font-size: 18px;
  font-weight: bold; }

.submitting {
  float: left;
  width: 100%;
  padding: 10px 0;
  display: none;
  font-weight: bold;
  font-size: 12px;
  color: #000; }

</style>
<div class="content">
    <div class="container">
      <?php 
        if(isset($_SESSION['msg-success'])){
          ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['msg-success'];
                unset($_SESSION['msg-success']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <?php 
        }
        else if(isset($_SESSION['msg-fill'])){
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
        else if(isset($_SESSION['msg-email'])){
          ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['msg-email'];
                unset($_SESSION['msg-email']);
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
        <div class="row justify-content-center">
            <div class="col-md-10">


                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <h3 class="heading mb-4">Let's talk about everything!</h3>
                        <p>What's on your mind, Or what is your problem with our platform write here and we'll response as fast as possible.</p>

                        <p><img src="./assets/contact_image.svg" alt="Image" class="img-fluid"></p>


                    </div>
                    <div class="col-md-6">

                        <form class="mb-5" action="contact.php" method="post" id="contactForm" name="contactForm">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Your name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="subject" id="subject"
                                        placeholder="Subject">
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="7"
                                        placeholder="Write your message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" value="Send Message" name="btnSubmit"
                                        class="btn btn-info rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>

                        <div id="form-message-warning mt-4"></div>
                        <!-- <div id="form-message-success">
                            Your message was sent, thank you!
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
include("./footer.php");
?>