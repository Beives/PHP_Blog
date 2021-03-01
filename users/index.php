<?php include('includes/header.php') ?>

    <!-- Page Content -->
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php 

            $paginationLimit = 5;
            if (isset($_GET['pagination'])) 
                $page = ($_GET['pagination'] * $paginationLimit)-$paginationLimit;
            else if (!isset($_GET['pagination']) || $_GET['pagination'] == 1)
                $page = 0;

            if (isset($_GET['postSearch']) && $_GET['postSearch'] != '')
                $ordered_post = getSearchedPosts();
            elseif (isset($_GET['category'])) 
                $ordered_post = getPostByCategory($_GET['category']);
            elseif(isset($_GET['author']))
                $ordered_post = getPostByAuthor($_GET['author']);
            else
                $ordered_post = getPostOrdered($page, $paginationLimit);

            foreach ($ordered_post as $row) {
                if ($row['post_id'] != 9999999) {
            ?>
                <h2>
                    <a href="post.php?post_id=<?php echo $row['post_id']?>"><?php echo $row['post_title'] ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php?author=<?php echo $row['post_author'] ?>"><?php echo $row['post_author'] ?></a>
                </p>
                <p> Posted on <?php echo $row['post_date'] ?></p>
                <hr>
                <img class="img-fluid" <?php echo 'src="data:image/jpg;base64,'.base64_encode( $row['post_img'] ).'"'?> >
                <hr>
                <p><?php echo substr($row['post_content'],0,75) ?>...</p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $row['post_id']?>">Read More</a>
                <hr><hr>
            <?php 
                }//if 
                else{
                    ?> 
                    <hr>
                    <img class="img-fluid" <?php echo 'src="data:image/jpg;base64,'.base64_encode( $row['post_img'] ).'"'?> >
                    <hr>
                    <p><?php echo $row['post_content'] ?></p>
                    <hr>
                    <a href="index.php" class="btn btn-primary">Return to main page</a>
                    <?php
                }
            } //foreach
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if(isset($_GET['pagination']) && $_GET['pagination'] > 1){?> 
                        <li class="page-item">
                            <a class="page-link" href="index.php?pagination=<?php echo $_GET['pagination']-1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php for($i = 1; $i <= ceil(countPosts() / $paginationLimit); $i++ ){ ?>
                        <li class="page-item"><a class="page-link" href="index.php?pagination=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                    
                    <?php if(isset($_GET['pagination']) && $_GET['pagination'] < ceil(countPosts() / $paginationLimit)){?> 
                        <li class="page-item">
                        <a class="page-link" href="index.php?pagination=<?php echo $_GET['pagination']+1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
            </div><!-- col-md-8 -->
        
<?php include('includes/sidebar.php') ?>
</div>
<?php include('includes/footer.php') ?>