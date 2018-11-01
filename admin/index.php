<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link href="../css/style.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">

</head>
<body><?php
session_start();

if(!isset($_SESSION['status_user']) || $_SESSION['status_user'] != 1){
    header("location: index.html");
}
?>

<div class="admin-menu">
<a href="categories.php">Kategorije</a>
<a href="artikli.php">Artikli</a>
<a href="logout.php">Log out</a>
</div>

<?php include "footer.php" ?>



