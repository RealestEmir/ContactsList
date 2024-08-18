<?php
    session_start();
    include "connection.php";

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }
    
    $stmt = $conn->prepare('SELECT Password, Username, Email FROM users WHERE PersonID = ?');
    $stmt->bind_param('i', $_SESSION['PersonID']);
    $stmt->execute();
    $stmt->bind_result($password, $username, $email);
    $stmt->fetch();
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WishList/css/profile.css">
    <link rel="stylesheet" href="/WishList/css/reset.css" type="text.css">
    <title>Profile</title>
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
        <div id="info">
            <article>
                <p>Account details below:</p>
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><?=htmlspecialchars($username, ENT_QUOTES)?></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><?=htmlspecialchars($password, ENT_QUOTES)?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?=htmlspecialchars($email, ENT_QUOTES)?></td>
                    </tr>
                </table>
            </article>
        </div>

        <form action="logout.php" method="post" id="logout">
            <fieldset>
                <button type="submit">Logout</button>
            </fieldset>
        </form>
    </section>
    
</body>
</html>