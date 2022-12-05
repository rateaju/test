<?php include "include/admin_header.php"; ?>

    <div id="wrapper">





<!-- Navigation -->

<?php 
include "include/admin_navigation.php";
?>

<?php
$session =session_id();
$time = time();
$time_out_in_seconds = 30;
$time_out = $time - $time_out_in_seconds;
$query = "SELECT * FROM users_online WHERE session = '$session' ";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);

if($count == null){
    $query = "INSERT INTO users_online(session, time) VALUES ('$session', '$time')";
    mysqli_query($connection, $query);
} else {
    $query = "UPDATE users_online SET time = '$time' WHERE session = '$session' ";
    mysqli_query($connection, $query);
}

$query = "SELECT * FROM users_online WHERE time > '$time_out' ";
$users_online_query = mysqli_query($connection, $query);
 $count_user = mysqli_num_rows($users_online_query);

?>




        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            welcom to admin <?php echo $_SESSION['username']?>
                            <small><?php echo $_SESSION['username']?></small>
                        </h1>

                        <h1>
                       <?php 
                        echo $count_user;
                        echo $time_out
?>
                        </h1>
 
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                        <?php
                        $query = "SELECT * FROM posts";
                        $select_all_post = mysqli_query($connection,$query);
                        $post_count = mysqli_num_rows($select_all_post);

                        echo "<div class='huge'>{$post_count}</div>"
                        ?>
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM comments";
                        $select_all_comments = mysqli_query($connection,$query);
                        $comments_count = mysqli_num_rows($select_all_comments);

                        echo "<div class='huge'>{$comments_count}</div>"
                        ?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM users";
                        $select_all_users = mysqli_query($connection,$query);
                        $users_count = mysqli_num_rows($select_all_users);

                        echo "<div class='huge'>{$users_count}</div>"
                        ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                    $query = "SELECT * FROM Categories";
                        $select_all_Categories = mysqli_query($connection,$query);
                        $Categories_count = mysqli_num_rows($select_all_Categories);

                        echo "<div class='huge'>{$Categories_count}</div>"
                        ?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

                <?php
                $query = "SELECT * FROM posts where post_status = 'published' ";
                $select_all_published_post = mysqli_query($connection,$query);
                $post_published_count = mysqli_num_rows($select_all_published_post);
                
                $query = "SELECT * FROM comments where comment_status = 'unapproved' ";
                $unapproved_comments_query = mysqli_query($connection,$query);
                $unapproved_comments_count = mysqli_num_rows($unapproved_comments_query);

                $query = "SELECT * FROM users where user_role = 'subscriber' ";
                $select_all_subscribers = mysqli_query($connection,$query);
                $subscriber_count = mysqli_num_rows($select_all_subscribers);
                ?>

                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
          <?php
          $element_text = ['All Posts','Active Posts', 'Subscriber', 'Categories', 'pending Comments', 'Users', 'Coments'];
          $arraycount = count($element_text);
          //$element_count = [1,2,3,4];
          $element_count = [$post_count, $post_published_count, $subscriber_count, $Categories_count, $unapproved_comments_count, $users_count, $comments_count];
          
          for($i = 0;$i < $arraycount; $i++){
            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
          }
          ?>
          //['posts',1000],

        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>

        <?php 
include "include/admin_footer.php";
?>