<?php
    session_start();
    include "connection.php";

    //Prevents user from submitting an empty form
    if (!isset($_POST['email'], $_POST['username'], $_POST['password'])){
        exit('Please complete the registration form');
    }

    //Prevents user from submitting an empty form
    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])){
        exit('Please complete the registration form');
    }

    //Makes sure email address submitted is in standard email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        exit('Email is not valid');
    }

    //Ensures username is composed of only alphanumeric characters
    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0){
        exit('Username is not valid');
    }

    //Ensures password is between 5 and 20 characters
    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5){
        exit('Password must be between 5 and 20 characters long');
    }

    //Checks if their already exists an account under the same name by searching the table for any records with the same username
    //Duplicates are prevented from being made
    if ($stmt = $conn->prepare('SELECT PersonID, Password FROM users WHERE Username = ?')){
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows() > 0){
            echo 'Username exists, please choose another';
        }
        else{
            //Prepares sql statement to insert the user's details into the table
            if ($stmt = $conn->prepare('INSERT INTO users (Username, Password, Email) VALUES (?, ?, ?)')){
                //User's password is hashed before being stored
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                $stmt->execute();
                //Redirects to the login page upon completion
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
