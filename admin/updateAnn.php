<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_POST["id"];
$title = $_POST["title"];
$ann = $_POST["ann"];
$visib = 0;

for($i = 1; $i < 13; $i++) {
	if(isset($_POST[$i])) {
		$visib += pow(2,$i - 1);
	}
}

$query=mysqli_query($mysqli, "UPDATE announcement SET title = '".$title."', ann =  '".$ann."', visibility = ".$visib." WHERE ann_id = ".$id."");

if($query) {
	echo 
	"<form action='viewAnn.php' method='POST'>
		<input type='hidden' name='ann_id' value=".$id.">
	</form> 
	<script>
		document.forms[0].submit();
	</script>";
}