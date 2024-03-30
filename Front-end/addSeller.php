<?php
session_start();
var_dump($_SESSION);
include('../Admin/connection/connect.php');
include('validateZip.php');
include("../Admin/model/class/CRUD.php");



// Sanitize and retrieve form data
$businessName = isset($_POST['businessName']) ? htmlspecialchars($_POST['businessName']) : '';
$businessStreet = isset($_POST['businessStreet']) ? htmlspecialchars($_POST['businessStreet']) : '';
$city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
$region = isset($_POST['region']) ? htmlspecialchars($_POST['region']) : '';
$country = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : '';
$zipcode = strtolower(isset($_POST['zipcode']) ? htmlspecialchars($_POST['zipcode']) : '');
$idCard = isset($_FILES['idCard']) ? $_FILES['idCard'] : '';
var_dump($idCard);

// Perform validation
$errors = array();

// Validate business name
if (empty($businessName)) {
    $errors[] = "Business name is required.";
} else {
    // Check if the business name contains only valid characters
    $validCharacters = "/^[a-zA-Z0-9\s\-,.&'()]+$/";
    if (!preg_match($validCharacters, $businessName)) {
        $errors[] = "Business name can only contain letters, numbers, spaces, and common symbols.";
    }
    // Check business name length
    $minLength = 2;
    $maxLength = 50;
    if (strlen($businessName) < $minLength || strlen($businessName) > $maxLength) {
        $errors[] = "Business name must be between $minLength and $maxLength characters long.";
    }
}

// Validate business street
if (empty($businessStreet)) {
    $errors[] = "Business street is required.";
} else {
    // Check business street length
    $minLengthStreet = 2;
    $maxLengthStreet = 100;
    if (strlen($businessStreet) < $minLengthStreet || strlen($businessStreet) > $maxLengthStreet) {
        $errors[] = "Business street must be between $minLengthStreet and $maxLengthStreet characters long.";
    }
}

// Validate city
if (empty($city)) {
    $errors[] = "City is required.";
} else {
    // Check city length
    $minLengthCity = 2;
    $maxLengthCity = 50;
    if (strlen($city) < $minLengthCity || strlen($city) > $maxLengthCity) {
        $errors[] = "City must be between $minLengthCity and $maxLengthCity characters long.";
    }
}

// Validate region (if required)
if (empty($region)) {
    $errors[] = "Region is required.";
} else {
    // Check region length
    $minLengthRegion = 2;
    $maxLengthRegion = 50;
    if (strlen($region) < $minLengthRegion || strlen($region) > $maxLengthRegion) {
        $errors[] = "Region must be between $minLengthRegion and $maxLengthRegion characters long.";
    }
}

// Validate country (if required)
if (empty($country)) {
    $errors[] = "Country is required.";
} else {
    // Check country length
    $minLengthCountry = 2;
    $maxLengthCountry = 50;
    if (strlen($country) < $minLengthCountry || strlen($country) > $maxLengthCountry) {
        $errors[] = "Country must be between $minLengthCountry and $maxLengthCountry characters long.";
    }
}
// Validate zipcode
if (empty($zipcode)) {
    $errors[] = "Zipcode is required.";
} else {
    // Call the validate_zip_code function
    $country_code = strtolower($country); 
    if (isset($countries[$country_code])) {
        $country_code_value = $countries[$country_code];
        if (validate_zip_code($country_code_value, $zipcode)) {
            echo "Valid ZIP code.";
        } else {
            echo "Invalid ZIP code.";
        }
    } else {
        echo "Country is not found.";
    }
}

// Validate ID card files (optional)
if (empty($idCard['name'])) {
    var_dump($idCard);
    $errors[] = "ID card file is required.";
} else {
    $allowedExtensions = array('pdf');
    $fileExtension = pathinfo($idCard['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        $errors[] = "Invalid file format. Please upload images only in PDF";
    }
}

// Output validation result
if (!empty($errors)) {
    // If there are validation errors, return them as JSON response
    echo json_encode(array('success' => false, 'errors' => $errors));
} else {

    //by compare session to find the customer ID so we can put it in the seller database 
    $username = $_SESSION['userType'];
    $sql0 = "SELECT id,username FROM users WHERE username = ?";
    $stmt0 = $con->prepare($sql0);
    $stmt0->bind_param("s", $username);
    $stmt0->execute();
    $result = $stmt0->get_result();

    // Check if a user with the given username exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['id'];
    } else {
        $errors[] =  "User not found";
    }
    // handle file uploading of the image 
    if ($idCard["error"] == UPLOAD_ERR_OK) {
        $successMessage = "";
        $upload_dir = './assets/img/sellers';
        $file_name = uniqid() . '_' . basename($_FILES["idCard"]["name"]);
        $imgUrl = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES["idCard"]["tmp_name"], $imgUrl)) {
            $successMessage = "File uploaded successfully and path stored in database: $imgUrl<br>";
        } else {
            $errors[] =  "Error moving uploaded file.<br>";
        }
    } else {
        $errors[] = "Error uploading file: " . $_FILES["idCard"]["error"] . "<br>";
    }
    $type = 3;
    if(!isset($_SESSION['customerId'])){
        $sellerID = $_SESSION['sellerId'];
    }
    else{
        $sellerID = $_SESSION['customerId'];
    }
    

    // var_dump($sellerID);
    $sql = "UPDATE users SET type = ?, id_card = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssi", $type, $imgUrl, $sellerID);
    $stmt->execute();

    // now i will send all info indo database 
    $sql = "INSERT INTO shop(shop_name,seller_id,street,city,region,zipcode,country) VALUES(?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sisssss", $businessName, $sellerID, $businessStreet, $city, $region, $zipcode, $country);
    $status = $stmt->execute();
    if ($status) {
        unset($_SESSION['customerId']);
        $_SESSION['userType'] = 'seller';
        $_SESSION['sellerId'] = $sellerID;

        $s = new User();
        $sel = $s->getUserSellerById($sellerID);
        $_SESSION['sellerId'] = $sel['seller_id'];

        header("location: ./index.php");
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    echo json_encode(array('success' => false, 'errors' => $errors)); // Return validation errors as JSON
}
