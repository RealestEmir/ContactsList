<?php
    include "connection.php";

    //Prevents empty form submission
    if (!isset($_POST['link'], $_POST['name'], $_POST['price'], $_POST['image'], $_POST['list-belonging'])){
        exit('Please fill in the necessary fields');
    }
    else{
        $productLink = $_POST['link'];

        $words = explode(' ', $productLink);

        $containsLink = false;

        foreach($words as $word){
            if (filter_var($word, FILTER_VALIDATE_URL)){
                $containsLink = true;
                break;
            }
        }

        if ($containsLink){
            $tableName = strtoupper($_POST['list-belonging']);

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

            $stmt = $conn->prepare("INSERT INTO `$tableName` (link, name, price, image, description, value)
                                    VALUES (?, ?, ?, ?, ?, ?)");
            
            $description = !empty($_POST['description']) ? $_POST['description'] : '';

            $stmt->bind_param("ssdsss", $_POST['link'], $_POST['name'], $_POST['price'], $_POST['image'], $description, $tableName);

            if($stmt->execute()){
                header("Location: main.php");
            }
            else{
                echo "Error adding product: " . $conn->error;
            }
        }
        else{
            echo "Please submit a valid link";
        }
    }
    