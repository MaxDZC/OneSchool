<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id=$_SESSION['id'];
$dest = "img/profile/";

$dest = $dest.basename($_FILES['photo']['name']);
if($_FILES['photo']['error'] == 0) {
    move_uploaded_file($_FILES['photo']['tmp_name'], $dest);

    $result = mysqli_query($mysqli, "UPDATE admin SET idPic ='".$dest."' WHERE admin_id = '".$id."'");
    if ($result){
        header("location: admin-profile.php");
    } else {
        header("location: ../database/db_error.php");
    }
}