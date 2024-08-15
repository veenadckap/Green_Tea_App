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
//adding to products in wishlist
if(isset($_POST['add_to_wishlist'])){
    $id= unique_id();
    $product_id = $_POST['product_id'];

    $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
    $verify_wishlist->execute([$user_id, $product_id]);


    $cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $cart_num->execute([$user_id, $product_id]);
    if ($verify_wishlist->rowCount()>0){
        $warning_msg[] = 'product already exist in your wishlist';
    }
    else if ($cart_num->rowCount() > 0){
        $warning_msg[] = 'product already exist in your cart';
    }
    else{
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price=$select_price->fetch(PDO::FETCH_ASSOC);

        $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
        $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);


        $success_msg[] = 'product added to wishlist  successfully';

    }

}

//adding to products in cart
if(isset($_POST['add_to_cart'])){
    $id= unique_id();
    $product_id = $_POST['product_id'];

    $qty = 1;

    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $verify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if ($verify_cart->rowCount()>0){
        $warning_msg[] = 'product already exist in your wishlist';
    }
    else if ($max_cart_items->rowCount() > 20){
        $warning_msg[] = 'cart is full';
    }
    else{
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price=$select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO `cart` (id, user_id, product_id, price,qty) VALUES (?,?, ?, ?, ?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'],$qty]);

        $success_msg[] = 'product added to cart  successfully';

    }

}
function fetch_product_details($conn, $pid) {
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
    $select_products->execute([$pid]);
    return $select_products->fetch(PDO::FETCH_ASSOC);
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
    <title>Green Coffee - Home Page</title>
</head>
<body>
<?php include "../view/partial/header.php"; ?>
<div class="main">
    <div class="banner">
        <h1>Product Detail</h1>
    </div>
    <div class="title2">
        <a href="/view/home.php">Home</a> / <span>Product Detail</span>
    </div>
    <section class="view_page">
        <?php
        if(isset($_GET['pid'])){
            $pid = $_GET['pid'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$pid]);
            if ($select_products->rowCount() > 0){
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                    $image_data = base64_encode($fetch_products['image']);
                    $image_src = 'data:image/jpeg;base64,' . $image_data;
                    ?>
                    <form action="" method="post">
                        <img src="<?php echo $image_src; ?>" alt="Product Image">
                        <div class="detail">
                            <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
                            <div class="name"><?php echo $fetch_products['name']; ?></div>
                            <div class="detail">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae cum et
                                    eveniet illo iusto modi reiciendis sequi temporibus totam veniam. Blanditiis modi
                                    perferendis reiciendis sunt temporibus? Accusantium ad aliquid at consequatur,dignissimos doloribus eaque earum eos error fuga itaque laudantium minima minus nemo nisi officiis,
                                    expedita facere in incidunt labore, maxime minima</p>
                            </div>
                            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'];  ?>">
                            <div class="button">
                                <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                                <a href="/view/view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bx bx-show"></a>
                            </div>
                        </div>
                    </form>
                    <?php
                }
            }
        }
        ?>
    </section>
    <?php include "../view/partial/footer.php"; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="/controller/script.js"></script>
<?php require "../view/alert.php"; ?>
</body>
</html>
