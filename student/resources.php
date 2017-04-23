<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'S'){
    header("location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Learning Resources</title>

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
        <li class="breadcrumb-item">Learning Resources</li>
        <li class="breadcrumb-item active">Visit</li>
      </ol>

      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-6">
            <div class="card card-inverse card-primary">              
              <div class="card-header">
                <h3>Universal Library</h3>
              </div>
              <div class="card-block">
                <a href="library.php">
                  <center><img src="../img/bookshelf.png" width="490px"></center>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card card-inverse card-success">
              <div class="card-header">
                <h3>Teachers' Repositories</h3>
              </div>
              <div class="card-block">
                <a href="teachersdesk.php">
                  <center><img src="../img/desk.png" width="490px"></center>
                </a>
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
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>