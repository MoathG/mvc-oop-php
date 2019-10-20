<?php
    include('../layout/header.php');
    include('../../Database/Database.php');
    include('../../model/Category.php');

    $db = new Database();
    $conn = $db->conn();

    $category = new Category($conn);
    $categories = $category->getAll();

    if(isset($_POST['delete'])) {

        $category->deleteCategory($conn, $_POST['delete-category']);
        $categories = $category->getAll();

    }
?>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col"> Id </th>
                <th scope="col"> Name </th>
                <th scope="col"> Created </th>
                <th scope="col"> Modified </th>
                <th scope="col"> Delete </th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($categories as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $created = $row['created'];
                    $modified = $row['modified'];

                    echo "
                        <tr>
                                <td> $id </td>
                                <td> $name </td>
                                <td> $created </td>
                                <td> $modified </td>
                                <td>
                                    <form method='post'>
                                        <input type='hidden' name='id_to_delete' value='$id'>
                                        <button type='submit' name='delete-category' value='Delete' class='btn btn-brand z-depth-0'>X</button>
                                    </form>
                                </td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>

<?php include('../layout/footer.php'); ?>
