<?php
session_start();
require ("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
  header("location: ../index.php");
}

$id=$_SESSION['id'];
$subj=$_POST['subj'];


$dest = "repos/".$id."/".$subj."/";

$dest = $dest.basename($_FILES['file']['name']);
if($_FILES['file']['error'] == 0) {
    move_uploaded_file($_FILES['file']['tmp_name'], $dest);

    $result = mysqli_query($mysqli, "INSERT INTO REPOSITORY (teacher_id, subj_id, file) VALUES ('".$id."', ".$subj.", '".$dest."')");

    if ($result){
    	echo
    	"<form action='viewRepo.php' method='POST'>
    		<input type='hidden' name='subj' value='".$subj."'>
		</form>
		<script>
			document.forms[0].submit();
		</script>";
    } else {
        header("location: ../database/db_error.php");
    }
}
