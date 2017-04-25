<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_SESSION["id"];

$selectT=mysqli_query($mysqli,"SELECT * FROM admin WHERE admin_id='".$id."'");
$select=mysqli_fetch_array($selectT);

$name = $select[2]." "; 
if($select[3]) { $name.= $select[3][0].". "; } 
$name.= $select[4];

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Profile Page</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <style>
  div.fileinputs {
    position: relative;
  }

  div.fakefile {
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 1;
  }

  input.file {
    position: relative;
    text-align: right;
    -moz-opacity:0 ;
    filter:alpha(opacity: 0);
    opacity: 0;
    z-index: 2;
  }

  .btn-bs-file{
    position:relative;
  }

  .btn-bs-file input[type="file"]{
    position: absolute;
    top: -9999999;
    filter: alpha(opacity=0);
    opacity: 0;
    width:0;
    height:0;
    outline: none;
    cursor: inherit;
  }

  td:nth-child(1) {
    width: 40%;
    padding-right:50px;
    padding-left:50px;
  }
  td:nth-child(2) {
    width: 60%;
  }
  </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header-admin.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar-admin.php") ?>  
    <main class="main">            
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item active">View</li>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-default">
              <div class="card-header">
                  Administrator Details
              </div>

              <!-- Profile Picture Settings -->
              <form id="form" method="POST" action="updateProfPic-admin.php" enctype="multipart/form-data">
                <div class="fileinputs" style="margin: 2%">
                  <input type="file" name="photo" id="file" class="file" accept="image/*">
                  <div class="fakefile">
                    <label class="btn-bs-file btn btn-sm btn-primary" style="width:110%; height:120%;">
                      <i class="icon-camera"> Change Profile Pic</i>
                    <input type="file"/>
                    </label>
                  </div>
                </div>
              </form>

              <center>
                <img src="
                  <?php if($select[5]) { echo $select[5]; } else { echo "img/lecture-1.png"; } ?>" 
                  class="img-avatar" width="20%" style="padding: 2%">
              </center>

              <div class="card-block">
                <table class="table table-striped table-bordered">
                  <tr>
                    <td>Name: </td>
                    <td><?php echo $name; ?></td>
                  </tr>
                  <tr>
                    <td>ID Number:</td>
                    <td> <?php echo $select[0]; ?></td>
                  </tr>
                </table>
              </div>

            </div>   
          </div>
        </div>
      
      </div> <!-- End of Container -->
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
  document.getElementById("file").onchange = function() {
    document.getElementById("form").submit();
  };
  </script>

</body>
</html>
