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
$address = $_POST["address"];
$email = $_POST["email"];
$bday = $_POST["bday"];
$ed = $_POST["ed_att"];

$query=mysqli_query($mysqli, "UPDATE teacher SET t_fName = '".$fname."', t_mName = '".$mname."', t_lName = '".$lname."', address = '".$address."', email = '".$email."', bday = '".$bday."', ed_att = '".$ed."' WHERE teacher_id = '".$id."' ");

if($query) {
    echo "
    <form action='editTeach.php' method='POST'>
        <input type='hidden' name='id' value='".$id."'>
    </form>
    <script>
        document.forms[0].submit();
    </script>";
}