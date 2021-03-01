

        <!-- Navigation -->
        <nav class="navbar  navbar-dark bg-dark fixed-top">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="index.php">Navbar</a>

            <!-- Top Menu Items -->
            <ul class="nav justify-content-end">

                <li class="nav-item dropdown btn btn-secondary mx-1">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>
                    <div class="dropdown-menu">
                        
                        <a href="profile.php" class="dropdown-item">Profile</a>
                        
                        <div class="dropdown-divider"></div>
                        
                    <form action="../controllers/controllers.php" method="post">
                        <input class="dropdown-item" type="submit" value="Logout" name="logoutSubmit">
                    </form>
                    </div>
                </li>
                <li class="nav-item btn btn-secondary">
                    <a class="nav-link text-white " href="../users/index.php">Main page</a>
                </li>
            </ul>
        </nav>

        <div class="row">

            <div class="col-xl-1 p-1">
                <div class="nav flex-column">
                    <a class="nav-link btn btn-secondary mb-1" href="index.php">Dashboard</a>

                    <a class="nav-link btn btn-secondary mb-1" href="users.php">Users</a>

                    <a class="nav-link btn btn-secondary mb-1" href="categories.php">Categories</a>
                    <a class="nav-link btn btn-secondary mb-1" href="comments.php">Comments</a>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuUsers" data-toggle="dropdown" aria-haspopup="true">
                            Posts
                        </button>
                        <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuUsers">
                            <a class="dropdown-item text-center" href="posts.php">View all posts</a>
                            <a class="dropdown-item text-center" href="posts.php?source=new">New post</a>
                        </div>
                    </div>                    
                </div>
            </div>