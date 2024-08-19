<?php
    session_start();
    include "connection.php";

    //Prevents user from submitting an empty form
    if (!isset($_POST['email'], $_POST['password'])){
        exit('Please fill both the username and password fields');
    }

    //Prepares sql statement to search for the user using their email 
    if ($stmt = $conn->prepare("SELECT PersonID, Password FROM users WHERE Email = ?")){
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();

        //If user is found their id and password are binded to a prepared statement for results storage
        if ($stmt->num_rows() > 0){
            $stmt->bind_result($PersonID, $Password);
            $stmt->fetch();

            //Hashes password and checks if it matches the stored hashed password
            if (password_verify($_POST['password'], $Password)){
                session_regenerate_id();
                //Boolean statement to set the user as logged in, their id is assigned to a session variable
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['PersonID'] = $PersonID;
                //Redirected to profile page upon completion
                header("Location: profile.php");
                exit();
            }
            else{
                header("Location: login.php?error=IncorrectPassword");
            }
        }
        else{
            header("Location: login.php?error=IncorrectPassword");
        }

        $stmt->close();
    }
    
    else{
        exit('Failed to prepare SQL statement');
    }