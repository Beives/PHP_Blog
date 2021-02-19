<?php 

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

function getPosts(){
    global $conn;
    $query = "SELECT * FROM post";
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

function deletePost(){
    global $conn;
    if (isset($_GET['deletePostId'])) {
        $deleteQuery="DELETE FROM post WHERE post_id=".$_GET['deletePostId'];
        mysqli_query($conn,$deleteQuery);
        header("LOCATION: ../admin/posts.php");
    }
}
?>