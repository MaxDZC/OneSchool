<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["id"];

$selectT=mysqli_query($mysqli,"SELECT * FROM teacher WHERE teacher_id='".$id."'");
$select=mysqli_fetch_array($selectT);

?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Edit Teacher Profile</title>

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
        <li class="breadcrumb-item">Admin Tasks</li>
        <li class="breadcrumb-item"><a href="createteach.php">Teacher Creation</a></li>
        <li class="breadcrumb-item active"><?php echo $id; ?></li>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-default">
              <div class="card-header">
                  Teacher Details
              </div>

              <!-- Profile Picture part -->
              <form id="form" method="POST" action="updateProfPic-teacher.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>" required>
                <div class="fileinputs" style="margin: 2%">
                  <input type="file" name="photo" id="file" class="file" accept="image/*">
                  <div class="fakefile">
                    <label class="btn-bs-file btn btn-sm btn-primary" style="width:110%; height:120%;">
                      <i class="icon-camera"> Change Profile Pic</i>
                    </label>
                  </div>
                </div>
              </form>

              <center>
                <img src="
                  <?php if($select[8]) { echo "../teacher/".$select[8]; } else { echo "../teacher/img/lecture-1.png"; } ?>" 
                  class="img-avatar" width="20%" style="padding: 2%">
              </center>

              <form action="updateTeach.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                <div class="card-block">
                  <table class="table table-striped table-bordered">
                    <tr>
                      <td><strong>First Name: </strong></td>
                      <td><input class="form-control" type="text" name="fName" value= "<?php echo $select[2]; ?>" required></td>
                    </tr>
                    <tr>
                      <td><strong>Middle Name: </strong></td>
                      <td><input class="form-control" type="text" name="mName" value= "<?php echo $select[3]; ?>"></td>
                    </tr>
                    <tr>
                      <td><strong>Last Name: </strong></td>
                      <td><input class="form-control" type="text" name="lName" value= "<?php echo $select[4]; ?>"></td>
                    </tr>
                    <tr>
                      <td><strong>Address: </strong></td>
                      <td><input class="form-control" type="text" name="address" value= "<?php echo $select[5]; ?>"></td>
                    </tr>
                    <tr>
                      <td><strong>Email Address: </strong></td>
                      <td><input class="form-control" type="email" name="email" value= "<?php echo $select[6]; ?>"></td>
                    </tr>
                    <tr>
                      <td><strong>Birthday: </strong></td>
                      <td>
                        <input class="form-control" type="date" name="bday" value="<?php echo $select[7]; ?>" required><br>
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Educational Attainment: </strong></td>
                      <td>
                        <select name="ed_att" class="form-control" required>
                          <option value="High School" <?php if($select[9] == "High School") { echo "selected"; } ?>>High School Graduate</option>
                          <option value="Bachelor" <?php if($select[9] == "Bachelor") { echo "selected"; } ?>>College Undergraduate</option>
                          <option value="Master" <?php if($select[9] == "Master") { echo "selected"; } ?>>Master's Graduate</option>
                          <option value="Doctorate" <?php if($select[9] == "Doctorate") { echo "selected"; } ?>>PhD Graduate</option>
                        </select>
                      </td>
                    </tr>
                  </table>
                  <button type="submit" class='btn btn-md btn-success'><i class='icon-note'></i> Update</button>
                </div>
              </form>
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
    document.getElementById("file").onchange = function() {
      document.getElementById("form").submit();
    };
  </script>

</body>
</html>