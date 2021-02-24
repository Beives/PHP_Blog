<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php 
include('database.php');

//categories
if (isset($_POST['updateSubmit'])) {
    $updateQuery = "UPDATE categories SET cat_title='{$_POST['cat_update_name']}' WHERE cat_id = {$_POST['updateId']}";
    mysqli_query($conn,$updateQuery);
    header('LOCATION: ../admin/categories.php');
}
if (isset($_POST['uploadSubmit'])) {
    $query = "INSERT INTO categories (cat_title) VALUES ('{$_POST['cat_name']}')";
    mysqli_query($conn,$query);
    header('LOCATION: ../admin/categories.php');
}

//posts
if(isset($_POST['newPostSubmit'])){
    $image = addslashes(file_get_contents($_FILES['postImage']['tmp_name']));
    $tags = "{$_POST['postAuthor']},{$_POST['postTags']},{$_POST['postTitle']}, {$_POST['selectCategory']}";
    $query= "INSERT INTO post (post_title,post_author,post_date,post_img,post_content,post_tags,post_comments,post_category_id) VALUES
    ('{$_POST['postTitle']}','{$_POST['postAuthor']}','{$_POST['postDate']}','$image','{$_POST['postContent']}','{$tags}','0','{$_POST['selectCategory']}')";
    mysqli_query($conn,$query);
    if ($err= mysqli_error($conn)) {
        echo $err;
    }
    header('LOCATION: ../admin/posts.php');
}
if(isset($_POST['editPostSubmit'])){
    $query= "UPDATE post SET 
    post_title='{$_POST['postTitle']}',
    post_author='{$_POST['postAuthor']}',
    post_date='{$_POST['postDate']}',
    post_content='{$_POST['postContent']}',
    post_tags='{$_POST['postTags']}',
    post_comments='{$_POST['postComments']}',
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
        header('LOCATION: ../admin/posts.php');
}

//comments
if(isset($_POST['submitComment'])){
    $date = date('Y-m-d H:i:s');
    $comments = $_POST['postComments']+1;
    $query = "INSERT INTO comments (commented_post, comment_date,comment_author,comment_content)
              VALUES ('{$_POST['postId']}','$date','{$_POST['commentAuthor']}','{$_POST['commentContent']}')";
    mysqli_query($conn,$query);
    $postCommentsQuery = "UPDATE post SET post_comments='{$comments}' WHERE post_id={$_POST['postId']}";
    mysqli_query($conn,$postCommentsQuery);
    header("LOCATION: ../users/post.php?post_id=".$_POST['postId']);
}
?>

</body>
</html>