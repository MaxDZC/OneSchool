<?php 
	$idnum=$_GET['idnum'];
	$name=$_GET['name'];


	$mysqli=new mysqli("localhost","root","","oneschool");
 	$sql="DELETE FROM teacherlist WHERE teacherid='$idnum' AND teachername='$name'";
 	$mysqli->query($sql);
    header("Location: createteach.php");
 ?>