<?php
function getIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}

function cart()
{
    if (isset($_GET['add_cart'])) {
        $ip = getIp();
        $pro_id = $_GET['add_cart'];
        //$pro_qty = $_POST['qty'];
        $checkPro = Cart::getAll(" where ip_add='$ip' and p_id='$pro_id'");
        if (count($checkPro) > 0) {
            /*
            $selectedProdact = new Cart();
            $selectedProdact->p_id = $pro_id;
            $selectedProdact->ip_add = $ip;
            $qty = $selectedProdact->qty = $pro_qty;
            $selectedProdact->update();
            print_r($selectedProdact);
            if ($pro_qty <= 0) {
                $deleteProduct = new Cart();
                $deleteProduct->delete($pro_id);*/

        } else {
            $selectedProd = new Cart();
            $selectedProd->p_id = $_GET['add_cart'];
            $selectedProd->ip_add = $ip;
            //$selectedProd->qty = $_POST['qty'];
            $selectedProd->save();
            echo "<script>window.open('cart.php','_self')</script>";

        }
    }
}


function total_items()
{
    if (isset($_POST['add_cart'])) {
        $ip = getIp();
        $get_items = Cart::getAll(" where ip_add='$ip'");
        $count_items = count($get_items);
    } else {
        $ip = getIp();
        $get_items = Cart::getAll(" where ip_add='$ip'");
        $count_items = count($get_items);
    }
    echo $count_items;
}

function total_price()
{
    $total = 0;
    $ip = getIp();
    $sel_price = Cart::getAll(" where ip_add='$ip'");
    foreach ($sel_price as $p_price) {
        $pro_id = $p_price->p_id;
        $pro_qty = $p_price->qty;

        $pro_price = Products::getAll(" where id='$pro_id'");
        foreach ($pro_price as $pp_price) {
            $sum = $pp_price->price * $pro_qty . "<br>";
            $product_price = array($sum);
            $values = array_sum($product_price);
            $total += $values;
        }
    }
    echo "$" . $total;
}

function getCat()
{
    $category = Category::getAll();
    foreach ($category as $cat) {
        echo "<a  href='products.php?cid=" . $cat->id . "'>{$cat->name_cat}</a>";
    }
}

function getProd()
{
    $id = isset($_GET['cid']) && is_numeric($_GET['cid']) ? $_GET['cid'] : '1';
    $products = Products::getAll("where cat_id= $id");


    foreach ($products as $prodact) {
        ?>
        <div class="artikl">
            <div class="artikl_hidden">
                <div class="details">
                    <a href="buy.php?mid=<?php echo $prodact->id; ?>">
                        <h4>Details...</h4></a>
                </div>
                <img src="<?php echo "images/" . $prodact->image; ?>" alt='Picture'></div>
            <?php if ($prodact->in_stock == 0) {
                echo "<h4>Sold out!</h4>";
            } else {
                ?>

                <h5><?php echo "Cena: " . $prodact->price ?></h5>
                <p><?php echo $prodact->descr; ?></p>

                <a class='button' href="cart.php?add_cart=<?php echo $prodact->id; ?>">Add to cart</a>

                <?php
            }
            ?>
        </div>
        <?php
    }


}

function getProBuy()
{
    $id = isset($_GET['mid']) && is_numeric($_GET['mid']) ? $_GET['mid'] : 0;
    $product = Products::get($id);
    $cart = Cart::getAll(" where p_id='$id'");
    foreach ($cart as $qty) {
         $_SESSION['qty'] = $qty->qty;
    }

    ?>

    <div class="buy-main">
        <div class="buy-image">
            <a href="<?php echo "images/" . $product->image; ?>"
               data-lightbox="<?php echo "images/" . $product->price; ?>" data-title=""><img
                        src="<?php echo "images/" . $product->image; ?>" alt='Image'></a></div>
        <div class="buy-desc">
            <h4>Price: <?php echo $product->price ?></h4>
            <p>Description: <?php echo $product->descr ?></p>
            <p><?php if ($product->in_stock == 0) {
                    echo "Sold out!";
                } else {
                    ?>
                    <a class="button" href="products.php?add_cart=<?php echo $product->id; ?>">Add to cart</a>
                    <?php
                }
                ?>
            </p>
            <input class="button2" type="button" value="Back" onclick="history.back(-1)"/>

        </div>
    </div>
    <?php

}




