<?php
	$mysqli = new mysqli("localhost","root","","oneschool");
	var average=0;
	$subject1=mysqli_query($mysqli,"SELECT* FROM studentgrades WHERE subject="Mother Tongue"");
	while($row=mysqli_fetch_array($subject1)){
		average+=$row[6];
	}
	$sql="INSERT INTO grade analysis(subject,average) VALUES ('Mother Tongue','average)";
	if($mysqli->query($sql)===TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: ".$sql."<br>".$mysqli->error;
	}
?>