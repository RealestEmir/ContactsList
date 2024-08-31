<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WishList/css/signup.css">
    <link rel="stylesheet" href="/WishList/css/reset.css" type="text.css">
    <title>Keepintabs-sign-up</title>
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
            <form action="perform-signup.php" method="post" id="Sign-up">
                <fieldset>
                    <legend>Sign Up</legend>
                    <!--Input boxes to create an account-->
                    <label for="">Email</label><br>
                    <input type="email" name="email" id="email" placeholder="Enter Email" required><br>
                    <label for="">Username</label><br>
                    <input type="text" name="username" id="username" placeholder="Create username" required><br>
                    <label for="">Password</label><br>
                    <input type="password" name="password" id="password" placeholder="Enter Password" required><br>
                    <label for="">Confirm Password</label><br>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Enter Password" required><br>
                    <a href="login.php">Already have an account? Click here.</a><br>
                    <button type="submit">Sign up</button>
                </fieldset>
            </form>
        </article>
    </section>
</body>
</html>