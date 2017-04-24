<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T') {
  header("location: ../index.php");
}

$id = $_POST['id'];
$subj_id = $_POST['subj'];

$subjNameT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$subj_id." ");
$subjName=mysqli_fetch_array($subjNameT);

$gradesT=mysqli_query($mysqli, "SELECT DISTINCT grade_level FROM grades WHERE student_id = '".$id."' AND active = 1 ORDER BY grade_level");
$cnt=mysqli_num_rows($gradesT);

$studT=mysqli_query($mysqli, "SELECT * FROM student WHERE student_id = '".$id."' ");
$stud=mysqli_fetch_array($studT);

$avgT=mysqli_query($mysqli, "SELECT * FROM grades WHERE student_id = '".$id."' AND subj_id = ".$subj_id." AND active = 1 ORDER BY grade_level");
$size=mysqli_num_rows($avgT);

$grarray = array();
while($grades=mysqli_fetch_array($gradesT)) {
  array_push($grarray, $grades[0]);
}

$len = count($grarray);


?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Performance Tracker</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header-teacher.php"); ?>
  </header>

  <div class="app-body">
    <?php require("sidebar-teacher.php"); ?>
    <main class="main">

      <ol class="breadcrumb">
        <li class="breadcrumb-item">Performance Tracker</li>
        <li class="breadcrumb-item active"><a href="studentprog.php">View</a></li>
        <li class="breadcrumb-item active">Student Progress</li>
      </ol>

      <div class="container-fluid">

        <div class="row">
          <div class='col-lg-3'></div>
          <?php
            $name = $stud[2]." ";
            if($stud[3]) {
              $name.= $stud[3]." ";
            }

            $name.= $stud[4];
            echo 
            "<div class='col-lg-6'><div class='card'>
                <div class='card-header'>
                  <strong>
                    Performance of ".$name." in ".$subjName[0]."
                  </strong>
                </div>
                <canvas id='bar' class='bar'></canvas>
              </div></div>";
          ?>
        </div>

      </div>

    </main>
  </div>

  <script src="../js/angular.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/views/Chart.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script> 
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>

  <script>
  $(document).ready(function() {
      var ctx = $('#bar');
      var colors = getRandomColor()
      var data = {
        labels: [
        <?php
          for($j = 0; $j < $len; $j++) {
            echo '"Grade '.$grarray[$j].'"';
            if($j != $len - 1) {
              echo ", ";
            }
          }
        ?>
        ],
        datasets: [
          {
            label: 'Grade',
            backgroundColor: colors,
            borderColor: colors,
            borderWidth: 1,
            data: [
            <?php 
              for($g=0; $grade=mysqli_fetch_array($avgT); $g++) {

                $fgrade=round($grade[4]);
                $sgrade=round($grade[5]);
                $tgrade=round($grade[6]);
                $frgrade=round($grade[7]);

                $avg=round(($fgrade + $sgrade + $tgrade + $frgrade)/4);
                echo $avg;

                if($g != $size - 1) {
                  echo ", ";
                }
              }
            ?>
            ],  
          }] 
        };

        propertyTypes= new Chart(ctx, {
          type: 'bar',
          data: data,
          options: {
            legend: {
              display: false
            },
            scales: {
              yAxes: [{
                ticks: {
                  max: 100,
                  min: 75
                }
              }]
            }
          }
        });


      function getRandomColor(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var j;

        for(j = 0; j < 6; j++){
            color += letters[Math.floor(Math.random() * 16)];
        }

        return color;
      }

  });
  </script>
</body>
</html>
