<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'S'){
    header("location: ../index.php");
}

$id=$_SESSION["id"];

$table=mysqli_query($mysqli,"SELECT * FROM STUDENT WHERE student_id= '".$id."'");
$secT=mysqli_query($mysqli,"SELECT * FROM section WHERE student_id='".$id."' AND active = 1");
$select=mysqli_fetch_array($table);

$num=mysqli_num_rows($secT);

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Enroll</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <style>
  #unenroll {
    width: 50%;
    margin-left: 25%;
    margin-top: 10%;
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
        <li class="breadcrumb-item">Enrolment System</li>
        <li class="breadcrumb-item active"><?php echo "Grade ".$select[6]; ?></li>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">

              <div class="card-header"><strong> Class Schedule
                <?php if($select[5]) { echo " - Section ".$select[5]; } ?></strong>
              </div>

              <div class="card-block">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>Time</th>
                      <th>Teacher</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    while($row=mysqli_fetch_array($secT)) {
                      $get=mysqli_query($mysqli, "SELECT * FROM class WHERE class_id = ".$row[0]."");
                      $row2=mysqli_fetch_array($get);

                      $sched=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id = ".$row2[1]."");
                      $row3=mysqli_fetch_array($sched);

                      $subj=mysqli_query($mysqli, "SELECT * FROM subjects WHERE subj_id=".$row3[1]."");
                      $row4=mysqli_fetch_array($subj);

                      $tech=mysqli_query($mysqli, "SELECT * FROM teacher WHERE teacher_id='".$row2[2]."'");
                      $teacher=mysqli_fetch_array($tech);

                      $date=date("h:i A", strtotime($row3[3]))." - ".date("h:i A", strtotime($row3[4]));
                      $days= "";

                      if($row3[5] & 1){ $days = "M"; }
                      if($row3[5] & 2){ $days .= "T"; }                                                
                      if($row3[5] & 4){ $days .= "W"; }
                      if($row3[5] & 8){ $days .= "TH"; }                        
                      if($row3[5] & 16){ $days .= "F"; }
                      if($row3[5] & 32){ $days .= "Sat"; } 
                      if($row3[5] & 64){ $days .= "Sun"; }

                      $date .= " ".$days;
                      $name=$teacher[4].", ".$teacher[2]." ".$teacher[3]; 

                      echo
                      "<tr>
                        <td>".$row4[1]."</td>
                        <td>".$date."</td>
                        <td>".$name."</td>
                      </tr>";
                    }
                  ?>      
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <?php 
                  if($num == 0) {
                    echo 
                    "<button data-toggle='modal' data-target='#enrollsched' class='btn btn-md btn-success'>
                      <i class='icon-plus'></i> Enroll
                    </button>";
                  } else {
                    echo 
                    "<button data-toggle='modal' data-target='#unenroll' class='bt btn-md btn-danger'>
                      <i class='icon-minus'></i> Unenroll
                    </button>";
                  }
                ?>
              </div>
            </div>
          </div>  
        </div>
      </div>

    </main>
  </div>

  <div class="modal" id="enrollsched" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Available Classes</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="card">

            <div class="card-block">

              <form action="viewclass.php" method="POST">
                <input type="hidden" name="secid" value="" required>
                <input type="hidden" name="name" value="" required>
              </form>

              <form action="enrollstud.php" method="POST">
                <input type="hidden" name="secid" value="" required>
              </form>

              <?php
                if(!$select[10]){
                  $table=mysqli_query($mysqli,"SELECT * FROM subsection WHERE grade_level=".$select[6]." AND active = 1");

                  if(mysqli_num_rows($table) > 0) {

                    echo 
                    "<table class='table-striped table-bordered table'>
                      <thead>
                        <th>Section</th>
                        <th>Adviser</th>
                        <th>Action</th>
                      </thead>
                      <tbody>";

                      while($row=mysqli_fetch_array($table)){
                        $nameget=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id ='".$row[1]."'");
                        $name=mysqli_fetch_array($nameget);

                        $fullName=$name[2].", ".$name[0]." ".$name[1];

                        echo
                        "<tr>
                          <td>".$row[3]."</td>
                          <td>".$fullName."</td>
                          <td>
                            <a href='javascript:formView(".$row[0].", \"".$row[3]."\")'><button class='btn btn-md btn-primary'><i class='fa fa-circle-o'></i>  View</button>
                            </a> 
                            <a href='javascript:formEnroll(".$row[0].")'><button class='btn btn-md btn-warning'><i class='icon-check'></i>  Select</button>
                            </a>
                          </td>
                        </tr>";
                      }

                      echo
                        "</tbody>
                      </table>";
                  } else {
                    echo "There are no schedules to display.";
                  }
                } else {
                    echo "You are already enrolled!";
                }
              ?>
            </div> <!-- close block -->
                        
          </div>       
        </div> <!-- modal body close -->

      </div> <!-- modal content close -->
    </div>  <!-- modal dialog -->
  </div> <!-- modal -->

  <div class="modal" id="unenroll" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Are you sure you want to unenroll all of your subjects?</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="card">

            <div class="card-block">
              <center>
                <a href='unenrollAll.php'>
                  <button data-toggle='modal' data-target='#unenroll' class='bt btn-md btn-success'>
                    <i class='icon-check'></i> Yes
                  </button>
                </a>

                <button data-toggle='modal' data-target='#unenroll' class='bt btn-md btn-primary'>
                  <i class='icon-close'></i> No
                </button>
              </center>

            </div> <!-- close block -->
                        
          </div>       
        </div> <!-- modal body close -->

      </div> <!-- modal content close -->
    </div>  <!-- modal dialog -->
  </div> <!-- modal -->

  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>     
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/app.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <script> 
    function formView(secid, name) 
    {     
      document.forms[0].secid.value = secid;
      document.forms[0].name.value = name;
      document.forms[0].submit();
    }

    function formEnroll(secid) 
    {     
      document.forms[1].secid.value = secid;
      document.forms[1].submit();
    }
  </script>
</body>
</html>