<?php
include("sql_connect.php");

if(1 == 1) {
    header("location: logout.php");
} else {
    for($i = 1; $i < 6; $i++) {
        for($j = 1; $j < 13; $j++) {
            $arr=[];
            for($k = 1; $k < 5; $k++) {
                $gbT=mysqli_query($mysqli, "SELECT * FROM gradebreakdown WHERE grade_level = ".$i." AND subj_id = ".$j." AND grade_per = ".$k." AND student_id = 'S14101334'");
                $gb=mysqli_fetch_array($gbT);

                $arr[$k] = $gb[7]*0.1 + $gb[8]*0.1 + $gb[9]*0.05 + $gb[10]*0.20 + $gb[11]*0.25 + $gb[12]*0.30;
            }
            $insert=mysqli_query($mysqli, "INSERT INTO grades VALUES ('S14101334', ".$j.", 'T14103150', ".$i.", ".$arr[1].", ".$arr[2].", ".$arr[3].", ".$arr[4].", 1)");
        }
    }

    echo "Well done?";
}