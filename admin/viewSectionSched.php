<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["id"];

$sectionT=mysqli_query($mysqli, "SELECT * FROM subsection WHERE sec_id = ".$id." AND active = 1");
$section=mysqli_fetch_array($sectionT);

$schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sec_id = ".$id." AND active = 1 ORDER BY UNIX_TIMESTAMP(time_start)");
$num=mysqli_num_rows($schedT);

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
        <li class="breadcrumb-item active">Schedule: <?php echo $section[3]." - Grade ".$section[2]; ?></li>
      </ol>

      <div class="container-fluid">

        <div class="row col-lg-16 card">
          <div class="card-header">
            <strong>Schedule of Section <?php echo $section[3]; ?></strong>
          </div>

          <div class="card-block">
          <?php
            if($num == 0) {
              echo "This section has no schedules.";
            } else {

              echo "
              <table class='table table-striped table-bordered'>
                <thead>
                  <th>Subject</th>
                  <th>Time</th>
                  <th>Teacher</th>
                </thead>
                <tbody>";

              while($sched=mysqli_fetch_array($schedT)) {
                $subjT=mysqli_query($mysqli, "SELECT subject FROM SUBJECTS WHERE subj_id = ".$sched[1]." AND active = 1");
                $teacherT=mysqli_query($mysqli, "SELECT teacher_id FROM class WHERE sched_id = ".$sched[0]." AND active = 1");

                if(mysqli_num_rows($subjT) == 1) {

                  if(mysqli_num_rows($teacherT) == 1) {
                    $teacherID=mysqli_fetch_array($teacherT);

                    $teacherNameT=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id = '".$teacherID[0]."' AND active = 1");
                    $teacherName=mysqli_fetch_array($teacherNameT);

                    $name=$teacherName[2].", ".$teacherName[0];
                    if($teacherName[1]) { $name.=" ".$teacherName[1][0]."."; }

                  } else {
                    $name = "No teacher yet.";
                  }

                  $subj=mysqli_fetch_array($subjT);

                    

                  $date=date("h:i A", strtotime($sched[3]))." - ".date("h:i A", strtotime($sched[4]));
                  $days= "";

                  if($sched[5] & 1){ $days = "M"; }
                  if($sched[5] & 2){ $days .= "T"; }
                  if($sched[5] & 4){ $days .= "W"; }
                  if($sched[5] & 8){ $days .= "TH"; }
                  if($sched[5] & 16){ $days .= "F"; }
                  if($sched[5] & 32){ $days .= "Sat"; }
                  if($sched[5] & 64){ $days .= "Sun"; }

                  $date .= " ".$days;

                  echo "
                  <tr>
                    <td>".$subj[0]."</td>
                    <td>".$date."</td>
                    <td>".$name."</td>
                  </tr>
                  ";
                }            
              }
              echo "</tbody></table>";
            }
          ?>                    
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
                        <input type="number" name="size" class="form-control" placeholder="Size of Class">
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
</body>
</html>