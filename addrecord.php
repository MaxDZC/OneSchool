<?php 
	$idnum=$_POST["id"];
	$type=$_POST["type"];
	$title=$_POST["title"];
	$total=$_POST["total"];
	$acc=$_POST["acc"];

	$no=$_POST["no"];

	$prd=$_GET["prd"];


	$level=$_GET["level"];
	$section=$_GET["section"];
	$stud=$idnum;
	$subj=$_GET["subj"];
	// $postedby=$_GET["name"];

	// if($type=="Homeworks and Assignments"){
	// 	$class="hw";
	// 	if($total!=0)
	// 		$score=($acc/$total)*100;
	// 	else 
	// 		$score=0;
	// }else if($type=="Seatworks"){
	// 	$class="sw";
	// 	if($total!=0)
	// 		$score=($acc/$total)*100;
	// 	else 
	// 		$score=0;
	// }else if($type=="Quizzes"){
	// 	$class="qz";
	// 	if($total!=0)
	// 		$score=($acc/$total)*100;
	// 	else 
	// 		$score=0;
	// }else if($type=="Projects"){
	// 	$class="prj";
	// 	if($total!=0)
	// 		$score=($acc/$total)*100;
	// 	else 
	// 		$score=0;
	// }else if($type=="Midterm Exam"){
	// 	$class="";
	// 	$no="me";
	// 	if($total!=0)
	// 		$score=($acc/$total)*100;
	// 	else 
	// 		$score=0;
	// }else if($type=="Periodical Exam"){
	// 	$class="";
	// 	$no="fe";
	// 	if($total!=0)
	// 		$score=($acc/$total)*100;
	// 	else 
	// 		$score=0;
	// }


	// $mysqli=new mysqli("localhost","root","","oneschool");
	// $sql="INSERT INTO studentgrades(idnum,gradelvl,gradingper,subject,type,title,total,score,postedby,no) VALUES ('$stud','$level','$prd','$subj','$type','$title','$total','$acc','$postedby','$no')";

	// $mysqli->query($sql);

	// $table=mysqli_query($mysqli,"SELECT * FROM classrecord");

	// $check=false;

	// while($row=mysqli_fetch_array($table)){
	// 	if($row[0]==$postedby&&$row[1]==$stud&&$row[2]==$level&&$row[3]==$subj&&$row[4]=$prd){
	// 		$check=true;
	// 	}
	// }

	// if($check==false){	
	// $sql="INSERT INTO classrecord(teacher,idnum,gradelevel,subject,gradingper,$class$no) VALUES('$postedby','$stud','$level','$subj','$prd','$score')";
	// }else{
	// $sql="UPDATE classrecord SET $class$no='$score' WHERE teacher='$postedby' AND idnum='$stud' AND gradelevel='$level' AND subject='$subj' AND gradingper='$prd'";	
	// }
	// $mysqli->query($sql);

	// echo $postedby;
	// header("Location: updaterecord-2.php?name=$postedby&level=$level&section=$section&subj=$subj&prd=$prd");
?>