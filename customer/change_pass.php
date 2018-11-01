<form action="" method="post">
    <table>
        <tr>
            <td colspan="2"><h4>Change your password</h4></td>
        </tr>
        <tr>
            <td>Enter current Password</td>
            <td>    <input type="password" name="current_pass" required><br>
            </td>
        </tr>
        <tr>
            <td>Enter new password</td>
            <td><input type="password" name="new_pass"><br></td>
        </tr>
        <tr>
            <td>Enter new password again</td>
            <td><input type="password" name="new_pass_again"></td>
        </tr>
        <tr>
            <td colspan="2"><input class="button" type="submit" name="change_pass" value="Change Password"></td>

        </tr>


    </table>
</form>

<?php
    if(isset($_POST['change_pass'])) {
        $user = $_SESSION['customer_email'];
        $current_pass = $_POST['current_pass'];
        $new_pass = $_POST['new_pass'];
        $new_again = $_POST['new_pass_again'];

        $sel_pass = Customer_Reg::getAll(" where customer_pass='$current_pass' and customer_email='$user' ");
        foreach($sel_pass as $sel){
            $sel_id=$sel->customer_id;
        }

        if (count($sel_pass) == 0) {
            echo "<script>alert('Your Current Password is wrong!')</script>";
        }

        if ($new_pass != $new_again) {
            echo "<script>alert('New password do not match!')</script>";
            exit();
        } else {
            $conn = Database::getInstance();
            $update_pass = " update customers set customer_pass='$new_pass' where customer_id='$sel_id' " ;
             $conn->exec($update_pass);
        }
    }
?>