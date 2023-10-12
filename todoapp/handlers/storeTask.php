<?php
session_start();
include("../database/connect.php");
include("../functions/validate.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    foreach($_POST as $key => $value)$$key=sanitizeInput($value);
    if(empty($content)){
        $_SESSION['error']="Please Enter a Task";
        header("location:../index.php");
    }else{
    $task_query="INSERT INTO task (content) VALUES ('$content')";
    $task_query_run=mysqli_query($con,$task_query);
    if(mysqli_affected_rows($con)>0){
        $_SESSION['success']="Task Added Successfully";
    }
    header("location:../index.php");
}
}