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
    exit();
}

if (isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $address = $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ',' . $_POST['country'] . ',' . $_POST['pincode'];
    $address_type = $_POST['address'];
    $method = $_POST['method'];

    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_cart->execute([$user_id]);

    if (isset($_GET['get_id'])) {
        $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $get_product->execute([$_GET['get_id']]);
        if ($get_product->rowCount() > 0) {
            while ($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)) {
                $insert_order = $conn->prepare("INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);
                header("Location: /view/order.php");
                exit();
            }
        } else {
            $warning_msg[] = 'Something went wrong';
        }
    } elseif ($verify_cart->rowCount() > 0) {
        while ($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)) {
            $insert_order = $conn->prepare("INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty']]);
        }
        if ($insert_order) {
            $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart_id->execute([$user_id]);
            header("Location: /view/order.php");
            exit();
        }
    } else {
        $warning_msg[] = 'Something went wrong';
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Green Coffee - Checkout Summary</title>
    <style type="text/css">
        <?php include("style.css"); ?>
    </style>
</head>
<body>
<?php include "../view/partial/header.php"; ?>
<div class="main">
    <div class="banner">
        <h1>Checkout Summary</h1>
    </div>
    <div class="title2">
        <a href="/view/home.php">Home</a> / <span>Checkout Summary</span>
    </div>
    <section class="checkout">
        <div class="title">
            <img src="/view/src/download.png" alt="" class="logo">
            <h1>Checkout Summary</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam delectus distinctio, exercitationem maxime officia pariatur!</p>
        </div>
        <div class="row">
            <form method="post">
                <h3>Billing Details</h3>
                <div class="flex">
                    <div class="box">
                        <div class="input-field">
                            <p>Your Name</p>
                            <input type="text" name="name" maxlength="50" placeholder="Enter your name" class="input" required>
                        </div>
                        <div class="input-field">
                            <p>Your Number</p>
                            <input type="number" name="number" maxlength="10" placeholder="Enter your number" class="input" required>
                        </div>
                        <div class="input-field">
                            <p>Your Email</p>
                            <input type="email" name="email" maxlength="50" placeholder="Enter your email" class="input" required>
                        </div>
                        <div class="input-field">
                            <p>Payment Method</p>
                            <select name="method" class="input" required>
                                <option value="cash on delivery">Cash on Delivery</option>
                                <option value="credit or debit card">Credit or Debit Card</option>
                                <option value="net banking">Net Banking</option>
                                <option value="UPI or RuPay">UPI or RuPay</option>
                                <option value="paytm">Paytm</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <p>Address Type</p>
                            <select name="address" class="input" required>
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                    </div>
                    <div class="box">
                        <div class="input-field">
                            <p>Address Line 01</p>
                            <input type="text" name="flat" maxlength="50" placeholder="e.g. flat & building name" class="input" required>
                        </div>
                        <div class="input-field">
                            <p>Address Line 02</p>
                            <input type="text" name="street" maxlength="50" placeholder="e.g. street name" class="input" required>
                        </div>
                        <div class="input-field">
                            <p>City Name</p>
                            <input type="text" name="city" maxlength="50" placeholder="Enter a city name" class="input" required>
                        </div>
                        <div class="input-field">
                            <p>Country Name</p>
                            <input type="text" name="country" maxlength="50" placeholder="Enter a country name" class="input" required>
                        </div>
                        <div class="input-field">
                            <p>Pincode</p>
                            <input type="text" name="pincode" maxlength="6" placeholder="110022" class="input" required>
                        </div>
                    </div>
                </div>
                <button class="btn" type="submit" name="place_order">Place Order</button>
            </form>
            <div class="summary">
                <h3>My Bag</h3>
                <div class="box-container">
                    <?php
                    $grand_total = 0;
                    if (isset($_GET['get_id'])) {
                        $select_get = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                        $select_get->execute([$_GET['get_id']]);
                        while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                            $sub_total = $fetch_get['price'];
                            $grand_total += $sub_total;
                            $image_data = base64_encode($fetch_get['image']);
                            $image_src = 'data:image/jpeg;base64,' . $image_data;
                            ?>
                            <div class="flex">
                                <img src="<?php echo $image_src; ?>" class="image">
                                <div class="details">
                                    <h3 class="name"><?= $fetch_get['name']; ?></h3>
                                    <p class="price"><?= $fetch_get['price']; ?>/-</p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                        $select_cart->execute([$user_id]);
                        if ($select_cart->rowCount() > 0) {
                            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                                $select_products->execute([$fetch_cart['product_id']]);
                                $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                                $sub_total = ($fetch_cart['qty'] * $fetch_products['price']);
                                $grand_total += $sub_total;
                                $image_data = base64_encode($fetch_products['image']);
                                $image_src = 'data:image/jpeg;base64,' . $image_data;
                                ?>
                                <div class="flex">
                                    <img src="<?php echo $image_src; ?>" class="image">
                                    <div class="details">
                                        <h3 class="name"><?= $fetch_products['name']; ?></h3>
                                        <p class="price"><?= $fetch_products['price']; ?> X <?= $fetch_cart['qty']; ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p class='empty'>Your cart is empty</p>";
                        }
                    }
                    ?>
                </div>
                <div class="grand-total">
                    <span>Total Amount Payable: </span><?= $grand_total; ?> /-
                </div>
            </div>
        </div>
    </section>
    <?php include "../view/partial/footer.php"; ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="/controller/script.js"></script>
<?php require "../view/alert.php"; ?>
</body>
</html>
