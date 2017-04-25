<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_POST["id"];

$classesT=mysqli_query($mysqli, "SELECT class_id FROM class WHERE teacher_id = '".$id."' ");

$classArray = array();
while($classes = mysqli_fetch_array($classesT)) {
    array_push($classArray, $classes[0]);
}


if(count($classArray) != 0) {
    $deleteClasses = mysqli_query($mysqli, "DELETE FROM SECTION WHERE class_id IN (".implode(", ", $classArray).") ");
} else {
    $deleteClasses = mysqli_query($mysqli, "SELECT * FROM SECTION");
}

if($deleteClasses) {
    $deleteTeacher = mysqli_query($mysqli, "DELETE FROM TEACHER WHERE teacher_id = '".$id."' ");

    if($deleteTeacher) {
        header("location: createteach.php");
    }
}