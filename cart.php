<?php
require "includes/header.php";
cart();
?>
<div class="wrap-card">
    <div class="wrapper">
    <input class="button2" type="button" value="Back" onclick="history.back(-1)"/>
    <?php
    $total = 0;
    $ip = getIp();
    $sel_price = Cart::getAll(" where ip_add='$ip'");
    foreach ($sel_price as $p_price) {
        $pro_id = $p_price->p_id;
        $pro_qty = $p_price->qty;
        $_SESSION['qty'] = $pro_qty;
        $pro_price = Products::getAll(" where id='$pro_id'");
     foreach ($pro_price as $pp_price) {

        ?>

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>

            <?php



            $product_desc = $pp_price->descr;
            $product_image = $pp_price->image;
            $product_in_stock = $pp_price->in_stock;
            $single_price = $pp_price->price;// * $pro_qty;
            $product_price = array($single_price);
            $values = array_sum($product_price);
            $total += $values;

            ?>

            <tr>
                <td>

                    <?php echo $product_desc; ?><br><input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
                    <img src="images/<?php echo $product_image; ?>" width="60" height="60">
                </td>
                <td>
                    <input type="number" name="qty" value="<?php echo $_SESSION['qty']; ?>">
                </td>

                <td><?php echo "$" . $single_price; ?></td>
                <td class="delete"><input class="button2" type="submit" name="deleteProduct" value="Delete prodacts"></td>
                <td class="update">
                    <input class="button2" type="submit" name="updateQty" value="Update Quantity">
                </td>
                <?php
                if (isset($_POST['updateQty'])) {
                    $ip = getIp();
                    $update_qty = new Cart();
                    $qty = $update_qty->qty = $_POST['qty'];
                    $update_qty->ip_add = $ip;
                    $update_qty->p_id = $_POST['pro_id'];
                    $update_qty->update();
                    $_SESSION['qty'] = $qty;
                    echo "<script>window.open('cart.php','_self')</script>";
                }
                ?>
            </tr>
        </table>
    </form>
    <?php
    }
    }

                ?>
            <tr>
                <td colspan="5"><h6>Sub Total: <?php echo  total_price() ."</h6>"; ?></td>
            </tr>
            <tr align="center"><td>
                   <a class="button" href="checkout.php"">Checkout</a>
                </td>
            </tr>
        </table>
    </div>
</div>

    <?php




        $ip=getIp();
        if(isset($_POST['deleteProduct'])) {
       			$pro_id=$_POST['pro_id'];
                $conn = Database::getInstance();
               $delete_product= $conn->exec("delete from cart where p_id ='$pro_id' and ip_add='$ip'");
                if ($delete_product) {
                    echo "<script>window.open('cart.php','_self')</script>";
                }
        }


    require "includes/footer.php";