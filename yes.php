<?php
    $gradelvl=$_POST["gradelvl"];
    $gradeprd=$_POST["gradeprd"];
    $subject=$_POST["subject"];
    $grade=$_POST["grade"];

    if($gradeprd == '1'){
        $gradeprd = "firstgr";
    } else if($gradeprd == '2'){
        $gradeprd = "secondgr";
    } else if($gradeprd == '3'){
        $gradeprd = "thirdgr";
    } else if($gradeprd == '4'){
        $gradeprd = "fourthgr";
    }

    $mysqli=new mysqli("localhost","root","","oneschool");

    $sql="UPDATE studentgrades SET ".$gradeprd."=".$grade." WHERE subject='".$subject."' and gradingper=".$gradelvl."";

    $hello = mysqli_query($mysqli,$sql);

    mysqli_close($mysqli);
?>