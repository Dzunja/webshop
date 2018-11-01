<?php
require "includes/header.php";
// include "functions/functions.php";
?>
<div class="wrap-card">

<div class="checkout-login">
    <div class="wrapper">
    <form action="customer_register.php" method="post" enctype="multipart/form-data">

        <table align="center" width="750">

            <tr align="center">
                <td colspan="6"><h4>Create an Account</h4></td>
            </tr>

            <tr>
                <td align="right">Customer Name:</td>
                <td><input type="text" name="c_name" required/></td>
            </tr>

            <tr>
                <td align="right">Customer Email:</td>
                <td><input type="text" name="c_email" required/></td>
            </tr>

            <tr>
                <td align="right">Customer Password:</td>
                <td><input type="password" name="c_pass" required/></td>
            </tr>

            <tr>
                <td align="right">Customer Image:</td>
                <td><input type="file" name="c_image"></td>
            </tr>


            <tr>
                <td align="right">Customer Country:</td>
                <td>
                    <select name="c_country">
                        <option>Select a Country</option>
                        <option>Sebia</option>
                        <option>India</option>
                        <option>Japan</option>
                        <option>Pakistan</option>
                        <option>Israel</option>
                        <option>Nepal</option>
                        <option>United Arab Emirates</option>
                        <option>United States</option>
                        <option>United Kingdom</option>
                    </select>

                </td>
            </tr>

            <tr>
                <td align="right">Customer City:</td>
                <td><input type="text" name="c_city" required/></td>
            </tr>

            <tr>
                <td align="right">Customer Contact:</td>
                <td><input type="text" name="c_contact" required/></td>
            </tr>

            <tr>
                <td align="right">Customer Address</td>
                <td><input type="text" name="c_address" required/></td>
            </tr>


            <tr align="center">
                <td colspan="6"><input class="button" type="submit" name="register" value="Create Account"/></td>
            </tr>


        </table>

    </form>
    </div>
</div>
</div>
<?php
require "includes/footer.php";
?>
<?php

if (isset($_POST['register'])) {
    $ip = getIp();
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    $run_c = new Customer_Reg();
    $run_c->customer_ip = $ip;
    $run_c->customer_name = $c_name;
    $run_c->customer_email = $c_email;
    $run_c->customer_pass = $c_pass;
    $run_c->customer_country = $c_country;
    $run_c->customer_city = $c_city;
    $run_c->customer_contact = $c_contact;
    $run_c->customer_address = $c_address;
    move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");
    $conn = Database::getInstance();
    $run_c->customer_id = $conn->lastInsertId();
    $run_c->save();

    $sel_cart = Cart::getAll(" where ip_add='$ip'");

    if ($sel_cat == []) {
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('Acount has been created successfully')</script>";
        echo "<script>window.open('customer/my_account.php','_self')</script>";
    } else {
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('Acount has been created successfully')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }
}

?>


















