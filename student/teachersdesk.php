<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'S'){
  header("location: ../index.php");
}

$repoT=mysqli_query($mysqli, "SELECT DISTINCT teacher_id, subj_id FROM REPOSITORY WHERE ACTIVE = 1");

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
        <li class="breadcrumb-item active">Teachers' Repositories</li>
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
                  <input type="hidden" name="teacher" value="" required>
                  <input type="hidden" name="subjid" value="" required>

                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      while($repo=mysqli_fetch_array($repoT)) {
                        $nameT=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id = '".$repo[0]."' AND active = 1");
                        $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$repo[1]." AND active = 1");
                        if(mysqli_num_rows($nameT) == 1 && mysqli_num_rows($subjT) == 1) {
                          $name=mysqli_fetch_array($nameT);
                          $subj=mysqli_fetch_array($subjT);

                          $tName=$name[0]." ";
                          if($name[1]) { $tName.=$name[1][0].". "; }
                          $tName.=$name[2];
                          echo 
                          "<tr>
                            <td>".$tName."</td>
                            <td>".$subj[0]."</td>
                            <td><button type='button' class='btn btn-sm btn secondary'>
                              <a href='javascript:formSubmit(\"".$repo[0]."\", ".$repo[1].");' style='text-decoration:none; color: black'>Open</a>
                            </button></td>
                          </tr>";
                        }
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
  <script> 
    function formSubmit(teacher, subjid) 
    {     
      document.forms[0].teacher.value = teacher;
      document.forms[0].subjid.value = subjid;
      document.forms[0].submit();
    }
  </script>
</body>
</html>