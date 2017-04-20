<?php 
	$level=$_GET['level'];
	$sect=$_GET['sect'];

	$mysqli=new mysqli("localhost","root","","oneschool");
 	$sql="DELETE FROM class WHERE gradelvl='$level' AND section='$sect'";
 	$mysqli->query($sql);
    header("Location: createclass.php");
 ?>