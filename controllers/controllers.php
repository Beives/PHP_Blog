<?php 
include('database.php');
session_start();
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
    $tags = "{$_POST['postAuthor']},{$_POST['postTags']},{$_POST['postTitle']}";
    $query= "INSERT INTO post (post_title,post_author,post_date,post_img,post_content,post_tags,post_comments,post_category_id) VALUES
    ('{$_POST['postTitle']}','{$_POST['postAuthor']}','{$_POST['postDate']}','$image','{$_POST['postContent']}','{$tags}','0','{$_POST['selectCategory']}')";
    mysqli_query($conn,$query);
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
    $query .= " WHERE post_id={$_POST['postId']}";
    mysqli_query($conn,$query);
    header('LOCATION: ../admin/posts.php');
}

//comments
if(isset($_POST['submitComment'])){
    $date = date('Y-m-d H:i:s');
    $comments = $_POST['postComments']+1;
    $query = "INSERT INTO comments (commented_post, comment_date,comment_author,comment_content)
              VALUES ('{$_POST['postId']}','$date','{$_POST['userId']}','{$_POST['commentContent']}')";
    mysqli_query($conn,$query);
    $postCommentsQuery = "UPDATE post SET post_comments='{$comments}' WHERE post_id={$_POST['postId']}";
    mysqli_query($conn,$postCommentsQuery);
    header("LOCATION: ../users/post.php?post_id=".$_POST['postId']);
}

//users
if(isset($_POST['registerUser'])){
    $username = mysqli_real_escape_string($conn,$_POST['register_username']);
    $firstname = mysqli_real_escape_string($conn,$_POST['register_firstname']);
    $lastname = mysqli_real_escape_string($conn,$_POST['register_lastname']);
    $password = mysqli_real_escape_string($conn,$_POST['register_password']);
    $re_password = mysqli_real_escape_string($conn,$_POST['register_password_again']);
    $email = mysqli_real_escape_string($conn,$_POST['register_email']);

    if ($password !== $re_password) {
        header("LOCATION: ../users/user.php?userPage=register&passerror=true");
    }else{
        $hashedpassword= password_hash($password,PASSWORD_DEFAULT);

        $urlimage = file_get_contents("https://st3.depositphotos.com/4111759/13425/v/600/depositphotos_134255626-stock-illustration-avatar-male-profile-gray-person.jpg");
        $image = mysqli_real_escape_string($conn,$urlimage);

        if (!empty($_FILES['register_image']['tmp_name'])) {
            $image= addslashes(file_get_contents($_FILES['register_image']['tmp_name']));
        }
        $query = "INSERT INTO users (username,user_firstname,user_lastname,user_password,user_image,user_email,user_role) VALUES
        ('{$username}',
        '{$firstname}',
        '{$lastname}',
        '{$hashedpassword}',
        '{$image}',
        '{$email}',
        'user')";
        mysqli_query($conn,$query);
        if ($err = mysqli_error($conn)) 
            echo $query,$err;
        else
            header("LOCATION: ../users/");
    }
}
if(isset($_POST['editUserSubmit'])){

    $username = mysqli_real_escape_string($conn,$_POST['user_update_username']);
    $firstname = mysqli_real_escape_string($conn,$_POST['user_update_firstname']);
    $lastname = mysqli_real_escape_string($conn,$_POST['user_update_lastname']);
    $email = mysqli_real_escape_string($conn,$_POST['user_update_email']);
    $password = mysqli_real_escape_string($conn,$_POST['user_update_password']);
    $re_password = mysqli_real_escape_string($conn,$_POST['user_update_password_again']);

    $query = "UPDATE users SET
    username='{$username}',
    user_firstname='{$firstname}',
    user_lastname='{$lastname}',
    user_email='{$email}'";

    if (!empty($_FILES['user_update_image']['tmp_name'])) {
        $image= addslashes(file_get_contents($_FILES['user_update_image']['tmp_name']));
        $query .= ", user_image='{$image}'";
    }
    if ($password != $re_password) {
        if ($_POST['location'] == "admin") 
            header("LOCATION: ../admin/users.php?editUserId=7&passerror=true");
        else if($_POST['location'] == "users")
            header("LOCATION:../users/user.php?userPage=editProfile&passerror=true");
        else if($_POST['location'] == "admin_profile")
            header("LOCATION:../admin/profile.php?profilePage=editProfile&passerror=true");
    }else if(!empty($_POST['user_update_password'])){
        $hashedpass=password_hash($_POST['user_update_password'],PASSWORD_DEFAULT);
        $query .= ", user_password='{$hashedpass}'";
    }

    $query .= " WHERE user_id = {$_POST['user_id']}";

    mysqli_query($conn,$query);

    if ($_POST['location'] == 'admin') 
        header("LOCATION:../admin/users.php");
    else if($_POST['location'] == "users")
        header("LOCATION:../users/user.php?userPage=profile");
    
}
if (isset($_POST['submitLogin'])) {
    $username = mysqli_real_escape_string($conn,$_POST['loginName']);
    $password = mysqli_real_escape_string($conn,$_POST['loginPass']);

    $query = "SELECT * FROM users WHERE username='{$username}'";
    $select_result = mysqli_query($conn,$query);

    if (mysqli_num_rows($select_result) == 0) {
        header("LOCATION: ../users/index.php?namefail=true");
    }else{
        $row = mysqli_fetch_array($select_result);
        if (!password_verify($password,$row['user_password']))
            header("LOCATION: ../users/index.php?passfail=true");
        else{
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_role'] = $row['user_role'];
            $_SESSION['name'] = $row['user_firstname'].' '.$row['user_lastname'];
            $_SESSION['user_id'] = $row['user_id'];
            header("LOCATION: ../users/index.php");
        }
    }
}
if (isset($_POST['logoutSubmit'])) {
    session_destroy();
    header("LOCATION: ../users/index.php");
}
?>