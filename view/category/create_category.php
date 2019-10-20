<?php
    include('../layout/header.php');
    include('../../Database/Database.php');
    include('../../model/Category.php');

    $db = new Database();
    $conn = $db->conn();
?>

<?php

?>
    <h2> Add New Category </h2>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">New Category</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add category">
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </form>

<?php
    if(isset($_POST['submit'])) {
        $category = new Category($conn);
        $category->setName($_POST['name']);
        $new_category = $category->create();
    }
?>

<?php include('../layout/footer.php'); ?>