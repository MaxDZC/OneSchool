<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_SESSION["id"];
$grade = $_POST["grade"];
$subject = $_POST["subject"];
$quiz = $_POST["quiz"];
$sw = $_POST["sw"];
$assign = $_POST["assign"];
$proj = $_POST["proj"];
$mexam = $_POST["mexam"];
$pexam = $_POST["pexam"];

$query = mysqli_query($mysqli, "UPDATE gradebreakdown SET admin_id = '".$id."', quiz = ".$quiz.", seatwork = ".$sw.", assignment = ".$assign.", project = ".$proj.", mexam = ".$mexam.", pexam = ".$pexam." WHERE grade_level = ".$grade." AND subj_id = ".$subject." AND teacher_id IS NULL AND student_id IS NULL");

if($query) {
    echo "
    <form action='editWeights.php' method='POST'>
        <input type='hidden' name='grade' value='".$grade."'>
        <input type='hidden' name='subject' value='".$subject."'>
    </form>
    <script>
        document.forms[0].submit();
    </script>";
}