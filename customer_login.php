<div class="checkout-login">
    <div class="wrapper">
        <form method="post" action="">
            <table>
                <tr>
                    <td colspan="3"><h4>Login or Register to Buy!</h4></td>
                </tr>
                <tr>
                    <td><b>Email:</b></td>
                    <td><input type="text" name="email" placeholder="enter email" required/></td>
                </tr>
                <tr>
                    <td><b>Password:</b></td>
                    <td><input type="password" name="pass" placeholder="enter password" required/></td>
                </tr>
                <tr>
                    <td colspan="2"><a href="checkout.php?forgot_pass">Forgot Password?</a></td>
                </tr>
                <tr>
                    <td><input class="button" type="submit" name="login" value="Login"/></td>
                    <td><a class="button" href="customer_register.php">New Register Here</a></td>
                </tr>
            </table>
            <h2></h2>
        </form>
    </div>
</div>
<?php
if (isset($_POST['login'])) {

    $c_email = $_POST['email'];
    $c_pass = $_POST['pass'];

    $sel_c = Customer_Reg::getAll(" where customer_pass='$c_pass' and customer_email='$c_email'");
    print_r($sel_c);
    if ($sel_c == []) {
        echo "<script>alert('Password or email is incorect, please try again!!')</script>";
        exit();
    }
    $ip = getIp();
    $sel_cart = Cart::getAll(" where ip_add='$ip'");
    if (count($sel_c) > 0 and count($sel_cart) == 0) {
        $_SESSION['customer_email'] = $c_email;

        echo "<script>alert('Acount has been created successfully')</script>";
        echo "<script>window.open('customer/my_account.php','_self')</script>";
    } else {
        $_SESSION['customer_email'] = $c_email;

        echo "<script>alert('You logged in successfully, Thanks!')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";


    }

}
?>
