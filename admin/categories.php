<?php include "index.php" ?>

<?php
require "../config.php";


$conn = Database::getInstance();

Session::start();
if (!Session::get("status_user") || Session::get("status_user") != 1) {
    header("location: index.html");
}
$selectedCategory = new Category();
if (isset($_GET['cid'])) {
    $selectedCategory = Category::get($_GET['cid']);
}

if (isset($_POST['btn_insert'])) {
    $selectedCategory = new Category();
    $name_cat = $selectedCategory->name_cat = $_POST['tb_name'];
    $conn = Database::getInstance();
    $selectedCategory->id = $conn->lastInsertId();
    $selectedCategory->save();
}

if (isset($_POST['btn_update'])) {
    $conn = Database::getInstance();
    $name_cat = $_POST['tb_name'];
    $get_id = $_GET['cid'];

    $q = "update categories set name_cat='$name_cat' where id='$get_id'";

    $res = $conn->exec($q);

}

if (isset($_POST['btn_delete'])) {
    $selectedCategory = Category::get($_POST['selcategory']);
    Category::delete($_POST['selcategory']);
}

?>
<div class="wrap-card ">
    <div class="wrapper wrap-admin">
        <form action="" method="post">

            <?php
            $allCategories = Category::getAll();

            ?>
            <select onchange="window.location='?cid=' +this.value" name="selcategory">
                <option value="-1">Category</option>
                <?php
                foreach ($allCategories as $cat) {
                    ?>
                    <option <?php echo ($selectedCategory->id == $cat->id) ? "selected" : ""; ?>
                            value="<?php echo $cat->id; ?>"><?php echo $cat->name_cat; ?></option>
                    <?php
                    echo $_POST['selcategory'];
                }
                ?>
            </select>
            <br><br>
            <label>Category name:</label><br>
                <input type="text" name="tb_name" value="<?php echo $selectedCategory->name_cat; ?>"><br>
            </label><br>
            <input class="button" type="submit" value="Add new" name="btn_insert">
            <input class="button" type="submit" value="Update" name="btn_update">
            <input class="button" type="submit" value="Delete" name="btn_delete">

        </form>
    </div>
</div>
<?php include "footer.php" ?>
