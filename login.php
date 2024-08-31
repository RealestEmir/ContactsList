<?php
    session_start();
    include "connection.php";

    //If user is logged in they are redirected to the profile page
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE){
        header("location: profile.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WishList/css/login.css">
    <link rel="stylesheet" href="/WishList/css/reset.css" type="text.css">
    <title>Keepintabs-login</title>
</head>
<body>
    <div class="Container-1">
        <div>
            <header id="header">
                <a href="">KeepinTabs</a>
            </header>
        </div>

        <div>
            <nav id="nav">
                <ul class="horizontal-list">
                    <li><a href="main.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="Lists.php">Lists</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <br>

    <section class="Container-2">
        <article>
            <form action="perform-login.php" method="post" id="Login">
                <fieldset>
                    <!--Input boxes to enter login details-->
                    <legend>Login</legend>
                    <label for="">Email</label><br>
                    <input type="email" name="email" id="email" placeholder="Enter Email" required><br>
                    <label for="">Password</label><br>
                    <input type="password" name="password" id="password" placeholder="Enter Password" required><br>
                    <a href="">Forgot your details? Click here.</a><br>
                    <a href="signup.php">Don't have an account yet? Click here.</a><br>
                    <button type="submit">Login</button>
                </fieldset>
            </form>
        </article>
    </section>
</body>
</html>