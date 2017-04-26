<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_SESSION["id"];
$subject = $_POST["subject"];
$quiz = $_POST["quiz"];
$sw = $_POST["sw"];
$assign = $_POST["assign"];
$proj = $_POST["proj"];
$mexam = $_POST["mexam"];
$pexam = $_POST["pexam"];

$query = mysqli_query($mysqli, "INSERT INTO subjects (subject) VALUES ('".$subject."')");
$subjidT = mysqli_query($mysqli, "SELECT subj_id FROM subjects WHERE subject = '".$subject."' ORDER BY subj_id DESC limit 1");
$subjid = mysqli_fetch_array($subjidT);

if($query) {
	for($i = 1; $i < 11; $i++) {
		$insert=mysqli_query($mysqli, "INSERT INTO gradebreakdown (admin_id, subj_id, grade_level, quiz, seatwork, assignment, project, mexam, pexam) VALUES ('".$id."', ".$subjid[0].", ".$i.", ".$quiz.", ".$sw.", ".$assign.", ".$proj.", ".$mexam.", ".$pexam.") ");

		if(!$insert) {
			header("location: ../database/db_error.php");
		}
	}

    header("location: createcat.php");
}