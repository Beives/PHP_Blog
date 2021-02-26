<?php
include('includes/header.php');
deleteUser("users");
deleteComment("users");
$currentPage = $_GET['userPage'];

switch ($currentPage) {
    case 'profile':
        $user = getUserById($_SESSION['user_id']); 
        $comments = getCommentsByUser($_SESSION['user_id']);?>
        <div class="row">
            <div class="col-sm-5">
                <img class="img-fluid" <?php echo 'src="data:image/jpg;base64,'.base64_encode( $user['user_image'] ).'"' ?> >
            </div>
            <div class="col-sm-7 my-auto">
                <h3 class="col-sm-6 mx-auto">User details</h3>
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <td>Username</td>
                            <td>Name</td>
                            <td>Email</td>
                        </tr>
                        <tr>
                            <td><?php echo $user['username'] ?></td>
                            <td><?php echo $user['user_firstname']." ".$user['user_lastname']?></td>
                            <td><?php echo $user['user_email'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="row justify-content-center">
                    <a onclick="javascript:return confirm('Are you sure?');"  class="col-sm-4 btn btn-danger" href="?deleteUserId=<?php echo $_SESSION['user_id']?>">Delete profile</a>
                    <a class="col-sm-4 ml-3 btn btn-warning" href="?userPage=editProfile">Edit profile</a>
                </div>
            </div>
        </div>
        <hr>
        <?php if (!empty($comments)) { ?>
            <div class="row">
                <h4>Your comments</h4>
            </div>
            <div class="row">
                <table class="table">
                <thead>
                    <tr>
                        <th>Commented post</th>
                        <th>Comment date</th>
                        <th>Comment content</th>
                        <th>Delete comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($comments as $comment){
                                $post = getPostById($comment['commented_post'])?>
                        <tr>
                            <td><?php echo $post['post_title'] ?></td>
                            <td><?php echo $comment['comment_date'] ?></td>
                            <td><?php echo $comment['comment_content'] ?></td>
                            <td><a class='btn btn-danger' href="?deleteCommentId=<?php echo $comment['comment_id']?>&affectedPost=<?php echo $post['post_id'] ?>&userId=<?php echo $_SESSION['user_id']?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
        <?php } ?>
    <?php break;
    case 'editProfile': 
    $user = getUserById($_SESSION['user_id'])?>
    <div class="row mx-auto justify-content-center">
            <div class="col-md-11">
                <form action="../controllers/controllers.php" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_GET['passerror'])){ ?>
                        <p class="text-danger">Passwords must match!</p>
                    <?php } ?>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                    <input type="hidden" name="location" value="users">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="user_update_email">Email</label>
                            <input value="<?php echo $user['user_email'] ?>" type="email" class="form-control" name="user_update_email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_update_firstname">First name</label>
                            <input value="<?php echo $user['user_firstname'] ?>" type="text" class="form-control" name="user_update_firstname" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_update_lastname">Last name</label>
                            <input value="<?php echo $user['user_lastname'] ?>" type="text" class="form-control" name="user_update_lastname" required>
                        </div>
                        
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-3">
                            <label for="user_update_username">Username</label>
                            <input value="<?php echo $user['username'] ?>" type="text" class="form-control" name="user_update_username" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_update_password">Password</label>
                            <input placeholder="Password, if you want to change it" type="password" class="form-control" name="user_update_password">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="user_update_password_again">Password again</label>
                            <input placeholder="Password again" type="password" class="form-control" name="user_update_password_again">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3">
                            <img class="img-fluid" <?php echo 'src="data:image/jpg;base64,'.base64_encode( $user['user_image'] ).'"' ?> >
                        </div>
                        <div class="form-group col-9 custom-file">
                            <input type="file" class="custom-file-input" name="user_update_image">
                            <label class="custom-file-label" for="user_update_image">Choose profile pic</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <input class="btn btn-primary btn-lg mx-auto" type="submit" value="Edit" name="editUserSubmit">
                    </div>
                </form>
            </div>
        </div>
    <?php break;
    case 'register': ?>
        <div class="row mx-auto justify-content-center">
            <div class="col-md-10">
                <form action="../controllers/controllers.php" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_GET['passerror'])){ ?>
                        <p class="text-danger">Passwords must match!</p>
                    <?php } ?>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="register_username">Username</label>
                            <input placeholder="donjoe" type="text" class="form-control" name="register_username" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="register_firstname">First name</label>
                            <input placeholder="John" type="text" class="form-control" name="register_firstname" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="register_lastname">Last name</label>
                            <input placeholder="Doe" type="text" class="form-control" name="register_lastname" required>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="register_password">Password</label>
                            <input placeholder="Password" type="password" class="form-control" name="register_password" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="register_email">Email</label>
                            <input placeholder="Email@email.com" type="email" class="form-control" name="register_email" required>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <input placeholder="Password again" type="password" class="form-control" name="register_password_again" required>
                        </div>
                        <div class="form-group col-md-7 custom-file">
                            <input type="file" class="custom-file-input" name="register_image">
                            <label class="custom-file-label" for="register_image">Choose profile pic</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <input class="btn btn-primary btn-lg mx-auto" type="submit" value="Register" name="registerUser">
                    </div>
                </form>
            </div>
        </div>
    <?php break;
    default:
        header("LOCATION: index.php");
        break;
}
?>

        
<?php include('includes/footer.php') ?>