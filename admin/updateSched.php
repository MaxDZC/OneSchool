<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id =  $_POST["id"];
$grade =  $_POST["grade"];
$subj =  $_POST["subj_id"];
$ts =  $_POST["time_start"];
$te =  $_POST["time_end"];

$visib = 0;

for($i = 0; $i < 7; $i++) {
    if(isset($_POST[$i])) {
        $visib += pow(2,$i);
    }
}


$query=mysqli_query($mysqli, "UPDATE schedule SET subj_id = ".$subj.", grade_level = ".$grade.", time_start = '".$ts."', time_end = '".$te."', days = ".$visib." WHERE sched_id = ".$id." AND active = 1 ");

if($query) {
    header("location: createsched.php");
}