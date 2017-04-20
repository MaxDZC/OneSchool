<?php 
	$idnum=$_GET["id"];
	$name=$_GET["name"];
    $x=0;
    $mysqli=new mysqli("localhost","root","","oneschool");
    $table=mysqli_query($mysqli,"SELECT * FROM studentlist WHERE idnum='$idnum'");
            while($row=mysqli_fetch_array($table)){
                $x++;
            }
	header("Location: tracks.php?id=$idnum&name=$name&count=$x&level=Grade 1");
?>