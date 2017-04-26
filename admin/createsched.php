<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE active = 1 ORDER BY time_start, grade_level");
$subjList=mysqli_query($mysqli, "SELECT * FROM subjects WHERE active = 1 ORDER BY subj_id");

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
        <li class="breadcrumb-item active">Schedule Plot</li>
      </ol>

      <div class="container-fluid">

        <div class="row col-lg-16 card">

          <div class="card-header">
            <strong>Created Schedules</strong>
          </div>

          <div class="card-block">

            <form action="editSched.php" method="POST">
              <input type="hidden" name="id" value="" required>
            </form>

            <form action="editSched.php">
              <input type="hidden" name="id" value="" required>
            </form>

            <table class="table table-striped table-bordered">
              <thead>
                <th>Grade Level</th>
                <th>Subject</th>
                <th>Time</th>
                <th>Teacher</th>
                <th>Action</th>
              </thead>
              <tbody>
              <?php
                while($row=mysqli_fetch_array($schedT)) {
                  $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$row[1]." AND ACTIVE = 1");
                  $classT=mysqli_query($mysqli, "SELECT teacher_id FROM class WHERE sched_id = ".$row[0]." and active = 1");

                  if(mysqli_num_rows($subjT) == 1) {
                    $subj=mysqli_fetch_array($subjT);

                    $date=date("h:i A", strtotime($row[3]))." - ".date("h:i A", strtotime($row[4]));
                    $days= "";

                    if($row[5] & 1){ $days = "M"; }
                    if($row[5] & 2){ $days .= "T"; }                                                
                    if($row[5] & 4){ $days .= "W"; }
                    if($row[5] & 8){ $days .= "TH"; }  
                    if($row[5] & 16){ $days .= "F"; }
                    if($row[5] & 32){ $days .= "Sat"; } 
                    if($row[5] & 64){ $days .= "Sun"; }

                    $date .= " ".$days;

                    
                    $class=mysqli_fetch_array($classT);

                    $teacherT=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id = '".$class[0]."' AND ACTIVE = 1");

                    if(mysqli_num_rows($teacherT) == 1) {
                      $teacher=mysqli_fetch_array($teacherT);
                      $name = $teacher[2].", ".$teacher[0];
                      if($teacher[1]) {
                        $name .= " ".$teacher[1][0].".";
                      }
                    } else {
                      $name = "No Teacher Yet";
                    }

                    echo "
                    <tr>
                      <td><center>".$row[2]."</center></td>
                      <td>".$subj[0]."</td>
                      <td>".$date."</td>
                      <td>".$name."</td>
                      <td>
                        <center>
                          <a href='javascript: formEdit(".$row[0].")'>
                            <button class='btn btn-sm btn-success'>
                              <i class='icon-check'></i> Edit
                            </button> 
                          </a>
                          <a href='data11.php?level=".$row[0]."&subj=".$row[1]."&sched=".$row[2]."'>
                        <button class='btn btn-sm btn-danger'>
                          <i class='icon-minus'></i> Delete
                        </button></a>
                        </center>
                      </td>
                      </tr>";
                  }
                }
              ?>
              </tbody>
            </table>

            <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addstud"><i class="icon-plus"></i> Add Schedule</button>                        
          </div>
        </div>                
      
      </div> <!-- Container End -->    
    </main>
  </div>
        
  <div class="modal" id="addstud" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Schedule Maker</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">

                <div class="card-block">

                  <form action="insertSched.php" onsubmit="return validate();" method="POST" class="form-horizontal">

                    <div class="form-group row">
                        <label class="col-md-3 form-control-label">Grade Level</label>
                        <div class="col-md-9">
                          <select name="grade" class="form-control" required>
                            <option value="">Select Grade Level...</option>
                            <option ng-repeat="i in [1,2,3,4,5,6,7,8,9,10]" value="{{i}}">Grade {{i}}</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Subject</label>
                      <div class="col-md-9">
                        <select name="subj_id" class="form-control" required>
                          <option value="">Select Subject...</option>
                          <?php
                            while($subj=mysqli_fetch_array($subjList)) {
                              echo "
                              <option value='".$subj[0]."' >".$subj[1]."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Time Start</label>
                      <div class="col-md-4">
                        <input type="time" name="time_start"  required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Time End</label>
                      <div class="col-md-4">
                        <input type="time" name="time_end"  required>
                      </div>
                    </div>

                    On what days? <br>
                    <div class="form-group row">
                      <span class="col-md-6">
                        <input type="checkbox" id="mon" name="0" value="0"> Monday
                      </span>
                      <span class="col-md-6">
                        <input type="checkbox" id="tue" name="1" value="1"> Tuesday
                      </span>
                      <span class="col-md-6">
                        <input type="checkbox" id="wed" name="2" value="2"> Wednesday
                      </span>
                      <span class="col-md-6">
                        <input type="checkbox" id="thu" name="3" value="3"> Thursday
                      </span>
                      <span class="col-md-6">
                        <input type="checkbox" id="fri" name="4" value="4"> Friday
                      </span>
                      <span class="col-md-6">
                        <input type="checkbox" id="sat" name="5" value="5"> Saturday
                      </span>
                      <span class="col-md-6">
                        <input type="checkbox" id="sun" name="6" value="6"> Sunday
                      </span>
                    </div>

                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                    </div>

                  </form>

                </div>

              </div> <!-- Card Close -->
            </div>        
          </div>
        </div> <!-- Modal Body -->
      
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
    function formEdit(id)
    {
      document.forms[0].id.value = id;
      document.forms[0].submit();
    }


    function validate()
    {
      mon = document.getElementById('mon').checked;
      tue = document.getElementById('tue').checked;
      wed = document.getElementById('wed').checked;
      thu = document.getElementById('thu').checked;
      fri = document.getElementById('fri').checked;
      sat = document.getElementById('sat').checked;
      sun = document.getElementById('sun').checked;

      ts = document.forms[2].time_start.value;
      te = document.forms[2].time_end.value;

      if((mon || tue || wed || thu || fri || sat || sun) && ts < te) {
        return true;
      } else {
        return false;
      }
    }
  </script>

</body>
</html>