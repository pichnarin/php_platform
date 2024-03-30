<?php 
  include("./header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller Terms of Service</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>

    .main-point {
      cursor: pointer;
    }
    .main-point.active {
      font-weight: bold;
      color: white;
      background-color: cadetblue; 
      border-color: cadetblue;
    }
    .main-point.active {
      font-weight: bold;
    }
    .scroll-con{
        height: 650px; 
      overflow: auto;
      border: 1px solid #ccc;
      padding: 10px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-3">
      <div class="list-group" id="sidebar">
        <a href="#registration" class="list-group-item list-group-item-action main-point">Account Registration</a>
        <a href="#listing" class="list-group-item list-group-item-action main-point">Listing and Selling Items</a>
        <a href="#fees" class="list-group-item list-group-item-action main-point">Fees and Payments</a>
        <a href="#obligations" class="list-group-item list-group-item-action main-point">Seller Obligations</a>
        <a href="#resolution" class="list-group-item list-group-item-action main-point">Dispute Resolution</a>
        <a href="#termination" class="list-group-item list-group-item-action main-point">Termination</a>
        <a href="#modifications" class="list-group-item list-group-item-action main-point">Modifications</a>
        <a href="#contact" class="list-group-item list-group-item-action main-point">Contact Us</a>
      </div>
    </div>
    <div class="col-md-9 scroll-con">
      <div id="registration">
        <h2>1. Account Registration</h2>
        <p>To become a seller on PSN, you must register for a seller account and provide accurate and complete information.</p>
        <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
      </div>
      <div id="listing">
        <h2>2. Listing and Selling Items</h2>
        <p>As a seller, you may list items for sale on PSN in accordance with our Seller Policies.</p>
        <p>You represent and warrant that any items you list for sale do not violate any applicable laws or infringe upon the rights of third parties, including intellectual property rights.</p>
        <p>You agree to fulfill orders promptly and accurately and to provide excellent customer service to buyers.</p>
      </div>
      <div id="fees">
        <h2>3. Fees and Payments</h2>
        <p>You agree to pay any applicable fees associated with selling on PSN, as outlined in our Fee Schedule.</p>
        <p>Payments for items sold will be processed through [Your Payment Processor], and you agree to comply with their terms and conditions.</p>
      </div>
      <div id="obligations">
        <h2>4. Seller Obligations</h2>
        <p>You agree to comply with all applicable laws and regulations, including those related to the sale of goods and consumer protection.</p>
        <p>You are solely responsible for the content you post on PSN, including item listings, product descriptions, and images.</p>
        <p>You agree not to engage in any fraudulent, deceptive, or misleading practices.</p>
      </div>
      <div id="resolution">
        <h2>5. Dispute Resolution</h2>
        <p>In the event of any disputes between sellers and buyers, you agree to work in good faith to resolve the issue promptly.</p>
        <p>PSN reserves the right to intervene in disputes and to take appropriate action, including suspension or termination of seller accounts, as deemed necessary.</p>
      </div>
      <div id="termination">
        <h2>6. Termination</h2>
        <p>PSN reserves the right to suspend or terminate your seller account at any time for any reason, including but not limited to violation of these Terms or our Seller Policies.</p>
      </div>
      <div id="modifications">
        <h2>7. Modifications</h2>
        <p>PSN reserves the right to modify or update these Seller Terms of Service at any time. We will notify you of any changes by posting the revised Terms on the platform.</p>
      </div>
      <div id="contact">
        <h2>8. Contact Us</h2>
        <p>If you have any questions or concerns about these Seller Terms of Service, please contact us at psn124@gmail.com.</p>
        <p>By creating a seller account on PSN, you acknowledge that you have read, understood, and agree to be bound by these Terms.</p>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
<?php 
  include("./footer.php");
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function(){
    $('.main-point').click(function(){
      $('.main-point').removeClass('active');
      $(this).addClass('active');
    });
  });
</script>
</body>

</html>
