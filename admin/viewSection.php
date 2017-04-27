<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["id"];

$sectionT=mysqli_query($mysqli, "SELECT * FROM subsection WHERE sec_id = ".$id." AND active = 1");
$section=mysqli_fetch_array($sectionT);

$classesT=mysqli_query($mysqli, "SELECT * FROM class WHERE sec_id = ".$id." AND active = 1");

$classArray = array();
while($classes=mysqli_fetch_array($classesT)) {
  array_push($classArray, $classes[0]);
}

$num=count($classArray);

$studentList=mysqli_query($mysqli, "SELECT * FROM student WHERE grade_level = ".$section[2]." AND sec_id IS NULL AND active = 1 ORDER BY s_lName");

$schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sec_id = ".$id." AND active = 1 ORDER BY time_start");


$stat = true;

if(mysqli_num_rows($schedT) == 0) {
  $stat = false;
}


$stats = true;

while($sched=mysqli_fetch_array($schedT)) {

  if($stats) {
    $teacherT=mysqli_query($mysqli, "SELECT teacher_id FROM class WHERE sched_id = ".$sched[0]." AND active = 1");

    if(mysqli_num_rows($teacherT) == 0) {
      $stats = false;
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - View Section</title>

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
        <li class="breadcrumb-item active">Section: <?php echo $section[3]." - Grade ".$section[2]; ?></li>
      </ol>

      <div class="container-fluid">

        <div class="row col-lg-16 card">
          <div class="card-header">
            <strong>Created Classes/Sections</strong>
          </div>

          <form action="unenrollStud.php" method="POST">
            <input type="hidden" name="id" value="" hidden>
            <input type="hidden" name="sec_id" value="<?php echo $id; ?>" hidden>
          </form>

          <div class="card-block">
          <?php
            if($num == 0) {
              echo "There are no students enrolled in this section.";
            } else {
              $studs=mysqli_query($mysqli, "SELECT student_id FROM section WHERE class_id IN (".implode(", ", $classArray).") group by student_id having count(student_id) = ".$num."");

              if(mysqli_num_rows($studs) == 0) {
                echo "There are no students enrolled in this section.";
              } else {
                echo "
                <table class='table table-striped table-bordered'>
                  <thead>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Action</th>
                  </thead>
                  <tbody>";

                  while($stud=mysqli_fetch_array($studs)) {
                    $studentT=mysqli_query($mysqli, "SELECT s_fName, s_mName, s_lName from STUDENT WHERE student_id = '".$stud[0]."' and active = 1");

                    if(mysqli_num_rows($studentT) == 1) {
                      $studName=mysqli_fetch_array($studentT);

                      $name=$studName[2].", ".$studName[0];
                      if($studName[1]) { $name.=" ".$studName[1][0]."."; }

                      echo "
                      <tr>
                        <td>".$stud[0]."</td>
                        <td>".$name."</td>
                        <td>
                          <center>
                            <a href='javascript: unenrollForm(\"".$stud[0]."\")' method='POST'>
                              <button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Unenroll</button>
                            </a>
                          </center>
                        </td>
                      </tr>
                      ";
                    }
                  }

                  echo "</tbody></table>";
              }
            }
          ?>
          <hr>
          <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#enrollStud" <?php if(!$stats || !$stat) { echo "disabled"; }?>>
            <i class="icon-plus"></i> <?php if(!$stat) { echo "This Section Has No Classes"; } else if(!$stats) { echo "Not All Schedules Have Teachers."; } else { echo "Enroll Student(s)"; } ?>
          </button>                   
          </div>

        </div> <!-- Row and stuff -->              
      
      </div> <!-- Container Ending -->

    </main>
  </div>

  <div class="modal" id="enrollStud" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Enroll Student</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-block">

                  <form action="enrollStud.php" method="POST" class="form-horizontal">
                    <input type="hidden" name="sec_id" value="<?php echo $id; ?>">

                    <?php 
                      if(mysqli_num_rows($studentList) != 0) {
                        echo "
                        <table class='table table-bordered'>
                          <thead>
                            <tr>
                              <th>Student ID</th>
                              <th>Student Name</th>
                              <th>Enroll</th>
                            </tr>
                          </thead>
                          <tbody>";

                        while($student=mysqli_fetch_array($studentList)) {
                          $sName= $student[4].", ".$student[2];
                          if($student[3]) { $sName.= " ".$student[3][0]."."; }
                          echo "
                          <tr>
                            <td>".$student[0]."</td>
                            <td>".$sName."</td>
                            <td>
                              <center><input name='enroll[]' value='".$student[0]."' type='checkbox'></center>
                            </td>
                          </tr>";
                        }

                        echo "
                          </tbody>
                        </table>
                        <div class='card-footer'>
                          <button class='btn btn-sm btn-primary'><i class='fa fa-dot-circle-o'></i> Submit</button>
                        </div>";
                      } else {
                        echo "There are no students that can enroll in this section.";
                      }
                    ?>
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
    function unenrollForm(id) 
    {
      document.forms[0].id.value = id;
      document.forms[0].submit();
    }

  </script>

</body>
</html>