<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name'])) {
  header("location: ../index.php");
}

$grad=$_POST['grad'];
$subjid=$_POST['subjid'];
$gper=$_POST['gper'];

$weightT=mysqli_query($mysqli, "SELECT * FROM gradebreakdown WHERE admin_id IS NOT NULL AND subj_id =".$subjid." AND grade_level = ".$grad." AND active = 1");
$weight=mysqli_fetch_array($weightT);

$subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$subjid." ");
$subj=mysqli_fetch_array($subjT);

$cond = "stud_id = '".$_SESSION['id']."' AND subj_id = ".$subjid." AND grade_level = ".$grad." AND grade_per = ".$gper." AND active = 1";

$assT=mysqli_query($mysqli, "SELECT * FROM assign WHERE ".$cond." ORDER BY ass_num");

$swT=mysqli_query($mysqli, "SELECT * FROM seatwork WHERE ".$cond." ORDER BY sw_num");

$qT=mysqli_query($mysqli, "SELECT * FROM quiz WHERE ".$cond." ORDER BY quiz_num");

$projT=mysqli_query($mysqli, "SELECT * FROM project WHERE ".$cond." ORDER BY proj_num");

$mexT=mysqli_query($mysqli, "SELECT * FROM exam WHERE ".$cond." AND exam_type = 'ME'");

$pexT=mysqli_query($mysqli, "SELECT * FROM exam WHERE ".$cond." AND exam_type = 'PE'");

$gradp="";
switch($gper) {
  case 1:
    $gradp = "First"; break;
  case 2:
    $gradp = "Second"; break;
  case 3:
    $gradp = "Third"; break;
  case 4:
    $gradp = "Fourth";
}

?>

<!DOCTYPE html>
<html lang="en" ng-app>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - View Grade Breakdown</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar.php"); ?>
    <main class="main">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Grade Reports</li>
        <li class="breadcrumb-item"><a href="viewgrades.php">View</a></li>
        <li class="breadcrumb-item active">Breakdown</li>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <center><strong><h1>
                  <?php
                    echo "Grade ".$_POST['grad']." - ".$subj[0]." - ".$gradp." Grading";
                  ?>
                </h1></strong></center>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><center><strong><h4>
                Homeworks and Assignments <?php echo " (".$weight[9]."%)"; ?>
                </h4></strong></center>
              </div>
              <?php
                $assSum=0;
                if(($cnt = mysqli_num_rows($assT)) != 0) {
                  echo "<table class='table table-striped table-bordered'><thead><tr>";

                  for($i = 1; $i <= $cnt; $i++) {
                    echo "<th><center>".$i."</center></th>";
                  }
                  echo "<th><center>Average</canter></th></tr></thead><tbody><tr>";

                  while($ass=mysqli_fetch_array($assT)) {
                    echo "<td><center>".$ass[4]."</center></td>";
                    $assSum+= $ass[4];
                  }
                  echo "<td><center>".round($assSum/$cnt, 2)."</center></td></tr></tbody></table>";
                } else {
                  echo "Your homeworks have not been recorded yet.";
                }
              ?>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><center><strong><h4>
                Seatworks <?php echo " (".$weight[8]."%)"; ?>
                </h4></strong></center>
              </div>
              <?php
                $swSum=0;
                if(($cnt = mysqli_num_rows($swT)) != 0) {
                  echo "<table class='table table-striped table-bordered'><thead><tr>";

                  for($i = 1; $i <= $cnt; $i++) {
                    echo "<th><center>".$i."</center></th>";
                  }
                  echo "<th><center>Average</center></th></tr></thead><tbody><tr>";

                  while($sw=mysqli_fetch_array($swT)) {
                    echo "<td><center>".$sw[4]."</center></td>";
                    $swSum += $sw[4];
                  }

                  echo "<td><center>".round($swSum/$cnt, 2)."</center></td></tr></tbody></table>";
                } else {
                  echo "Your seatworks have not been recorded yet.";
                }
              ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><center><strong><h4>
                Quizzes <?php echo " (".$weight[7]."%)"; ?>
                </h4></strong></center>
              </div>
              <?php
                $qSum=0;
                if(($cnt = mysqli_num_rows($qT)) != 0) {
                  echo "<table class='table table-striped table-bordered'><thead><tr>";

                  for($i = 1; $i <= $cnt; $i++) {
                    echo "<th><center>".$i."</center></th>";
                  }
                  echo "<th><center>Average</canter></th></tr></thead><tbody><tr>";

                  while($q=mysqli_fetch_array($qT)) {
                    echo "<td><center>".$q[4]."</center></td>";
                    $qSum+= $q[4];
                  }
                  echo "<td><center>".round($qSum/$cnt, 2)."</center></td></tr></tbody></table>";
                } else {
                  echo "Your quizzes have not been recorded yet.";
                }
              ?>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><center><strong><h4>
                Projects <?php echo " (".$weight[10]."%)"; ?>
                </h4></strong></center>
              </div>
              <?php
                $projSum=0;
                if(($cnt = mysqli_num_rows($projT)) != 0) {
                  echo "<table class='table table-striped table-bordered'><thead><tr>";

                  for($i = 1; $i <= $cnt; $i++) {
                    echo "<th><center>".$i."</center></th>";
                  }
                  echo "<th><center>Average</center></th></tr></thead><tbody><tr>";

                  while($proj=mysqli_fetch_array($projT)) {
                    echo "<td><center>".$proj[4]."</center></td>";
                    $projSum += $proj[4];
                  }

                  echo "<td><center>".round($projSum/$cnt, 2)."</center></td></tr></tbody></table>";
                } else {
                  echo "Your projects have not been recorded yet.";
                }
              ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-1">
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header"><center><strong><h4>
                Midterm Exam <?php echo " (".$weight[11]."%)"; ?>
                </h4></strong></center>
              </div>
              <?php
                if(mysqli_num_rows($mexT) != 0) {
                  $mex=mysqli_fetch_array($mexT); 
                  echo "<table class='table table-striped table-bordered'>  
                  <thead>
                  <tr>
                  <th>
                   <center><h5>Midterm Exam Grade</h5></canter>
                  </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <td>
                      <center><strong><h5>".$mex[4]."</h5></strong></center>
                  </td>
                  </tr>
                  </tbody>
                  </table>";
                } else {
                  echo "Your midterm exam has not been recorded yet.";
                }
              ?>
            </div>
          </div>
          <div class="col-lg-2">
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header"><center><strong><h4>
                Periodical Exam <?php echo " (".$weight[12]."%)"; ?>
                </h4></strong></center>
              </div>
              <?php
                if(mysqli_num_rows($pexT) != 0) {         
                  $pex=mysqli_fetch_array($pexT);
                  echo "<table class='table table-striped table-bordered'>  
                    <thead>
                    <tr>
                    <th>
                      <center><h5>Periodical Exam Grade</h5></center>
                    </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td>
                      <center><strong><h5>".$pex[4]."</h5></strong></center>
                    </td>
                    </tr>
                    </tbody>
                    </table>";
                } else {
                  echo "Your periodical exam has not been recorded yet.";
                }
              ?>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>