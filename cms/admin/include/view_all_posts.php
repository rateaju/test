<?php
if(isset($_POST['checkboxArray'])){
    foreach($_POST['checkboxArray'] as $postvalueid){
        
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options){
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' where post_id = {$postvalueid} ";
                $update_to_published_status = mysqli_query($connection,$query);
                break;
            
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' where post_id = {$postvalueid} ";
                $update_to_draft_status = mysqli_query($connection,$query);
                break;
            
                
            case 'delete':
                $query = "DELETE from posts where post_id = {$postvalueid} ";
                $delete_posts = mysqli_query($connection,$query);
                break;
            
            case 'clone':

                $query = "SELECT * FROM posts where post_id = '{$postvalueid}' ";
                $select_posts_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_posts_query)){
                    
                    
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_user = $row['post_user'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                 }
                 $query ="INSERT INTO posts(post_title, post_category_id, post_date, post_user, post_status, post_image, post_tags, post_content) ";
                 $query .="VALUES('{$post_title}', '{$post_category_id}', '{$post_date}', '{$post_user}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}') ";

                $copy_query = mysqli_query($connection, $query);

                if(!$copy_query){
                    die("Query failed" . mysqli_error($connection));
                }
                break;
        
        }
    }
}
?>

<form action="" method='post'>

<table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class ="col-xs-4" style= "padding:0px 5px 5px 0px">

    <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
    </select>
    </div>
    <div class="col-sx-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>
    </div>
                            <thead>
                                <tr>
                                    <th><input id="selectAllboxs" type="checkbox"></th>
                                    <th>ID</th>
                                    <th>Users</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tag</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>View Post</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>View Count</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <tr>
                                    <?php
                                        $prepage = 15;
                                        if(isset($_GET['p_page'])){
                                            $p_page = $_GET['p_page'];
                                            
                                        } else {
                                            $p_page = 1;

                                        }
                                        echo $p_page;

                                        if($p_page=="" || $p_page==1){
                                            $p_page1 = 0;
                                        } else{
                                            $p_page1 = ($p_page-1)*$prepage;
                                        }
                                        

                                        $viewpost_count_query = "SELECT * FROM posts ";
                                        $viewpost_allcount = mysqli_query($connection,$viewpost_count_query);
                                        $viewpost_count = mysqli_num_rows($viewpost_allcount);
                                        $viewpost_count = ceil($viewpost_count/15);
                                        
                                        



                                        $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $p_page1, $prepage";
                                        $select_posts = mysqli_query($connection, $query);
                                        while($row = mysqli_fetch_assoc($select_posts)){
                                            $post_id = $row['post_id'];
                                            $post_author = $row['post_author'];
                                            $post_user = $row['post_user'];
                                            $post_title = $row['post_title'];
                                            $post_category_id = $row['post_category_id'];
                                            $post_status = $row['post_status'];
                                            $post_image = $row['post_image'];
                                            $post_tags = $row['post_tags'];
                                            $post_comment_count = $row['post_comment_count'];
                                            $post_date = $row['post_date'];
                                            $post_views_count = $row['post_views_count'];
                                            
                                            echo "<tr>";?>




                                             <td><input value='<?php echo $post_id; ?>' name='checkboxArray[]' class='checkBoxes' type='checkbox'></td>
                                          
                                          
                                          <?php
                                            echo "<td>{$post_id}</td>";


                                            if(!empty($post_author)){
                                                echo "<td>{$post_author}</td>";
                                            } elseif((!empty($post_user))) {
                                                echo "<td>{$post_user}</td>";
                                            }
                                            
                                            echo "<td>{$post_title}</td>";
                                           
                                        
                                            $query = "SELECT * FROM categories where cat_id = $post_category_id ";
                                            $select_categories_id = mysqli_query($connection, $query);
                                            while($row = mysqli_fetch_assoc($select_categories_id)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                   


                                            
                                            echo "<td>{$cat_title}</td>";
                                            }
                                           
                                           
                                           
                                           
                                            echo "<td>{$post_status}</td>";
                                            echo "<td><img width=100 src='../images/$post_image' alt='image'></td>";
                                            echo "<td>{$post_tags}</td>";

                                            
                                            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                                            $send_comment_query = mysqli_query($connection, $query);
                                                                                                                                               

                                            
                                            $count_comments = mysqli_num_rows($send_comment_query);
                                            
                                            


                                            echo "<td><a href='post_comments.php?comment_id=$post_id'>{$count_comments}</a></td>";
                                            echo "<td>{$post_date}</td>";
                                            echo "<td><a href ='../post.php?p_id={$post_id}'>View Post</a></td>";
                                            echo "<td><a href ='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                                            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href ='posts.php?delete={$post_id}'>Delete</a></td>";
                                            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset');\" href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                                            echo "</tr>";
                                        }
                                            




                                    ?>
                                  
                                
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        if(isset($_GET['delete'])){
                            $the_post_id = $_GET['delete'];

                            $query ="DELETE FROM posts WHERE post_id = {$the_post_id} ";

                            $delete_query = mysqli_query($connection, $query);

                            header("location: posts.php");
                        }

                        if(isset($_GET['reset'])){
                            $the_post_id = $_GET['reset'];

                            $query ="UPDATE posts SET post_views_count = 0 where post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";

                            $reset_query = mysqli_query($connection, $query);

                            header("location: posts.php");
                        }
                        ?>
                        </form>
                        <hr>
                        <ul class="pager">
                        <?php


$block_cnt = 15;
$block_num = ceil($p_page/$block_cnt);
$block_start = (($block_num-1)*$block_cnt)+1;
$block_end = $block_start + $block_cnt -1;




if($block_end >= $viewpost_count){
    $block_end = $viewpost_count;
}

$total_block = ceil($viewpost_count/$block_cnt);





if($p_page <=1){
    echo "";
} else {
    echo "<li><a href='posts.php?p_page=1'>처음</a></li>";
}
if($p_page <=1){
    echo "";
} else {
    echo "<li><a href='posts.php?p_page=1'>이전</a></li>";
}
for($i = $block_start; $i <= $block_end; $i++){
    if($p_page == $i){
        echo "<li><a class='active_link' href='post.php?p_page={$i}'>{$i}</a></li>";    
    } else {
        echo "<li><a href='posts.php?p_page={$i}'>{$i}</a></li>";
    }
}

if($p_page >= $viewpost_count){
    echo "";

} else {
    $next = $p_page +1;
    echo "<li><a href='posts.php?p_page={$next}'>다음</a></li>";
}

if($p_page >= $viewpost_count){
    echo "";

} else {
    
    echo "<li><a href='posts.php?p_page={$viewpost_count}'>마지막</a></li>";
}
                        ?>
