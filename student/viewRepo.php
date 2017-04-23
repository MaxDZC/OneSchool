<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'S'){
  header("location: ../index.php");
}

$tId= $_POST['teacher'];
$subj_id = $_POST['subjid'];

$repoT=mysqli_query($mysqli, "SELECT * FROM repository WHERE teacher_id = '".$tId."' AND active = 1 ORDER BY item_id");
$nameT=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id = '".$tId."' AND active = 1");
$subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$subj_id." AND active = 1");

$name=mysqli_fetch_array($nameT);
$subj=mysqli_fetch_array($subjT);

$tName=$name[0]." ";
if($name[1]) { 
  $tName.=$name[1][0].". "; 
}
$tName.=$name[2];

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Teachers' Repositories</title>

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
        <li class="breadcrumb-item"><a href="resources.php">Visit</a></li>
        <li class="breadcrumb-item"><a href="teachersdesk.php">Teachers' Repositories</a></li>
        <li class="breadcrumb-item active"><?php echo $tName." - ".$subj[0]; ?></li>
      </ol>

      <div class="container-fluid">    
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <i class="fa fa-folder"></i> Repositories
              </div>
              <div class="card-block">
                <form action="viewRepo.php" method="POST">
                  <input type="hidden" name="item" value="" reqiured>
                  
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>Filename</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      while($repo=mysqli_fetch_array($repoT)) {
                        $fileName=basename($repo[3]);
                        echo 
                        "<tr>
                          <td>".$fileName."</td>
                          <td><button type='button' class='btn btn-sm btn secondary'>
                            <a href='../teacher/".$repo[3]."' style='text-decoration:none; color: black' download>Download</a>
                          </button></td>
                        </tr>";
                      }
                    ?>
                    </tbody>
                  </table>

                </form>

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