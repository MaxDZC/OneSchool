<?php 
	$subj=$_GET['subject'];
	$sched=$_GET['sched'];
	$level=$_GET['level'];
	$teacher=$_GET['teach'];
	
	echo $subj.$sched.$level.$teacher;

	$mysqli=new mysqli("localhost","root","","oneschool");
	$sql="UPDATE schedule SET teacher='$teacher' WHERE gradelvl='$level' AND subject='$subj' AND time='$sched'";
	$mysqli->query($sql);
	header("Location: manage-class.php?name=$teacher");
?>