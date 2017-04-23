<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T') {
  header("location: ../index.php");
}

$id=$_SESSION['id'];

$stmt="SELECT * FROM class WHERE teacher_id = '".$id."' AND active = 1";
$table=mysqli_query($mysqli, $stmt);

$takenClass=mysqli_query($mysqli, "SELECT sched_id from class WHERE active = 1 order by sched_id");

$taken = array();
while($tClass=mysqli_fetch_array($takenClass)) {
  array_push($taken, $tClass[0]);
}

echo implode(", ", $taken);

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
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header-teacher.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar-teacher.php") ?>
    <main class="main">  
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Class Schedule</li>
        <li class="breadcrumb-item active">Manage</li>                
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Current Schedule
                </div>
                <div class="card-block">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Schedule</th>
                        <th>Section</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      while($row=mysqli_fetch_array($table)) {
                        $schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id = ".$row[1]." AND active = 1");
                        $sched=mysqli_fetch_array($schedT);

                        $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$sched[1]."");
                        $subj=mysqli_fetch_array($subjT);

                        $date=date("h:i A", strtotime($sched[3]))." - ".date("h:i A", strtotime($sched[4]));
                        $days= "";

                        if($sched[5] & 1){ $days = "M"; }
                        if($sched[5] & 2){ $days .= "T"; }
                        if($sched[5] & 4){ $days .= "W"; }
                        if($sched[5] & 8){ $days .= "TH"; }
                        if($sched[5] & 16){ $days .= "F"; }
                        if($sched[5] & 32){ $days .= "Sat"; }
                        if($sched[5] & 64){ $days .= "Sun"; }

                        $date .= " ".$days;

                        $secT=mysqli_query($mysqli, "SELECT section_name FROM subsection WHERE sec_id =".$row[3]."");
                        $sec=mysqli_fetch_array($secT);

                        echo 
                        "<tr>
                          <td>".$subj[0]."</td>
                          <td>".$date."</td>
                          <td>".$sec[0]."</td>
                          <td>
                            <a href='deleteSched.php?id=".$row[0]."'><button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button>
                          </a>
                        </tr>";   
                      }

                    ?>
                    </tbody>
                  </table>
                  <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addsubj"><i class="icon-plus"></i> Add</button>
                  <button class="btn btn-sm btn-secondary"><i class="icon-doc"></i> Print</button>
                </div>
            </div>
          </div>
        </div>
      </div> <!-- end container -->

    </main>
  </div>

  <div class="modal" id="addsubj" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped table-condensed">
            <thead>
              <tr>
                <th>Subject</th>
                <th>Schedule</th>
                <th>Section</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $scheds=mysqli_query($mysqli,"SELECT * FROM schedule WHERE sched_id NOT IN (".implode(", ", $taken).") AND active = 1");
              while($sched=mysqli_fetch_array($scheds)){
                $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$sched[1]." AND active = 1");
                if(mysqli_num_rows($subjT) == 1) {
                  $subj=mysqli_fetch_array($subjT);

                  $date=date("h:i A", strtotime($sched[3]))." - ".date("h:i A", strtotime($sched[4]));
                  $days= "";

                  if($sched[5] & 1){ $days = "M"; }
                  if($sched[5] & 2){ $days .= "T"; }
                  if($sched[5] & 4){ $days .= "W"; }
                  if($sched[5] & 8){ $days .= "TH"; }
                  if($sched[5] & 16){ $days .= "F"; }
                  if($sched[5] & 32){ $days .= "Sat"; }
                  if($sched[5] & 64){ $days .= "Sun"; }

                  $date .= " ".$days;      

                  echo 
                  "<tr>
                    <td>Grade ".$sched[2]." - ".$subj[0]."</td>
                    <td>".$date."</td>
                    <td>".$sched[4]."</td>
                    <td>
                      <a href='data7.php?level=".$row[0]."&subject=".$row[1]."&sched=".$row[2]."&teach=".$_GET["name"]."'>
                        <button role='select' class='btn btn-sm btn-warning'>
                          <i class='icon-minus'></i> Select
                        </button>
                      </a>
                  </tr>"; 
                }  
              }
            ?>
            </tbody>
          </table>
        </div>

        <div class="modal-footer">
          <button data-dismiss="modal" type="button" class="btn btn-primary">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>     
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>
  <script src="../js/views/main.js"></script>

</body>
</html>