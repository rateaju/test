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

            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];
            }
            $query1 = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
            $select_all_posts_query = mysqli_query($connection, $query1);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    All post by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr>                    
                <?php
                }
                ?>

                <!-- Blog Comments -->
                    <?php
                    if(isset($_POST['create_comment'])){
                        $the_post_id = $_GET['p_id'];

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                            
                            $create_comment_query = mysqli_query($connection,$query);
                            
                            if(!$create_comment_query) {
                                die('query failed' . mysqli_error($connection));
                            }
                            $query ="UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            $query .="WHERE post_id = $the_post_id ";
                            $update_comment_count = mysqli_query($connection,$query);
                        }else {
                            echo "<script>alert('Fields cannot be empty')</script>";
                        }
                    
                            
                        }



                    ?>
                <!-- Comments Form -->
                

                    
                
                <!-- Comment -->
                
                
            
                    
                
                

<div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">hi
                            <small></small>
                        </h4>
                        
                    </div>
                </div>

            </div>


             

        

            <!-- Blog Sidebar Widgets Column -->
            <?php 
            include "includes/sidebar.php";
            ?>

        </div>
        <!-- /.row -->

        <hr>
    </div>    
<?php 
include "includes/footer.php";
?>

