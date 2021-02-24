<?php 

//categories
function DeleteCategories(){
    global $conn;
    if (isset($_GET['deleteid'])) {
        $deleteQuery = "DELETE FROM categories WHERE cat_id=".$_GET['deleteid'];
        mysqli_query($conn,$deleteQuery);
        header('LOCATION: ../admin/categories.php');
    }
}
function getCategories(){
    global $conn;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn,$query);
    $categories=array();
    while($row = mysqli_fetch_array($result)){
        array_push($categories, $row);
    }
    return $categories;
}
function getCategoryById($id){
    global $conn;
    $cat_query = "SELECT cat_title FROM categories WHERE cat_id=".$id;
    $cat_result = mysqli_query($conn,$cat_query);
    return mysqli_fetch_array($cat_result);
}

//posts
function getPosts(){
    global $conn;
    $query = "SELECT * FROM post WHERE post_id NOT IN (0)";
    $result = mysqli_query($conn,$query);
    $posts = array();
    while($row = mysqli_fetch_array($result)){
        array_push($posts,$row);
    }
    return $posts;
}
function getPostById($id){
    global $conn;
    $query = "SELECT * FROM post WHERE post_id=".$id;
    $result = mysqli_query($conn,$query);
    return mysqli_fetch_array($result);
}
function getSearchedPosts(){
    global $conn;
    $query = "SELECT * FROM post WHERE post_tags LIKE '%{$_GET['postSearch']}%' ORDER BY post_date DESC";
    $result = mysqli_query($conn, $query);
    $posts = array();
    if(mysqli_num_rows($result) == 0 || $_GET['postSearch'] == " "){
        $nullQuery = "SELECT * FROM post WHERE post_id = 0";
        $nullResult = mysqli_query($conn,$nullQuery);
        array_push($posts,mysqli_fetch_array($nullResult));
        return $posts;
    }else{
        while ($row = mysqli_fetch_array($result)) {
            array_push($posts,$row);
        }
        return $posts;
    }
}
function getPostOrdered(){
    global $conn;
    $query = "SELECT * FROM post WHERE post_id NOT IN (0) ORDER BY post_date DESC";
    $result = mysqli_query($conn, $query);
    $posts= array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($posts,$row);
    }
    return $posts;
}
function getPostByAuthor($author){
    global $conn;
    $query = "SELECT * FROM post WHERE post_author LIKE '%{$author}%' ORDER BY post_date DESC";
    $result = mysqli_query($conn,$query);
    $posts = array();
    if(mysqli_num_rows($result) == 0){
        $nullQuery = "SELECT * FROM post WHERE post_id = 0";
        $nullResult = mysqli_query($conn,$nullQuery);
        array_push($posts,mysqli_fetch_array($nullResult));
        return $posts;
    }else{
        while ($row = mysqli_fetch_array($result)) {
            array_push($posts,$row);
        }
        return $posts;
    }
}
function getPostByCategory($category){
    global $conn;
    $query = "SELECT * FROM post WHERE post_category_id=".$category;
    $result = mysqli_query($conn,$query);
    $posts = array();
    if(mysqli_num_rows($result) == 0){
        $nullQuery = "SELECT * FROM post WHERE post_id = 0";
        $nullResult = mysqli_query($conn,$nullQuery);
        array_push($posts,mysqli_fetch_array($nullResult));
        return $posts;
    }else{
        while ($row = mysqli_fetch_array($result)) {
            array_push($posts,$row);
        }
        return $posts;
    }
}
function deletePost(){
    global $conn;
    if (isset($_GET['deletePostId'])) {
        $deleteQuery="DELETE FROM post WHERE post_id=".$_GET['deletePostId'];
        mysqli_query($conn,$deleteQuery);
        header("LOCATION: ../admin/posts.php");
    }
}
//comments
function deleteComment(){
    global $conn;
    if (isset($_GET['deleteCommentId'])) {
        $deleteQuery="DELETE FROM comments WHERE comment_id=".$_GET['deleteCommentId'];
        mysqli_query($conn,$deleteQuery);
        $result = mysqli_query($conn, "SELECT post_comments FROM post WHERE post_id={$_GET['affectedPost']}");
        $row = mysqli_fetch_array($result);
        $affectedPostComments = $row['post_comments'] - 1;
        $updatePostComments = mysqli_query($conn, "UPDATE post SET post_comments='{$affectedPostComments}' WHERE post_id={$_GET['affectedPost']}");
        header("LOCATION: ../admin/comments.php");
    }
}
function getComments(){
    global $conn;
    $query = "SELECT * FROM comments";
    $result = mysqli_query($conn,$query);
    $comments = array();
    while($row = mysqli_fetch_array($result)){
        array_push($comments,$row);
    }
    return $comments;
}
function getCommentsByPostId($postId){
    global $conn;
    $query = "SELECT * FROM comments WHERE commented_post={$postId}";
    $result = mysqli_query($conn,$query);
    $comments=array();
    
    while ($row = mysqli_fetch_array($result)) {
        array_push($comments,$row);
    }
    return $comments;

}
?>