<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$enroll = $_POST["enroll"];
$sec_id = $_POST["sec_id"];

$sectionT=mysqli_query($mysqli, "SELECT * FROM subsection WHERE sec_id = ".$sec_id." AND active = 1");

$classesT=mysqli_query($mysqli, "SELECT class_id FROM class WHERE sec_id = ".$sec_id." AND active = 1");

$classArray = array();
while($classes = mysqli_fetch_array($classesT)) {
    array_push($classArray, $classes[0]);
}

$cnt = count($classArray);

// Check # of students already enrolled //
$checkT=mysqli_query($mysqli, "SELECT class_id FROM class WHERE sec_id = ".$sec_id." AND active = 1");

if(mysqli_num_rows($checkT) != 0) {

    $checkArray = array();
    while($check=mysqli_fetch_array($checkT)) {
        array_push($checkArray, $check[0]);
    }

    $answer=implode(", ", $checkArray);
    $numEnrolled = count($classArray);

    $enrolledT=mysqli_query($mysqli, "SELECT student_id FROM section WHERE class_id IN (".$answer.") group by student_id having count(student_id) = ".$numEnrolled."");

   $numEnrolled=mysqli_num_rows($enrolledT);

} else {
    $numEnrolled = 0;
}
// End Check for # of students $numEnrolled == # of students already enrolled //

if(mysqli_num_rows($sectionT) == 1) {

    $section=mysqli_fetch_array($sectionT);

    $num = count($enroll);

    if($num + $numEnrolled <= $section[4]) {

        for($i = 0; $i < $num; $i++) {
            $addSection=mysqli_query($mysqli, "UPDATE student SET section = '".$section[3]."', sec_id = ".$sec_id." WHERE student_id = '".$enroll[$i]."' AND active = 1");

            $stmt = "INSERT INTO SECTION (class_id, student_id) VALUES ";
            $cont = "";

            for($j = 0; $j < $cnt; $j++) {
                $stmt.= $cont."(".$classArray[$j].", '".$enroll[$i]."')";
                $cont = ", ";
            }

            echo $stmt;

            $addToClass=mysqli_query($mysqli, $stmt);
        }

        echo
        "<form action='viewSection.php' method='POST'>
            <input type='hidden' name='id' value='".$sec_id."'>
        </form>
        <script>
            document.forms[0].submit();
        </script>";
    
    }
}

