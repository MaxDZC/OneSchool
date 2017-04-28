<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_POST["id"];
$sched_id = $_POST['sched_id'];

if($status) {
    $input=mysqli_query($mysqli, "INSERT INTO class (sched_id, teacher_id, sec_id) VALUES (".$sched_id.", '".$id."', ".$insert[6].")");       
}

echo "
<form action='viewTeach.php' method='POST'>
    <input type='hidden' name='id' value='".$id."'>
</form>
<script>
    document.forms[0].submit();
</script>
";