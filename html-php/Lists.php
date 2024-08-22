<?php
    session_start();
    include "connection.php";

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WishList/css/Lists.css">
    <link rel="stylesheet" href="/WishList/css/reset.css" type="text.css">
    <title>Keepintabs-lists</title>
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

        <article>
            <form action="" id="Lists">
                <fieldset>
                    <Legend>Lists</Legend>   
                    <label for="">Select List</label><br>
                    <!--Drop down menu to select wishlists-->
                    <select name="list-list" id="list-list">
                        <option value="">All</option>
                    </select><br>

                    <!--Removes all products in currently open wishlist-->
                    <div class = "display-wishlist">
                        <ul id="product-list">
                        </ul>
                        <button onclick="removeAll()">Remove all</button>
                    </div>
                </fieldset>
            </form>
        </article>
    </section>
    <!--<script src="/js/products.js"></script>-->
</body>
</html>