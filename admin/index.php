<?php include('includes/header.php')?>


<div class="col-xl-11 bg-light container-fluid">
    <div class="card-group">
        <div class="card bg-primary m-1">
            <div class="card-body text-white row">
                <div class="col-sm-9 h4">Posts:</div>
                <div class="col-sm-1 offset-sm-1 h3"><?php echo countPosts() ?></div>
            </div>
            <div class="card-footer bg-white text-primary">
                <a href="posts.php" class="text-primary">View details &rarr;</a>
            </div>
        </div>

        <div class="card bg-success m-1">
            <div class="card-body text-white row">
                <div class="col-9 h4">Comments:</div>
                <div class="col-1 offset-1 h3"><?php echo countComments() ?></div>
            </div>
            <div class="card-footer bg-white text-success">
                <a href="comments.php" class="text-success">View details &rarr;</a>
            </div>
        </div>

        <div class="card bg-warning m-1">
            <div class="card-body text-white row">
                <div class="col-sm-9 h4">Users:</div>
                <div class="col-1 offset-1 h3"><?php echo countUsers() ?></div>
            </div>
            <div class="card-footer bg-white text-warning">
                <a href="users.php" class="text-warning">View details &rarr;</a>
            </div>
        </div>

        <div class="card bg-danger m-1">
            <div class="card-body text-white row">
                <div class="col-9 h4">Categories:</div>
                <div class="col-1 offset-1 h3"><?php echo countCategories() ?></div>
            </div>
            <div class="card-footer bg-white text-danger">
                <a href="categories.php" class="text-danger">View details &rarr;</a>
            </div>
        </div>
    </div> <!-- cards-->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="row">
        <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
            ['Posts', <?php echo countPosts() ?>],
            ['Comments', <?php echo countComments() ?>],
            ['Users', <?php echo countUsers() ?>],
            ['Categories', <?php echo countCategories() ?>]
            ]);

            var options = {
            chart: {
                title: 'Blog counts',
                subtitle: 'Users, comments, posts and categories count visualized'
            }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        </script>
        
        <div id="columnchart_material" class="col-sm-12" style="height:500px;"> </div>

    </div>
</div>
    
<?php include('includes/footer.php')?>