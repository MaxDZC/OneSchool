<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["sched_id"];
$sec_id = $_POST["sec_id"];

$sectionT=mysqli_query($mysqli, "SELECT * FROM subsection WHERE sec_id = ".$sec_id." AND active = 1");
$section=mysqli_fetch_array($sectionT);

$scheduleT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id = ".$id." AND active = 1");
$schedule=mysqli_fetch_array($scheduleT);

$subjectT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$schedule[1]." AND active = 1");
$subject=mysqli_fetch_array($subjectT);

$teacherList=mysqli_query($mysqli, "SELECT teacher_id FROM teacher WHERE active = 1 ORDER BY teacher_id");

$status = array();
for($x = 0; $teacher=mysqli_fetch_array($teacherList); $x++) {
  $classT=mysqli_query($mysqli, "SELECT sched_id FROM class WHERE teacher_id = '".$teacher[0]."' and active = 1");

  if(mysqli_num_rows($classT) != 0) {

    $classArray = array();
    while($class=mysqli_fetch_array($classT)) {
      array_push($classArray, $class[0]);
    }


    $schedT=mysqli_query($mysqli, "SELECT time_start, time_end, days FROM schedule WHERE sched_id IN (".implode(", ", $classArray).") AND active = 1");

    $takenTimes = array();
    $takenDays = array();
    while($sched=mysqli_fetch_array($schedT)) {
      array_push($takenDays, $sched[2]);
      array_push($takenTimes, $sched[0]);
      array_push($takenTimes, $sched[1]);
    }

    $len=count($takenTimes);
    $lim=count($takenDays);

  } else {
    $lim = 0;
  }

  $toInsert=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id = ".$id." and active = 1");
  $insert=mysqli_fetch_array($toInsert);

  $status[$x] = true;


  for($i=0; $i < $lim; $i++) {
    if(($takenDays[$i] & $insert[5]) != 0) {
      $status[$x] = false;
      break;
    }
  }

  if(!$status[$x]) {

    $status[$x] = true;

    for($i=0; $i < $len; $i+=2) {
      if(($takenTimes[$i] <= $insert[3] && $takenTimes[$i + 1] > $insert[3] ||
         $takenTimes[$i] < $insert[4] && $takenTimes[$i + 1] >= $insert[4] ||
         $takenTimes[$i] >= $insert[3] && $takenTimes[$i + 1] <= $insert[4])
          && (($takenDays[$i/2] & $insert[5]) != 0)) {
          $status[$x] = false;
          break;
      }
    }
  }
}

$teacherList=mysqli_query($mysqli, "SELECT teacher_id, t_fName, t_mName, t_lName FROM teacher WHERE active = 1 ORDER BY teacher_id");

$num = count(array_filter($status));

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Enroll a Teacher</title>

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
        <li class="breadcrumb-item">
          <a href="javascript: goBack()">Schedule: <?php echo $section[3]." - Grade ".$section[2]; ?></a>
        </li>
        <li class="breadcrumb-item active">Teacher Assignment for <?php echo $subject[0]; ?></li>
      </ol>

      <form action="viewSectionSched.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $sec_id; ?>">
      </form>

      <div class="container-fluid">

        <div class="row col-lg-16 card">
          <div class="card-header">
            <strong>List of Available Teachers For this Subject</strong>
          </div>

          <div class="card-block">
            <?php
              if($num == 0) {
                echo "There are no available teachers.";
              } else {

                echo "
                <table class='table table-striped table-bordered'>
                  <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Teacher</th>
                  </thead>
                  <tbody>";

                for($x = 0; $teacher=mysqli_fetch_array($teacherList); $x++) {
                  if($status[$x]) {
                    $name=$teacher[3].", ".$teacher[1];
                    if($teacher[2]) { $name.=" ".$teacher[2][0]."."; }

                    echo "
                    <tr>
                      <td>".$teacher[0]."</td>
                      <td>".$name."</td>
                      <td>
                        <center>
                          <a href='javascript: addTeacher(".$sched[1].")'>
                            <button class='btn btn-sm btn-success'>
                              <i class='icon-user-follow'></i> Enroll
                            </button>
                          </a>
                        </center>
                      </td>
                    </tr>";
                  }            
                }
                echo "
                  </tbody>
                </table>";
              }
            ?>
            <hr>
            <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addSched" <?php if($studNum != 0) { echo "disabled"; } ?>>
              <i class="icon-plus"></i> <?php if($studNum != 0) { echo "There are Students Enrolled"; } else { echo "Add Schedule"; } ?>
            </button>                 
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

  <script>
    function goBack(id) 
    {
      document.forms[0].submit();
    }
  </script>

</body>
</html>