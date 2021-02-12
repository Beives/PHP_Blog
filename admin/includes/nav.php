

        <!-- Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="index.php">Navbar</a>

            <!-- Top Menu Items -->
            <ul class="nav justify-content-end">

                <li class="nav-item dropdown btn btn-secondary">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>
                    <div class="dropdown-menu">
                        
                        <a href="#"  class="dropdown-item">Profile</a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <a href="#"  class="dropdown-item"> Log Out</a>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="row">

            <div class="col-lg-1">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link btn btn-secondary" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Dashboard</a>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuPosts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Posts
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuPosts">
                            <a class="dropdown-item" href="#">View all posts</a>
                            <a class="dropdown-item" href="#">New post</a>
                        </div>
                    </div>

                    <a class="nav-link btn btn-secondary" href="categories.php" aria-selected="false">Categories</a>
                    <a class="nav-link btn btn-secondary" id="v-pills-settings-tab"  href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Comments</a>

                    <div class="dropdown">
                        <button class="nav-link btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuUsers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Posts
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuUsers">
                            <a class="dropdown-item" href="#">View all posts</a>
                            <a class="dropdown-item" href="#">New post</a>
                        </div>
                    </div>

                    <a class="nav-link btn btn-secondary" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Profile</a>
                </div>
            </div>