<?php include('includes/header.php') ?>

    <!-- Page Content -->
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 
            if (isset($_GET['postSearch']) && $_GET['postSearch'] != ''){
                $ordered_post = getSearchedPosts();
            }
            else
                $ordered_post = getPostOrdered();

            foreach ($ordered_post as $row) {
                if ($row['post_id'] != 9999999) {
                    
            ?>
                <h2>
                    <a href="#"><?php echo $row['post_title'] ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row['post_author'] ?></a>
                </p>
                <p> Posted on <?php echo $row['post_date'] ?></p>
                <hr>
                
                <img class="img-fluid" <?php echo 'src="data:image/jpg;base64,'.base64_encode( $row['post_img'] ).'"'?> >
                <hr>
                <p><?php echo $row['post_content'] ?></p>
                <a class="btn btn-primary" href="#">Read More</a>
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

                

            </div>

<?php include('includes/sidebar.php') ?>
<?php include('includes/footer.php') ?>