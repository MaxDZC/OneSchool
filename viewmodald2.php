<?php
	$sect=$_GET["sect"];
	$level=$_GET["level"];
	$subject=$_GET["subject"];
	$mysqli=new mysqli("localhost","root","","oneschool");
	$sql="UPDATE schedule SET section='' WHERE gradelvl='$level' AND section='$sect' AND subject='$subject'";
	$mysqli->query($sql);
	header("Location: viewmodal.php?level=$level&sect=$sect");
?>