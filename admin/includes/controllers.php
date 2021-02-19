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

if(isset($_POST['newPostSubmit'])){
    $image = addslashes(file_get_contents($_FILES['postImage']['tmp_name']));
    $query= "INSERT INTO post (post_title,post_author,post_date,post_img,post_content,post_tags,post_comments,post_status,post_category_id) VALUES
    ('{$_POST['postTitle']}','{$_POST['postAuthor']}','{$_POST['postDate']}','$image','{$_POST['postContent']}','{$_POST['postTags']}','0','{$_POST['postStatus']}','{$_POST['selectCategory']}')";
    mysqli_query($conn,$query);
    if ($err= mysqli_error($conn)) {
        echo $err;
    }
    header('LOCATION: ../posts.php');
}

if(isset($_POST['editPostSubmit'])){
    $image = addslashes(file_get_contents($_FILES['postImage']['tmp_name']));
    $query= "UPDATE post SET 
    post_title='{$_POST['postTitle']}',
    post_author='{$_POST['postAuthor']}',
    post_date='{$_POST['postDate']}',
    post_content='{$_POST['postContent']}',
    post_tags='{$_POST['postTags']}',
    post_comments='{$_POST['postComments']}',
    post_status='{$_POST['postStatus']}',
    post_category_id= '{$_POST['selectCategory']}'";

    if (!empty($_FILES['postImage']['tmp_name'])) {
        $image= addslashes(file_get_contents($_FILES['postImage']['tmp_name']));
        $query .= ", post_img='{$image}'";
    }
    $query .= " WHERE post_id=".$_POST['postId'];
    mysqli_query($conn,$query);
    if ($err= mysqli_error($conn)) {
        echo $query;
        echo $err;
    }else
        header('LOCATION: ../posts.php');
}

?>
</body>
</html>



