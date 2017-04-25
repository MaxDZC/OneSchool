<?php
session_start();
require ("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$id=$_POST['id'];
$dest = "img/profile/";

$dest = $dest.basename($_FILES['photo']['name']);
if($_FILES['photo']['error'] == 0) {
    move_uploaded_file($_FILES['photo']['tmp_name'], "../student/".$dest);

    $result = mysqli_query($mysqli, "UPDATE student SET s_idPic='".$dest."' WHERE student_id = '".$id."'");
    if ($result){
        echo 
        "<form action='editStud.php' method='POST'>
            <input type='hidden' name='id' value='".$id."' required>
        </form>
        <script>
            document.forms[0].submit();
        </script>";
    } else {
        header("location: ../database/db_error.php");
    }
}
