<?php
    session_start();
    include "connection.php";

    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
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

        <!---<div id="add-list">
            <article>
                <a href="create-list.html">Click here to create a list</a>
            </article>
        </div>--->

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

                    <!--input fields for product info-->
                    <label for="">Product link</label><br>
                    <input type="text" name="link" id="link" placeholder="Paste url"><br>
                    <label for="">Product name</label><br>
                    <input type="text" name="name" id="name" placeholder="Enter name"><br>
                    <label for="">Product price (£)</label><br>
                    <input type="number" name="price" id="price" min="0.00" step="0.01"><br>
                    <label for="">Product image</label><br>
                    <input type="file" name="image" id="image"><br>
                    <label for="">Product description (optional)</label><br>
                    <input type="text" name="description" id="description"><br>
                    <label for="">Wishlist</label><br>
                    <input type="text" name="list-belonging" id="list-belonging"><br>
                    <!---<label for="">Select list</label><br>
                    <select name="" id="">
                        <option value=""></option>
                    </select><br>--->
                    <button onclick="addProduct()">Add product</button><br>
                </fieldset>
            </form>
        </article>

        <article>
            <form action="" id="Create-List">
                <fieldset>
                    <!--Input field to create a wishlist-->
                    <legend>Create a list</legend>
                    <label for="">List name</label><br>
                    <input type="text" name="list" id="list" placeholder="Enter name"><br>
                    <button onclick="addList()">Add list</button><br>
                    <button onclick="removeLists()">Remove all lists</button>
                </fieldset>
            </form>
        </article>
        <!--Both forms very rudimentary-->
    </section>
    <script src="/js/products.js"></script>
</body>
</html>