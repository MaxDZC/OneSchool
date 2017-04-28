<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$table=mysqli_query($mysqli,"SELECT * FROM subsection WHERE active = 1");
$teacherList = mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName, teacher_id FROM teacher WHERE active = 1 ORDER BY t_lName");

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Edit Section</title>

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
        <li class="breadcrumb-item active">Create Class</li>
      </ol>

      <div class="container-fluid">

        <div class="row col-lg-16 card">
          <div class="card-header">
            <strong>Created Classes/Sections</strong>
          </div>

          <div class="card-block">

            <form action="viewSectionSched.php" method="POST">
              <input type="hidden" name="id" value="" required>
            </form>

            <form action="viewSection.php" method="POST">
              <input type="hidden" name="id" value="" required>
            </form>

            <form action="editSection.php" method="POST">
              <input type="hidden" name="id" value="" required>
            </form>

            <form action="delSection.php" method="POST">
              <input type="hidden" name="id" value="" required>
            </form>

            <table class="table table-striped table-bordered">
              <thead>
                <th>Grade Level</th>
                <th>Section</th>
                <th>Adviser</th>
                <th>Enrolled Students</th>
                <th>Action</th>
              </thead>
              <tbody>
              <?php 
                while($row=mysqli_fetch_array($table)){
                  $teacherT=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id = '".$row[1]."' AND ACTIVE = 1");

                  if(mysqli_num_rows($teacherT) == 1) { 
                    $adv=mysqli_fetch_array($teacherT);

                    $name=$adv[2].", ".$adv[0];
                    if($adv[1]) { $name .= " ".$adv[1][0]."."; }

                    $classT=mysqli_query($mysqli, "SELECT class_id FROM class WHERE sec_id = ".$row[0]." AND active = 1");

                    if(mysqli_num_rows($classT) != 0) {

                      $classArray = array();
                      while($class=mysqli_fetch_array($classT)) {
                        array_push($classArray, $class[0]);
                      }

                      $answer=implode(", ", $classArray);
                      $num = count($classArray);

                      $enrolledT=mysqli_query($mysqli, "SELECT student_id FROM section WHERE class_id IN (".$answer.") group by student_id having count(student_id) = ".$num."");

                      $enrolled=mysqli_num_rows($enrolledT);

                      $num = $enrolled;
                    } else {
                      $num = 0;
                    }

                    echo 
                    "<tr>
                      <td><center>".$row[2]."</center></td>
                      <td>".$row[3]."</td>
                      <td>".$name."</td>
                      <td><center>".$num."/".$row[4]."</center></td>
                      <td>
                        <center>
                          <a href='javascript: viewSchedForm(".$row[0].")'>
                            <button type='submit' class='btn btn-sm btn-success'><i class='fa fa-circle-o'></i> View Schedule</button>
                          </a> 
                          <a href='javascript: viewForm(".$row[0].")'>
                            <button type='submit' class='btn btn-sm btn-success'><i class='fa fa-eye'></i> View Students</button>
                          </a>
                          <a href='javascript: editForm(".$row[0].")'>
                            <button type='submit' class='btn btn-sm btn-success'><i class='fa fa-pencil'></i> Edit Section</button>
                          </a>";

                    if($num == 0) {
                      echo "<a href='javascript: delForm(".$row[0].")'>
                            <button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button>
                          </a>";
                    }
                    echo "</center>
                      </td>
                    </tr>";
                  }
                }

              ?>
              </tbody>
            </table>
            
            <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addClass">
              <i class="icon-plus"></i> Add Section
            </button>                       
          </div>

        </div> <!-- Row and stuff -->              
      
      </div> <!-- Container Ending -->

    </main>
  </div>

  <div class="modal" id="addClass" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Class Creation</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-block">

                  <form action="insertSection.php" method="POST" class="form-horizontal">

                    <div class="form-group row">
                      <label class="col-md-3" for="grade">Grade: </label>
                      <div class="col-md-9">
                        <select name="grade" class="form-control" required>
                          <option value="" selected>Select Grade Level</option>
                          <option ng-repeat="i in [1,2,3,4,5,6,7,8,9,10]" value="{{i}}">Grade {{i}}</option>
                        </select>
                      </div>    
                    </div>
                                
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="section">Section: </label>
                      <div class="col-md-9">
                        <input type="text" name="section" class="form-control" placeholder="Section Name">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="studs">Max. No. of Students: </label>
                      <div class="col-md-9">
                        <input type="number" name="size" class="form-control" placeholder="Size of Section">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="studs">Adviser: </label>
                      <div class="col-md-9">
                        <select name="adviser" class="form-control" required>
                          <option value="" selected>Select an adviser</option>
                          <?php
                            while($teacher=mysqli_fetch_array($teacherList)) {
                              $teachName=$teacher[2].", ".$teacher[0];
                              if($teacher[1]) { $teachName .= " ".$teacher[1][0]."."; }
                              echo "<option value='".$teacher[3]."'>".$teachName."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>        
          </div>
        </div> <!-- Close modal body -->

      </div>
    </div>
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
    function viewSchedForm(id) 
    {
      document.forms[0].id.value = id;
      document.forms[0].submit();
    }

    function viewForm(id) 
    {
      document.forms[1].id.value = id;
      document.forms[1].submit();
    }

    function editForm(id) 
    {
      document.forms[2].id.value = id;
      document.forms[2].submit();
    }

    function delForm(id) 
    {
      document.forms[3].id.value = id;
      document.forms[3].submit();
    }

  </script>

</body>
</html>