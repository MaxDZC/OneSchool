<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])){
    header("location:index.php");
}

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

    <title>One School - View Grades</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">
    

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
                <?php 
                    $id=$_GET["secid"];

                    $studT=mysqli_query($mysqli, "SELECT * FROM student WHERE student_id ='".$_SESSION['id']."'");
                    $level=mysqli_fetch_array($studT);

                    echo '<li class="breadcrumb-item"><a href="enrollclass.php">Grade '.$level[6].'</a></li>';
                    echo '<li class="breadcrumb-item active">'.$_GET["name"].'</li>';    
                ?>
            </ol>

            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <i><strong> Class Schedule</strong></i>
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
                            $table = mysqli_query($mysqli,"SELECT * FROM class WHERE sec_id='".$id."' AND active = 1");
                            while($row=mysqli_fetch_array($table)){
                              $schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id=".$row[1]." AND active = 1");
                              $sched=mysqli_fetch_array($schedT);

                              $subjT=mysqli_query($mysqli, "SELECT * FROM subjects WHERE subj_id=".$sched[1]." AND active = 1");
                              $subj=mysqli_fetch_array($subjT);

                              $date=date("h:i A", strtotime($sched[3]))." - ".date("h:i A", strtotime($sched[4]));
                              $days= "";

                              $teachT=mysqli_query($mysqli, "SELECT * FROM teacher WHERE teacher_id='".$row[2]."'");
                              $teacher=mysqli_fetch_array($teachT);

                              if($sched[5] & 1){
                                  $days = "M";
                              }

                              if($sched[5] & 2){
                                  $days .= "T";
                              }                                                

                              if($sched[5] & 4){
                                  $days .= "W";
                              }

                              if($sched[5] & 8){
                                  $days .= "TH";
                              }  
                              
                              if($sched[5] & 16){
                                  $days .= "F";
                              }

                              if($sched[5] & 32){
                                  $days .= "Sat";
                              } 

                              if($sched[5] & 64){
                                  $days .= "Sun";
                              }

                              $date .= " ".$days;
                              $name=$teacher[4].", ".$teacher[2]." ".$teacher[3]; 

                              echo
                                "<tr>
                                    <td>".$subj[1]."</td>
                                    <td>".$date."</td>
                                    <td>".$name."</td>
                                </tr>";
                            }
                          ?>        
                        </tbody>
                      </table>
                      <?php
                       echo '<a href="enrollstud.php?secid='.$_GET['secid'].'"><button class="btn btn-md btn-warning"><i class="icon-check"></i>  Select</button>
                      </a>';
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- /.conainer-fluid -->
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
          <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <div class="card-block">
                                    <table class="table-striped table-bordered table">
                                        <thead>
                                            <th>Grade Level</th>
                                            <th>Section</th>
                                            <th>Adviser</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                          <?php
                                            $idnum = $_GET["id"];
                                            $name=$_GET["name"];
                                            $mysqli = new mysqli("localhost","root","","oneschool");

                                            $query=mysqli_query($mysqli,"SELECT currentgr FROM studentlist WHERE idnum='$id' AND status!='Done'");

                                            $select=mysqli_fetch_array($query);

                                            $level=$select[0];

                                            $table = mysqli_query($mysqli,"SELECT * FROM class WHERE gradelvl='$level'");
                                            while($row=mysqli_fetch_array($table)){
                                                echo
                                                    "<tr>
                                                        <td>".$row[0]."</td>
                                                        <td>".$row[1]."</td>
                                                        <td>".$row[2]."</td>
                                                        <td><a target='_blank' href='viewclass.php?id=$idnum&name=$name&level=$row[0]&sect=$row[1]'><button class='btn btn-md btn-primary'><i class='fa fa-circle-o'></i>  View</button></a> <button class='btn btn-md btn-warning'><i class='icon-check'></i>  Select</button></td>
                                                    </tr>";
                                                }
                                        ?>  
                                        </tbody>
                                    </table>
                                </label>
                                </div>
                                    
                                </div>

                    </div>
                </div>        
      </div>
    </div>
  </div>
</div>

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

    <!-- GenesisUI main scripts -->

    <script src="js/app.js"></script>





    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
    <script src="js/views/main.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>