<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
    header("location: ../index.php");
}

$sched_id = $_POST['sched_id'];

// Pre-process
$classT=mysqli_query($mysqli, "SELECT sched_id FROM class WHERE teacher_id = '".$_SESSION['id']."' and active = 1");

if(mysqli_num_rows($classT) != 0) {

    $classArray = array();
    while($class=mysqli_fetch_array($classT)) {
        array_push($classArray, $class[0]);
    }

    $schedT=mysqli_query($mysqli, "SELECT time_start, time_end, days FROM schedule WHERE sched_id IN (".implode(", ", $classArray).") AND active = 1");

    $takenTimes = array();
    $takenDays = array();
    while($sched=mysqli_fetch_array($schedT)) {
        array_push($takenDays, $sched[2]);
        array_push($takenTimes, $sched[0]);
        array_push($takenTimes, $sched[1]);
    }

    $len=count($takenTimes);
    $lim=count($takenDays);

} else {
    $lim = 0;
}

// Insertion
$toInsert=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id = ".$sched_id." and active = 1");
$insert=mysqli_fetch_array($toInsert);

$status = true;

for($i=0; $i < $lim; $i++) {
    if(($takenDays[$i] & $insert[5]) != 0) {
        $status = false;
        break;
    }
}

if(!$status) {

    $status = true;

    for($i=0; $i < $len; $i+=2) {
        if(($takenTimes[$i] <= $insert[3] && $takenTimes[$i + 1] > $insert[3] ||
           $takenTimes[$i] < $insert[4] && $takenTimes[$i + 1] >= $insert[4] ||
           $takenTimes[$i] >= $insert[3] && $takenTimes[$i + 1] <= $insert[4])
            && (($takenDays[$i/2] & $insert[5]) != 0)) {
            $status = false;
            break;
        }
    }
}

if($status) {
    $input=mysqli_query($mysqli, "INSERT INTO class (sched_id, teacher_id, sec_id) VALUES (".$sched_id.", '".$_SESSION['id']."', ".$insert[6].")");

    if($input) {
        header("location: manage-class.php");
    }
} else {
    header("location: manage-class.php");
}