<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
    header("location: ../index.php");
}

$ann=mysqli_query($mysqli, "SELECT * FROM announcement WHERE active = 1");
$num=mysqli_num_rows($ann);

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Welcome Page</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header-admin.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar-admin.php") ?>
    <main class="main">

      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
          <a href="welcome-admin.php">
            Welcome
          </a>
        </li>
        <li class="breadcrumb-item active">New Announcement</li>     
      </ol>

      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                 <i class="fa fa-align-justify"></i> Post an Announcement
              </div>
              <div class="card-block">
                <form action="insertAnn.php" method="POST">
                  <fieldset class="form-group">
                    <input class="form-control" type="text" name="title" value="" placeholder="Title of the Announcement" required>
                  </fieldset>
                  <fieldset class="form-group">
                    <textarea rows="8" class="form-control" type="text" name="ann" value="" placeholder="Announcement Content" required></textarea>
                  </fieldset>
                  <fieldset class="form-group">
                    Who can see this? <br>
                    <span ng-repeat="i in [1,2,3,4,5,6,7,8,9,10]" class="col-md-6">
                      <input type="checkbox" name="{{i}}" value="{{i}}"> Grade {{i}}
                    </span>
                  </fieldset>
                
                  <button class="btn btn-sm btn-success">
                    <span class="icon-plus"></span> Post
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      
      </div> <!-- End of container -->
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