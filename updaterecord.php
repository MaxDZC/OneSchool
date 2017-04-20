<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])){
    header("location:index.php");
}

$gbT=mysqli_query($mysqli, "SELECT * FROM gradebreakdown WHERE admin_id IS NOT NULL AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND active = 1");
$gb=mysqli_fetch_array($gbT);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>One School - Manage Class</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

</head>

<style type="text/css">
    /* Add a black background color to the top navigation */
.topnav {
    background-color: #1e2f2f;
    overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 10px 10px 10px 10px;
    text-decoration: none;
    font-size: 15px;
}

/* Change the color of links on hover */
.topnav a:hover {
    background-color: #0099cc;
    color: white;
}

/* Add a color to the active/current link */
.topnav a.active {
    background-color: #4CAF50;
    color: red;
}
</style>



<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <?php include("header-teacher.php"); ?>
    </header>

    <div class="app-body">
        <?php include("sidebar-teacher.php") ?>

        
        <main class="main">

            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Class Record</li>
                <li class="breadcrumb-item"><?php echo 'Grade '.$_GET["level"].' - '.$_GET["section"];?></li>
                <li class="breadcrumb-item active"><?php echo $_GET["subject"];?></li>
                
            </ol>
            <div class="container-fluid">
                <div class="topnav">
                  <a href="updaterecord.php?<?php echo "classid=".$_GET["classid"]."&gper=1&level=".$_GET["level"]."&section=".$_GET["section"]."&subject=".$_GET['subject']."&subj=".$_GET["subj"]; ?>">First Grading</a>
                  <a href="updaterecord.php?<?php echo "classid=".$_GET["classid"]."&gper=2&level=".$_GET["level"]."&section=".$_GET["section"]."&subject=".$_GET['subject']."&subj=".$_GET["subj"]; ?>">Second Grading</a>
                  <a href="updaterecord.php?<?php echo "classid=".$_GET["classid"]."&gper=3&level=".$_GET["level"]."&section=".$_GET["section"]."&subject=".$_GET['subject']."&subj=".$_GET["subj"]; ?>">Third Grading</a>
                  <a href="updaterecord.php?<?php echo "classid=".$_GET["classid"]."&gper=4&level=".$_GET["level"]."&section=".$_GET["section"]."&subject=".$_GET['subject']."&subj=".$_GET["subj"]; ?>">Fourth Grading</a>
                </div>                                
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                 <strong>Records: 
                                  <?php 
                                    $grading =""; 
                                    switch($_GET["gper"]) {
                                      case 1: $grading = "First"; break;
                                      case 2: $grading = "Second"; break;
                                      case 3: $grading = "Third"; break;
                                      case 4: $grading = "Fourth";
                                    }
                                    echo " ".$grading." Grading";
                                  ?></strong>
                            </div>
                            <div class="card-block">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr align="center">
                                            <th rowspan="2" valign="middle"><center>ID Number</center></th>
                                            <th colspan="5"><center>HW & A <?php echo "  (".$gb[9]."%)";?></center></th>
                                            <th colspan="5"><center>Seatworks <?php echo "  (".$gb[8]."%)"; ?></center></th>
                                            <th colspan="5"><center>Quizzes<?php echo "  (".$gb[7]."%)"; ?></center></th>
                                            <th colspan="5"><center>Projects<?php echo "  (".$gb[10]."%)"; ?></center></th>
                                            <th rowspan="2"><center>Midterms<?php echo "  (".$gb[11]."%)"; ?></center></th>
                                            <th rowspan="2"><center>Periodicals<?php echo "  (".$gb[12]."%)"; ?></center></th>
                                            <th rowspan="2"><center>Equiv. Grade</center></th>
                                        </tr>
                                        <tr>
                                        <?php
                                          for($i=0; $i<4; $i++) {
                                            for($j=1; $j<6; $j++) {
                                              echo "<td>".$j."</td>";
                                            }
                                          }
                                        ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                      $table=mysqli_query($mysqli,"SELECT student_id FROM section WHERE class_id = ".$_GET['classid']." AND active = 1");

                                      while($row=mysqli_fetch_array($table)) {
                                        echo "<tr><td>".$row[0]."</td>";

                                        $assignT=mysqli_query($mysqli, "SELECT score FROM assign WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY ass_num");

                                          for($i=0; $i<5 && $assign=mysqli_fetch_array($assignT); $i++) {
                                            echo "<td>".$assign[0]."</td>";
                                          }

                                        $swT=mysqli_query($mysqli, "SELECT score FROM seatwork WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY sw_num");

                                          for($i=0; $i<5 && $sw=mysqli_fetch_array($swT); $i++) {
                                            echo "<td>".$sw[0]."</td>";
                                          }      

                                        $quizT=mysqli_query($mysqli, "SELECT score FROM quiz WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY quiz_num");

                                          for($i=0; $i<5 && $quiz=mysqli_fetch_array($quizT); $i++) {
                                            echo "<td>".$quiz[0]."</td>";
                                          }

                                        $projT=mysqli_query($mysqli, "SELECT score FROM project WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND active = 1 ORDER BY proj_num");

                                          for($i=0; $i<5 && $proj=mysqli_fetch_array($projT); $i++) {
                                            echo "<td>".$proj[0]."</td>";
                                          }   

                                        $mexT=mysqli_query($mysqli, "SELECT score FROM exam WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND exam_type='ME' AND active = 1");

                                          $mex=mysqli_fetch_array($mexT);
                                          echo "<td><center><h5>".$mex[0]."</center></h5></td>";

                                         $pexT=mysqli_query($mysqli, "SELECT score FROM exam WHERE stud_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND grade_per = ".$_GET['gper']." AND exam_type='PE' AND active = 1");

                                          $pex=mysqli_fetch_array($pexT);
                                          echo "<td><center><h5>".$pex[0]."</center></h5></td>";

                                        $gradeT=mysqli_query($mysqli, "SELECT * FROM grades WHERE student_id ='".$row[0]."' AND subj_id = ".$_GET['subj']." AND grade_level = ".$_GET['level']." AND teacher_id = '".$_SESSION['id']."' AND active = 1");

                                          $grade=mysqli_fetch_array($gradeT);
                                          echo "<td><center><h5>".round($grade[$_GET['gper'] + 3], 2)."</center></h5></td>";

                                      }

                                    ?>
                                    </tbody>
                                </table>
                                <div class="card-footer">
                            <button class="btn btn-sm btn-success" data-target="#update" data-toggle="modal"> Update </button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="update" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Score Record</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <div class="card-block">

                                <!-- name=$teacher&level=$level&section=$section&stud=$id&subj=$ -->

                                    <form action="addrecord1.php?<?php 
                                     $subj=$_GET["subj"]; $name=$_GET["name"]; $level=$_GET["level"]; $section=$_GET["section"];$prd=$_GET["prd"];

                                      echo "name=$name&level=$level&section=$section&subj=$subj&prd=$prd";

                                     ?>"
                                    " method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">ID Number</label>
                                            <div class="col-md-9">
                                            <input type="text" class="form-control" name="id" id="id" placeholder="Enter ID Number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="text-input">Type</label>
                                            <div class="col-md-4">
                                                <select class="form-control" id="type" name="type" onchange="get(this.value);">
                                                <option value='0'>SELECT...</option>
                                                <option>Homeworks and Assignments</option>
                                                <option>Seatworks</option>
                                                <option>Quizzes</option>
                                                <object></object>
                                                <option>Projects</option>
                                                <option>Midterm Exam</option>
                                                <option>Periodical Exam</option>
                                                </select>
                                          </div>


                                          <label class="col-md-2 form-control-label" for="password-input">No.</label>
                                            <div class="col-md-3">
                                                <select class="form-control" type="text" name="no" id="no"></select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="password-input">Title</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="title" id="title" placeholder="Enter Topic/Title">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="password-input">Total Score</label>
                                            <div class="col-md-4">
                                                <input class="form-control" type="text" name="total" id="total">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="password-input">Accumulated Score</label>
                                            <div class="col-md-4">
                                                <input class="form-control" type="text" name="acc" id="acc"></div>
                                            </div>
                                    <div class="card-footer">
                                    <button onsubmit="validate()" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                    </div>
                                    </form>
                                </div>

                    </div>
                </div>        
      </div>
    </div>
  </div>
</div>

</div>
            <!-- /.conainer-fluid -->
        </main>


<script type="text/javascript">
    var o=document.getElementById('no');

      function get(value){
          if(value=='0'||value=="Midterm Exam"||value=="Periodical Exam"){
            o.innerHTML="<option></option>";
          }else if(value=="Projects"){
            o.innerHTML="<option>1</option><option>2</option><option>3</option>";
          }else{
            o.innerHTML="<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>";
          }
      }

    </script>

        <script type="text/javascript">
            var t=document.getElementById('tablebody');
            t.innerHTML="<?php 
                $level=$_GET["level"];
                $section=$_GET["section"];
                $teacher=$_GET["name"];

                $mysqli=new mysqli("localhost","root","","oneschool");
                $table=mysqli_query($mysqli,"SELECT * FROM studentlist WHERE section='$section' AND status!='Done'");
                while($row=mysqli_fetch_array($table)){
                    echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td><a href='updaterecord.php?name=$teacher&level=$level&section=$section&stud=$row[0]'><button class='btn btn-sm btn-primary'> View</button></a></td></tr>";

                }

            ?>"
                

        </script>


    </div>

    <footer class="app-footer">

    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
     
    <script src="bower_components/pace/pace.min.js"></script>


    <!-- Plugins and scripts required by all views -->
    <script src="bower_components/chart.js/dist/Chart.min.js"></script>


     <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- GenesisUI main scripts -->

    <script src="js/app.js"></script>


    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
    <script src="js/views/main.js"></script>

</body>

</html>
    