<?php
    $server = 'localhost'; // corrected variable name
    $username = 'root'; // replace with your MySQL username
    $password = ''; // replace with your MySQL password
    $database = 'fashion';

    $con = new mysqli($server, $username, $password, $database);
    if ($con->connect_error){
        die('Connection to ecommerce unsuccessful: ' . $con->connect_error);
    } 
?>