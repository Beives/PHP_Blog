<?php include('includes/database.php') ?>
<?php include('includes/header.php') ?>

    <!-- Page Content -->
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 
            
            $query = "SELECT * FROM post ORDER BY post_id DESC";
            $result = mysqli_query($conn, $query);

            if (isset($_POST['search']) && $_POST['search'] != "") {
                $query = "SELECT * FROM post WHERE post_tags LIKE '%".$_POST['search']."%' ORDER BY post_id DESC";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) == 0){
                    echo "There is no such a post";
                }
            }

            while ($row = mysqli_fetch_assoc($result)) { ?>
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
            <?php } ?>

                

            </div>

<?php include('includes/sidebar.php') ?>
<?php include('includes/footer.php') ?>