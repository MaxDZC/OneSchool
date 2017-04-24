<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
    header("location: ../index.php");
}

$id = $_POST['id'];
$file = $_POST['filename'];
$subj = $_POST['subj'];


$query=mysqli_query($mysqli, "DELETE FROM repository WHERE item_id = ".$id." ");

if($query) {
	unlink("repos/".$_SESSION['id']."/".$subj."/".$file);
	echo
	"<form action='viewRepo.php' method='POST'>
		<input type='hidden' name='subj' value='".$subj."'>
	</form>
	<script>
		document.forms[0].submit();
	</script>";
}