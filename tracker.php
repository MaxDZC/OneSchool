<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])){
    header("location: index.php");
}

$subjT=mysqli_query($mysqli, "SELECT DISTINCT subj_id FROM grades WHERE student_id = '".$_SESSION['id']."' AND active = 1 ORDER By subj_id");
$cnt=mysqli_num_rows($subjT);

$gradesT=mysqli_query($mysqli, "SELECT DISTINCT grade_level FROM grades WHERE student_id = '".$_SESSION['id']."' AND active = 1 ORDER BY grade_level");

$grarray = array();
while($grades=mysqli_fetch_array($gradesT)) {
  array_push($grarray, $grades[0]);
}

$subArray = array();
while($subjs=mysqli_fetch_array($subjT)) {
  array_push($subArray, $subjs[0]);
}

$len = count($grarray);
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

    <title>One School - Performance Tracker</title>

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
                <li class="breadcrumb-item">Performance Tracker</li>
                <li class="breadcrumb-item active">View</li>
            </ol>
            <div class="container-fluid">
            <?php
              for($i=0; $i<$cnt; $i++) {
                if($i % 2 == 0) {
                  echo "<div class='row'>";
                }
                  $subjNameT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$subArray[$i]." ");
                  $subjName=mysqli_fetch_array($subjNameT);

                  echo "<div class='col-lg-6'><div class='card'>
                          <div class='card-header'>
                            <strong>
                              ".$subjName[0]."
                            </strong>
                          </div>
                          <canvas id='bar".$i."' class='bar'></canvas>
                        </div></div>";
                  if($i % 2 != 0) {
                    echo "</div>";
                  }
              }
            ?>
            </div>
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
    var ctx;
    var colors;
    var data;
<?php
  for($i = 0; $i < $cnt; $i++) {
    echo "ctx = $('#bar".$i."');
          colors = getRandomColors();
          data= {
            labels: [";

      for($j = 0; $j < $len; $j++) {
        echo '"Grade '.$grarray[$j].'"';
        if($j != $len - 1) {
          echo ", ";
        }
      }
      echo "],
      datasets: [
        {
            label: 'Grade',
            backgroundColor: [
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0]
            ],
            borderColor: [
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0],
                colors[0]
            ],
            borderWidth: 1,
            data: [";

        $avgT=mysqli_query($mysqli, "SELECT * FROM grades WHERE student_id = '".$_SESSION['id']."' AND subj_id = ".$subArray[$i]." AND active = 1 ORDER BY grade_level");
        $size=mysqli_num_rows($avgT);
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

        echo "],  }] };
          propertyTypes= new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    max: 100,
                    min: 75
                  }
                }]
              }
            }
          });";
  }?>
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

});
</script>