<?php
    session_start();
    include "connection.php";

    if (!isset($_POST['email'], $_POST['password'])){
        exit('Please fill both the username and password fields');
    }

    if ($stmt = $conn->prepare("SELECT PersonID, Password FROM users WHERE Email = ?")){
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows() > 0){
            $stmt->bind_result($PersonID, $Password);
            $stmt->fetch();

            if (password_verify($_POST['password'], $Password)){
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['PersonID'] = $PersonID;
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