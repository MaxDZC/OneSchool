<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$sched_id = $_POST["sched_id"];
$sec_id = $_POST["sec_id"];
$teacher_id = $_POST["teacher_id"];

$query = mysqli_query($mysqli, "UPDATE class SET teacher_id = '".$teacher_id."' WHERE sched_id = ".$sched_id."");

if($query) {
    echo "<form action='viewSectionSched.php' method='POST'>
            <input type='hidden' name='id' value='".$sec_id."'>
        </form>
        <script>
            document.forms[0].submit();
        </script>";
}