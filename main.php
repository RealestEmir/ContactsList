<?php
    session_start();
    include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WishList/css/main.css">
    <link rel="stylesheet" href="/WishList/css/reset.css" type="text.css">
    <title>Keepintabs-main</title>
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

    <section class="Container-2">
    <div id="count">
            <article>
                <p>You currently have: X Lists.</p>
            </article>
        </div>

        <div id="add">
            <article>
                <a href="create-list.html">Click here to create a list</a><br>
                <a href="add-product.html">Click here to add a product</a><br>
            </article>
        </div>
    </section>
</body>
</html>