<?php 

function DeleteCategories(){
    global $conn;
    if (isset($_GET['deleteid'])) {
        $deleteQuery = "DELETE FROM categories WHERE cat_id=".$_GET['deleteid'];
        mysqli_query($conn,$deleteQuery);
        header('LOCATION: ../admin/categories.php');
    }
}

?>