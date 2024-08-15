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
    <title>Green Coffee - order  Page</title>
</head>
<body>
<?php include "../view/partial/header.php"; ?>
<div class="main">
    <div class="banner">
        <h1>my order</h1>
    </div>
    <div class="title2">
        <a href="/view/home.php">home</a> / <span>order</span>
    </div>
    <section class="orders">
        <div class="title">
            <img src="/view/src/download.png" class="logo" alt="">
            <h1>my order</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                dolore incidunt rem rerum similique. Sit?</p>
        </div>
        <div class="box-container">
            <?php
               $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC ");
               $select_orders->execute([$user_id]);
               if ($select_orders->rowCount() > 0){
                   while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                       $select_products =$conn->prepare("SELECT * FROM `products` WHERE  id = ?");
                       $select_products->execute([$fetch_order['product_id']]);
                       if ($select_products->rowCount() > 0){
                           while ($fetch_product =  $select_products->fetch(PDO::FETCH_ASSOC)){
                               $image_data = base64_encode($fetch_product['image']);
                               $image_src = 'data:image/jpeg;base64,' . $image_data;
                       ?>
                               <div class="box" <?php if ($fetch_order['status']==="cancle"){echo 'style="border:2px solid red";';}  ?> >
                                   <a href="view_order.php?get_id=<?=$fetch_order['id'];?>">
                                       <p class="date"><i class="bi bi-calender-fill"></i>
                                           <span><?=$fetch_order['date'];?></span></p>
                                           <img src="<?php echo $image_src; ?>" class="image">
                                           <div class="row">
                                               <h3 class="name"><?=$fetch_product['name'];?></h3>
                                               <p class="price">Price : <?=$fetch_order['price'];?> X <?=$fetch_order['qty'];?></p>
                                              <p class="status" style="color: <?php if ($fetch_order['status']==='delivered'){echo 'green';}elseif($fetch_order['status']=='canceled'){echo 'red';}
                                              else{echo 'orange';       }?>">Price : <?=$fetch_order['price'];?> X <?=$fetch_order['qty'];?></p>
                                           </div>
                                   </a>
                               </div>
                       <?php
                           }
                       }
                     }
               }else{
                   echo '<p class="empty">no order takes places yet</p>';
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
