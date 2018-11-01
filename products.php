<?php
require "includes/header.php";
?>
<?php

cart();
?>
<article class="navproduct">
        <?php
        getCat();
        ?>
    </article>

<section id="wrproduct">
    <div class="wrapper">
        <article class="main">
            <?php
                getProd();
            ?>
        </article>
    </div>
</section>

<?php
require "includes/footer.php";
?>





















