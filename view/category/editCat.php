<?php
    include('../layout/header.php');

?>

<div class="container">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <label for="name"> Name </label>
            <input type="text" name="name" class="form-control" id="name" value="">
        </div>

        <button type="submit" name="edit-cat" class="btn btn-primary" > Edit </button>
    </form>
</div>
