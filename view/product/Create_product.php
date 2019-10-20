<?php

include('../layout/header.php');
include('../../Database/Database.php');
include('../../model/Category.php');

$db = new Database();
$conn = $db->conn();

$category = new Category($conn);
$categories = $category->getAll();

$new_post = "";

include('../../model/Product.php');

if(isset($_POST['submit'])) {
    $product = new Product($conn);
    $product->setName($_POST['name']);
    $product->setPrice($_POST['price']);
    $product->setDescription($_POST['description']);
    $product->setCategoryId($_POST['categories']);
    $new_post = $product->create();
}


?>
<div class="container m-5">

    <h2> Add New Product </h2>
    <?php
    if($new_post != "") {
        if($new_post) {
            echo "<div class='alert alert-success'> Product was created </div>";
        } else {
            echo "<div class='alert alert-warning'> Unable to create a new product. </div>";
        }
    }
    ?>

    <form method="post" action='<?php $_SERVER['PHP_SELF']; ?>'>
        <div class="form-group">
            <label for="exampleFormControlInput1">name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="insert your name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">description</label>
            <input name="description" type="text" class="form-control" id="exampleFormControlInput1" placeholder="...">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">price</label>
            <input name="price" type="text" class="form-control" id="exampleFormControlInput1" placeholder="how much ?">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select name="categories" class="form-control" id="exampleFormControlSelect1">
                <option selected> category </option>
                <?php
                foreach ($categories as $col) {
                    $id = $col['id'];
                    $name = $col['name'];

                    echo "<option value='$id' class='text-capitalize'> $name </option>";
                }
                ?>
            </select>
        </div>
        <div>
            <button class="btn btn-primary" name="submit" type="submit"> Submit </button>
        </div>
    </form>
</div>

<?php include('../layout/footer.php'); ?>


