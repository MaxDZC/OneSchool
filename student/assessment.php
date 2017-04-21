<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name'])) {
    header("location: ../index.php");
}

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
                    <tr>
                      <td>Tuition Fee</td>
                      <td>Php 5000.00</td>
                      <td>7/20/2016</td>
                      <td>Leni de Castro</td>
                    </tr>
                    <tr>
                      <td>Medical Fee</td>
                      <td>Php 400.00</td>
                      <td>8/11/2016</td>
                      <td>Walter Disney</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td><b>Total Paid Amount: </b></td>
                      <td>Php 5400.00</td>
                    </tr>
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
                    <tr>
                      <td>First Grading</td>
                      <td>Php 5000.00</td>
                    </tr>
                    <tr>
                      <td>Second Grading</td>
                      <td>Php 5000.00</td>
                    </tr>
                    <tr>
                      <td>Third Grading</td>
                      <td>Php 5000.00</td>
                    </tr>
                    <tr>
                      <td>Fourth Grading</td>
                      <td>Php 5000.00</td>
                    </tr>
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
                                  <tr>
                                      <td>School Bus</td>
                                      <td>Php 500.00</td>
                                  </tr>
                                  <tr>
                                      <td>Library Fee</td>
                                      <td>Php 300.00</td>
                                  </tr>
                                   <tr>
                                      <td>Medical Fee</td>
                                      <td>Php 400.00</td>
                                  </tr>
                                  <tr>
                                      <td>Online System Fee</td>
                                      <td>Php 100.00</td>
                                  </tr>
                                  <tr>
                                      <td><b>Current Balance: </b></td>
                                      <td>Php 15900.00</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
              </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>   
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/piechart.js"></script>
</body>
</html>