<?php 
	$name=$_GET["name"];
	$idnum=$_GET["idnum"];
	$bdate=$_GET["bdate"];
	$currentgr=$_GET["currentgr"];
	$pass=$_GET["pass"];


	switch ($currentgr) {
		case 'Grade 1':
			$updategr='Grade 2';			
			break;
		case 'Grade 2':
			$updategr='Grade 3';
			break;
		case 'Grade 3':
			$updategr='Grade 4';
			break;
		case 'Grade 4':
			$updategr='Grade 5';
			break;
		case 'Grade 5':
			$updategr='Grade 6';
			break;
		case 'Grade 6':
			$updategr='Grade 7';
			break;
		case 'Grade 7':
			$updategr='Grade 8';
			break;
		case 'Grade 8':
			$updategr='Grade 9';
			break;
		case 'Grade 9':
			$updategr='Grade 10';
			break;
	}

	$mysqli=new mysqli("localhost","root","","oneschool");
	$sql="UPDATE studentlist SET status='Done' WHERE idnum='$idnum' AND currentgr='$currentgr'";

	$mysqli->query($sql);

	$sql="UPDATE studentgrades SET status='Done' WHERE idnum='$idnum' AND gradelvl='$currentgr'";

	$mysqli->query($sql);

	$sql="UPDATE classrecord SET status='Done' WHERE idnum='$idnum' AND gradelevel='$currentgr'";

	$mysqli->query($sql);


	$sql="INSERT INTO studentlist(idnum,name,bdate,currentgr,pass) VALUES('$idnum','$name','$bdate','$updategr','$pass')";

	$mysqli->query($sql);

	header("Location: createstud.php");

?>