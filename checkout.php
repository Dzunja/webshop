<?php
require "includes/header.php";
?>
<?php
cart();
?>

<div class="wrap-card">
<div class="wrapper">
<?php
if(!isset($_SESSION['customer_email'])){

    include("customer_login.php");
}
else {

    include("payment.php");

}

?>
</div>
</div>
<?php
require "includes/footer.php";
?>





















