<h2 class="text"></h2>
<?php
    $ip=getIp();
    $conn=Database::getInstance();
    $get_cart=Cart::getAll("where ip_add='$ip'");
    foreach($get_cart as $getc) {
        $get_p_id = $getc->p_id;
        $get_qty = $getc->qty;

        $user = $_SESSION['customer_email'];
        $get_all = Customer_Reg::getAll(" where customer_email='$user'");
        foreach ($get_all as $get) {
            $customer_id = $get->customer_id;
            $customer_name = $get->customer_name;
            $customer_email = $get->customer_email;
            $customer_address = $get->customer_address;
            $customer_city = $get->customer_city;
            $customer_contact = $get->customer_city;


            if (isset($_POST['Sent'])) {
                $q = "insert into orders values (null,$get_p_id,$customer_id,$get_qty,now())";
                $conn->exec($q);

            }
        }
    }

?>
<script>
    $(document).ready(function () {
        $('.sent').click(function () {
            alert("Orders has been send!Thanks!!");
        });
    });

</script>


<form action="" method="post">
<table>
    <tr>
        <td>Name</td>
        <td><?php echo $customer_name; ?></td>
    </tr>

    <tr>
        <td>Email:</td>
        <td><?php echo $customer_email; ?></td>
    </tr>

    <tr>
        <td>Address: </td>
        <td><?php echo $customer_address; ?></td>
    </tr>

    <tr>
        <td>City:</td>
        <td><?php echo $customer_city; ?></td>
    </tr>

    <tr>
        <td>Contact:</td>
        <td><?php echo $customer_contact; ?></td>
    </tr>
    <tr>
        <td><h6>Total:</h6></td>
        <td><h6><?php echo total_price();?></h6></td>
    </tr>

    <tr>
        <td colspan="2">
            <input type="checkbox" name="checkbox" required >I agree!!!
        </td>
    </tr>
    <tr>
        <td><a href="cart.php" class="button">Back to cart!!</a> </td>
        <td><input class="button sent" type="submit" value="Sent" name="Sent"> </td>
    </tr>
</table>

</form>
