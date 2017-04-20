<?php 
session_start();
include("sql_connect.php");

$id=$_GET['id'];

$table=mysqli_query($mysqli, "UPDATE class SET active=0 WHERE class_id = ".$id."");

if($table){
    header("location: manage-class.php");
} else {
    header("location: db_error.php");
}