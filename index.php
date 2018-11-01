<?php
require "includes/header.php";
?>
<article id="hero" class="negative">
    <div class="wrapper">
        <div class="back">
            <h1>IGRA STAKLENIH PERLI</h1>
            <p>Sapiente excepturi aspernatur sed cupiditate ducimus</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla, possimus, beatae, temporibus provident
                veritatis iste laboriosam perferendis.</p>
            <p><a href="#about" class="button">Learn more &raquo;</a></p>
        </div>
    </div>
</article>
<section id="products">
    <div class="wrapper">
        <h2>Category</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, esse, fugit, autem, ratione quam doloremque
            impedit sunt unde repellat ipsum architecto quod itaque ab omnis laudantium modi fugiat accusamus?
            Explicabo, tempore, est, rerum recusandae at architecto quas cum officiis quaerat accusamus laudantium
            totam ratione ducimus assumenda omnis laboriosam consectetur velit unde tempora necessitatibus aut harum
            enim quibusdam sequi dignissimos vitae vero distinctio ipsum minus neque! Mollitia, quae, quod, nam
            dolorem sequi iste nobis optio ipsam iusto soluta accusantium corporis tenetur et necessitatibus odit
            officia consequatur accusamus culpa minima nisi atque quibusdam delectus veritatis aliquam tempore sunt
            quidem maxime quas officiis.</p>
            <div class="product-front">
        <?php
        $categories = Category::getAll();
    
        foreach ($categories as $category) {
            ?>
            <article class="product"><span> <i class="fa fa-paper-plane"></i> </span>
                <h2><?php echo $category->name_cat; ?></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, quidem ipsum deserunt.</p>
                <p><a href="<?php echo "products.php?cid=" . $category->id; ?>" class="button">Learn more
                        &raquo;</a></p>
            </article>
            <?php
        }
        ?>
         </div>
    </div>
</section>
<a name="about"></a>
<article id="about" class="negative">
    <div class="wrapper">
        <div class="aboutback">
            <h2>About us and our company</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, iure, laboriosam laudantium cumque fuga
                ab autem nihil quis optio quaerat veniam quo illum ratione accusamus sequi deserunt distinctio enim
                quidem officiis saepe ullam nesciunt facilis ipsam accusantium nisi velit iste nostrum eveniet ipsa hic?
                Numquam, aut, quisquam, alias cumque est deleniti eligendi ex animi minima ipsa eos aliquid explicabo
                officia. Rerum, corrupti deleniti suscipit omnis optio inventore modi iusto tempora quis aliquam
                aspernatur consectetur hic ducimus aliquid id accusamus labore maiores nobis autem incidunt. Recusandae,
                doloremque, praesentium, cumque, possimus reprehenderit maxime omnis saepe ipsum vel dolores mollitia
                porro eligendi corrupti.</p>
            <p><a href="about.html" class="button">Learn more &raquo;</a></p>
        </div>
    </div>
</article>
<section id="new_products">
    <div class="wrapper">
        <h2>New in store</h2>
        <div class="product-new-wrap">
        <?php
        $products = Products::getAll(" order by id desc limit 0,3");

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

                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        
        </div>
    </div>
</section>
<?php
require "includes/footer.php";
?>
     
