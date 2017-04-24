<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T') {
  header("location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Student Progress</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">

  <style>
    .hide {
      display: none;
    }
  </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header-teacher.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar-teacher.php") ?>     
    <main class="main">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Student Progress</li>
        <li class="breadcrumb-item active">View</li>
      </ol>

      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="card">
              <div class="card-block">
                <form>
                  <div class="form-group">
                    <label for="group">Subject and Group</label>
                    <select class="form-control" id="drop">
                      <option value='' selected>Please Select...</option>
                      <?php 
                        $table=mysqli_query($mysqli, "SELECT * FROM class WHERE teacher_id = '".$_SESSION['id']."' AND active = 1");
                        while($row=mysqli_fetch_array($table)){
                          $secT=mysqli_query($mysqli, "SELECT grade_level, section_name FROM subsection WHERE sec_id = ".$row[3]." AND active = 1");

                          if(mysqli_num_rows($secT) != 0) {
                            $sec=mysqli_fetch_array($secT);
                            $schedT=mysqli_query($mysqli, "SELECT subj_id FROM schedule WHERE sched_id = ".$row[1]." AND active = 1");

                            if(mysqli_num_rows($schedT) != 0) {
                              $sched=mysqli_fetch_array($schedT);
                              $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$sched[0]." AND active = 1");

                              if(mysqli_num_rows($subjT) != 0) {
                                $subj=mysqli_fetch_array($subjT);
                                echo "<option value=".$row[0].">Grade ".$sec[0]." - ".$sec[1]." : ".$subj[0]."</option>";
                              }
                            }
                          }
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>  <!-- end row -->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">

            <div class="card-header">
              <strong>Enrolled Students</strong>
            </div>

            <div class="card-block">

              <form action="viewprogress.php" method="POST">
                <input type="hidden" name="id" value="" required>
                <input type="hidden" name="subj" value="" required>
              </form>

              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>ID Number</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <?php
                    $classT=mysqli_query($mysqli, "SELECT class_id, sched_id FROM class WHERE teacher_id = '".$_SESSION['id']."' AND active = 1");
                    if(mysqli_num_rows($classT) != 0) {

                      while($class=mysqli_fetch_array($classT)) {

                        $sectionT=mysqli_query($mysqli, "SELECT student_id FROM section WHERE class_id = ".$class[0]." AND active = 1");

                        if(mysqli_num_rows($sectionT) != 0) {

                          echo "<tbody id='tablebody".$class[0]."' class='hide'>";

                            while($section=mysqli_fetch_array($sectionT)) {

                              $studentT=mysqli_query($mysqli, "SELECT s_fName, s_mName, s_lName, student_id FROM student WHERE student_id = '".$section[0]."' AND active = 1");
                              $student=mysqli_fetch_array($studentT);

                              $name=$student[2].", ".$student[0];
                              if($student[1]) { $name.= " ".$student[1][0]."."; }

                              $subjT=mysqli_query($mysqli, "SELECT subj_id FROM schedule WHERE sched_id = ".$class[1]." AND active=1");

                              if(mysqli_num_rows($subjT) != 0) {
                                $subj=mysqli_fetch_array($subjT);
                                echo 
                                "<tr>
                                    <td>".$section[0]."</td>
                                    <td>".$name."</td>
                                    <td><a href='javascript: viewProg(\"".$student[3]."\", ".$subj[0].")'><button class='btn btn-md btn-success'><i class='fa fa-circle-o'></i> View</button></a></td>
                                </tr>";      
                             }
                          }
                          echo "</tbody>";
                        }
                      }
                    }
                  ?>
              </table>
            </div>
          </div>
        </div>
      </div>

      </div> <!-- end container -->

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
    var stat;
    var id;
    var prev;

    stat = false;

    $("#drop").change(function() {
      if(stat) {
        $(prev).attr("class", "hide");
      }
      id = $("#drop").find(":selected").val();
      table= "#tablebody"+id;
      $(table).attr("class", "");
      prev = table;
      stat = true;
    });


    function viewProg(id, subj)
    {
      document.forms[1].id.value = id;
      document.forms[1].subj.value = subj;
      document.forms[1].submit();
    }
  </script>
</body>
</html>