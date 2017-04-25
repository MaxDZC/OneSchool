<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$adviser = $_POST["adviser"];
$grade = $_POST["grade"];
$section = $_POST["section"];
$size = $_POST["size"];

$query = mysqli_query($mysqli, "INSERT INTO subsection (section_adviser, grade_level, section_name, size) VALUES ('".$adviser."', ".$grade.", '".$section."', ".$size." )");

if($query) {
    header("location: createclass.php");
} else {
    header("location: ../database/db_error.php");
}