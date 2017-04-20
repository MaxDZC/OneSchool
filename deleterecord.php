<?php 
	$name=$_GET["name"];
	$level=$_GET["level"];
	$stud=$_GET["stud"];
	$subj=$_GET["subj"];
	$type=$_GET["type"];
	$title=$_GET["title"];
	$period=$_GET["gradingper"];
	$section=$_GET["section"];
	$no=$_GET["no"];

	if($type=="Homeworks and Assignments"){
		$class="hw";
	}else if($type=="Seatworks"){
		$class="sw";
	}else if($type=="Quizzes"){
		$class="qz";
	}else if($type=="Projects"){
		$class="prj";
	}else if($type=="Midterm Exam"){
		$class="";
		$no="me";
	}else if($type=="Periodical Exam"){
		$class="";
		$no="pe";
	}


	$mysqli=new mysqli("localhost","root","","oneschool");

	$sql="DELETE FROM studentgrades WHERE idnum='$stud' AND gradelvl='$level' AND gradingper='$period' AND type='$type' AND title='$title'";
	$mysqli->query($sql);

	$sql="UPDATE classrecord SET $class$no='0' WHERE teacher='$name' AND idnum='$stud' AND gradelevel='$level' AND subject='$subj' AND gradingper='$period'";

	$mysqli->query($sql);

	header("Location: updaterecord2.php?name=$name&level=$level&stud=$stud&subj=$subj&section=$section");

?>