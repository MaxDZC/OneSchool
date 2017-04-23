<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'S'){
    header("location: ../index.php");
}

$studT=mysqli_query($mysqli,"SELECT * FROM student WHERE student_id = '".$_SESSION['id']."'");
$stud=mysqli_fetch_array($studT);

$cnt=$stud[6];

$subjT=mysqli_query($mysqli, "SELECT DISTINCT subj_id FROM grades WHERE student_id = '".$_SESSION['id']."' AND active = 1 ORDER By subj_id");

$gradeArray = array();
$subjArray = array();
$subjNArray = array();

while($subjs=mysqli_fetch_array($subjT)) {
  array_push($subjArray, $subjs[0]);
}

$lim=count($subjArray);

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - View Grades</title>

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
    <?php require("sidebar.php"); ?>
    <main class="main">

      <ol class="breadcrumb">
        <li class="breadcrumb-item">Track Analysis</li>
        <li class="breadcrumb-item active">View</li>
      </ol>

      <div class="container-fluid">

        <div class="row">

          <div class="col-lg-6"> <!-- Bar Chart Here -->                     
            <div class="card" height="200px">
              <div class="card-block">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="icon-chart"></i> Tracks</h4>
                </div> 
                <br>
                <div class="panel-body">
                  <canvas id="bar" class="bar"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6"> <!-- Rankings Here -->
            <div class="card" height="200px">
              <div class="card-block">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-trophy"></i> RANK OF TRACKS</h4>
                </div>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Track</th>
                      <th>Status</th>
                      <th>GPA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr id="rank1"></tr>
                    <tr id="rank2"></tr>
                    <tr id="rank3"></tr>
                    <tr id="rank4"></tr>
                  </tbody>
                </table>   
              </div>
            </div>
          </div>

        </div> <!-- end of first row -->
                
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <center><strong>Summary of Grades</strong></center>
              </div>
              <table class="table table-striped table-bordered">  
                <thead>
                  <tr>
                    <th style="display: table-cell; vertical-align: middle;" rowspan="2">
                      <center>Subject</center>
                    </th>
                    <?php 
                      for($i=1; $i <= $cnt; $i++){
                        echo 
                        "<th rowspan='2'>
                          <center>Grade ".$i."</center>
                        </th>";
                      }

                      echo 
                      "<th style='display: table-cell; vertical-align: middle;' rowspan='2'>
                        <center >Average</center>
                      </th>";
                    ?>
                  </tr>
                </thead>
                <tbody>
                <?php
                  for($i = 0; $i < $lim; $i++) {
                    $subjT=mysqli_query($mysqli, "SELECT * FROM subjects WHERE subj_id =".$subjArray[$i]." AND active = 1");
                    $subj=mysqli_fetch_array($subjT);
                    
                    array_push($subjNArray, $subj[1]);

                    $sum=0;
                    $num=0;

                    echo 
                    "<tr>
                      <td>".$subj[1]."</td>";
                    
                    for($j = 1; $j <= $cnt; $j++) {
                      $gradeT=mysqli_query($mysqli, "SELECT * FROM grades WHERE student_id = '".$_SESSION['id']."' AND grade_level = ".$j." AND subj_id = ".$subjArray[$i]." AND active = 1");
                      $grade=mysqli_fetch_array($gradeT);

                      echo "<td><center>";

                      if(mysqli_num_rows($gradeT) == 0){
                        echo "N/A";
                      } else {
                        $fgrade=round($grade[4]);
                        $sgrade=round($grade[5]);
                        $tgrade=round($grade[6]);
                        $frgrade=round($grade[7]);

                        $avg=round(($fgrade + $sgrade + $tgrade + $frgrade)/4);

                        echo $avg;
                        
                        $sum+=$avg;
                        $num++;
                      }
                      echo "</center></td>";
                    }

                    echo "<td><center>";

                    if($sum!=0 && $num!=0){
                      echo $sum/$num;
                      array_push($gradeArray, $sum/$num);
                    } else {
                      echo "N/A";
                      array_push($gradeArray, 0);
                    }

                    echo "</center></td></tr>";
                  }
                ?>     
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div> <!-- Closing of container -->
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

  <script>
  $(document).ready(function() {    
    var ctx = $("#bar");
    var colors = getRandomColors();
    var data = {
      labels: ["HUMSS", "STEM", "ABM", "GAS"],
      datasets: [{
        label: "Grade Point Average",
        backgroundColor: [
          colors[0],
          colors[1],
          colors[2],
          colors[3]
        ],
        borderColor: [
          colors[0],
          colors[1],
          colors[2],
          colors[3]
        ],
        borderWidth: 1,
        data: [

        <?php
          // Magic aka Analysis
          $rankArray= array();

          for($m=2; $m<6; $m++) {
            $gpa = 0;

            for($k=0; $k<$lim; $k++) {
              $stat = false;
              $gradeAT=mysqli_query($mysqli, "SELECT * FROM gradeanalysis");

              while($gradeA=mysqli_fetch_array($gradeAT)) {
                if($gradeA[1] == $subjNArray[$k]) {
                  $stat = true;
                  break;
                }
              }

              if($stat) {
                $gpa += round($gradeArray[$k]*($gradeA[$m]/100), 2);
                if($m == 2) {
                  $rankArray['HUMSS'] = $gpa;
                } else if($m == 3) {
                  $rankArray['STEM'] = $gpa;
                } else if($m == 4) {
                  $rankArray['ABM'] = $gpa;
                } else {
                  $rankArray['GAS'] = $gpa;
                }
              }
            }
            echo $gpa;

            if($m != 5) {
              echo ", ";
            }

          }
        ?>
        ],
      }]
    }; // End of data 

    propertyTypes = new Chart(ctx ,{
      type: 'bar',
      data: data,
      options: {
        legend : {
          display: false
        },
        scales : {
          yAxes: [{
            ticks: {
              max: 100,
              min: 75
            }
          }]
        }
      }
    });

    function getRandomColors(){
      var letters = "0123456789ABCDEF";
      var color = "#";
      var colors = new Array();
      var i, j;

      for(i = 0; i < 4; i++){
          for(j = 0; j < 6; j++){
              color += letters[Math.floor(Math.random() * 16)];
          }
          colors[i] = color;
          color = "#";
      }

      return colors;
    }

    <?php
      // For the rankings based on student grades
      arsort($rankArray, -1);
      $p=1;

      foreach ($rankArray as $key => $value) {

        if($key == "HUMSS") {
          if($value < 75) {
            $btn = 'danger">FAILED';
          } else {
            $btn = 'primary">PASSED';
          }
        } else if($value < 80) {
          $btn = 'danger">FAILED';
        } else {
          $btn = 'primary">PASSED';
        }
        echo "$('#rank".$p."').html('<td>".$p."</td><td>".$key."</td><td><span style=\"padding: 5px\" class=\"btn-".$btn."</span></td><td>".$value."</td>');";
        $p++;
        
      }
    ?>
  });
  </script>

</body>
</html> 