<?php 
    include('includes/header.php');
?>
<div class="col-xl-11 bg-light">

<?php 
deletePost();
$source="";
if (isset($_GET['source'])) 
    $source= $_GET['source'];
    
switch ($source) {
    case 'new':
        $categories = getCategories();
    ?>
        <form action="../controllers/controllers.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="selectCategory">Select category</label>
                    <select name="selectCategory" class="form-control">
                        <?php foreach ($categories as $value) { ?>
                            <option value="<?php echo $value['cat_id'] ?>"><?php echo $value['cat_title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label for="postTitle">Post title</label>
                    <input type="text" class="form-control" name="postTitle" placeholder="Post title here">
                </div>
                <div class="form-group col-sm-4">
                    <label for="postAuthor">Post author</label>
                    <input type="text" class="form-control" name="postAuthor" placeholder="Post author name here">
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-sm-8">
                    <label for="postTags">Post tags</label>
                    <input type="text" class="form-control" name="postTags" placeholder="Post tags here">
                </div>
                <div class="form-group col-sm-4">
                    <label for="postDate">Pick post date</label>
                    <input value="<?php echo date("Y-m-d") ?>" type="date" name="postDate" max="3000-12-31" min="2010-01-01" class="form-control">
                </div>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="postImage">
                <label class="custom-file-label" for="postImage">Upload image</label>
            </div>
            <div class="form-group">
                <label for="postContent">Post content</label>
                <textarea class="form-control" name="postContent" rows="5"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" name="newPostSubmit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    <?php        
        break;
    case 'edit':
        $categories = getCategories();
        $post = getPostById($_GET['editId']);
        ?>
        <form action="../controllers/controllers.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="postId" value="<?php echo $post['post_id'] ?>" />
            <input type="hidden" name="postComments" value="<?php echo $post['post_comments'] ?>">
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="selectCategory">Select category</label>
                    <select name="selectCategory" class="form-control">
                        <?php foreach ($categories as $value) { ?>
                            <option value="<?php echo $value['cat_id'] ?>" 
                                <?php if ($value['cat_id'] == $post['post_category_id']) {
                                    echo 'selected="selected"';
                                }?>>
                                <?php echo $value['cat_title'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label for="postTitle">Post title</label>
                    <input value="<?php echo $post['post_title'] ?>" type="text" class="form-control" name="postTitle" placeholder="Post title here">
                </div>
                <div class="form-group col-sm-4">
                    <label for="postAuthor">Post author</label>
                    <input value="<?php echo $post['post_author'] ?>" type="text" class="form-control" name="postAuthor" placeholder="Post author name here">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-8">
                    <label for="postTags">Post tags</label>
                    <input value="<?php echo $post['post_tags'] ?>" type="text" class="form-control" name="postTags" placeholder="Post tags here">
                </div>
                <div class="form-group col-sm-4">
                    <label for="postDate">Pick post date</label>
                    <input value="<?php echo $post['post_date'] ?>" type="date" name="postDate" max="3000-12-31" min="2010-01-01" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-5">
                <?php echo '<img class="img-fluid" src="data:image/jpg;base64,'.base64_encode( $post['post_img'] ).'"/>'; ?>
                </div>
                <div class="form-group col-sm-7 custom-file">
                    <input type="file" class="custom-file-input" name="postImage">
                    <label class="custom-file-label" for="postImage">Upload image</label>
                </div>
            </div>
            <div class="form-group">
                <label for="postContent">Post content</label>
                <textarea class="form-control" name="postContent" rows="5"><?php echo $post['post_content'] ?></textarea>
            </div>
            <div class="text-center">
                <button type="submit" name="editPostSubmit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <?php
        break;
    default:
    ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $posts = getPosts();
                foreach ($posts as $row) {
                    $cat_row=getCategoryById($row['post_category_id']);
                ?>
                <tr>
                    <td><?php echo $row['post_id'] ?></td>
                    <td><?php echo $row['post_author'] ?></td>
                    <td><?php echo $row['post_title'] ?></td>
                    <td>
                        <?php 
                            echo $cat_row['cat_title'];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo '<img class="img-fluid" src="data:image/jpg;base64,'.base64_encode( $row['post_img'] ).'"/>';
                        ?> 
                    </td>
                    <td><?php echo $row['post_tags'] ?></td>
                    <td><?php echo $row['post_comments'] ?></td>
                    <td><?php echo $row['post_date'] ?></td>
                    <td>
                        <a onclick="javascript:return confirm('Are you sure?');" class="btn btn-danger" href="?deletePostId=<?php echo $row['post_id'] ?>">Delete</a>
                        <a class="btn btn-warning" href="?source=edit&editId=<?php echo $row['post_id'] ?>">Edit</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
        break;
    }
    ?>
</div>
    
<?php include('includes/footer.php')?>