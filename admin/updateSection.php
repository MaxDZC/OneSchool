<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_POST["id"];
$name = $_POST["name"];
$size = $_POST["size"];
$teacher = $_POST["teacher"];

$query = mysqli_query($mysqli, "UPDATE SUBSECTION SET section_name = '".$name."', size = ".$size.", section_adviser = '".$teacher."' WHERE sec_id = ".$id." ");

header("location: createclass.php");