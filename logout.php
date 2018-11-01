<?php
include_once "functions/functions.php";
include "config.php";
$ip=getIp();
$conn=Database::getInstance();
$conn->exec(" delete from cart where ip_add='$ip'");
echo "<script>window.open('index.php','_self')</script>";
session_start();

session_destroy();

?>