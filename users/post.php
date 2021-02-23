<?php 
include('includes/header.php');
$post = getPostById($_GET['post_id']);
if ($_GET['post_id'] == 9999999)
    header("LOCATION: index.php");
?>
        <div class="row">
            <div class="col-md-8">
                <h1><?php echo $post['post_title'] ?></h1>

                <!-- Author -->
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
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                </div>

                <hr>

                <!-- Comment -->
                <div class="media">
                    <img class="align-self-start mr-3" src="http://placehold.it/64x64" alt="">
                    <div class="media-body">
                        <h4 >Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <img class="align-self-start mr-3" src="http://placehold.it/64x64" alt="">
                    <div class="media-body">
                        <h4>Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media mt-3">
                            <img class="align-self-center mr-3" src="http://placehold.it/64x64" alt="">
                            <div class="media-body">
                                <h4>Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

<?php include('includes/sidebar.php') ?>
<?php include('includes/footer.php') ?>