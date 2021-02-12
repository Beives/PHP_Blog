<?php 
    include('includes/header.php');
    include('includes/functions.php');
?>

<div class="col-xl-11 bg-light">
    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="card text-center">
                    <div class="card-header">Add new category</div>
                    <div class="card-body">
                        <form action="includes/controllers.php" method="post">
                            <div class="form-group">
                                <label for="cat_name">Category title</label>
                                <input type="text" class="form-control" name="cat_name">
                            </div>
                            <button type="submit" name="uploadSubmit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        
        
            <div class="card">
                <div class="card text-center">
                    <div class="card-header">Edit category</div>
                    <div class="card-body">
                        <form action="includes/controllers.php" method="post">
                            <div class="form-group">
                                <label for="cat_name">Category title</label>
                                <?php 
                                    if (isset($_GET['edit'])) {
                                        $editQuery = "SELECT * FROM categories WHERE cat_id=".$_GET['edit'];
                                        $result = mysqli_query($conn, $editQuery);
                                        $row = mysqli_fetch_assoc($result);
                                ?>
                                    <input type="hidden" name="updateId" value="<?php echo $row['cat_id'] ?>">
                                    <input value="<?php echo$row['cat_title'] ?>" type="text" class="form-control" name="cat_update_name">
                                <?php }else{ ?>
                                    <input type="text" class="form-control" name="cat_update_name">
                                <?php } ?>
                            </div>
                            <button type="submit" name="updateSubmit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

<?php 
    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn,$query);
    DeleteCategories();
?>

        <div class="col-sm-7">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td scope="col">ID</td>
                        <td scope="col">Title</td>
                        <td scope="col">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['cat_id'] ?></td>
                        <td><?php echo $row['cat_title'] ?></td>
                        <td>
                            <a class="btn btn-danger" href="?deleteid=<?php echo $row['cat_id'] ?>">Delete</a>
                            <a class="btn btn-warning" href="?edit=<?php echo $row['cat_id'] ?>">Edit</a>
                        </td>
                    </tr> 
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
<?php include('includes/footer.php')?>