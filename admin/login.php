<?php
require "../config.php";
if(!isset($_POST['tb_username']) && !isset($_POST['tb_pass'])){
    die("invalid parameters");
}

$username=$_POST['tb_username'];
$password=$_POST['tb_pass'];
$username=str_replace("'","",$username);
$password=str_replace("'","",$password);
$password=str_replace("-","",$password);
$username=str_replace("-","",$username);


$users=User::getAll(" where username ='{$username}' and password ='{$password}' limit 1");
foreach($users as $user){
    session_start();
    $status_user=$user->status_user;
}
    $_SESSION['status_user'] = $status_user;

if($users){
    header("location: index.php");
}else {
    echo "Invalid user <br>";
    echo"<a href='index.html'>Back</a>";
}