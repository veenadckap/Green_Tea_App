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
    exit;
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header("Location: /view/order.php");
    exit;
}
if (isset($_POST['cancel'])) {
    $update_order = $conn->prepare("UPDATE `orders` SET `status` = ? WHERE `id` = ?");
    $update_order->execute(['canceled', $get_id]);
    header('location:order.php');
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
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Green Coffee - Order Detail Page</title>
</head>
<body>
<?php include "../view/partial/header.php"; ?>
<div class="main">
    <div class="banner">
        <h1>Order Detail</h1>
    </div>
    <div class="title2">
        <a href="/view/home.php">Home</a> / <span>Order Detail</span>
    </div>
    <section class="orders-detail">
        <div class="title">
            <img src="/view/src/download.png" class="logo" alt="">
            <h1>Order Detail</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                dolore incidunt rem rerum similique. Sit?</p>
        </div>
        <div class="box-container">
           <?php 
           $grand_total = 0;
           $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
           $select_orders->execute([$get_id]);
           if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {

                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                    $select_products->execute([$fetch_orders['product_id']]);
                    if ($select_products->rowCount() > 0) {
                        while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                            $sub_total = ($fetch_orders['price'] * $fetch_orders['qty']);
                            $grand_total += $sub_total;
                             $image_data = base64_encode($fetch_product['image']);
                               $image_src = 'data:image/jpeg;base64,' . $image_data;
            ?>
            <div class="box">
                <div class="col">
                  <p class="title"><i class="bx bxs-calendar"></i><?= $fetch_orders['date']; ?></p>
                  <img src="<?php echo $image_src; ?>" class="image">
                  <p class="price"><?= $fetch_product['price']?> X <?=$fetch_orders['qty']; ?></p>
                  <h3 class="name"><?= $fetch_product['name']?></h3>
                  <p class="grand-total">Total amount payable : <span><?= $grand_total;?></span></p>
          </div>
            <div class="col">
            <p class="title">billing address</p>
            <p class="user"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
  <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
</svg> <?= $fetch_orders['name']?></p>
            <p class="user"><i class="bx bx-phone"></i><?= $fetch_orders['number']?></p>
            <p class="user"><i class="bx bxs-envelope"></i><?= $fetch_orders['email']?></p>
            <p class="user"><i class="bx bx-map"></i><?= $fetch_orders['address']?></p>
            <p class="title">status</p>
            <p class="status" style="color:<?php if ($fetch_orders['status']=='delivered'){echo 'green';}elseif($fetch_orders['status']=='canceled'){echo 'red';}else{echo 'orange';}?>"><?= $fetch_orders['status']?></p>        
               <?php
                 if($fetch_orders['status']=='canceled'){?>
                  <a href="checkout.php?get_id=<?=$fetch_product['id'];?>" class="btn">order again</a>
                 <?php }else {?>
                 <form method="post" >
                     <button type="submit" name="cancel" class="btn" onclick="return confirm('do you want to cancel this order')">cancel order</button>
                 </form>
                 <?php } ?>
               
                </div>
            </div>
            <?php
                        }
                    }else{
                   echo '<p class="empty">product not found</p>';
               }
                }
           } else{
                echo '<p class="empty">no order found</p>';

           }
            ?>
        </div>
    </section>
    <?php include "../view/partial/footer.php"; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="/controller/script.js"></script>
<?php require "../view/alert.php"; ?>
</body>
</html>
