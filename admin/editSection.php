<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["id"];

$sectionT=mysqli_query($mysqli,"SELECT * FROM subsection WHERE sec_id = ".$id." ");
$teacherList = mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName, teacher_id FROM teacher WHERE active = 1 ORDER BY t_lName");

$section=mysqli_fetch_array($sectionT);

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Create Teacher</title>

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
        <li class="breadcrumb-item">Admin Tasks</li>
        <li class="breadcrumb-item"><a href="createclass.php">Create Class</a></li>
        <li class="breadcrumb-item active">Edit Section: <?php echo $section[3]; ?></li>
      </ol>

      <div class="container-fluid">

        <div class="row col-lg-16 card">
          <div class="card-header">
            <strong>Section <?php echo $section[3]; ?></strong>
          </div>

          <div class="card-block">

            <form action="updateSection.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $id; ?>">

              <div class="form-group row">
                <label class="col-md-3 form-control-label">Section Name: </label>
                <div class="col-md-4">
                  <input type="text" name="name" value="<?php echo $section[3]; ?>" class="form-control" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 form-control-label">Size: </label>
                <div class="col-md-4">
                  <input type="number" name="size" value="<?php echo $section[4]; ?>" class="form-control" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 form-control-label">Adviser: </label>
                <div class="col-md-4">
                  <select name="teacher" class="form-control">
                  <?php
                    while($teacher=mysqli_fetch_array($teacherList)) {
                      $name = $teacher[2].", ".$teacher[0];
                      if($teacher[1]) { $name.= " ".$teacher[1][0]."."; }

                      echo "<option value='".$teacher[3]."' "; 
                      if($teacher[3] == $section[1]) { echo "selected"; }
                      echo " >".$name."</option>";
                    }
                  ?>
                  </select>
                </div>
              </div>
            
              <button class="btn btn-md btn-success">
                <i class="icon-plus"></i> Update Section
              </button>

            </form>                   
          </div>

        </div> <!-- Row and stuff -->              
      
      </div> <!-- Container Ending -->

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