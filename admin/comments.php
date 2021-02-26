<?php 
    include('includes/header.php');
    deleteComment("admin");
?>
<div class="col-xl-11 bg-light">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Commented post title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>          
            <?php 
                $comments = getComments();
                foreach ($comments as $comm) {
            ?>
            <tr>
                <td><?php echo $comm['comment_id']?></td>
                <td>
                <a href="../users/post.php?post_id=<?php echo $comm['commented_post']?>">
                <?php 
                    $post = getPostById($comm['commented_post']);
                    echo $post['post_title'];
                ?>
                </a>
                </td>
                <td><?php echo $comm['comment_author']?></td>
                <td><?php echo $comm['comment_date']?></td>
                <td><?php echo $comm['comment_content']?></td>
                <td><a onclick="javascript:return confirm('Are you sure?');" class="btn btn-danger" href="?affectedPost=<?php echo $post['post_id']?>&deleteCommentId=<?php echo $comm['comment_id'] ?>">Delete</a></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
    
<?php include('includes/footer.php')?>