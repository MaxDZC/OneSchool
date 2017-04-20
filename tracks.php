<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])){
    header("location: index.php");
}

$studT=mysqli_query($mysqli,"SELECT * FROM student WHERE student_id = '".$_SESSION['id']."'");
$stud=mysqli_fetch_array($studT);

$cnt=$stud[6];

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

<!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

<style type="text/css">
    /* Add a black background color to the top navigation */
.topnav {
    background-color: #1e2f2f;
    overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 10px 10px 10px 10px;
    text-decoration: none;
    font-size: 14.5px;
}

/* Change the color of links on hover */
.topnav a:hover {
    background-color: #0099cc;
    color: white;
}

/* Add a color to the active/current link */
.topnav a.active {
    background-color: #4CAF50;
    color: red;
}
</style>

</head>

<body onload="loadtables();" class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
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
                    <div class="col-lg-6">                         
                    <div class="card">
                        <div class="card-block">
                        <div class="panel panel-green">
                            <div class="panel-heading"><h4 class="panel-title"><i class="icon-chart"></i> Tracks</h4></div> 
                            <div class="panel-body">
                                <canvas id="bar" class="bar" height="150%"></canvas>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>

                   <div class="col-lg-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-trophy"></i> RANK OF TRACKS</h4>
                                    </div>
                                </div>
                                <div class="card-block">
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
                                            <tr id="rank1">
                                            </tr>
                                            <tr id="rank2">
                                            </tr>
                                            <tr id="rank3">
                                            </tr>
                                            <tr id="rank4">
                                            </tr>
                                        </tbody>
                                    </table>   
                                </div>
                            </div>
                        </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                          <div class="card-header"><center><strong>Summary of Grades</strong></center></div>
                            <table class="table table-striped table-bordered">  
                                <thead>
                                    <tr>
                                        <th rowspan="2">
                                            <center>Subject</center>
                                        </th>
                                        <?php 
                                            for($i=1; $i <= $cnt; $i++){
                                              echo "<th>
                                                      <center>Grade ".$i."</center>
                                                    </th>";
                                            }
                                            echo "<th>
                                                    <center>Average</center>
                                                  </th>";
                                        ?>
                                    </tr>
                            </thead>
                            <tbody>
                              <?php
                                $gradeArray = array();
                                $subjArray = array();
                                for($i = 1; $i < 13; $i ++) {
                                    $sum=0;
                                    $num=0;
                                    echo "<tr><td>";
                                    $subjT=mysqli_query($mysqli, "SELECT * FROM subjects WHERE subj_id =".$i." AND active = 1");
                                    $subj=mysqli_fetch_array($subjT);
                                    echo $subj[1]."</td>";
                                    array_push($subjArray, $subj[1]);
                                    for($j = 1; $j <= $cnt; $j++) {
                                        echo "<td><center>";
                                        $gradeT=mysqli_query($mysqli, "SELECT * FROM grades WHERE student_id = '".$_SESSION['id']."' AND grade_level = ".$j." AND subj_id = ".$i." AND active = 1");
                                        $grade=mysqli_fetch_array($gradeT);
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
            <!-- /.conainer-fluid -->
        </main>
    </div>

    <footer class="app-footer">

    </footer>
</body>

</html>


 <!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/views/Chart.js"></script>
<script src="js/views/Charts.js"></script>
<script src="js/views/main.js"></script>
<script src="js/app.js"></script>

<!-- Bootstrap and necessary plugins -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/tether/dist/js/tether.min.js"></script>
<script src="bower_components/pace/pace.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script> 
<!-- Plugins and scripts required by all views -->
<script src="bower_components/chart.js/dist/Chart.min.js"></script>
<script src="js/piechart.js"></script>

<script>
$(document).ready(function() {    
    var options = {
        legend: {
            position: "bottom",
            labels: {
                padding: 20
            }
        }
    };
    var ctx = $("#pie");    
        // data
    var colors = getRandomColors();
    var data = {
        labels: [
        <?php
          $lim = count($subjArray);
          for($i=0; $i<$lim; $i++) {
            echo '"'.$subjArray[$i].'"';
            if($i != $lim - 1) {
              echo ", ";
            }
          }
        ?>
        ],
        datasets: [
            {
                data:[
                <?php
                  for($j=0; $j<$lim; $j++) {
                    echo $gradeArray[$j];
                    if($i != $lim - 1) {
                      echo ", ";
                    }
                  }
                ?>

                ],
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9],
                    colors[10],
                    colors[11]
                ],
                hoverBackgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9],
                    colors[10],
                    colors[11]
                ]
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'pie',
        data: data,
        options: options
    });

    ctx = $("#bar");
    colors = getRandomColors();
    data = {
        labels: ["HUMSS", "STEM", "ABM", "GAS"],
        datasets: [
            {
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
                    $rankArray= array();
                    for($m=2; $m<6; $m++) {
                      $gpa = 0;
                      for($k=0; $k<$lim; $k++) {
                        $stat = false;
                        $gradeAT=mysqli_query($mysqli, "SELECT * FROM gradeanalysis");
                        while($gradeA=mysqli_fetch_array($gradeAT)) {
                          if($gradeA[1] == $subjArray[$k]) {
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

    };

    // Property Type Distribution
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

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

    <?php
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