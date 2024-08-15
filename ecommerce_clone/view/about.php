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
};

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<style type="text/css" xmlns="http://www.w3.org/1999/html">
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
       <h1>about us</h1>
   </div>
    <div class="title2">
        <a href="/view/home.php">home</a> / <span>about</span>
    </div>
    <div class="about-category">
        <div class="box">
            <img src="/view/src/3.webp" alt="">
            <div class="detail">
                <span>coffee</span>
                <h1>lemon green</h1>
                <a href="/view/view_product.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box">
            <img src="/view/src/2.webp" alt="">
            <div class="detail">
                <span>coffee</span>
                <h1>lemon green</h1>
                <a href="/view/view_product.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box">
            <img src="/view/src/about.png" alt="">
            <div class="detail">
                <span>coffee</span>
                <h1>lemon Teaname</h1>
                <a href="/view/view_product.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box">
            <img src="/view/src/1.webp" alt="">
            <div class="detail">
                <span>coffee</span>
                <h1>lemon green</h1>
                <a href="/view/view_product.php" class="btn">shop now</a>
            </div>
        </div>
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
    <div class="about">
        <div class="row">
            <div class="img-box">
                <img src="/view/src/3.png" alt="">
            </div>
            <div class="detail">
                <h1>visit our beautiful showroom!</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias doloribus ipsum libero magni molestiae placeat quidem sequi, vero vitae voluptatum?</p>
                <a href="/view/view_product.php" class="btn">shop now</a>
            </div>
        </div>
    </div>
      <div class="testimonial-container">
          <div class="title">
              <img src="/view/src/download.png" alt="" class="logo">
              <h1>what people say about us</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta facilis itaque nobis sunt voluptatibus?</p>
          </div>
          <div class="container">
              <div class="testimonial-item active">
                  <img src="/view/src/01.jpg" alt="">
                  <h1>sara smith</h1>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam
                      asperiores cum dolor doloremque ea, est excepturi, fugit inventore, ipsam mollitia
                      nesciunt odio  quas quibusdam reiciendis saepe suscipit veniam veritatis.</p>
              </div>
              <div class="testimonial-item">
                  <img src="/view/src/02.jpg" alt="">
                  <h1>harry potter</h1>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam
                      asperiores cum dolor doloremque ea, est excepturi, fugit inventore, ipsam mollitia
                      nesciunt odio  quas quibusdam reiciendis saepe suscipit veniam veritatis.</p>
              </div>
              <div class="testimonial-item">
                  <img src="/view/src/03.jpg" alt="">
                  <h1>Alice</h1>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam
                      asperiores cum dolor doloremque ea, est excepturi, fugit inventore, ipsam mollitia
                      nesciunt odio  quas quibusdam reiciendis saepe suscipit veniam veritatis.</p>
              </div>
              <div class="left-arrow" onclick="prevSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
              <div class="right-arrow" onclick="nextSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
          </div>
      </div>

       <?php include "../view/partial/footer.php";?>
    </div>
  </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert.min.js"></script>
<script src="/controller/script.js"></script>
<?php //include "view/alert.php";?>
</body>
</html>