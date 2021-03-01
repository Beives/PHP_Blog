<?php 
    include('includes/header.php');

    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
        deleteUser("admin");
        
    modifyRole();
    $users = getUsers();
?>

<div class="col-xl-11 bg-light">
<?php 
    if (isset($_GET['editUserId'])) {
        $users = getUserById($_GET['editUserId']);
        ?>
        <form action="../controllers/controllers.php" method="POST" enctype="multipart/form-data">
            <?php if (isset($_GET['passerror'])){ ?>
                <p class="text-danger">Passwords must match!</p>
            <?php } ?>
            <input type="hidden" name="user_id" value="<?php echo $users["user_id"] ?>">
            <input type="hidden" name="location" value="admin">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="user_update_username">Username</label>
                    <input value="<?php echo $users['username'] ?>" type="text" class="form-control" name="user_update_username" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="user_update_password">Password</label>
                    <input type="password" class="form-control" name="user_update_password">
                </div>
                <div class="form-group col-md-4">
                    <label for="user_update_password_again">Password again</label>
                    <input type="password" class="form-control" name="user_update_password_again">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="user_update_firstname">First name</label>
                    <input value="<?php echo $users['user_firstname'] ?>" type="text" class="form-control" name="user_update_firstname" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="user_update_lastname">Last name</label>
                    <input value="<?php echo $users['user_lastname'] ?>" type="text" class="form-control" name="user_update_lastname" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="user_update_email">Email</label>
                    <input value="<?php echo $users['user_email'] ?>" type="text" class="form-control" name="user_update_email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                <?php echo '<img class="img-fluid" src="data:image/jpg;base64,'.base64_encode( $users['user_image'] ).'"/>'; ?>
                </div>
                <div class="form-group col-sm-9 custom-file">
                    <input type="file" class="custom-file-input" name="user_update_image">
                    <label class="custom-file-label" for="user_update_image">Upload image</label>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Submit editing" name="editUserSubmit">
        </form>
        
        <?php 
    }else{
?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full name</th>
                <th>Profile pic</th>
                <th>Email</th>
                <th>User role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>          
            <?php 
                foreach ($users as $user) {
            ?>
            <tr>
                <td><?php echo $user['user_id']?></td>
                <td><?php echo $user['username']?></td>
                <td><?php echo $user['user_firstname']?> <?php echo $user['user_lastname']?></td>
                <td><?php echo '<img class="img-thumbnail" src="data:image/jpg;base64,'.base64_encode( $user['user_image'] ).'"/>'; ?></td>
                <td><?php echo $user['user_email']?></td>
                <td><?php echo $user['user_role']?></td>
                <td>
                <div class="row">
                    <a onclick="javascript:return confirm('Are you sure?');" class="btn btn-danger" href="?deleteUserId=<?php echo $user['user_id']?>">Delete</a> 
                    <a class="btn btn-warning" href="?editUserId=<?php echo $user['user_id']?>">Modify</a>
                </div>
                <div class="row">
                    <?php if ($user['user_role'] == "admin"){ ?>
                        <a onclick="javascript:return confirm('Are you sure?');" class="btn btn-danger" href="?removeAdmin=<?php echo $user['user_id']?>">Remove from admin</a>
                    <?php }else{?>
                        <a onclick="javascript:return confirm('Are you sure?');" class="btn btn-danger" href="?makeAdmin=<?php echo $user['user_id']?>">Make user admin</a>
                    <?php } ?>
                </div>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
<?php } ?>    
</div>
    
<?php include('includes/footer.php')?>