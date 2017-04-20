<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])) {
    header("location: index.php");
}

$fname=$_POST["fname"];
$mname=$_POST["mname"];
$lname=$_POST["lname"];
$address=$_POST["address"];
$bday=$_POST["bday"];
$grade_level=$_POST["grade_level"];
$gender=$_POST["gender"];

if($gender == "M") {
    $gender = "Male";
} else {
    $gender = "Female";
}

$id="S".date("ym");

do {
    $tempId=$id.sprintf("%04d", rand(0, 9999));
    $checkT=mysqli_query($mysqli, "SELECT * FROM STUDENT WHERE student_id = '".$tempId."'");
} while(mysqli_num_rows($checkT) != 0);

$id = $tempId;

$insert=mysqli_query($mysqli, "INSERT INTO student VALUES ('".$id."', '123', '".$fname."', '".$mname."', '".$lname."', NULL, ".$grade_level.", '".$address."', '".$gender."', '".$bday."', NULL, NULL, 1)");

if($insert) {
    header("location: createstud.php");
}