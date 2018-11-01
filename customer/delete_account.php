<h4>Do you realy want to delete account!</h4>
<form action="" method="post">
    <input class="button2" type="submit" value="Yes I want" name="yes"><br>
    <input class="button2" type="submit" value="Not I do not want" name="no">
</form>

<?php
    if(isset($_SESSION['customer_email'])){
        $users = $_SESSION['customer_email'];
        if (isset($_POST['yes'])) {
            $delete_customer = "delete from customers where customer_email='$users'";
            $conn = Database::getInstance();
            $conn->exec($delete_customer);
            echo "<script>alert('We are really sorry, your account has been deleted!!')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
        }
        if(isset($_POST['no'])){
            echo "<script>window.open('my_account.php','_self')</script>";
        }
    }

?>