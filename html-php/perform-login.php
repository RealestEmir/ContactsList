<?php
    session_start();
    include "connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Initialize variables from post data
        $email = $_POST['email'];
        $password = $_POST['password'];

        //create sql statement to check if login details matchup with table data
        $sql = "select * from users where email = '$email' and password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0){
            //If matching table data present, set session variables and redirect to Lists.html
            $_SESSION['email'] = $email;
            header("Location: Lists.html");
            exit();
        }
        else{
            //If not matching table data present, set error message and redirect to login.php
            $_SESSION['error'] = "Incorrect login details.";
            header("Location: login.php");
            exit();
        }
    }