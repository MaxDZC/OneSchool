<?php
	$subject=$_GET["subject"];
	$time=$_GET["time"];
	$sect=$_GET["sect"];
	$level=$_GET["level"];

	$mysqli=new mysqli("localhost","root","","oneschool");
	$sql="UPDATE schedule SET section='$sect' WHERE subject='$subject' AND time='$time' AND gradelvl='$level'";
	$mysqli->query($sql);

	header("Location: viewmodal.php?level=$level&sect=$sect");
?>