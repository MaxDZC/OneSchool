<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'S'){
    header("location: ../index.php");
}

$id=$_POST["secid"];
$secName=$_POST["name"];

$studT=mysqli_query($mysqli, "SELECT * FROM student WHERE student_id ='".$_SESSION['id']."'");
$table = mysqli_query($mysqli,"SELECT * FROM class WHERE sec_id='".$id."' AND active = 1");
$level=mysqli_fetch_array($studT);

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
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header.php"); ?>
  </header>

  <div class="app-body">
    <?php require("sidebar.php"); ?>
    <main class="main">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Enrolment System</li>
        <li class="breadcrumb-item"><a href="enrollclass.php">Grade <?php echo $level[6]; ?></a></li>
        <li class="breadcrumb-item active"><?php echo $secName; ?></li>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">

              <div class="card-header">
                <strong> Class Schedule</strong>
              </div>

              <form action="enrollstud.php" method="POST">
                <input type="hidden" name="secid" value="" required>
              </form>

              <div class="card-block">
                <?php
                  if(mysqli_num_rows($table) > 0) {
                    echo 
                    "<table class='table table-bordered table-striped table-condensed'>
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Time</th>
                          <th>Teacher</th>
                        </tr>
                      </thead>
                      <tbody>";

                      while($row=mysqli_fetch_array($table)){
                        $schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id=".$row[1]." AND active = 1");
                        $sched=mysqli_fetch_array($schedT);

                        $subjT=mysqli_query($mysqli, "SELECT * FROM subjects WHERE subj_id=".$sched[1]." AND active = 1");
                        $subj=mysqli_fetch_array($subjT);

                        $date=date("h:i A", strtotime($sched[3]))." - ".date("h:i A", strtotime($sched[4]));
                        $days= "";

                        $teachT=mysqli_query($mysqli, "SELECT * FROM teacher WHERE teacher_id='".$row[2]."'");
                        $teacher=mysqli_fetch_array($teachT);

                        if($sched[5] & 1){ $days = "M"; }
                        if($sched[5] & 2){ $days .= "T"; }                                                
                        if($sched[5] & 4){ $days .= "W"; }
                        if($sched[5] & 8){ $days .= "TH"; }  
                        if($sched[5] & 16){ $days .= "F"; }
                        if($sched[5] & 32){ $days .= "Sat"; } 
                        if($sched[5] & 64){ $days .= "Sun"; }

                        $date .= " ".$days;
                        $name=$teacher[4].", ".$teacher[2]." ".$teacher[3]; 

                        echo
                        "<tr>
                          <td>".$subj[1]."</td>
                          <td>".$date."</td>
                          <td>".$name."</td>
                        </tr>";
                      }      
                      
                      echo 
                        "</tbody>
                      </table>";

                  } else {
                    echo "There are no subjects to display.";
                  }

                  echo 
                  "<a href='javascript:formSubmit(".$id.")'>
                    <button class='btn btn-md btn-warning'><i class='icon-check'></i> Enroll</button>
                  </a>";
                ?>
              </div> 

            </div> <!-- end card -->


          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>     
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/app.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <script> 
    function formSubmit(secid) 
    {     
      document.forms[0].secid.value = secid;
      document.forms[0].submit();
    }
  </script>
</body>
</html>