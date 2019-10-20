<?php
include('../layout/header.php');
include('../../Database/Database.php');
include('../../model/Category.php');
include('../../model/Product.php');

$db = new Database();
$conn = $db->conn();

$product = new Product($conn);
//$products = $product->getAll();

$category = new Category($conn);
$categories = $category->getAll();

$id = "";
$name = "";
$description = "";
$price = "";
$category_id = "";
$error = null;

if(isset($_POST['edit-Prod-now'])) {
    $product_id = $_POST['product-id'];
    $product_to_edit = $product->getOne($product_id);

    $id = $product_to_edit['id'];
    $name = $product_to_edit['name'];
    $description = $product_to_edit['description'];
    $price = $product_to_edit['price'];
    $category_id = $product_to_edit['category_id'];
}

if (isset($_POST['edit-Prod'])) {
    echo "product updated";
    $name = $_POST['name'];
    $id = $_POST['id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    $product->setName($_POST[$name]);
    $product->setDescription($_POST[$description]);
    $product->setPrice($_POST[$price]);
    $product->setCategoryId($category_id);
    $product->editProd($id);
}



?>

<div class="container">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <label for="name"> Name </label>
            <input value="<?php echo $name ?>" type="text" name="name" class="form-control" id="name" value="<?php $product['name'] ?>">
        </div>
        <div class="form-group">
            <label for="description"> Description </label>
            <input type="text" name="description" class="form-control" id="description"
                   value="<?php $product['description'] ?>">
        </div>
        <div class="form-group">
            <label for="price"> Price </label>
            <input type="text" name="price" class="form-control" id="price" value="<?php $product['price'] ?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select name="categories" class="form-control" id="exampleFormControlSelect1">
                <option selected> category</option>
                <?php
                foreach ($categories as $col) {
                    $id = $col['id'];
                    $name = $col['name'];

                    echo "<option value='$id' class='text-capitalize'> $name </option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="edit-Prod" class="btn btn-primary"> Edit</button>
    </form>
</div>