<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$sec_id = $_POST["sec_id"];
$id = $_POST["id"];


$query = mysqli_query($mysqli, "UPDATE SCHEDULE SET SEC_ID = ".$sec_id." WHERE sched_id = ".$id." ");

echo "
<form action='viewSectionSched.php' method='POST'>
    <input type='hidden' name='id' value='".$sec_id."'>
</form>
<script>
    document.forms[0].submit();
</script>
";