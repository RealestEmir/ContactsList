<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $db_name = "wishlists";
    $conn = new mysqli($servername, $username, $password, $db_name);

    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }