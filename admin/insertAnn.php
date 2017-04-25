<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$title = $_POST['title'];
$ann = $_POST['ann'];
$visib = 0;

for($i = 1; $i < 11; $i++) {
	if(isset($_POST[$i])) {
		$visib += pow(2,$i - 1);
	}
}

$query=mysqli_query($mysqli, "INSERT INTO announcement (admin_id, title, ann, visibility) VALUES ('".$_SESSION['id']."', '".$title."', '".$ann."', ".$visib.") ");

if($query) {
	echo 
	"<form action='viewAnn.php' method='POST'>
		<input type='hidden' name='ann_id' value=".$id.">
	</form> 
	<script>
		document.forms[0].submit();
	</script>";
}
