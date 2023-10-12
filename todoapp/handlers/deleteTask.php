<?php
session_start();
include("../database/connect.php");

if(isset($_GET['id'])){
$taskId=$_GET['id'];
// check if the id is exist or not
$task_query="SELECT * FROM task where id='$taskId'";
$task_query_run=mysqli_query($con,$task_query);
$row=mysqli_fetch_row($task_query_run);

if(!$row){
    $_SESSION['notexists']="Data Not Exist";
}else{
$task_query="DELETE FROM task where id='$taskId'";
mysqli_query($con,$task_query);
if(mysqli_affected_rows($con)>0){
    $_SESSION['delete']="Task Deleted Successfully";
}
header("location:../index.php");
}
}