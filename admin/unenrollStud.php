<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id = $_POST["id"];

$query = mysqli_query($mysqli, "DELETE FROM section WHERE student_id = '".$id."' AND active = 1");

if($query) {
    $query2 = mysqli_query($mysqli, "UPDATE student SET section = NULL, sec_id = NULL WHERE student_id = '".$id."' AND active = 1");

    if($query2) {
        echo "
        <form action='viewSection.php' method='POST'>
            <input type='hidden' name='id' value='".$_POST["sec_id"]."'>
        </form>
        <script>
            document.forms[0].submit();
        </script>
        ";
    }
}