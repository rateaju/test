<?php
$db['db_host']="localhost";
$db['db_user']="ntea100";
$db['db_pass']="a846813ab!";
$db['db_name']="ntea100";
/*
$db['db_user']="root";
$db['db_pass']="111111";
$db['db_name']="cms";
*/
foreach($db as $key => $value){

    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


//if($connection){
   // echo "We are connected";}











?>
