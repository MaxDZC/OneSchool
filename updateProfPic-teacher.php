<?php
session_start();
require ("sql_connect.php");

$id=$_SESSION['id'];
$dest = "img/profile/";

$dest = $dest.basename($_FILES['photo']['name']);
if($_FILES['photo']['error'] == 0) {
    move_uploaded_file($_FILES['photo']['tmp_name'], $dest);

    $result = mysqli_query($mysqli, "UPDATE teacher SET idPic ='".$dest."' WHERE teacher_id = '".$id."'");
    if ($result){
            header("location: teacher-profile.php");
    } else {
            header("location: db_error.php");
    }
}
