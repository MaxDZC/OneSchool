<?php

if(1 == 1){
    header("location: logout.php");
} else {
    include("sql_connect.php");

    for($i=1; $i<6; $i++) {
        for($j=1; $j<5; $j++) {
            for($k=1; $k<13; $k++) {
                $quizT=mysqli_query($mysqli, "SELECT AVG(score) FROM quiz WHERE grade_level=".$i." AND grade_per =".$j." AND subj_id =".$k." AND stud_id = 'S14101334'");
                $quiz=mysqli_fetch_array($quizT); 

                $swT=mysqli_query($mysqli, "SELECT AVG(score) FROM seatwork WHERE grade_level =".$i." AND grade_per=".$j." AND subj_id=".$k." AND stud_id = 'S14101334'");
                $sw=mysqli_fetch_array($swT);

                $assT=mysqli_query($mysqli, "SELECT AVG(score) FROM assign WHERE grade_level =".$i." AND grade_per=".$j." AND subj_id=".$k." AND stud_id = 'S14101334'");
                $ass=mysqli_fetch_array($assT);

                $projT=mysqli_query($mysqli, "SELECT AVG(score) FROM project WHERE grade_level =".$i." AND grade_per=".$j." AND subj_id=".$k." AND stud_id = 'S14101334'");
                $proj=mysqli_fetch_array($projT);

                $pexT=mysqli_query($mysqli, "SELECT AVG(score) FROM exam WHERE grade_level =".$i." AND grade_per=".$j." AND subj_id=".$k." AND exam_type ='PE' AND stud_id = 'S14101334'");
                $pex=mysqli_fetch_array($pexT);

                $mexT=mysqli_query($mysqli, "SELECT AVG(score) FROM exam WHERE grade_level =".$i." AND grade_per=".$j." AND subj_id=".$k." AND exam_type ='ME' AND stud_id = 'S14101334'");
                $mex=mysqli_fetch_array($mexT);

                $query=mysqli_query($mysqli, "UPDATE gradebreakdown SET quiz=".$quiz[0].", seatwork =".$sw[0].", assignment =".$ass[0].", project =".$proj[0].", pexam =".$pex[0].", mexam =".$mex[0]." WHERE grade_level = ".$i." AND grade_per = ".$j." AND subj_id = ".$k." AND student_id = 'S14101334'");
            }
        }
    }

    echo "Well done!";
}