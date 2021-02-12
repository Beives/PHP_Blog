<?php 
include('../../users/includes/database.php');
if (isset($_POST['updateSubmit'])) {
    $updateQuery = "UPDATE categories SET cat_title='{$_POST['cat_update_name']}' WHERE cat_id = {$_POST['updateId']}";
    mysqli_query($conn,$updateQuery);
    header('LOCATION: ../categories.php');
}

if (isset($_POST['uploadSubmit'])) {
    $query = "INSERT INTO categories (cat_title) VALUES ('".$_POST['cat_name']."')";
    mysqli_query($conn,$query);
    header('LOCATION: ../categories.php');
}

?>