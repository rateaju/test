<?php

function escape($string){

global $connection;

return mysqli_real_escape_string($connection, trim($string));

}


function users_online(){


    if(isset($_GET['onlineusers'])){
        
    

    global $connection;

    if(!$connection){
        session_start();
        include("../includes/db.php");
    
    
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
    echo $count_user = mysqli_num_rows($users_online_query);
}
    
}


}
users_online();

function confirm($result){
    
    global $connection;

    if(!$result){
        die("failed ." . mysqli_error($connection));
    } 
    
    }

function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
         echo "This field should not be emppty";
        } else {
         $query = "INSERT INTO categories(cat_title) ";
         $query .= "VALUE('{$cat_title}') ";
         

         $create_category_query = mysqli_query($connection,$query);
        
         if(!$create_category_query) {
             die('query failed'.mysqli_error($connection));
         }
     
        }
     }
}


function findAllcategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories where cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("location: categories.php");
      }
}
?>