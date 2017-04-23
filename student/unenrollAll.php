<?php
session_start(); 
include("../database/sql_connect.php");

$delete=mysqli_query($mysqli, "DELETE FROM section WHERE student_id = '".$_SESSION['id']."' ");

if($delete) {
    $work=mysqli_query($mysqli, "UPDATE student SET sec_id = NULL, section = NULL WHERE student_id ='".$_SESSION['id']."'");
    if($work) {
        header("location: enrollclass.php");
    }
}