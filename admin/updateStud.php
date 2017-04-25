<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_POST["id"];
$fname = $_POST["fName"];
$mname = $_POST["mName"];
$lname = $_POST["lName"];
$grade = $_POST["grade_level"];
$address = $_POST["Address"];
$bday = $_POST["bday"];
$gender = ($_POST["gender"] == 'M') ? "Male" : "Female";

$query=mysqli_query($mysqli, "UPDATE student SET s_fName = '".$fname."', s_mName = '".$mname."', s_lName = '".$lname."', grade_level = ".$grade.", address = '".$address."', gender = '".$gender."', bday = '".$bday."' WHERE student_id = '".$id."' ");

if($query) {
    echo "
    <form action='editStud.php' method='POST'>
        <input type='hidden' name='id' value='".$id."'>
    </form>
    <script>
        document.forms[0].submit();
    </script>";
}