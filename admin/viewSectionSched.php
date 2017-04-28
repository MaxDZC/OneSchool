<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["id"];

$sectionT=mysqli_query($mysqli, "SELECT * FROM subsection WHERE sec_id = ".$id." AND active = 1");
$section=mysqli_fetch_array($sectionT);

$schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sec_id = ".$id." AND grade_level = ".$section[2]." AND active = 1 ORDER BY days, time_start");
$num=mysqli_num_rows($schedT);

$subjectCheckerT=mysqli_query($mysqli, "SELECT subj_id FROM schedule WHERE sec_id = ".$id." AND grade_level = ".$section[2]." AND active = 1");

$subjectCheck = array();
while($subjectChecker=mysqli_fetch_array($subjectCheckerT)) {
  array_push($subjectCheck, $subjectChecker[0]);
}

if(count($subjectCheck) != 0) {
  $stmt = "SELECT sched_id, time_start, time_end, days, subj_id FROM schedule WHERE sec_id IS NULL AND grade_level = ".$section[2]." AND subj_id NOT IN (".implode(", ", $subjectCheck).") ORDER BY time_start, days";
} else {
  $stmt = "SELECT sched_id, time_start, time_end, days, subj_id FROM schedule WHERE sec_id IS NULL AND grade_level = ".$section[2]." ORDER BY time_start, days";
}

$addSchedT=mysqli_query($mysqli, $stmt);

$cnt=mysqli_num_rows($addSchedT);

if($cnt != 0) {
  $avail = array();
  $availDays = array();
  while($addSched=mysqli_fetch_array($addSchedT)) {
    array_push($availDays, $addSched[3]);
    array_push($avail, $addSched[0]);
    array_push($avail, $addSched[1]);
    array_push($avail, $addSched[2]);
  }

  if($num != 0) {
    $schedSecT=mysqli_query($mysqli, "SELECT sched_id, time_start, time_end, days FROM schedule WHERE sec_id = ".$id." AND grade_level = ".$section[2]." AND active = 1 ORDER BY time_start, days");

    $inSection = array();
    $sectionDays = array();
    while($schedSec=mysqli_fetch_array($schedSecT)) {
      array_push($sectionDays, $schedSec[3]);
      array_push($inSection, $schedSec[0]);
      array_push($inSection, $schedSec[1]);
      array_push($inSection, $schedSec[2]);
    }

    $cnt = count($avail);
    $cnt2 = count($inSection);

    
    for($i = $j = 1; $i < $cnt && $j < $cnt2;) {
      if($avail[$i + 1] <= $inSection[$j]) {
        $i += 3;
      } else if($inSection[$j + 1] <= $avail[$i]) {
        $j += 3;
      } else if(($avail[$i] >= $inSection[$j] && $avail[$i] < $inSection[$j + 1]
        || $avail[$i + 1] > $inSection[$j] && $avail[$i + 1] <= $inSection[$j + 1]
        || $avail[$i] <= $inSection[$j] && $avail[$i + 1] >= $inSection[$j + 1])
        && ($availDays[$i/3] & $sectionDays[$j/3]) != 0) {
        array_splice($availDays, ($i/3), 1);
        array_splice($avail, $i - 1, 3);
        $cnt -= 3;
      } else if($availDays[$i/3] < $sectionDays[$j/3]) {
        $i += 3;
      } else if($availDays[$i/3] > $sectionnDays[$j/3]) {
        $j += 3;
      }
    }

    $cnt = count($avail);

  } else {
    $cnt = count($avail);
  }
}


// Check for # of Students Enrolled //
$classesT=mysqli_query($mysqli, "SELECT * FROM class WHERE sec_id = ".$id." AND active = 1");

$classArray = array();
while($classes=mysqli_fetch_array($classesT)) {
  array_push($classArray, $classes[0]);
}


$studNum=count($classArray);

if($studNum != 0) {
  $studs=mysqli_query($mysqli, "SELECT student_id FROM section WHERE class_id IN (".implode(", ", $classArray).") group by student_id having count(student_id) = ".$studNum."");

  $studNum = mysqli_num_rows($studs);
}

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - View Schedule</title>

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
            <form action="enrollTeacher.php" method="POST">
              <input type="hidden" name="sec_id" value="<?php echo $id; ?>" required>
              <input type="hidden" name="sched_id" value="" required>
            </form>

            <form action="changeTeacher.php" method="POST">
              <input type="hidden" name="sec_id" value="<?php echo $id; ?>" required>
              <input type="hidden" name="sched_id" value="" required>
              <input type="hidden" name="id" value="" required>
            </form>

            <form action="removeTeacher.php" method="POST">
              <input type="hidden" name="sec_id" value="<?php echo $id; ?>" required>
              <input type="hidden" name="sched_id" value="" required>
            </form>

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
                    <th>Action</th>
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
                      <td>
                        <center>";

                    if($name == "No teacher yet.") {
                      echo "
                        <a href='javascript: addTeacher(".$sched[0].")'>
                          <button class='btn btn-sm btn-success'>
                            <i class='icon-user-follow'></i> Add Teacher
                          </button>
                        </a>";
                    } else {
                      echo "
                        <a href='javascript: changeTeacher(".$sched[0].", \"".$teacherID[0]."\") '>
                          <button class='btn btn-sm btn-warning'>
                            <i class='icon-people'></i> Change Teacher
                          </button>
                        </a>";

                      if($studNum == 0) {
                        echo "
                        <a href='javascript: removeTeacher(".$sched[0].")'>
                          <button class='btn btn-sm btn-danger'>
                            <i class='icon-user-unfollow'></i> Remove Teacher
                          </button>
                        </a>";
                      }
                    }
                     
                   echo "</center>
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

  <div class="modal" id="addSched" role="dialog">
    <div class="modal-dialog modal-lg">
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

                  <form action="insertSchedSection.php" method="POST" class="form-horizontal">
                    <input type="hidden" name="sec_id" value="<?php echo $id; ?>" hidden>
                    <input type="hidden" name="id" value="" hidden>
                  </form>
                  <?php
                    if($cnt != 0) {
                      echo "
                        <table class='table table-bordered'>
                          <thead>
                            <th>Subject</th>
                            <th>Time</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";

                      for($i = 0; $i < $cnt; $i+=3) {
                        $freeScheds=mysqli_query($mysqli, "SELECT * FROM SCHEDULE WHERE SCHED_ID = ".$avail[$i]." ");
                        $freeSched=mysqli_fetch_array($freeScheds);

                        $subjectNameT=mysqli_query($mysqli, "SELECT SUBJECT FROM SUBJECTS WHERE subj_id = ".$freeSched[1]." ");
                        $subjectName=mysqli_fetch_array($subjectNameT);

                        $date=date("h:i A", strtotime($freeSched[3]))." - ".date("h:i A", strtotime($freeSched[4]));

                        $days= "";

                        if($freeSched[5] & 1){ $days = "M"; }
                        if($freeSched[5] & 2){ $days .= "T"; }                                                
                        if($freeSched[5] & 4){ $days .= "W"; }
                        if($freeSched[5] & 8){ $days .= "TH"; }  
                        if($freeSched[5] & 16){ $days .= "F"; }
                        if($freeSched[5] & 32){ $days .= "Sat"; } 
                        if($freeSched[5] & 64){ $days .= "Sun"; }

                        $date .= " ".$days;

                        echo "
                        <tr>
                          <td>".$subjectName[0]."</td>
                          <td>".$date."</td>
                          <td>
                            <center>
                              <a href='javascript: addForm(".$freeSched[0].")'>
                                <button class='btn btn-sm btn-primary'>
                                  <i class='fa fa-dot-circle-o'></i> Add Schedule
                                </button>
                              </a>
                            </center>
                          </td>
                        </tr>";

                      }

                      echo "
                        </tbody>
                      </table>";

                    } else {
                      echo "There are no available schedules.";
                    }

                  ?>
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
    function addTeacher(sched_id)
    {
      document.forms[0].sched_id.value = sched_id;
      document.forms[0].submit();
    }

    function changeTeacher(sched_id, id)
    {
      document.forms[1].sched_id.value = sched_id;
      document.forms[1].id.value = id;
      document.forms[1].submit();
    }

    function removeTeacher(sched_id)
    {
      document.forms[2].sched_id.value = sched_id;
      document.forms[2].submit();
    }

    function addForm(id)
    {
      document.forms[3].id.value = id;
      document.forms[3].submit();
    }
  </script>

</body>
</html>