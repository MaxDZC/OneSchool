<?php
	$id=$_GET["idnum"];
	$name=$_GET["name"];
	$sect=$_GET["sect"];
	$level=$_GET["level"];

	$mysqli=new mysqli("localhost","root","","oneschool");
	$sql="UPDATE studentlist SET section='' WHERE idnum='$id' AND section='$sect'";
	$mysqli->query($sql);
	header("Location: viewmodal.php?level=$level&sect=$sect");
?>