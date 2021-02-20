<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <?php 
              $categories = getCategories();
              foreach ($categories as $value) {
               ?>
              <li class="nav-item active">
                <a class="nav-link" href="#"><?php echo $value['cat_title'] ?></a>
              </li>
              <?php
              }
              ?>
            </ul>
          </div>
    </nav>