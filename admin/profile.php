<?php 
include('includes/header.php');

if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
    deleteUser("admin");

$user = getUserById($_SESSION['user_id']);
$page = "";
if (isset($_GET['profilePage'])) {
    $page=$_GET['profilePage'];
}
?>


<div class="col-xl-11 bg-light">
    <?php switch ($page) {
        case 'editProfile': ?>
            <form action="../controllers/controllers.php" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_GET['passerror'])){ ?>
                        <p class="text-danger">Passwords must match!</p>
                    <?php } ?>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                    <input type="hidden" name="location" value="admin_profile">
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
    <?php   break;
        
        default: ?>
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
                    <a class="col-sm-4 ml-3 btn btn-warning" href="?profilePage=editProfile">Edit profile</a>
                </div>
            </div>
        </div>
    <?php    
    break;
    }?>
</div>
    
<?php include('includes/footer.php')?>