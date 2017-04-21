<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name'])){
  header("location: ../index.php");
}

if(!isset($_POST['grade'])) {
  $level = 1;
} else {
  $level = $_POST['grade'];
}

$result=mysqli_query($mysqli, "SELECT grade_level FROM STUDENT WHERE student_id = '".$_SESSION['id']."'");
$gradelvl=mysqli_fetch_array($result);

$table=mysqli_query($mysqli,"SELECT * FROM grades WHERE student_id='".$_SESSION['id']."' AND grade_level =".$level." AND active = 1");



?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - View Grades</title>

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
    <?php include("header.php"); ?>
  </header>

  <div class="app-body">
    <?php require("sidebar.php"); ?>
    <main class="main">          
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Grade Reports</li>
        <li class="breadcrumb-item active">View</li>
      </ol>

      <div class="container-fluid">
        <div class="topnav" id="myTopnav">
          <form action="viewGrades.php" method="POST">
            <input type="hidden" name="grade" value="-1">
            <?php 
              $grad=$gradelvl[0];
              for($i = 1; $i <= $grad; $i++){
                echo "<a href='javascript:formGrades(".$i.");'>Grade $i</a>";
              }
            ?>
          </form>
        </div>
        <br>
          <div class="row">
            <div class="col-lg-12" id="grades">                                    
              <div class="card">
                <div class='card-header'><strong>Grade $level</strong></div>
                  <div class='card-block'>
                    <form action="viewbreak.php" method="POST">
                      <input type="hidden" name="grad" value="" required>
                      <input type="hidden" name="subjid" value="" required>
                      <input type="hidden" name="gper" value="" required>

                      <table class='table table-striped table-bordered'>
                        <thead>
                          <th>Subject</th>
                          <th>First Grading</th>
                          <th>Second Grading</th>
                          <th>Third Grading</th>
                          <th>Fourth Grading</th>
                          <th>Average</th>
                        </thead>
                        <tbody>
                        <?php
                          $i=1;
                          for($i=1; $row=mysqli_fetch_array($table); $i++){
                            $subject=mysqli_query($mysqli, "SELECT * FROM SUBJECTS WHERE subj_id =".$row[1]."");
                            $subj=mysqli_fetch_array($subject);
                            $first=round($row[4]);
                            $second=round($row[5]);
                            $third=round($row[6]);
                            $fourth=round($row[7]);
                            $avg=($first + $second + $third + $fourth)/4;
                            echo 
                            "<tr>
                              <td>
                                $subj[1]
                              </td>
                              <td>
                                <center>
                                  <a href='javascript:formBreak(".$level.", ".$i.", 1)' style='text-decoration:none; color: black'>$first</a>
                                </center>
                              </td>
                              <td>
                                <center>
                                  <a href='javascript:formBreak(".$level.", ".$i.", 2)' style='text-decoration:none; color: black'>$second</a>
                                </center>
                              </td>
                              <td>
                                <center>
                                  <a href='javascript:formBreak(".$level.", ".$i.", 3)' style='text-decoration:none; color: black'>$third</a>
                                </center>
                              </td>
                              <td>
                                <center>
                                  <a href='javascript:formBreak(".$level.", ".$i.", 4)' style='text-decoration:none; color: black'>$fourth</a>
                                </center>
                              </td>
                              <td>
                                <center>".number_format($avg, 2)."</center>
                              </td>
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
  <script src="../js/jquery.js"></script>
  <script src="../js/app.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <script> 
    function formGrades(grade) 
    {     
      document.forms[0].grade.value = grade;
      document.forms[0].submit();
    }

    function formBreak(grad, subjid, gper) 
    {     
      document.forms[1].grad.value = grad;
      document.forms[1].subjid.value = subjid;
      document.forms[1].gper.value = gper;
      document.forms[1].submit();
    }
  </script>
</body>
</html>

