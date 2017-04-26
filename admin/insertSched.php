<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$subj = $_POST["subj_id"];
$grade = $_POST["grade"];
$ts = $_POST["time_start"];
$te = $_POST["time_end"];

$visib = 0;

for($i = 0; $i < 7; $i++) {
    if(isset($_POST[$i])) {
        $visib += pow(2,$i);
    }
}

$query = mysqli_query($mysqli, "INSERT INTO SCHEDULE (subj_id, grade_level, time_start, time_end, days) VALUES (".$subj.", ".$grade.", '".$ts."', '".$te."', ".$visib.") ");

if($query) {
    header("location: createsched.php");
} else {
    header("location: ../database/db_error.php");
}