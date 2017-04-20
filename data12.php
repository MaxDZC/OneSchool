<?php 
	$subj=$_GET['subj'];
	$lvl=$_GET['lvl'];

	$mysqli=new mysqli("localhost","root","","oneschool");
 	$sql="DELETE FROM category WHERE grdlvl='$lvl' AND subjid='$subj'";
 	$mysqli->query($sql);
 	header("Location: createcat.php");
 ?>