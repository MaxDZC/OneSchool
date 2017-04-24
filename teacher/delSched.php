<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
    header("location: ../index.php");
}

$sched_id = $_POST['sched_id'];

$delete=mysqli_query($mysqli, "DELETE FROM class WHERE sched_id = ".$sched_id." ");

if($delete) {
    header("location: manage-class.php");
}