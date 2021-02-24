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
                    <form action="../controllers/controllers.php" method="POST">
                        <input type="hidden" name="postId" value="<?php echo $_GET['post_id'] ?>">
                        <input type="hidden" name="postComments" value="<?php echo $post['post_comments'] ?>">
                        <div class="form-group">
                            <label for="commentAuthor">Your name</label>
                            <input type="text" class="form-control" name="commentAuthor"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="commentContent">Comment:</label>
                            <textarea class="form-control" name="commentContent" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submitComment" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                </div>

                <hr>
                <?php 
                foreach ($comments as $comment) { ?>                
                    <!-- Comment -->
                    <div class="media">
                        <img class="align-self-start mr-3" src="http://placehold.it/64x64" alt="">
                        <div class="media-body">
                            <h4 ><?php echo $comment['comment_author'] ?>
                                <small><?php echo $comment['comment_date'] ?></small>
                            </h4>
                            <?php echo $comment['comment_content'] ?>
                        </div>
                    </div>
                    <hr>
                <?php } ?>

            </div> <!-- col-md-8 -->

<?php include('includes/sidebar.php') ?>
<?php include('includes/footer.php') ?>