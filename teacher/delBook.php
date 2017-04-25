<?php
session_start();
require ("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
  header("location: ../index.php");
}

$id = $_POST["id"];

$query = mysqli_query($mysqli, "DELETE FROM UNIV_LIBRARY WHERE book_id = ".$id." ");

if($query) {
    header("location: library.php");
}