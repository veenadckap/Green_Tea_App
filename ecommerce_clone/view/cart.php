<?php
include("../model/connectDb.php");
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /view/login.php");
}
//update product in cart
if (isset($_POST['update_cart'])){
    $cart_id =$_POST['cart_id'];
    $qty = $_POST['qty'];

    $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id =?");
    $update_qty->execute([$qty,$cart_id]);

    $success_msg[] ='cart quantity updated successfully';
}

//delete item from wishlist
if (isset($_POST['delete_item'])){
    $cart_id = $_POST['cart_id'];

    $verify_delete_items = $conn->prepare("SELECT * FROM `cart` WHERE id = ?" );
    $verify_delete_items->execute([$cart_id]);

    if ($verify_delete_items->rowCount() > 0){
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete_cart_id->execute([$cart_id]);
        $success_msg[]= "cart item delete successfully";
    }
    else{
        $warning_msg[]= "cart  item already deleted";
    }
}
//empty_cart
if (isset($_POST['empty_cart'])){
    $verify_empty_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_empty_item->execute([$user_id]);
    if ($verify_empty_item->rowCount() > 0){
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart_id->execute([$user_id]);
        $success_msg[]= "empty successfully";
    }
    else{
        $warning_msg[]= "cart  item already deleted";
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<style type="text/css">
    <?php include("style.css"); ?>
</style>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Green Coffee - cart  page</title>
</head>
<body>
<?php include "../view/partial/header.php"; ?>
<div class="main">
    <div class="banner">
        <h1>My cart</h1>
    </div>
    <div class="title2">
        <a href="/view/home.php">Home</a> / <span>cart </span>
    </div>
    <section class="products">
        <h1 class="title">products added in cart</h1>
        <div class="box-container">
            <?php
            $grand_total =0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0){
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_products->execute([$fetch_cart['product_id']]);
                    if ($select_products->rowCount() >0){
                        $fetch_products= $select_products->fetch(PDO::FETCH_ASSOC);
                        $image_data = base64_encode($fetch_products['image']);
                        $image_src = 'data:image/jpeg;base64,' . $image_data;
                        ?>
                        <form method="post" class="box">
                            <input type="hidden" name="cart_id" value="<?=$fetch_cart['id']; ?>">
                            <img src="<?php echo $image_src; ?>"   class="image" >
                            <h3 class="name"><?=$fetch_products['name']; ?></h3>
                            <div class="flex">
                                <p class="price">price ₹<?=$fetch_products['price']; ?>/-</p>
                                <input type="number" name="qty" min="1" value="<?= $fetch_cart['qty'];?>" max="99" maxlength="2" class="qty" >
                                <button type="submit" name="update_cart" class="bx bxs-edit fa-edit"></button>
                            </div>
                            <p class="sub-total">sub total : <span>$<?=$sub_total =($fetch_cart['qty']*$fetch_cart['price']) ?></span></p>
                            <button type="submit" name="delete_item" class="btn" onclick="return confirm('delete this item')">delete</button>

                        </form>
                        <?php
                        $grand_total+=$sub_total;
                    }
                    else{
                        echo " <p class='empty'>product was not found</p>";

                    }
                }
            } else {
                echo " <p class='empty'>no cart  add yet!</p>";
            }


            ?>
        </div>
        <?php
        if ($grand_total != 0){
        ?>
        <div class="cart-total">
            <p>total amount payable : <span>$ <?=$grand_total; ?>/-</span></p>
            <div class="button">
                <form method="post">
                    <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to ' +
                     'empty your cart')">empty cart</button>
                </form>
                <a href="/view/checkout.php" class="btn">proceed to checkout</a>
            </div>
        </div>
        <?php   } ;    ?>
    </section>
    <?php include "../view/partial/footer.php"; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="/controller/script.js"></script>
<?php require "../view/alert.php"; ?>
</body>
</html>
