<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$grade = $_POST["grade"];
$subject = $_POST["subject"];

$subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$subject." ");
$gaT=mysqli_query($mysqli, "SELECT * FROM gradebreakdown WHERE teacher_id IS NULL AND student_id IS NULL AND grade_level = ".$grade." AND subj_id = ".$subject." AND active = 1");

$subj=mysqli_fetch_array($subjT);
$ga=mysqli_fetch_array($gaT);

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

  <style type="text/css">
    /* Add a black background color to the top navigation */
    .topnav {
        background-color: #1e2f2f;
        overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 10px 10px 10px 10px;
        text-decoration: none;
        font-size: 15px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: #0099cc;
        color: white;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
        background-color: #4CAF50;
        color: red;
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
        <li class="breadcrumb-item"><a href="createcat.php">Subject Management</a></li>
        <li class="breadcrumb-item active">Breakdown for: <?php echo $subj[0]; ?></li>
      </ol>


      <div class="container-fluid">

        <div class="topnav" id="myTopnav">
          <form action="editWeights.php" method="POST">
            <input type="hidden" name="subject" value ="<?php echo $subject; ?>">
            <input type="hidden" name="grade" value="">
            <?php 
              for($i = 1; $i <= 10; $i++){
                echo "<a href='javascript:formGrades(".$i.");'>Grade $i</a>";
              }
            ?>
          </form>
        </div>

        <br>

        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="card">

              <div class="card-header">
                <strong>Weights for <?php echo $subj[0]." for Grade ".$grade; ?></strong>
              </div>

              <form action="updateWeights.php" onsubmit="return validate();" method="POST">
                <input type="hidden" name="grade" value="<?php echo $grade; ?>">
                <input type="hidden" name="subject" value="<?php echo $subject; ?>">

                <div class="card-block">

                  <div class="form-group row">
                    <label class="col-md-3 form-control-label">Quiz (%):</label>
                    <div class="col-md-3">
                      <input type="number" name="quiz" class="form-control" value="<?php echo $ga[7]; ?>" placeholder="Quiz Weight" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 form-control-label">Seatwork (%):</label>
                    <div class="col-md-3">
                      <input type="number" name="sw" class="form-control" value="<?php echo $ga[8]; ?>" placeholder="Seatwork Weight" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 form-control-label">Assignment (%):</label>
                    <div class="col-md-3">
                      <input type="number" name="assign" class="form-control" value="<?php echo $ga[9]; ?>" placeholder="Assignment Weight" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 form-control-label">Project (%):</label>
                    <div class="col-md-3">
                      <input type="number" name="proj" class="form-control" value="<?php echo $ga[10]; ?>" placeholder="Project Weight" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 form-control-label">Midterm (%):</label>
                    <div class="col-md-3">
                      <input type="number" name="mexam" class="form-control" value="<?php echo $ga[11]; ?>" placeholder="Midterm Exam Weight" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 form-control-label">Periodical (%):</label>
                    <div class="col-md-3">
                      <input type="number" name="pexam" class="form-control" value="<?php echo $ga[12]; ?>" placeholder="Periodical Exam Weight" required>
                    </div>
                  </div>


                  <button class="btn btn-md btn-success" data-toggle="modal" data-target="#addSubject">
                    <i class="icon-plus"></i> Update Weights
                  </button> 
                </form>                  
              </div>
            </div>
          </div>
        </div>

      </div> <!-- Container End -->

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
    function formGrades(grade)
    {
      document.forms[0].grade.value = grade;
      document.forms[0].submit();
    }

    function validate()
    {
      quiz = parseFloat(document.forms[1].quiz.value);
      sw = parseFloat(document.forms[1].sw.value);
      assign = parseFloat(document.forms[1].assign.value);
      proj = parseFloat(document.forms[1].proj.value);
      mexam = parseFloat(document.forms[1].mexam.value);
      pexam = parseFloat(document.forms[1].pexam.value);

      if(quiz + sw + assign + proj + mexam + pexam != 100) {
        alert("The sum must be 100!");
        return false;
      } else {
        return true;
      }
    }
  </script>
</body>
</html>