<?php

// Function to validate ZIP code
function validate_zip_code($country, $zipcode) {
    // Construct the URL for the API endpoint
    $url = "https://api.zippopotam.us/{$country}/{$zipcode}";

    // Make a GET request to the API endpoint
    $response = file_get_contents($url);

    // Check if the response was successful
    if ($response !== false) {
        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if the response contains valid data
        if (isset($data['places']) && !empty($data['places'])) {
            return true; // ZIP code is valid
        } else {
            return false; // ZIP code is invalid or not found
        }
    } else {
        return false; // Failed to fetch data
    }
}

// List of countries and their country codes
$countries = array(
    "cambodia" => "kh",
    "thailand" => "th",
    "vietnam" => "vn",
    "laos" => "la",
    "myanmar" => "mm",
    "malaysia" => "my",
    "singapore" => "sg",
    "indonesia" => "id",
    "philippines" => "ph",
    "brunei" => "bn",
    "timor-leste" => "tl",
    "china" => "cn",
    "south korea" => "kr",
    "japan" => "jp",
    "france" => "fr",
    "germany" => "de",
    "united kingdom" => "gb",
    "united states" => "us",
    "canada" => "ca",
    "brazil" => "br",
    "egypt" => "eg",
    "south africa" => "za",
    "australia" => "au",
    "new zealand" => "nz"
);
