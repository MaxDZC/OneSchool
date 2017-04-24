<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
    header("location: ../index.php");
}

$subj = $_POST['subject'];

$query=mysqli_query($mysqli, "INSERT INTO repository (teacher_id, subj_id) VALUES ('".$_SESSION['id']."', ".$subj.") ");

if($query) {
    mkdir("repos/".$_SESSION['id']."/".$subj);
    header("location: repository.php");
}