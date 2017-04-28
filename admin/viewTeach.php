<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A') {
  header("location: ../index.php");
}

$id=$_POST["id"];

$teacherNameT=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id = '".$id."' AND active = 1");
$teacherName=mysqli_fetch_array($teacherNameT);

$tName=$teacherName[0]." ";
if($teacherName[1]) { $tName .= $teacherName[1][0].". "; }
$tName .= $teacherName[2];

$stmt="SELECT * FROM class WHERE teacher_id = '".$id."' AND active = 1";
$table=mysqli_query($mysqli, $stmt);

$takenClass=mysqli_query($mysqli, "SELECT sched_id from class WHERE active = 1 order by sched_id");

$taken = array();
while($tClass=mysqli_fetch_array($takenClass)) {
  array_push($taken, $tClass[0]);
}

$classT=mysqli_query($mysqli, "SELECT sched_id FROM class WHERE teacher_id = '".$id."' and active = 1");

if(mysqli_num_rows($classT) != 0) {

  $classArray = array();
  while($class=mysqli_fetch_array($classT)) {
    array_push($classArray, $class[0]);
  }

  $schedT=mysqli_query($mysqli, "SELECT sched_id, time_start, time_end, days FROM schedule WHERE sched_id IN (".implode(", ", $classArray).") AND active = 1 ORDER BY time_start, days");

  $takenTimes = array();
  $takenDays = array();
  while($sched=mysqli_fetch_array($schedT)) {
    array_push($takenDays, $sched[3]);
    array_push($takenTimes, $sched[0]);
    array_push($takenTimes, $sched[1]);
    array_push($takenTimes, $sched[2]);
  }

  $toInsert=mysqli_query($mysqli, "SELECT sched_id, time_start, time_end, days FROM schedule WHERE sched_id NOT IN (".implode(", ", $taken).") AND sec_id IS NOT NULL AND active = 1 ORDER BY time_start, days");

  $availTimes = array();
  $availDays = array();
  while($insert = mysqli_fetch_array($toInsert)) {
    array_push($availDays, $insert[3]);
    array_push($availTimes, $insert[0]);
    array_push($availTimes, $insert[1]);
    array_push($availTimes, $insert[2]);
  }

  $cnt = count($availTimes);
  $cnt2 = count($takenTimes);

  for($i = $j = 1; $i < $cnt && $j < $cnt2;) {
    if($availTimes[$i + 1] <= $takenTimes[$j]) {
      $i += 3;
    } else if($takenTimes[$j + 1] <= $availTimes[$i]) {
      $j += 3;
    } else if(($availTimes[$i] >= $takenTimes[$j] && $availTimes[$i] < $takenTimes[$j + 1]
      || $availTimes[$i + 1] > $takenTimes[$j] && $availTimes[$i + 1] <= $takenTimes[$j + 1]
      || $availTimes[$i] <= $takenTimes[$j] && $availTimes[$i + 1] >= $takenTimes[$j + 1])
      && ($availDays[$i/3] & $takenDays[$j/3]) != 0) {
      array_splice($availDays, ($i/3), 1);
      array_splice($availTimes, $i - 1, 3);
      $cnt -= 3;
    } else if($availDays[$i/3] < $takenDays[$j/3]) {
      $i += 3;
    } else if($availDays[$i/3] > $takenDays[$j/3]) {
      $j += 3;
    }
  }

  $cnt = count($availTimes);

} else {
  $cnt = 0;
}


?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - View Teacher Schedule</title>

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
        <li class="breadcrumb-item"><a href="createteach.php">Teacher Creation</a></li>
        <li class="breadcrumb-item active">Viewing Schedule of <?php echo $tName; ?></li>            
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Current Schedule
                </div>
                <div class="card-block" id="print">

                  <form action="delSchedteacher.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="sched_id" value="" required>
                  </form>

                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Schedule</th>
                        <th>Section</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      while($row=mysqli_fetch_array($table)) {
                        $schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id = ".$row[1]." AND active = 1");
                        $sched=mysqli_fetch_array($schedT);

                        $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$sched[1]."");
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

                        $secT=mysqli_query($mysqli, "SELECT section_name FROM subsection WHERE sec_id =".$row[3]."");
                        $sec=mysqli_fetch_array($secT);

                        $checkT=mysqli_query($mysqli, "SELECT * FROM section WHERE class_id =".$row[0]." ");
                        if(mysqli_num_rows($checkT) != 0) {
                          $stats = false;
                        } else {
                          $stats = true;
                        }

                        $check=mysqli_num_rows($checkT);

                        echo 
                        "<tr>
                          <td>".$subj[0]."</td>
                          <td>".$date."</td>
                          <td>".$sec[0]."</td>
                          <td>";

                          if($stats) {
                            echo "
                            <a href='javascript: delSched(".$row[1].")'><button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button></a>";
                          } else {
                            echo "There are ".$check." student(s) enrolled";
                          }
                          
                       echo "</tr>";   
                      }

                    ?>
                    </tbody>
                  </table>
                  <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addsubj"><i class="icon-plus"></i> Add</button>
                  <a href='javascript: printSched()'><button class="btn btn-sm btn-secondary"><i class="icon-doc"></i> Print</button></a>
                </div>
            </div>
          </div>
        </div>
      </div> <!-- end container -->

    </main>
  </div>

  <div class="modal" id="addsubj" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="addSched.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="sched_id" value="" required>
          </form>

          <table class="table table-bordered table-striped table-condensed">
            <thead>
              <tr>
                <th>Subject</th>
                <th>Schedule</th>
                <th>Section</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              for($x = 0; $x < $cnt; $x+=3) {
                $scheds=mysqli_query($mysqli,"SELECT * FROM schedule WHERE sched_id = ".$availTimes[$x]." AND active = 1");
                $sched=mysqli_fetch_array($scheds);
                $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$sched[1]." AND active = 1");
                $secT=mysqli_query($mysqli, "SELECT section_name FROM subsection WHERE sec_id = ".$sched[6]." and active = 1");
                if(mysqli_num_rows($subjT) == 1 && mysqli_num_rows($secT) == 1) {
                  $subj=mysqli_fetch_array($subjT);
                  $sec=mysqli_fetch_array($secT);

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

                  echo 
                  "<tr>
                    <td>Grade ".$sched[2]." - ".$subj[0]."</td>
                    <td>".$date."</td>
                    <td>".$sec[0]."</td>
                    <td>
                      <a href='javascript: addSched(".$sched[0].")'>
                        <button role='select' class='btn btn-sm btn-warning'>
                          <i class='icon-minus'></i> Select
                        </button>
                      </a>
                  </tr>"; 
                }  
              }
            ?>
            </tbody>
          </table>
        </div>

        <div class="modal-footer">
          <button data-dismiss="modal" type="button" class="btn btn-primary">Close</button>
        </div>
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
    style = new String('<link href="../css/style.css" rel="stylesheet">');
    function delSched(sched_id)
    {
      document.forms[0].sched_id.value = sched_id;
      document.forms[0].submit();
    }

    function addSched(sched_id)
    {
      document.forms[1].sched_id.value = sched_id;
      document.forms[1].submit();
    }

    function printSched()
    {
      var printContents = document.getElementById("print").innerHTML;
      var popupWin = window.open('', '_blank', 'width=1000, height=1000');

      popupWin.document.open();
      popupWin.document.write("<html><head>" + style + "</head><body>" + printContents + "</body></html>");
      popupWin.document.close();
    }
  </script>

</body>
</html>