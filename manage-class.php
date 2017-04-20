<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])) {
    header("location: index.php");
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

    <title>One School - Manage Class</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <?php include("header-teacher.php"); ?>
    </header>

    <div class="app-body">
        <?php include("sidebar-teacher.php") ?>

        
        <main class="main">

            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Class Schedule</li>
                <li class="breadcrumb-item active">Manage</li>                
            </ol>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" style="padding-left:50px; padding-right:50px">
                    <div class="card">
                        <div class="card-header">
                            Current Schedule
                        </div>
                        <div class="card-block">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Subject</td>
                                        <td>Schedule</td>
                                        <td>Section</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   
                                        $teacher=$_SESSION["name"];
                                        $id=mysqli_real_escape_string($mysqli, $_SESSION["id"]);

                                        $stmt="SELECT * FROM class WHERE teacher_id = '$id' AND active = 1";
                                        $table=mysqli_query($mysqli, $stmt);

                                        while($row=mysqli_fetch_array($table)) {
                                          $schedT=mysqli_query($mysqli, "SELECT * FROM schedule WHERE sched_id = ".$row[1]." AND active = 1");
                                          $sched=mysqli_fetch_array($schedT);

                                          $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$sched[1]."");
                                          $subj=mysqli_fetch_array($subjT);

                                          $date=date("h:i A", strtotime($sched[3]))." - ".date("h:i A", strtotime($sched[4]));
                                          $days= "";

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

                                          $secT=mysqli_query($mysqli, "SELECT section_name FROM subsection WHERE sec_id =".$row[3]."");
                                          $sec=mysqli_fetch_array($secT);

                                         echo "<tr>
                                                <td>".$subj[0]."</td>
                                                <td>".$date."</td>
                                                <td>".$sec[0]."</td>
                                                <td>
                                                  <a href='deleteSched.php?id=".$row[0]."'><button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button>
                                                  </a>
                                            </tr>";   
                                        }

                                    ?>
                               </tbody>
                            </table>
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addsubj"><i class="icon-plus"></i> Add</button>
                            <button class="btn btn-sm btn-secondary"><i class="icon-doc"></i> Print</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /.conainer-fluid -->
        </main>

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
                  $table2=mysqli_query($mysqli,"SELECT* FROM schedule WHERE teacher=''");
                  while($row=mysqli_fetch_array($table2)){
                    echo '<tr>
                    <td>'.$row[0].' '.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[4].'</td>
                    <td><a href="data7.php?level='.$row[0].'&subject='.$row[1].'&sched='.$row[2].'&teach='.$_GET["name"].'"><button role="select" class="btn btn-sm btn-warning"><i class="icon-minus"></i> Select</button></a>
                    </tr>';   
                  }
                ?>


                    </tbody>
                    </table>
                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#">Prev</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">2</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">4</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
      </div>

      <div class="modal-footer">
        <button data-dismiss="modal" type="button" class="btn btn-primary">Close</button>
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
    <script src="js/bootstrap.min.js"></script>

    <!-- GenesisUI main scripts -->

    <script src="js/app.js"></script>


    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
    <script src="js/views/main.js"></script>

</body>

</html>