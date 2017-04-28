<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$sec_id = $_POST["sec_id"];
$sched_id = $_POST["sched_id"];

$query = mysqli_query($mysqli, "DELETE FROM class WHERE sched_id = ".$sched_id."");

if($query) {
    echo "<form action='viewSectionSched.php' method='POST'>
            <input type='hidden' name='id' value='".$sec_id."'>
        </form>
        <script>
            document.forms[0].submit();
        </script>";
}