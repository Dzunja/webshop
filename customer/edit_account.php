<?php

    $user=$_SESSION['customer_email'];

    $customers=Customer_Reg::getAll(" where customer_email='$user'");
    foreach($customers as $customer){
        $c_image=$customer->customer_image;
        $c_name=$customer->customer_name;
        $c_pass=$customer->customer_pass;
        $c_email=$customer->customer_email;
        $c_country=$customer->customer_country;
        $c_city=$customer->customer_city;
        $c_contact=$customer->customer_contact;
        $c_address=$customer->customer_address;
        $c_id=$customer->customer_id;
    }


?>


<div >

    <form action="" method="post" enctype="multipart/form-data">

        <table align="center" width="750">

            <tr align="center">
                <td colspan="6"><h4>Update your Account</h4></td>
            </tr>

            <tr>
                <td align="right" >Customer Name:</td>
                <td ><input type="text" name="c_name" value="<?php echo $c_name;?>"required/></td>
                <td></td>
                <input type="hidden" name="c_id" value="<?php echo $c_id;?>"
            </tr>

            <tr>
                <td align="right">Customer Email:</td>
                <td><input type="text" name="c_email" value="<?php echo $c_email;?>"required/></td>
                <td></td>
            </tr>

            <tr>
                <td align="right">Customer Password:</td>
                <td><input type="password" name="c_pass" value="<?php echo $c_pass;?>"required/></td>
                <td></td>
            </tr>

            <tr>
                <td align="right">Customer Image:</td>
                <td><input width="20" type="file" name="c_image" value="<?php echo $c_image; ?>"></td>
                   <td> <img src="customer_images/<?php echo $c_image;?>"></td>
            </tr>


            <tr>
                <td align="right">Customer Country:</td>
                <td>
                    <select name="c_country" disabled>
                        <option><?php echo $c_country;?></option>
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
                <td></td>
            </tr>

            <tr>
                <td align="right">Customer City:</td>
                <td><input type="text" name="c_city" value="<?php echo $c_city;?>"required/></td>
                <td></td>
            </tr>

            <tr>
                <td align="right">Customer Contact:</td>
                <td><input type="text" name="c_contact" value="<?php echo $c_contact; ?>"required/></td>
                <td></td>
            </tr>

            <tr>
                <td align="right">Customer Address</td>
                <td><input type="text" name="c_address" value="<?php echo $c_address;?>"required/></td>
                <td></td>
            </tr>


            <tr align="center">
                <td colspan="6"><input class="button" type="submit" name="update" value="Update Account"/></td>
            </tr>


        </table>

    </form>
</div>

<?php

if (isset($_POST['update'])) {
    $ip = getIp();
    $c_id=$_POST['c_id'];
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    $run_c = new Customer_Reg();
    $run_c->customer_ip = $ip;
    $run_c->customer_name = $c_name;
    $run_c->customer_email = $c_email;
    $run_c->customer_pass = $c_pass;
    $run_c->customer_city = $c_city;
    $run_c->customer_contact = $c_contact;
    $run_c->customer_address = $c_address;
    move_uploaded_file($c_image_tmp, "customer_images/$c_image");
    $run_c->customer_image = $c_image;
    $run_c->customer_id = $c_id;
    $run_c->update();

    $sel_cart = Cart::getAll(" where ip_add='$ip'");

    if ($sel_cat == []) {
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('Acount has been  successfully updated')</script>";
        echo "<script>window.open('my_account.php','_self')</script>";
    }
}
?>