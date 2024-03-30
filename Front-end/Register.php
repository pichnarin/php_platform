
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="./sellerpage.css">
        <title>Title</title>
    </head>

    <body>
        <div class="container costom-container">
            <div class="registerUser-form">
                <h2>Open Seller Account</h2>

                <form action="addSeller.php" method="POST" role="form" enctype="multipart/form-data" name="sellerForm" onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="profile" class="form-label">Business Name</label>
                                <input type="text" class="form-control" name="businessName">
                            </div>
                            <div class="mb-3">
                                <label for="profile" class="form-label">Street</label>
                                <input type="text" class="form-control" name="businessStreet">
                            </div>
                            <div class="mb-3">
                                <label for="profile" class="form-label">City</label>
                                <input type="text" class="form-control" name="city">
                            </div>
                            <div class="mb-3">
                                <label for="profile" class="form-label">State/Province/Region:</label>
                                <input type="text" class="form-control" name="region">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-control" id="country" name="country">
                                    <option value="">Select Country</option>
                                    <optgroup label="Southeast Asia">
                                        <option value="KH">Cambodia</option>
                                        <option value="TH">Thailand</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="LA">Laos</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="SG">Singapore</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="PH">Philippines</option>
                                        <option value="BN">Brunei</option>
                                        <option value="TL">Timor-Leste</option>
                                    </optgroup>
                                    <optgroup label="East Asia">
                                        <option value="CN"> China</option>
                                        <option value="KR">South Korea</option>
                                        <option value="JP"> Japan</option>
                                    </optgroup>
                                    <optgroup label="Europe">
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                        <option value="GB">United Kingdom</option>
                                    </optgroup>
                                    <optgroup label="North/South America">
                                        <option value="US">United State</option>
                                        <option value="CA">Canada</option>
                                        <option value="BR">Brazil</option>
                                    </optgroup>
                                    <optgroup label="Africa">
                                        <option value="EG">Egypt</option>
                                        <option value="ZA">South Africa</option>
                                    </optgroup>
                                    <optgroup label="Oceania">
                                        <option value="AU">Australia</option>
                                        <option value="NZ">New Zealand</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="profile" class="form-label">Postal/ZIP Code</label>
                                <input type="text" class="form-control" name="zipcode">
                            </div>

                            <div class="mb-3">
                                <label for="profile" class="form-label">ID card (front and back in PDF file)</label>
                                <img src="assets/img/idcard.png" alt="Example ID Card" style="max-width: 100%; height: auto; margin-bottom: 10px;">
                                <input type="file" class="form-control" name="idCard" >
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-cadetblue">Register</button>
                    <div class="alreadyHasAcc-container">
                        <label for="termservice" class="form-check-label">I accept the <a href="termService.php" target="_blank">Terms of Service </a></label>
                        <input type="checkbox" id="termservice" class="form-check-input" required>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function validateForm() {
                var businessName = document.forms['sellerForm']['businessName'].value;
                var businessStreet = document.forms['sellerForm']['businessStreet'].value;
                var city = document.forms['sellerForm']['city'].value;
                var region = document.forms['sellerForm']['region'].value;
                var zipcode = document.forms['sellerForm']['zipcode'].value;
                var country = document.forms['sellerForm']['country'].value;
                var idCard = document.forms['sellerForm']['idCard'].files;

                if (businessName == "" || businessStreet == "" || city == "" || region == "" || zipcode == "" || country == "" || idCard.length == 0) {
                    alert("You need to fill all the fields.");
                    return false;
                } else {
                    // Validate business name
                    var validCharacters = /^[a-zA-Z0-9\s\-,.&'()]+$/;
                    if (!validCharacters.test(businessName)) {
                        alert("Business name can only contain letters, numbers, spaces, and common symbols.");
                        return false;
                    }
                    var minLength = 2;
                    var maxLength = 50;
                    if (businessName.length < minLength || businessName.length > maxLength) {
                        alert("Business name must be between " + minLength + " and " + maxLength + " characters long.");
                        return false;
                    }

                    // Validate the street 
                    var minLengthStreet = 2;
                    var maxLengthSteet = 100;
                    if (businessStreet.length < minLengthStreet || businessStreet.length > maxLengthSteet) {
                        alert("Business street must be between " + minLengthStreet + " and " + maxLengthSteet + " characters long.");
                        return false;
                    }

                    // Validate city
                    var minLengthCity = 2;
                    var maxLengthCity = 50;
                    if (city.length < minLengthCity || city.length > maxLengthCity) {
                        alert("City must be between " + minLengthCity + " and " + maxLengthCity + " characters long.");
                        return false;
                    }

                    // Validate zip code using Python (server-side validation)
                    var country_code = country.toLowerCase();
                    $.get("validateZip.php", {
                        country_code: country_code,
                        zip_code: zipcode
                    }, function(data) {
                        if (!data.valid) {
                            return false;
                        }
                    });

                    // Validate the file format
                    // for (var i = 0; i < idCard.length; i++) {
                    //     var fileName = idCard[i].name;
                    //     var fileExtension = fileName.split(".").pop().toLowerCase();
                    //     if (fileExtension !== 'jpg' && fileExtension !== 'jpeg' && fileExtension !== 'png') {
                    //         alert("Invalid file format. Please upload images only (jpg, jpeg, png)");
                    //         return false;
                    //     }
                    // }
                }
            }
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    </body>

    </html>