<?php
session_start(); 
include("sql_connect.php");

$idnum=$_GET["secid"];

$section=mysqli_query($mysqli, "SELECT * FROM subsection WHERE sec_id=".$idnum."");
$data=mysqli_fetch_array($section);

$result=mysqli_query($mysqli, "UPDATE student SET sec_id=".$idnum.", section='".$data[3]."' WHERE student_id ='".$_SESSION['id']."'");

if($result){
    $table=mysqli_query($mysqli, "SELECT * FROM class WHERE sec_id =".$idnum."");

    while($row=mysqli_fetch_array($table)){
        $stmt = "INSERT INTO section VALUES (".$row[0].", '".$_SESSION['id']."', 1)";
        $do=mysqli_query($mysqli, $stmt);

        if(!$do){
            header("location: enrollclass.php");
        }
    }

    header("location: enrollclass.php");
} else {
    header("location: enrollclass.php");
}