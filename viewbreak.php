<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])) {
  header("location: index.php");
}

$weightT=mysqli_query($mysqli, "SELECT * FROM gradebreakdown WHERE admin_id IS NOT NULL AND subj_id =".$_GET['subjid']." AND grade_level = ".$_GET['grad']." AND active = 1");
$weight=mysqli_fetch_array($weightT);

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
<meta name="author" content="Łukasz Holeczek">
<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
<link rel="shortcut icon" href="img/favicon.png">

<title>One School - View Grades</title>

<!-- Icons -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/simple-line-icons.css" rel="stylesheet">

<!-- Main styles for this application -->
<link href="css/style.css" rel="stylesheet">

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
            <li class="breadcrumb-item"><a href="viewgrades.php?grade=<?php echo $_GET['grad']; ?>">View</a></li>
            <li class="breadcrumb-item active">Breakdown</li>
            </li>
        </ol>


        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <center><strong><h1>
                    <?php
                      $subjT=mysqli_query($mysqli, "SELECT subject  FROM subjects WHERE subj_id = ".$_GET['subjid']." ");
                      $subj=mysqli_fetch_array($subjT);

                      $gradp="";
                      switch($_GET['gper']) {
                        case 1:
                          $gradp = "First"; break;
                        case 2:
                          $gradp = "Second"; break;
                        case 3:
                          $gradp = "Third"; break;
                        case 4:
                          $gradp = "Fourth";
                      }

                      echo "Grade ".$_GET['grad']." - ".$subj[0]." - ".$gradp." Grading";
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
                </h4></strong></center></div>
                  <?php
                    $assSum=0;
                    $assT=mysqli_query($mysqli, "SELECT * FROM assign WHERE stud_id = '".$_SESSION['id']."' AND subj_id = ".$_GET['subjid']." AND grade_level = ".$_GET['grad']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY ass_num");

                    if(($cnt = mysqli_num_rows($assT)) != 0) {
                      echo '<table class="table table-striped table-bordered">  
                              <thead>
                              <tr>';

                      for($i = 1; $i <= $cnt; $i++) {
                        echo "<th>
                                <center>".$i."</center>
                              </th>";
                      }
                      echo "<th>
                              <center>Average</canter>
                            </th></tr>
                        </thead><tbody><tr>";

                      while($ass=mysqli_fetch_array($assT)) {
                        echo "<td>
                                <center>".$ass[4]."</center>
                              </td>";
                              $assSum+= $ass[4];
                      }
                      echo "<td>
                              <center>".round($assSum/$cnt, 2)."</center>
                            </td>";

                      echo "</tr></tbody></table>";
                    } else {
                      echo "This student has not done any homeworks.";
                    }
                  ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header"><center><strong><h4>
                  Seatworks <?php echo " (".$weight[8]."%)"; ?>
                </h4></strong></center></div>
                  <?php
                    $swSum=0;
                    $swT=mysqli_query($mysqli, "SELECT * FROM seatwork WHERE stud_id = '".$_SESSION['id']."' AND subj_id = ".$_GET['subjid']." AND grade_level = ".$_GET['grad']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY sw_num");

                    if(($cnt = mysqli_num_rows($swT)) != 0) {
                      echo '<table class="table table-striped table-bordered">  
                              <thead>
                              <tr>';

                      for($i = 1; $i <= $cnt; $i++) {
                        echo "<th>
                                <center>".$i."</center>
                              </th>";
                      }
                      echo "<th>
                              <center>Average</center>
                            </th></tr>
                        </thead><tbody><tr>";

                      while($sw=mysqli_fetch_array($swT)) {
                        echo "<td>
                                <center>".$sw[4]."</center>
                              </td>";
                              $swSum += $sw[4];
                      }

                      echo "<td>
                              <center>".round($swSum/$cnt, 2)."</center>
                            </td></tr></tbody></table>";
                    } else {
                      echo "This student has not taken any seatworks.";
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
                </h4></strong></center></div>
                  <?php
                    $qSum=0;
                    $qT=mysqli_query($mysqli, "SELECT * FROM quiz WHERE stud_id = '".$_SESSION['id']."' AND subj_id = ".$_GET['subjid']." AND grade_level = ".$_GET['grad']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY quiz_num");

                    if(($cnt = mysqli_num_rows($qT)) != 0) {
                      echo '<table class="table table-striped table-bordered">  
                              <thead>
                              <tr>';

                      for($i = 1; $i <= $cnt; $i++) {
                        echo "<th>
                                <center>".$i."</center>
                              </th>";
                      }
                      echo "<th>
                              <center>Average</canter>
                            </th></tr>
                        </thead><tbody><tr>";

                      while($q=mysqli_fetch_array($qT)) {
                        echo "<td>
                                <center>".$q[4]."</center>
                              </td>";
                              $qSum+= $q[4];
                      }
                      echo "<td>
                              <center>".round($qSum/$cnt, 2)."</center>
                            </td>";

                      echo "</tr></tbody></table>";
                    } else {
                      echo "This student has not taken any quizzes.";
                    }
                  ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header"><center><strong><h4>
                  Projects <?php echo " (".$weight[10]."%)"; ?>
                </h4></strong></center></div>
                  <?php
                    $projSum=0;
                    $projT=mysqli_query($mysqli, "SELECT * FROM project WHERE stud_id = '".$_SESSION['id']."' AND subj_id = ".$_GET['subjid']." AND grade_level = ".$_GET['grad']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY proj_num");

                    if(($cnt = mysqli_num_rows($projT)) != 0) {
                      echo '<table class="table table-striped table-bordered">  
                              <thead>
                              <tr>';

                      for($i = 1; $i <= $cnt; $i++) {
                        echo "<th>
                                <center>".$i."</center>
                              </th>";
                      }
                      echo "<th>
                              <center>Average</center>
                            </th></tr>
                        </thead><tbody><tr>";

                      while($proj=mysqli_fetch_array($projT)) {
                        echo "<td>
                                <center>".$proj[4]."</center>
                              </td>";
                              $projSum += $proj[4];
                      }

                      echo "<td>
                              <center>".round($projSum/$cnt, 2)."</center>
                            </td></tr></tbody></table>";
                    } else {
                      echo "This student has not completed any projects.";
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
                </h4></strong></center></div>
                  <?php
                    $mexT=mysqli_query($mysqli, "SELECT * FROM exam WHERE stud_id = '".$_SESSION['id']."' AND subj_id = ".$_GET['subjid']." AND grade_level = ".$_GET['grad']." AND grade_per = ".$_GET['gper']." AND exam_type = 'ME' AND active = 1");

                    if(mysqli_num_rows($mexT) != 0) {
                      echo '<table class="table table-striped table-bordered">  
                              <thead>
                              <tr>
                                <th>
                                  <center><h5>Midterm Exam Grade</h5></canter>
                                </th>
                                </tr>
                        </thead><tbody><tr>';

                    $mex=mysqli_fetch_array($mexT); 
                        echo "<td>
                                <center><strong><h5>".$mex[4]."</h5></strong></center>
                              </td>";

                      echo "</tr></tbody></table>";
                    } else {
                      echo "This student didn't take this exam yet.";
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
                </h4></strong></center></div>
                  <?php
                    $pexT=mysqli_query($mysqli, "SELECT * FROM exam WHERE stud_id = '".$_SESSION['id']."' AND subj_id = ".$_GET['subjid']." AND grade_level = ".$_GET['grad']." AND grade_per = ".$_GET['gper']." AND exam_type = 'PE' AND active = 1");

                    if(mysqli_num_rows($pexT) != 0) {
                      echo '<table class="table table-striped table-bordered">  
                              <thead>
                              <tr>
                              <th>
                                <center><h5>Periodical Exam Grade</h5></center>
                              </th>
                              </tr>
                        </thead><tbody><tr>';

                      $pex=mysqli_fetch_array($pexT);
                        echo "<td>
                                <center><strong><h5>".$pex[4]."</h5></strong></center>
                              </td>";

                      echo "</tr></tbody></table>";
                    } else {
                      echo "This student has not taken any seatworks.";
                    }
                  ?>
              </div>
            </div>
          </div>

        </div>
        <!-- /.conainer-fluid -->
    </main>




</div>

<footer class="app-footer">

</footer>

<!-- Bootstrap and necessary plugins -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/tether/dist/js/tether.min.js"></script>
 
<script src="bower_components/pace/pace.min.js"></script>


<!-- Plugins and scripts required by all views -->
<script src="bower_components/chart.js/dist/Chart.min.js"></script>


 <!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- GenesisUI main scripts -->

<script src="js/app.js"></script>





<!-- Plugins and scripts required by this views -->

<!-- Custom scripts required by this view -->
<script src="js/views/main.js"></script>

</body>

</html>