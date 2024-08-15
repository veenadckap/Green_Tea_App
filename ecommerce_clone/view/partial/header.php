<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header class="header">
    <div class="flex">
        <a href="/view/home.php" class="logo"><img src="/view/src/logo.jpg" alt=""></a>
        <nav class="navbar">
            <a href="/view/home.php">home</a>
            <a href="/view/view_product.php">products</a>
            <a href="order.php">orders</a>
            <a href="/view/about.php">about us</a>
            <a href="contact.php">contact us</a>
        </nav>
        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>
            <?php
              $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
              $count_wishlist_items->execute([$user_id]);
              $total_wishlist_items = $count_wishlist_items->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup><?=$total_wishlist_items?></sup></a>
            <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="cart.php" class="cart-btn"><i class="bx bx-cart-download"></i><sup><?=$total_cart_items?></sup></a>
            <i class="bx bx-list-plus" id="menu-btn" style="font-size: 2rem"></i>
        </div>
        <div class="user-box">
            <p>username : <span> <?php echo  $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="login.php" class="btn">login</a>
            <a href="/view/register.php" class="btn">register</a>
            <form method="post">
                <button type="submit" name="logout" class="logout-btn">log out</button>
            </form>

        </div>
    </div>
</header>

<script src="../../controller/script.js"></script>
</body>
</html>
