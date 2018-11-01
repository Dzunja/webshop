
<table>
    <tr>
        <td>Prodact image:</td>
        <td>Prodact price:</td>
        <td>Quantity:</td>
        <td>Order date:</td>
    </tr>
<?php
$user=$_SESSION['customer_email'];
$get_customer=Customer_Reg::getAll(" where customer_email='$user'");

foreach($get_customer as $customer) {
    $customer_id = $customer->customer_id;

    $ip = getIp();

    $get_orders = Orders::getAll(" where c_id='$customer_id'");
    foreach ($get_orders as $geto) {
        $get_qty = $geto->qty;
        $get_order_date = $geto->order_date;
        $get_p_id=$geto->p_id;


        $get_prodact = Products::getAll("where id='$get_p_id'");
        foreach ($get_prodact as $prodact) {
            $prodact_price = $prodact->price;
            $prodact_image = $prodact->image;

            ?>

            <tr>
                <td><img src="../images/<?php echo $prodact_image; ?>" width="70px" height="60px"></td>
                <td><?php echo $prodact_price; ?></td>
                <td><?php echo $get_qty; ?></td>
                <td><?php echo $get_order_date; ?></td>
            </tr>

            <?php

        }
    }
}

?>
</table>

