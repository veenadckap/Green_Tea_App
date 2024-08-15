<?php
include("../model/connectDb.php");
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
if (isset($_POST['logout'])){
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
    <title>Green Coffee -home page</title>
</head>
<body>
<?php include "../view/partial/header.php";?>
   <div class="main">
       <div class="banner">
           <h1>contact  us</h1>
       </div>
       <div class="title2">
           <a href="/view/home.php">home</a> / <span>contact us</span>
       </div>
       <section class="services">
           <div class="title">
               <img  src="/view/src/download.png" alt="logo" class="logo">
               <h1>why choose us</h1>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum fuga minus repudiandae?</p>
           </div>
           <div class="box-container">
               <div class="box">
                   <img src="/view/src/icon2.png" alt="">
                   <div class="detail">
                       <h3>great savings</h3>
                       <p>save big every order</p>
                   </div>
               </div>
               <div class="box">
                   <img src="/view/src/icon1.png" alt="">
                   <div class="detail">
                       <h3>24*7</h3>
                       <p>one-on-one support</p>
                   </div>
               </div>
               <div class="box">
                   <img src="/view/src/icon0.png" alt="">
                   <div class="detail">
                       <h3>gift vouchers</h3>
                       <p>vouchers on every festivals</p>
                   </div>
               </div>
               <div class="box">
                   <img src="/view/src/icon.png" alt="">
                   <div class="detail">
                       <h3>worldwide delivery</h3>
                       <p>dropship worldwide </p>
                   </div>
               </div>
           </div>
       </section>
       <div class="form-container">
           <form action="" method="post">
               <div class="title">
                   <img src="/view/src/download.png" class="logo" alt="">
               </div>
               <div class="input-field">
                   <p>your name <span class="sup">*</span> </p>
                   <input type="text" name="name">
               </div>
               <div class="input-field">
                   <p>your email <span class="sup">*</span> </p>
                   <input type="email" name="email">
               </div>
               <div class="input-field">
                   <p>your number <span class="sup">*</span> </p>
                   <input type="text" name="number">
               </div>
               <div class="input-field">
                   <p>your message <span class="sup">*</span> </p>
                   <textarea name="message" ></textarea>
               </div>
               <button type="submit" name="submit-btn" class="btn">send message</button>

           </form>
       </div>
       <div class="address">
           <div class="title">
               <img src="/view/src/download.png" class="logo" alt="">
               <h1>contact detail</h1>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
           </div>
           <div class="box-container">
               <div class="box">
                   <i class="bx bxs-map-pin"></i>
                   <div>
                       <h4>address</h4>
                       <p>Avadi,India</p>
                   </div>
               </div>
               <div class="box">
                   <i class="bx bxs-phone-call"></i>
                   <div>
                       <h4>phone number</h4>
                       <p>1234567890</p>
                   </div>
               </div>
               <div class="box">
                   <i class="bx bxs-map-pin"></i>
                   <div>
                       <h4>email</h4>
                       <p>veena@gmail.com</p>
                   </div>
               </div>
           </div>
       </div>
    <?php include "../view/partial/footer.php";?>
   </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert.min.js"></script>
<script src="/controller/script.js"></script>
<?php require "/view/alert.php";?>
</body>
</html>