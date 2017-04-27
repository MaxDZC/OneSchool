<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
    header("location: ../index.php");
}

$id = $_POST["id"];

$query = mysqli_query($mysqli, "DELETE FROM SUBSECTION WHERE SEC_ID = ".$id." ");

if($query) {
    header("location: createclass.php");
}