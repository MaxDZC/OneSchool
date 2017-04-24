<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
    header("location: ../index.php");
}

$subj = $_POST['subj'];

$query=mysqli_query($mysqli, "DELETE FROM repository WHERE teacher_id = '".$_SESSION['id']."' AND subj_id = ".$subj." ");

if($query) {
	rmdir("repos/".$_SESSION['id']."/".$subj);
    header("location: repository.php");
}