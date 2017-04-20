<?php 
	$level=$_GET['level'];
	$subj=$_GET['subj'];
	$sched=$_GET['sched'];
	$sect=$_GET['sect'];

	$mysqli=new mysqli("localhost","root","","oneschool");
 	$sql="DELETE FROM schedule WHERE gradelvl='$level' AND subject='$subj' AND time='$sched'";
 	$mysqli->query($sql);
 	header("Location: createsched.php");
 ?>