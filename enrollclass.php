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

    <title>One School - Enroll</title>

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
                <li class="breadcrumb-item active"><?php 
                    $id=$_SESSION["id"];

                    $table=mysqli_query($mysqli,"SELECT * FROM STUDENT WHERE student_id= '".$id."'");
                    $select=mysqli_fetch_array($table);
                    echo "Grade ".$select[6];
                ?></li>
            </ol>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"></i><strong> Class Schedule
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
                                            $idnum = $_SESSION["id"];

                                            $table=mysqli_query($mysqli,"SELECT * FROM section WHERE student_id='".$id."' AND active = 1");

                                            while($row=mysqli_fetch_array($table)){
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

                                                if($row3[5] & 1){
                                                    $days = "M";
                                                }

                                                if($row3[5] & 2){
                                                    $days .= "T";
                                                }                                                

                                                if($row3[5] & 4){
                                                    $days .= "W";
                                                }

                                                if($row3[5] & 8){
                                                    $days .= "TH";
                                                }  
                                                
                                                if($row3[5] & 16){
                                                    $days .= "F";
                                                }

                                                if($row3[5] & 32){
                                                    $days .= "Sat";
                                                } 

                                                if($row3[5] & 64){
                                                    $days .= "Sun";
                                                }

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
                                        <div class="card-footer">
                                            <button data-toggle="modal" data-target="#enrollsched" class="btn btn-md btn-success"><i class="icon-plus"></i> Enroll</button>
                                        </div>
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
                                    <?php
                                        if(!$select[10]){
                                            echo '<table class="table-striped table-bordered table">
                                                    <thead>
                                                        <th>Section</th>
                                                        <th>Adviser</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>';

                                            $table=mysqli_query($mysqli,"SELECT * FROM subsection WHERE grade_level=".$select[6]." AND active = 1");


                                            while($row=mysqli_fetch_array($table)){
                                                $nameget=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id ='".$row[1]."'");
                                                $name=mysqli_fetch_array($nameget);

                                                $fullName=$name[2].", ".$name[0]." ".$name[1];

                                                echo
                                                    '<tr>
                                                      <td>
                                                        '.$row[3].'
                                                      </td>
                                                      <td>
                                                        '.$fullName.'
                                                      </td>
                                                      <td>
                                                        <a href="viewclass.php?secid='.$row[0].'&name='.$row[3].'"><button class="btn btn-md btn-primary"><i class="fa fa-circle-o"></i>  View</button>
                                                        </a> 
                                                        <a href="enrollstud.php?secid='.$row[0].'"><button class="btn btn-md btn-warning"><i class="icon-check"></i>  Select</button>
                                                        </a>
                                                      </td>
                                                    </tr>';
                                                }
                                         echo'
                                        </tbody>
                                    </table>';
                                        } else {
                                            echo "You are already enrolled!";
                                        }
                                    ?>
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