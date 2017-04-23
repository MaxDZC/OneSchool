<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'S') {
    header("location: ../index.php");
}

$gradeT=mysqli_query($mysqli, "SELECT grade_level FROM STUDENT WHERE student_id = '".$_SESSION['id']."' ");
$grade=mysqli_fetch_array($gradeT);

$tuitionMiscT=mysqli_query($mysqli, "SELECT * FROM tuition WHERE grade IS NULL and active = 1");
$tuitionT=mysqli_query($mysqli, "SELECT * FROM tuition WHERE grade = ".$grade[0]." AND active = 1 ORDER BY grade");
$historyT=mysqli_query($mysqli, "SELECT * FROM tuition_history WHERE student_id = '".$_SESSION['id']."' AND active = 1 ORDER BY date_paid");

?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - View Assessment</title>

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
      <li class="breadcrumb-item">Assessment Report</li>
      <li class="breadcrumb-item active">View</li>
    </ol>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <i class="icon-notebook"></i> Payment History
              </div>
              <div class="card-block">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Payment Amount</th>
                      <th>Date Received</th>
                      <th>Person In-charge</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sumPaid = 0;
                    while($history=mysqli_fetch_array($historyT)) {
                      $name=$history[6]." ";
                      if($history[7]) { $name.= $history[7]." "; }
                      $name.=$history[8];
                      $sumPaid += $history[3];
                      echo "
                      <tr>
                        <td>
                          ".$history[4]."
                        </td>
                        <td>
                          Php ".number_format($history[3], 2)."
                        </td>
                        <td>
                          ".date("m/d/Y", strtotime($history[5]))."
                        </td>
                        <td>
                          ".$name."
                        </td>
                      </tr>";
                    }

                    echo 
                    "<tr>
                      <td></td>
                      <td></td>
                      <td><b>Total Paid Amount: </b></td>
                      <td>Php ".number_format($sumPaid, 2)."</td>
                    </tr>";

                  ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                 <i class="icon-notebook"></i> Tuition Fees
              </div>
              <div class="card-block">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>Period</th>
                      <th>Payment Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sumToPay=0;
                    while($tuition = mysqli_fetch_array($tuitionT)) {
                      $sumToPay+=$tuition[4];
                      switch($tuition[2]) {
                        case 1: $grading="First"; break;
                        case 2: $grading="Second"; break;
                        case 3: $grading="Third"; break;
                        case 4: $grading="Fourth";
                      }
                      echo 
                      "<tr>
                        <td>".$grading." Grading</td>
                        <td>Php ".number_format($tuition[4], 2)."</td>
                      </tr>";
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <i class="icon-notebook"></i> Other Fees
              </div>
              <div class="card-block">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Payment Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    while($tuitionMisc=mysqli_fetch_array($tuitionMiscT)) {
                      $sumToPay+=$tuitionMisc[4];
                      echo 
                      "<tr>
                        <td>".$tuitionMisc[1]."</td>
                        <td>Php ".number_format($tuitionMisc[4], 2)."</td>
                      </tr>";
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <table class="table table-striped table-condensed">
                  <tr>
                    <td><h3>Current Balance: </h3></td>
                    <td><h3>Php <?php echo number_format($sumToPay - $sumPaid, 2); ?></h3></td>
                  </tr>
                </table>
              </div>
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
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>