<?php
    session_start();
    include "connection.php";

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }
?>

<?php
    include "connection-2.php";
    $databaseName = 'wishlists';

    $stmt = $conn->prepare("SELECT TABLE_NAME
                            FROM information_schema.tables
                            WHERE table_schema = ?"
                        );
    $stmt->bind_param('s', $databaseName);
    $stmt->execute();
    $result = $stmt->get_result();

    $selectedList = 'null';
    
    if(isset($_POST['list-list']) && $_POST['list-list'] != 'null'){
        $selectedList = $_POST['list-list'];
        if ($selectedList === 'all'){
            $sql = "SELECT * FROM `all`";
        }
        else{

        }
    }
    else {
        $sql = "SELECT * FROM `all`";
    }

    $result = $conn->query($sql);

    $productsDisplay = [];

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $productsDisplay[] = $row;
        }
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="Lists">
                <fieldset>
                    <Legend>Lists</Legend>   
                    <label for="">Select List</label><br>
                    <!--Drop down menu to select wishlists-->
                    <select name="list-list" id="list-list" onchange="changeWishlist()">
                        <?php
                            while ($row = $result->fetch_assoc()){
                                echo "<option value='" . htmlspecialchars($row['TABLE_NAME']) . "'>" . htmlspecialchars($row['TABLE_NAME']) . "</option>";
                            }
                        ?>
                    </select><br>
                    <div class="Products">
                            <?php
                                if(!empty($productsDisplay)){
                                    foreach ($productsDisplay as $products){
                                        echo "<div class = item>";
                                        echo "<h2>" . $products["name"] . "</h2>";
                                        echo '<a href="' . htmlspecialchars($products["link"]) . '">
                                                <img src="' . htmlspecialchars($products["image"]) . '" alt="Product Image">
                                            </a>';
                                        echo "<p>" . $products["price"] . "</p>";
                                        echo "<p>" . $products["description"] . "</p>";
                                    }
                                }
                            ?>
                    </div>
                </fieldset>
            </form>
        </article>
    </section>
    <script src="/js/products.js"></script> 
</body>
</html>