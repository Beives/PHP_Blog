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
function countCategories(){
    global $conn;
    $query = "SELECT COUNT(*) FROM categories";
    $result = mysqli_query($conn,$query);
    $count = mysqli_fetch_array($result);
    return $count[0];
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
function getPostOrdered($page, $pagination){
    global $conn;
    $query = "SELECT * FROM post WHERE post_id NOT IN (0) ORDER BY post_date DESC LIMIT {$page}, {$pagination}";
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
        $deleteQuery="DELETE FROM post WHERE post_id={$_GET['deletePostId']}";
        mysqli_query($conn,$deleteQuery);
        $deleteCommentsQuery = "DELETE FROM comments WHERE commented_post={$_GET['deletePostId']}";
        mysqli_query($conn,$deleteCommentsQuery);
        header("LOCATION: ../admin/posts.php");
    }
}
function countPosts(){
    global $conn;
    $query = "SELECT COUNT(*) FROM post";
    $result = mysqli_query($conn,$query);
    $count = mysqli_fetch_array($result);
    return $count[0] - 1;
}
//comments
function deleteComment($location){
    global $conn;
    if (isset($_GET['deleteCommentId'])) {
        $deleteQuery="DELETE FROM comments WHERE comment_id=".$_GET['deleteCommentId'];
        mysqli_query($conn,$deleteQuery);

        $result = mysqli_query($conn, "SELECT post_comments FROM post WHERE post_id={$_GET['affectedPost']}");
        $row = mysqli_fetch_array($result);
        $affectedPostComments = $row['post_comments'] - 1;
        $updatePostComments = mysqli_query($conn, "UPDATE post SET post_comments='{$affectedPostComments}' WHERE post_id={$_GET['affectedPost']}");

        if ($location == "admin") 
            header("LOCATION: ../admin/comments.php");
        else if($location == "users")
            header("LOCATION: ?userPage=profile&userId={$_GET['userId']}");
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
function getCommentsByUser($userId){
    global $conn;
    $query = "SELECT * FROM comments WHERE comment_author={$userId}";
    $result = mysqli_query($conn,$query);
    $comments=array();
    
    while ($row = mysqli_fetch_array($result)) {
        array_push($comments,$row);
    }
    return $comments;
}
function countComments(){
    global $conn;
    $query = "SELECT COUNT(*) FROM comments";
    $result = mysqli_query($conn,$query);
    $count = mysqli_fetch_array($result);
    return $count[0];
}

//users
function getUsers(){
    global $conn;
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn,$query);
    $users = array();
    while($row = mysqli_fetch_array($result)){
        array_push($users,$row);
    }
    return $users;
}
function getUserById($id){
    global $conn;
    $query = "SELECT * FROM users WHERE user_id=".$id;
    $result = mysqli_query($conn,$query);
    return mysqli_fetch_array($result);
}
function deleteUser($location){
    global $conn;
    if (isset($_GET['deleteUserId'])) {
        $deleteQuery="DELETE FROM users WHERE user_id=".$_GET['deleteUserId'];
        mysqli_query($conn,$deleteQuery);

        if ($location = "admin") 
            header("LOCATION: ../admin/users.php");
        else if($location = "users"){
            session_unset();
            session_destroy();
            header("LOCATION: ../users/");
        }
    }
}
function modifyRole(){
    global $conn;
    if (isset($_GET['removeAdmin'])) {
        $updateQuery = "UPDATE users SET user_role='user' WHERE user_id = {$_GET['removeAdmin']}";
        mysqli_query($conn,$updateQuery);
        header('LOCATION: ../admin/users.php');
    }
    else if (isset($_GET['makeAdmin'])) {
        $updateQuery = "UPDATE users SET user_role='admin' WHERE user_id = {$_GET['makeAdmin']}";
        mysqli_query($conn,$updateQuery);
        header('LOCATION: ../admin/users.php');
    }
}
function countUsers(){
    global $conn;
    $query = "SELECT COUNT(*) FROM users";
    $result = mysqli_query($conn,$query);
    $count = mysqli_fetch_array($result);
    return $count[0];
}
?>