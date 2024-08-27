<?php
    include "connection-2.php";

    //Prevents empty form submission
    if (!isset($_POST['inputName'])){
        exit('Please fill in the field');
    }

    //Name of table is wishlist name user submitted
    $tableName = strtoupper($_POST['inputName']);

    //sql statement to create the table
    $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS `$tableName` (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        link VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        image VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        value VARCHAR(255) NOT NULL DEFAULT ?
    )");

    //Bind table name to the placeholder and execute
    $stmt->bind_param("s", $tableName);
    $stmt->execute();

    //Redirect back to create-list.html
    header("Location: create-list.html");