<?php 
include "includes/db.php";
include "includes/header.php";
?>



    <!-- Navigation -->
<?php 
include "includes/navigation.php";
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php    
            $perpage = 5;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page =1;
            } 
            if($page =="" || $page==1){
                $page_1 = 0;
            } else {
                $page_1 = ($page * $perpage) - $perpage;
            }

            $post_query_count = "SELECT * FROM posts";
            $find_count =mysqli_query($connection,$post_query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count/5) ;

            $query1 = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1, $perpage;";
            $select_all_posts_query = mysqli_query($connection, $query1);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,100);
                    $post_status = $row['post_status'];

                    if($post_status !== 'published'){
                        echo "";
                        
                    } else  {
                    ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h1><?php echo $count; ?></h1>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>                    
                <?php
                } }
                ?>



             

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php 
            include "includes/sidebar.php";
            ?>

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
                <?php
                $block_cnt = 5;
                $block_num = ceil($page/$block_cnt);
                $block_start = (($block_num-1)*$block_cnt)+1;
                $block_end = $block_start + $block_cnt -1;

                if($block_end > $count){
                    $block_end = $count;
                }
                $total_block = ceil($count/$block_cnt);
                
                if($page <=1){
                    echo "";
                } else {
                    echo "<li><a href='index.php?page=1'>??????</a></li>";
                }
                if($page <=1){
                    echo "";
                } else {
                    $pre = $page -1;
                    echo "<li><a href='index.php?page=$pre'>??????</a></li>";
                }

                for($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";    
                    } else {
                        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }

                if($page >= $count){
                    echo "";

                } else {
                    $next = $page +1;
                    echo "<li><a href='index.php?page={$next}'>??????</a></li>";
                }
                if($page >= $count){
                    echo "";

                } else {
                    $next = $count;
                    echo "<li><a href='index.php?page={$count}'>?????????</a></li>";
                }
                /*
                for($i = 1; $i<=$count ; $i++){

                    if($i == $page) {
                        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";    
                    } else {
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
            */
                ?>
        </ul>
<?php 
include "includes/footer.php";
?>

