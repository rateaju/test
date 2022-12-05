<?php
if(isset($_GET['edit_user'])){
    $the_user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_users_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_users_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
}


if(isset($_POST['edit_user'])){
    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    
    /*
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    */
    
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    //$post_date = date('d-m-y');
    //$post_comment_count = 4;

    //move_uploaded_file($post_image_temp, "../images/$post_image");
    /*
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";

    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";

    $create_user_query = mysqli_query($connection,$query);
*/
    //confirm($create_user_query);
    /*
    if(empty($post_image)){
        $query ="SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($connection,$query);
       
        while($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
            }
        }
*/
/*
$query ="SELECT randSalt From users";
$select_randsalt_query = mysqli_query($connection, $query);

if(!$select_randsalt_query){
    die("query failed" . mysqli_error($connection));
}
$row = mysqli_fetch_array($select_randsalt_query);

$salt = $row['randSalt'];

$salt = mysqli_real_escape_string($connection, $salt);
$hashed_password = crypt($user_password, $salt);
*/
    if(!empty($user_password)){
        $query_password = "SELECT * FROM users WHERE user_id = $the_user_id";
        $get_user_query = mysqli_query($connection,$query_password);

        $row = mysqli_fetch_array($get_user_query);
        $db_user_password =$row['user_password'];
        
        if($db_user_password != $user_password){
            $hashed_password = password_hash($user_password, PASSWORD_DEFAULT, array('cost'=>10));
        


        $query = "UPDATE users SET ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_role = '{$user_role}', ";
        $query .="username = '{$username}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$hashed_password}' ";
        $query .="WHERE user_id = {$the_user_id}";
    
        $edit_user_query = mysqli_query($connection,$query);
        confirm($edit_user_query);

        echo "user updated " . "<a href='users.php'>VIEW Users?</a>'";
    }
    }

    }




} else {
    header("location : index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label for="Firstname">Firstname</label>
        <input type="text" class="form-control"  value="<?php echo $user_firstname;?>" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="Lastname">Lastname</label>
        <input type="text" class="form-control" value="<?php echo $user_lastname;?>" name="user_lastname">
    </div>
    
    
<div class="form-group">
    <select name="user_role" id="">
    <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
    <?php if($user_role == 'admin'){
        echo "<option value='subscriber'>subscriber</option>";
    } else {
        echo "<option value='admin'>admin</option>";
    }
    
    ?>
    
    
    
    </select>
    </div>


<!--
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
-->
    <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" class="form-control"  value="<?php echo $username;?>" name="username">
    </div>

    <div class="form-group">
        <label for="Email">Email</label>
        <input type="text" class="form-control"  value="<?php echo $user_email;?>" name="user_email">
    </div>

    <div class="form-group">
        <label for="Password">Password</label>
        <input autocomplete="off" type="password" class="form-control" value="" name="user_password">
    </div>
<!--
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
        </textarea>
    </div>
-->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>