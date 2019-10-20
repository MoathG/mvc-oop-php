<?php
include('../layout/header.php');
include('../../Database/Database.php');
include('../../model/Product.php');

$db = new Database();
$conn = $db->conn();

$product = new Product($conn);
$products = $product->getAll();

if(isset($_POST['delete'])) {
    $product->deleteProduct($conn, $_POST['delete_id']);
    $products = $product->getAll();
}

?>

<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Created</th>
            <th scope="col">Modified</th>
            <th scope="col">Category</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($products as $col) {
                    $id = $col['id'];
                    $name = $col['name'];
                    $description = $col['description'];
                    $price = $col['price'];
                    $created = $col['created'];
                    $modified = $col['modified'];
                    $category_id = $col['category'];

                    echo "
                        <tr>
                            <th scope='row'> $id </th>
                            <td> $name </td>
                            <td> $description </td>
                            <td> $price </td>
                            <td> $created </td>
                            <td> $modified </td>
                            <td> $category_id </td>
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='delete_id' value='$id'>
                                    <button type='submit' name='delete' class='btn btn-danger'> Delete </button>                                
                                </form>
                            </td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</div>
