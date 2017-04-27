<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["id"];

$scheduleT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id = ".$id." ");
$subjList=mysqli_query($mysqli, "SELECT * FROM subjects WHERE active = 1");

$teacherList=mysqli_query($mysqli, "SELECT teacher_id, t_fName, t_mName, t_lName FROM teacher WHERE active = 1 ORDER BY t_lName");

$schedule=mysqli_fetch_array($scheduleT);

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Edit Schedule</title>

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
        <li class="breadcrumb-item"><a href="createsched.php">Schedule Plot</a></li>
        <li class="breadcrumb-item active">Edit Schedule</li>
      </ol>

      <div class="container-fluid">

        <div class="row col-lg-16 card">

          <div class="card-header">
            <strong>Update Schedule</strong>
          </div>

          <div class="card-block">

             <form action="updateSched.php" onsubmit="return validate();" method="POST" class="form-horizontal">

              <input type="hidden" name="id" value="<?php echo $id; ?>">

              <div class="form-group row">
                  <label class="col-md-3 form-control-label">Grade Level</label>
                  <div class="col-md-9">
                    <select name="grade" class="form-control" required>
                    <?php
                      for($i=1; $i < 11; $i++) {
                        echo "<option value='".$i."' ";
                        if($i == $schedule[2]) { echo "selected"; }
                        echo ">Grade ".$i."</option>";
                      }                        
                    ?>  
                    </select>
                  </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Subject</label>
                <div class="col-md-9">
                  <select name="subj_id" class="form-control" required>
                  <?php
                    while($subj=mysqli_fetch_array($subjList)) {
                      echo "
                      <option value='".$subj[0]."'";
                      if($subj[0] == $schedule[1]) { echo "selected"; }
                      echo ">".$subj[1]."</option>";
                    }
                  ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 form-control-label">Time Start</label>
                <div class="col-md-4">
                  <input type="time" name="time_start" value="<?php echo $schedule[3]; ?>" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 form-control-label">Time End</label>
                <div class="col-md-4">
                  <input type="time" name="time_end" value="<?php echo $schedule[4]; ?>" required>
                </div>
              </div>

              On what days? <br>
              <div class="form-group row">
                <span class="col-md-6">
                  <input type="checkbox" id="mon" name="0" value="0" <?php if(($schedule[5] & 1) != 0) { echo "checked"; } ?>> Monday
                </span>
                <span class="col-md-6">
                  <input type="checkbox" id="tue" name="1" value="1" <?php if(($schedule[5] & 2) != 0) { echo "checked"; } ?>> Tuesday
                </span>
                <span class="col-md-6">
                  <input type="checkbox" id="wed" name="2" value="2" <?php if(($schedule[5] & 4) != 0) { echo "checked"; } ?>> Wednesday
                </span>
                <span class="col-md-6">
                  <input type="checkbox" id="thu" name="3" value="3" <?php if(($schedule[5] & 8) != 0) { echo "checked"; } ?>> Thursday
                </span>
                <span class="col-md-6">
                  <input type="checkbox" id="fri" name="4" value="4" <?php if(($schedule[5] & 16) != 0) { echo "checked"; } ?>> Friday
                </span>
                <span class="col-md-6">
                  <input type="checkbox" id="sat" name="5" value="5" <?php if(($schedule[5] & 32) != 0) { echo "checked"; } ?>> Saturday
                </span>
                <span class="col-md-6">
                  <input type="checkbox" id="sun" name="6" value="6" <?php if(($schedule[5] & 64) != 0) { echo "checked"; } ?>> Sunday
                </span>
              </div>

              <button class="btn btn-md btn-success"><i class="icon-note"></i> Update Schedule</button>  
            </form>                      
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
    function validate()
    {
      mon = document.getElementById('mon').checked;
      tue = document.getElementById('tue').checked;
      wed = document.getElementById('wed').checked;
      thu = document.getElementById('thu').checked;
      fri = document.getElementById('fri').checked;
      sat = document.getElementById('sat').checked;
      sun = document.getElementById('sun').checked;

      ts = document.forms[0].time_start.value;
      te = document.forms[0].time_end.value;

      if((mon || tue || wed || thu || fri || sat || sun) && ts < te) {
        return true;
      } else {
        return false;
      }
    }
  </script>

</body>
</html>