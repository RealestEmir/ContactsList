<?php
    session_start();
    include "connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Initialize variables from post data
        $newEmail = $_POST['email'];
        $username = $_POST['username'];
        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        //Check if passwords are matching
        if ($newPassword == $confirmPassword){
            //sql statement to insert user info into the user table
            $sql = "insert into users values ('', '$username', '$newEmail', '$newPassword')";
            $result = mysqli_query($conn, $sql);
            header("Location: login.php");
            exit();
        }
        else{
            $_SESSION['error'] = "Passwords do not match";
            header("Location: signup.html");
            exit();
        }
    }