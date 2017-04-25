<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_POST['ann_id'];

$query=mysqli_query($mysqli, "DELETE FROM announcement WHERE ann_id = ".$id." ");

if($query) {
	header("location: welcome-admin.php");
}