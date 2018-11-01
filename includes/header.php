<?php
session_start();
require "config.php";
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="theme-color" content="#e84e1b">
<meta name="viewport" content="width=device-width">
<title>E-commerce</title>

<!--jquery cdn-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--angular cdn-->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link href="js/lightbox2-master/dist/css/lightbox.css" rel="stylesheet">
<!--font awasome-->
 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<!--google fonts -->
<link href="https://fonts.googleapis.com/css?family=Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
<!--css file-->
<link href="css/style.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
<link href="css/media-query.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">

</head>
<?php
include "functions/functions.php";
?>
<body>

<script>
  $(function() {
    $('a[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
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

<!--js navigation current page -->
<script src="js/nav_current_page.js"></script>
<a name="top"></a>
<header id="header">
  <div id="headerTop">
    <div class="wrapper">
      <div id="headerTopLeft"> <span><i class="fa fa-lg fa-phone"></i>&nbsp;&nbsp;&nbsp;162/211322</span> <span><i class="fa fa-lg fa-envelope-o"></i>&nbsp;&nbsp;&nbsp;info@jfdk.rs</span> </div>
      <div id="headerTopRight"> <a href="#" target="_blank"><i class="fa fa-lg fa-facebook-square"></i></a> <a href="#" target="_blank"><i class="fa fa-lg fa-twitter-square"></i></a> <a href="#" target="_blank"><i class="fa fa-lg fa-linkedin-square"></i></a> </div>
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
          <li><a href="index.php">HOME</a></li>
          <li><a href="products.php?cid=1">PRODUCTS</a></li>
          <li><a href="about.php">ABOUT US</a></li>
          <li><a href="contact.php">CONTACT</a></li>
          <li><a href="customer/my_account.php">My Account</a></li>
          <li><a href="cart.php">VIEW CART</a></li>
          <li>
           <?php
              if(!isset($_SESSION['customer_email'])){
                echo "<a href='checkout.php'>Login</a>";
                }else {
                echo "<a href='logout.php'>Logout</a>";
                }
           ?>
          </li>
        </ul>

   </nav>

    <div class="navprice">
       <span>Total items:  <?php total_items();?></span>
       <span>Total price: <?php total_price();?></span>
    </div>

      </div>
      <!-- end wrapper -->
  </div>
  <!-- end headerBottom -->
</header>
<!-- kraj #header -->
<?php

?>
