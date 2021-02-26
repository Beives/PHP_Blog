<?php 
include('includes/header.php');
$post = getPostById($_GET['post_id']);
$comments=getCommentsByPostId($_GET['post_id']);
if ($_GET['post_id'] == 0)
    header("LOCATION: index.php");
?>
        <div class="row">
            <div class="col-md-8">
                <h1><?php echo $post['post_title'] ?></h1>
                <p class="lead">
                    by <a href="#"><?php echo $post['post_author'] ?></a>
                </p>
                <hr>
                <p>Posted on <?php echo $post['post_date'] ?></p>
                <hr>
                <img class="img-fluid" <?php echo 'src="data:image/jpg;base64,'.base64_encode( $post['post_img'] ).'"' ?> >
                <hr>
                <p><?php echo $post['post_content'] ?></p>
                <hr>

                <!-- Comments Form -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Leave a Comment:</h4>
                        <?php if (isset($_SESSION['user_id'])) {?>
                            <form action="../controllers/controllers.php" method="POST">
                            <input type="hidden" name="userId" value="<?php echo $_SESSION['user_id']?>">
                            <input type="hidden" name="postId" value="<?php echo $_GET['post_id'] ?>">
                            <input type="hidden" name="postComments" value="<?php echo $post['post_comments'] ?>">
                            <div class="form-group">
                                <label for="commentContent">Comment:</label>
                                <textarea class="form-control" name="commentContent" rows="3"></textarea>
                            </div>
                            <button type="submit" name="submitComment" class="btn btn-primary">Submit</button>
                        </form>
                        <?php }else{?>
                            <h5>Please log in to leave a comment</h5>
                        <?php } ?>
                    </div>
                </div>

                <hr>
                <?php 
                foreach ($comments as $comment) { 
                    $user = getUserById($comment['comment_author'])?>                
                    <!-- Comment -->
                    <div class="media row">
                        <img class="col-3 align-self-start mr-3" <?php echo 'src="data:image/jpg;base64,'.base64_encode( $user['user_image'] ).'"' ?>>
                        <div class="media-body col">
                            <h4 ><?php echo $user['user_firstname']." ".$user['user_lastname'] ?>
                                <small><?php echo $comment['comment_date'] ?></small>
                            </h4>
                            <?php echo $comment['comment_content'] ?>
                        </div>
                    </div>
                    <hr>
                <?php } ?>

            </div> <!-- col-md-8 -->
<?php include('includes/sidebar.php') ?>
</div>
<?php include('includes/footer.php') ?>