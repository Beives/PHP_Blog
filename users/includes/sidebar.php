<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Blog Search</h4>
            <form action="index.php?" method="get">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <input type="submit" class="btn btn-outline-secondary" value="Search">
                    </div>
                        <input type="text" name="postSearch" class="form-control">
                </div>
            </form>
            </div>
            </div>

            <?php if (!isset($_SESSION['name'])) {?>
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Login</h4>

                    <?php
                        if (isset($_GET['namefail'])) {?> 
                            <p class="text-danger">Wrong username</p>
                    <?php } elseif(isset($_GET['passfail'])){?>
                            <p class="text-danger">Wrong password</p>
                    <?php } ?>

                        <form action="../controllers/controllers.php" method="post">
                            <div class="form-group">
                                <input type="text" name="loginName" class="form-control" placeholder="Username">                                
                                <input type="password" name="loginPass" class="form-control my-1" placeholder="Password">
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group">
                                    <input type="submit" name="submitLogin" class="col-xm-4 btn btn-outline-secondary" value="Login">
                                    <a class="col-xm-8 btn btn-outline-secondary" href="user.php?userPage=register">Registration</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }else { ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Welcome <?php echo $_SESSION['name'] ?></h5>
                        <hr>
                        <a href="user.php?userPage=profile">Profile</a>

                        <form action="../controllers/controllers.php" method="post">
                            <input class="btn btn-outline-secondary" type="submit" value="Logout" name="logoutSubmit">
                        </form>
                    </div>
                </div>
            <?php } ?>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Side Widget Well</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                    </div>
                </div>

            </div>