<?php
session_start();
include("sql_connect.php");

$id=$_POST["id"];
$pass=$_POST["pass"];

switch(substr($id, 0, 1)){
	case 'A': case 'a':
		$stmt="SELECT * FROM ADMIN WHERE admin_id = '".$id."' AND password = '".$pass."' AND active != 0";
		$address="welcome-admin.php";
		break;
	case 'S': case 's':
		$stmt="SELECT * FROM STUDENT WHERE student_id = '".$id."' AND password = '".$pass."' AND active != 0";
		$address="welcome.php";
		break;
	case 'T': case 't':
		$address="welcome-teacher.php";
		$stmt="SELECT * FROM TEACHER WHERE teacher_id = '".$id."' AND password = '".$pass."' AND active != 0";
}

$table=mysqli_query($mysqli, $stmt);

echo mysqli_num_rows($table);

if(mysqli_num_rows($table) == 1){
	$row=mysqli_fetch_array($table);
	$_SESSION['name'] = $row[2];
	$_SESSION['id'] = $row[0];
	header("location: ".$address);
} else {
//	header("location: login.php");
}