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
    <section class="home-section">
        <div class="slider">
            <div class="slider__slider slider1">
                <div class="overlay"> </div>
                <div class="slide_detail">
                    <h1>Lorem ipsum dolor sit</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, consectetur!</p>
                    <a href="/view/view_products.php" class="btn">shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!-------------------slide one----------------------------------->
            <div class="slider__slider slider2">
                <div class="overlay"> </div>
                <div class="slide_detail">
                    <h1>welcome to my shop</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, consectetur!</p>
                    <a href="/view/view_products.php" class="btn">shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!-------------------slide one------------------>

            <div class="slider__slider slider3">
                <div class="overlay"> </div>
                <div class="slide_detail">
                    <h1>welcome to my shop</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, consectetur!</p>
                    <a href="/view/view_products.php" class="btn">shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!-------------------slide one------------------>

            <div class="slider__slider slider4">
                <div class="overlay"> </div>
                <div class="slide_detail">
                    <h1>welcome to my shop</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, consectetur!</p>
                    <a href="/view/view_products.php" class="btn">shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!-------------------slide one------------------>

            <div class="slider__slider slider5">
                <div class="overlay"> </div>
                <div class="slide_detail">
                    <h1>welcome to my shop</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, consectetur!</p>
                    <a href="/view/view_products.php" class="btn">shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!-------------------slide one------------------>
            <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
            <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
        </div>
    </section>
    <!-------------------home slider end------------------>

    <section class="thumb">
        <div class="box-container">
           <div class="box">
               <img src="/view/src/thumb2.jpg" alt="">
               <h3>green tea</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ipsa odio placeat.</p>
               <i class="bx bx-chevron-right"></i>
           </div>

            <div class="box">
                <img src="/view/src/thumb0.jpg" alt="">
                <h3>lemon tea</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ipsa odio placeat.</p>
                <i class="bx bx-chevron-right"></i>
            </div>

            <div class="box">
                <img src="/view/src/thumb1.jpg" alt="">
                <h3>green coffee</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ipsa odio placeat.</p>
                <i class="bx bx-chevron-right"></i>
            </div>

            <div class="box">
                <img src="/view/src/thumb.jpg" alt="">
                <h3>green tea</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ipsa odio placeat.</p>
                <i class="bx bx-chevron-right"></i>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="box-container">
            <div class="box">
                <img class="img" src="/view/src/about-us.jpg" alt="">
            </div>
            <div class="box">
                <img src="/view/src/download.png" alt="">
                <span>healthy tea </span>
                <h1>save up to 50% off</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A delectus dolorem facere.</p>
            </div>
        </div>
    </section>
    
    <section class="shop">
        <div class="title">
            <img src="/view/src/download.png" alt="">
             <h1>Trending Products</h1>
        </div>
        <div class="row">
            <img src="/view/src/about.jpg" alt="">
            <div class="row-detail">
                <img  class="img"  src="/view/src/basil.jpg" alt="">
                <div class="top-footer">
                    <h1>a cup of green tea makes you healthy</h1>
                </div>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="/view/src/card.jpg" alt="">
                <a href="/view/view_product.php"  class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="/view/src/card0.jpg" alt="">
                <a href="/view/view_product.php"  class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="/view/src/card1.jpg" alt="">
                <a href="/view/view_product.php"  class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="/view/src/card2.jpg" alt="">
                <a href="/view/view_product.php"  class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="/view/src/10.jpg" alt="">
                <a href="/view/view_product.php"  class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="/view/src/6.webp" alt="">
                <a href="/view/view_product.php"  class="btn">shop now</a>
            </div>
        </div>
    </section>

    <section class="shop-category">
        <div class="box-container">
            <div class="box">
                <img class="img" src="/view/src/6.jpg" alt="">
                <div class="detail">
                    <span>BIG OFFERS</span>
                    <h1>Extra 15% off</h1>
                    <a href=/view/view_product.php"  class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img class="img" src="/view/src/7.jpg" alt="">
                <div class="detail">
                    <span>new in taste</span>
                    <h1>coffee house</h1>
                    <a href=/view/view_product.php"  class="btn">shop now</a>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
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
    <section class="brand">
        <div class="box-container">
            <div class="box">
                <img src="/view/src/brand%20(1).jpg" alt="">
            </div>
            <div class="box">
                <img src="/view/src/brand%20(2).jpg" alt="">
            </div>
            <div class="box">
                <img src="/view/src/brand%20(3).jpg" alt="">
            </div>
            <div class="box">
                <img src="/view/src/brand%20(4).jpg" alt="">
            </div>
            <div class="box">
                <img src="/view/src/brand%20(5).jpg" alt="">
            </div>
        </div>
    </section>
    <?php include "../view/partial/footer.php";?>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert.min.js"></script>
<script src="/controller/script.js"></script>
<?php //include "view/alert.php";?>
</body>
</html>