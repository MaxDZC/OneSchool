<?php
session_start();
include("sql_connect.php");

$delete=mysqli_query($mysqli, "UPDATE student SET active = 0 WHERE student_id = '".$_GET['idnum']."' ");

header("Location: createstud.php");
