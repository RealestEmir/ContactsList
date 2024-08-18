<?php
    session_start();
    include "connection.php";

    if (!isset($_POST['email'], $_POST['username'], $_POST['password'])){
        exit('Please complete the registration form');
    }

    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])){
        exit('Please complete the registration form');
    }

    if ($stmt = $conn->prepare('SELECT PersonID, Password FROM users WHERE Username = ?')){
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows() > 0){
            echo 'Username exists, please choose another';
        }
        else{
            if ($stmt = $conn->prepare('INSERT INTO users (Username, Password, Email) VALUES (?, ?, ?)')){
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                $stmt->execute();
                header("location: login.php");
            }
            else {
                echo 'Could not prepare a statement';
            }
        }
    }
    else{
        echo 'Could not prepare a statement';
    }
    $conn->close();
