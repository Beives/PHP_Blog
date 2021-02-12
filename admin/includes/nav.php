

        <!-- Navigation -->
        <nav class="navbar  navbar-dark bg-dark fixed-top">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="index.php">Navbar</a>

            <!-- Top Menu Items -->
            <ul class="nav justify-content-end">

                <li class="nav-item dropdown btn btn-secondary">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>
                    <div class="dropdown-menu">
                        
                        <a href="#"  class="dropdown-item">Profile</a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <a href="#"  class="dropdown-item"> Log Out</a>
                    </div>
                </li>
                <li class="nav-item btn btn-secondary">
                    <a class="nav-link text-white " href="../users/">Main page</a>
                </li>
            </ul>
        </nav>

        <div class="row">

            <div class="col-xl-1">
                <div class="nav flex-column">
                    <a class="nav-link btn btn-secondary" href="#v-pills-home">Dashboard</a>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuPosts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Users
                        </button>
                        <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuPosts">
                            <a class="dropdown-item text-center" href="#">View all posts</a>
                            <a class="dropdown-item text-center" href="#">New post</a>
                        </div>
                    </div>

                    <a class="nav-link btn btn-secondary" href="categories.php">Categories</a>
                    <a class="nav-link btn btn-secondary" href="#v-pills-settings">Comments</a>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuUsers" data-toggle="dropdown" aria-haspopup="true">
                            Posts
                        </button>
                        <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuUsers">
                            <a class="dropdown-item text-center" href="viewposts.php">View all posts</a>
                            <a class="dropdown-item text-center" href="newpost.php">New post</a>
                        </div>
                    </div>

                    <a class="nav-link btn btn-secondary" href="#v-pills-settings">Profile</a>
                </div>
            </div>