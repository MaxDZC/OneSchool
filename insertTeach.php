<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])) {
    header("location : index.php");
}

$fname=$_POST["fname"];
$mname=$_POST["mname"];
$lname=$_POST["lname"];
$address=$_POST["address"];
$email=$_POST["email"];
$bday=$_POST["bday"];
$ed_att=$_POST["ed_att"];

$id="T".date("ym");

do {
    $tempId=$id.sprintf("%04d", rand(0, 9999));
    $checkT=mysqli_query($mysqli, "SELECT * FROM TEACHER WHERE teacher_id = '".$tempId."'");
} while(mysqli_num_rows($checkT) != 0);

$id = $tempId;

$insert=mysqli_query($mysqli, "INSERT INTO teacher VALUES ('".$id."', '123', '".$fname."', '".$mname."', '".$lname."', '".$address."', '".$email."', '".$bday."', NULL, '".$ed_att."', 1)");

if($insert) {
    header("location: createteach.php");
}