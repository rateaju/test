<?php
if(isset($_POST['create_user'])){
    
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
    $user_password = password_hash($user_password, PASSWORD_DEFAULT, array('cost'=>10));
    //$post_date = date('d-m-y');
    //$post_comment_count = 4;

    //move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";

    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";

    $create_user_query = mysqli_query($connection,$query);

    //confirm($create_user_query);
    echo "User created : " . " " . "<a href='users.php'>View Users</a>";
}
?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label for="Firstname">Firstname</label>
        <input type="text" class="form-control"  name="user_firstname">
    </div>

    <div class="form-group">
        <label for="Lastname">Lastname</label>
        <input type="text" class="form-control"  name="user_lastname">
    </div>
    
    
<div class="form-group">
    <select name="user_role" id="">
    <option value="subscriber">Select Options</option>
    <option value="admin">Admin</option>
    <option value="subscriber">Subscriber</option>
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
        <input type="text" class="form-control"  name="username">
    </div>

    <div class="form-group">
        <label for="Email">Email</label>
        <input type="text" class="form-control"  name="user_email">
    </div>

    <div class="form-group">
        <label for="Password">Password</label>
        <input type="text" class="form-control"  name="user_password">
    </div>
<!--
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
        </textarea>
    </div>
-->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>