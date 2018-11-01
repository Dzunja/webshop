<?php include "index.php" ?>


<?php
require "../config.php";

Session::start();
if (!Session::get("status_user") || Session::get("status_user") != 1) {
    header("location: index.html");
}
$selectedArtikl = new Artikli();

if (isset($_GET['art'])) {
    $selectedArtikl = Artikli::get($_GET['art']);
}

if (isset($_POST['btn_update'])) {
    $conn = Database::getInstance();
    $price = $_POST['tb_price'];
    $descr = $_POST['tb_desc'];
    $in_stock = $_POST['tb_in_stock'];

    if (isset($_FILES['fup_image']) && $_FILES['fup_image']['size'] > 0) {
        move_uploaded_file($_FILES['fup_image']['tmp_name'], "../images/" . $_FILES['fup_image']['name']);
        $image = $_FILES['fup_image']['name'];
    }
    $cat_id = $_POST['selcategory'];
    $art_id = $_GET['art'];
    $q = "update products set descr='$descr', price='$price',in_stock='$in_stock',image='$image',cat_id='$cat_id' where id='$art_id'";

    $conn->exec($q);
}

if (isset($_POST['btn_insert'])) {
    $selectedArtikl = new Artikli();
    $selectedArtikl->price = $_POST['tb_price'];
    $selectedArtikl->descr = $_POST['tb_desc'];
    $selectedArtikl->in_stock = $_POST['tb_in_stock'];

    if (isset($_FILES['fup_image']) && $_FILES['fup_image']['size'] > 0) {
        move_uploaded_file($_FILES['fup_image']['tmp_name'], "../images/" . $_FILES['fup_image']['name']);
        $selectedArtikl->image = $_FILES['fup_image']['name'];
    }
    $selectedArtikl->cat_id = $_POST['selcategory'];
    $conn = Database::getInstance();
    $selectedArtikl->id = $conn->lastInsertId();
    $selectedArtikl->save();
}

if (isset($_POST['btn_delete'])) {
    $selectedArtikl = new Artikli();
    $selectedArtikl->delete($_POST['selartikli']);
}
?>
<div class="wrap-admin">

<form action="" method="post" enctype="multipart/form-data" class="admin-wrap">
    <select name="selartikli" onchange="if(this.value<0)return;window.location='?art='+this.value">
        <option value="-1">Description</option>
        <?php
        $allArtikli = Artikli::getAll();
        foreach ($allArtikli as $art) {
            ?>
            <option <?php echo ($selectedArtikl->id == $art->id) ? "selected" : ""; ?>
                    value="<?php echo $art->id; ?>"><?php echo $art->descr ?></option>

            <?php
        }
        ?>
    </select><br><br>

    <select name="selcategory">
        <option value="-1">Choose category:</option>
        <?php
        $allCat = Category::getAll();
        foreach ($allCat as $cat) {
            ?>
            <option <?php echo ($selectedArtikl->id == $cat->id) ? "selected" : ""; ?>
                    value="<?php echo $cat->id; ?>"><?php echo $cat->name_cat; ?></option>

            <?php
        }
        ?>
    </select>
    <br>
    <label><br>Price:<br>
        <input type="text" name="tb_price" value="<?php echo $selectedArtikl->price; ?>">
    </label><br><br>
    <img src="<?php echo "../images/" . $selectedArtikl->image; ?>" width="93px" height="95px">
    <br><input type="file" name="fup_image"><br><br>
    <label>Description:<br>
        <input type="text" name="tb_desc" value="<?php echo $selectedArtikl->descr; ?>"><br>
    </label><br>
    <label>In stock:<br>
        <input type="text" name="tb_in_stock" value="<?= $selectedArtikl->in_stock; ?>"><br>
    </label>
    <input class="button" type="submit" value="Add new" name="btn_insert">
    <input class="button" type="submit" value="Update" name="btn_update">
    <input class="button" type="submit" value="Delete" name="btn_delete">
</form>
    
</div>
<?php include "footer.php" ?>


