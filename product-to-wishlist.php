<?php
    include "connection-2.php";

    //Prevents empty form submission
    if (!isset($_POST['link'], $_POST['name'], $_POST['price'], $_FILES['image'], $_POST['list-belonging'])){
        exit('Please fill in the necessary fields');
    }
    else{
        //Retrieve product link
        $productLink = $_POST['link'];

        //Split the link text by spaces to check each word
        $words = explode(' ', $productLink);

        $containsLink = false;

        //loop through each word to check if it's a valid url
        foreach($words as $word){
            if (filter_var($word, FILTER_VALIDATE_URL)){
                $containsLink = true;
                break;
            }
        }

        if ($containsLink){
            $tableName = strtoupper($_POST['list-belonging']);

            $imageDir = 'uploads/';
            if (!is_dir($imageDir)){
                mkdir($imageDir, 0777, true);
            }

            $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $imageName = uniqid() . '.' . $imageFileType;
            $imagePath = $imageDir . $imageName;

            $imagePath = $imageDir . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){
                $imagePath = '/' . $imagePath;
            }
            else{
                exit('Error uploading image');
            }

            //SQL statement to create the table, if table doesn't exist already
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

            //SQL statement to insert product details into the specified wishlist
            $stmt = $conn->prepare("INSERT INTO `$tableName` (link, name, price, image, description, value)
                                    VALUES (?, ?, ?, ?, ?, ?)"); 
            $stmt2 = $conn->prepare("INSERT INTO `all` (link, name, price, image, description, value)
                                    VALUES (?, ?, ?, ?, ?, ?)");
            
            //Provide an empty string as the default value for the description if one is not provided by the user
            $description = !empty($_POST['description']) ? $_POST['description'] : '';

            //Bind details to the SQL statement
            $stmt->bind_param("ssdsss", $_POST['link'], $_POST['name'], $_POST['price'], $imagePath, $description, $tableName);
            $stmt2->bind_param("ssdsss", $_POST['link'], $_POST['name'], $_POST['price'], $imagePath, $description, $tableName);

            //Execute the SQL statement to insert the data
            if ($stmt->execute() && $stmt2->execute()) {
                header("Location: add-product.html");
            } else {
                echo "Error adding product: " . $conn->error;
            }
        }
        else{
            echo "Please submit a valid link";
        }
    }
    