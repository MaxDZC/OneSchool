<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_POST["id"];
$sched_id = $_POST['sched_id'];

$delete=mysqli_query($mysqli, "DELETE FROM class WHERE sched_id = ".$sched_id." ");

echo "
<form action='viewTeach.php' method='POST'>
    <input type='hidden' name='id' value='".$id."'>
</form>
<script>
    document.forms[0].submit();
</script>
";