<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$enroll = $_POST["enroll"];
$sec_id = $_POST["sec_id"];

$sectionT=mysqli_query($mysqli, "SELECT * FROM subsection WHERE sec_id = ".$sec_id." AND active = 1");

if(mysqli_num_rows($sectionT) == 1) {

    $section=mysqli_fetch_array($sectionT);

    $num = count($enroll);

    for($i = 0; $i < $num; $i++) {
        $addSection=mysqli_query($mysqli, "UPDATE student SET section = '".$section[2]."', sec_id = ".$sec_id." WHERE student_id = '".$enroll[$i]."' AND active = 1");

        $addToClass=mysqli_query($mysqli, "INSERT INTO SECTION ");
    }

}

