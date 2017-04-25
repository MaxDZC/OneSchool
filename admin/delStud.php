<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["id"];

// Cascades waaay too much D:
// Goodbye data :(
// **tentative, going to set active to 0 when to preserve the data
$delete=mysqli_query($mysqli, "DELETE from student WHERE student_id = '".$id."' ");

if($delete) {
	header("location: createstud.php");
}