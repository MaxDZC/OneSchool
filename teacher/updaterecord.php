<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T') {
  header("location: ../index.php");
}

$gbT=mysqli_query($mysqli, "SELECT * FROM gradebreakdown WHERE admin_id IS NOT NULL AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND active = 1");
$gb=mysqli_fetch_array($gbT);

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Manage Class</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">

  <style type="text/css">
  .topnav {
    background-color: #1e2f2f;
    overflow: hidden;
  }

  .topnav a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 10px 10px 10px 10px;
    text-decoration: none;
    font-size: 15px;
  }

  .topnav a:hover {
    background-color: #0099cc;
    color: white;
  }

  .topnav a.active {
    background-color: #4CAF50;
    color: red;
  }
  </style>

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header-teacher.php"); ?>
  </header>
  
    <div class="app-body">
        <?php include("sidebar-teacher.php") ?>      
        <main class="main">  
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Class Record</li>
                <li class="breadcrumb-item"><?php echo 'Grade '.$_GET["level"].' - '.$_GET["section"];?></li>
                <li class="breadcrumb-item active"><?php echo $_GET["subject"];?></li>
                
            </ol>
            <div class="container-fluid">
                <div class="topnav">
                  <a href="updaterecord.php?<?php echo "classid=".$_GET["classid"]."&gper=1&level=".$_GET["level"]."&section=".$_GET["section"]."&subject=".$_GET['subject']."&subj=".$_GET["subj"]; ?>">First Grading</a>
                  <a href="updaterecord.php?<?php echo "classid=".$_GET["classid"]."&gper=2&level=".$_GET["level"]."&section=".$_GET["section"]."&subject=".$_GET['subject']."&subj=".$_GET["subj"]; ?>">Second Grading</a>
                  <a href="updaterecord.php?<?php echo "classid=".$_GET["classid"]."&gper=3&level=".$_GET["level"]."&section=".$_GET["section"]."&subject=".$_GET['subject']."&subj=".$_GET["subj"]; ?>">Third Grading</a>
                  <a href="updaterecord.php?<?php echo "classid=".$_GET["classid"]."&gper=4&level=".$_GET["level"]."&section=".$_GET["section"]."&subject=".$_GET['subject']."&subj=".$_GET["subj"]; ?>">Fourth Grading</a>
                </div>                                
                <br>
                <div class="row" >
                    <div class="col-lg-12" >
                        <div class="card">
                            <div class="card-header">
                                 <strong>Records: 
                                  <?php 
                                    $grading =""; 
                                    switch($_GET["gper"]) {
                                      case 1: $grading = "First"; break;
                                      case 2: $grading = "Second"; break;
                                      case 3: $grading = "Third"; break;
                                      case 4: $grading = "Fourth";
                                    }
                                    echo " ".$grading." Grading";
                                  ?></strong>
                            </div>
                            <div class="card-block" id="box" style="height: 500px; background-color: white">

                            <!--
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr align="center">
                                            <th rowspan="2" valign="middle"><center>ID Number</center></th>
                                            <th colspan="5"><center>HW & A <?php /* echo "  (".$gb[9]."%)";?></center></th>
                                            <th colspan="5"><center>Seatworks <?php echo "  (".$gb[8]."%)"; ?></center></th>
                                            <th colspan="5"><center>Quizzes<?php echo "  (".$gb[7]."%)"; ?></center></th>
                                            <th colspan="5"><center>Projects<?php echo "  (".$gb[10]."%)"; ?></center></th>
                                            <th rowspan="2"><center>Midterms<?php echo "  (".$gb[11]."%)"; ?></center></th>
                                            <th rowspan="2"><center>Periodicals<?php echo "  (".$gb[12]."%)"; ?></center></th>
                                            <th rowspan="2"><center>Equiv. Grade</center></th>
                                        </tr>
                                        <tr>
                                        <?php
                                          for($i=0; $i<4; $i++) {
                                            for($j=1; $j<6; $j++) {
                                              echo "<td>".$j."</td>";
                                            }
                                          }
                                        ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    /*
                                      $table=mysqli_query($mysqli,"SELECT student_id FROM section WHERE class_id = ".$_GET['classid']." AND active = 1");

                                      while($row=mysqli_fetch_array($table)) {
                                        echo "<tr><td>".$row[0]."</td>";

                                        $assignT=mysqli_query($mysqli, "SELECT score FROM assign WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY ass_num");

                                          for($i=0; $i<5 && $assign=mysqli_fetch_array($assignT); $i++) {
                                            echo "<td>".$assign[0]."</td>";
                                          }

                                        $swT=mysqli_query($mysqli, "SELECT score FROM seatwork WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY sw_num");

                                          for($i=0; $i<5 && $sw=mysqli_fetch_array($swT); $i++) {
                                            echo "<td>".$sw[0]."</td>";
                                          }      

                                        $quizT=mysqli_query($mysqli, "SELECT score FROM quiz WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY quiz_num");

                                          for($i=0; $i<5 && $quiz=mysqli_fetch_array($quizT); $i++) {
                                            echo "<td>".$quiz[0]."</td>";
                                          }

                                        $projT=mysqli_query($mysqli, "SELECT score FROM project WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY proj_num");

                                          for($i=0; $i<5 && $proj=mysqli_fetch_array($projT); $i++) {
                                            echo "<td>".$proj[0]."</td>";
                                          }   

                                        $mexT=mysqli_query($mysqli, "SELECT score FROM exam WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND exam_type='ME' AND active = 1");

                                          $mex=mysqli_fetch_array($mexT);
                                          echo "<td><center><h5>".$mex[0]."</center></h5></td>";

                                         $pexT=mysqli_query($mysqli, "SELECT score FROM exam WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND exam_type='PE' AND active = 1");

                                          $pex=mysqli_fetch_array($pexT);
                                          echo "<td><center><h5>".$pex[0]."</center></h5></td>";

                                        $gradeT=mysqli_query($mysqli, "SELECT * FROM grades WHERE student_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND teacher_id = '".$_SESSION['id']."' AND active = 1");

                                          $grade=mysqli_fetch_array($gradeT);
                                          echo "<td><center><h5>".round($grade[$_GET['gper'] + 3], 2)."</center></h5></td>";

                                      }
*/
                                    ?>
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

      </div>

        </main>





    </div>

    <script src="../codebase/spreadsheet.php?sheet=1&parent=box&math=true"></script>
    <script src="../js/angular.js"></script>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/tether/dist/js/tether.min.js"></script>   
    <script src="../bower_components/pace/pace.min.js"></script>
    <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>
    