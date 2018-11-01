<?php
session_start();
require "../config.php";
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#e84e1b">
    <meta name="viewport" content="width=device-width">
    <title>E-commerce</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <link href="js/lightbox2-master/dist/css/lightbox.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic,100italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,latin-ext'
        rel='stylesheet' type='text/css'>
    <link href="../css/style.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="../css/media-query.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">

</head>
<?php
include "../functions/functions.php";
?>

<body>


    <script>
        $(function () {
            $('a[href*="#"]:not([href="#"])').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    </script>

    <a name="top"></a>
    <header id="header">

        <div id="headerTop">
            <div class="wrapper">
                <div id="headerTopLeft">
                    <span><i class="fa fa-lg fa-phone"></i>&nbsp;&nbsp;&nbsp;162/211322</span>
                    <span><i class="fa fa-lg fa-envelope-o"></i>&nbsp;&nbsp;&nbsp;info@jfdk.rs</span>
                </div>
                <div id="headerTopRight">
                    <a href="#" target="_blank"><i class="fa fa-lg fa-facebook-square"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-lg fa-twitter-square"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-lg fa-linkedin-square"></i></a>
                </div>
            </div>
        </div>

        <div id="headerBottom">
            <div class="wrapper">
            <a href="javascript:void(0);" class="icon" onclick="mynav()">
        <div class="menu_icon">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </a>
                <nav id="nav">
                    <ul>
                        <li><a href="../index.php">HOME</a></li>
                        <li><a href="../products.php?cid=1">PRODUCTS</a></li>
                        <li><a href="../about.php">ABOUT US</a></li>
                        <li><a href="../contact.php">CONTACT</a></li>
                        <li><a href="../customer/my_account.php">My Account</a></li>
                        <li><a href="../cart.php">VIEW CART</a></li>
                        <li>
                            <?php
                        if(!isset($_SESSION['customer_email'])){
                            echo "<a href='../checkout.php'>Login</a>";
                        }else {
                            echo "<a href='../logout.php'>Logout</a>";
                        }

                        ?>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="navprice">
                                <span>Total items:
                                    <?php total_items();?></span><span>Total price:
                                    <?php total_price();?></span>
                            </div>
                        </li>
                    </ul>
            </div>

        </div>
    </header><!-- kraj #header -->
    <?php

?>
    <div class="wrap-card">
        <?php

cart();
?>
        <div class="main_my_account">
            <div class="wrapper">
                <div class="my_account_main">

                    <?php
     if(isset($_SESSION['customer_email'])){
         $user=$_SESSION['customer_email'];

         $customers=Customer_Reg::getAll(" where customer_email='$user'");
         foreach($customers as $customer){
             $c_image=$customer->customer_image;
             $c_name=$customer->customer_name;
         }
     }


    if(!isset($_GET['my_orders'])){
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['change_pass'])){
                if(!isset($_GET['delete_account'])){
                    if(isset($_SESSION['customer_email'])){
                        echo "<h2>Welcome: " .$c_name."</h2>";
                        echo  "<div ><img src='customer_images/". $c_image,"' alt='slika' width='200' height='250'></div><br>";
                        echo "<p>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></p>";


                    }

                }
            }
        }
    }

    if(!isset($_SESSION['customer_email'])){
        echo "<h2><a class='button' href='../checkout.php'>Login or register now to buy!</a></h2>";

    }

        if(isset($_GET['edit_account']) and isset($_SESSION['customer_email'])){
            include "edit_account.php";
        }

        if(isset($_GET['change_pass']) and isset($_SESSION['customer_email'])){
            include "change_pass.php";
        }
        if(isset($_GET['delete_account']) and isset($_SESSION['customer_email'])){
            include "delete_account.php";
        }
        if(isset($_GET['my_orders']) and isset($_SESSION['customer_email'])){
            include "my_orders.php";
        }
?>
                </div>
                <div class="my_account_inf">
                    <h4>My account:</h4><br>
                    <div class="myaccount-sidebar">
                        <p><a href="my_account.php?my_orders">My Orders</a></p><br>
                        <p><a href="my_account.php?edit_account">Edit Acount</a></p><br>
                        <p><a href="my_account.php?change_pass">Change Password</a></p><br>
                        <p><a href="my_account.php?delete_account">Delete account</a></p><br>
                    </div>

                </div>
            </div>
        </div>

<footer id="footer" class="negative">
    <div class="wrapper">

        <div class="footerBlock">
            <h3>Consectetur adipisi</h3>
            <p class="bold">Lorem ipsum dolor consectetur adipisicing elit. Doloribus.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, optio, dolore, quibusdam molestiae voluptate cupiditate hic itaque mollitia deserunt maxime assumenda beatae illo delectus earum nisi voluptatibus iure dolor minima culpa enim expedita voluptas quod quis quia iste harum ducimus magni ad ipsam modi.</p>
        </div>
        <div class="footerBlock">
            <h3>Delectus earum nisi</h3>
            <p class="bold">Natus, excepturi, suscipit, voluptates quam veniam repudiandae nemo debitis qui illum</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, optio, dolore, quibusdam molestiae voluptate cupiditate hic itaque mollitia deserunt maxime assumenda beatae illo delectus earum nisi voluptatibus iure dolor minima culpa enim expedita voluptas quod quis quia iste harum ducimus magni ad ipsam modi.</p>
        </div>
          <div class="wrapper" id="footerBottom">
        <a href="#top" class="button">back to top</a>


    </div>
     <p class="copyright">Copyright @ ivana// <a href="#">
    </div>


</footer>
<!--jquery lightbox -->
<script src="../js/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
    <script>
        lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'fadeDuration':1000,
        'positionFromTop':100
        })
    </script>
    <?php
    cart();
    ?>

    <script src="../js/nav.js" charset="utf-8"></script>
    </body>
    </html>
