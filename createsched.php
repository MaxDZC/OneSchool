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

    <title>One School - Create Teacher</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

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
                <li class="breadcrumb-item active">Schedule Plot</li>
            </ol>

            <div class="container-fluid">
                <div class="row col-lg-16 card">
                    <div class="card-header">
                        <strong>Created Schedule</strong>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>Grade Level</th>
                                <th>Subject</th>
                                <th>Time</th>
                                <th>Teacher</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                  $table=mysqli_query($mysqli, "SELECT * FROM schedule WHERE active = 1");
                                  while($row=mysqli_fetch_array($table)){
                                    $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$row[1]."");
                                    $subj=mysqli_fetch_array($subjT);

                                    $date=date("h:i A", strtotime($row[3]))." - ".date("h:i A", strtotime($row[4]));
                                    $days= "";

                                    if($row[5] & 1){
                                        $days = "M";
                                    }

                                    if($row[5] & 2){
                                        $days .= "T";
                                    }                                                

                                    if($row[5] & 4){
                                        $days .= "W";
                                    }

                                    if($row[5] & 8){
                                        $days .= "TH";
                                    }  
                                    
                                    if($row[5] & 16){
                                        $days .= "F";
                                    }

                                    if($row[5] & 32){
                                        $days .= "Sat";
                                    } 

                                    if($row[5] & 64){
                                        $days .= "Sun";
                                    }

                                    $date .= " ".$days;

                                    $classT=mysqli_query($mysqli, "SELECT teacher_id FROM class WHERE sched_id = ".$row[0]." and active = 1");
                                    $class=mysqli_fetch_array($classT);

                                    $teacherT=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id = '".$class[0]."'");

                                    if(mysqli_num_rows($teacherT) == 1) {
                                      $teacher=mysqli_fetch_array($teacherT);
                                      $name = $teacher[2].", ".$teacher[0];
                                      if($teacher[1]) {
                                        $name .= " ".$teacher[1][0].".";
                                      }
                                    } else {
                                      $name = "No Teacher Yet";
                                    }

                                    echo "<tr>
                                            <td>
                                              <center>".$row[2]."</center>
                                            </td>
                                            <td>
                                              ".$subj[0]."
                                            </td>
                                            <td>
                                              ".$date."
                                            </td>
                                            <td>
                                              ".$name."
                                            </td>
                                            <td>
                                              <button class='btn btn-sm btn-success'>
                                                <i class='icon-check'></i> Update
                                              </button> 

                                              <a href='data11.php?level=".$row[0]."&subj=".$row[1]."&sched=".$row[2]."'>
                                              <button class='btn btn-sm btn-danger'>
                                                <i class='icon-minus'></i> Delete
                                              </button></a>
                                            </td>
                                            </tr>";
                                  }
                              ?>
                            </tbody>
                        </table>
                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addstud"><i class="icon-plus"></i> Add Schedule</button>                        
                    </div>
                </div>                
            </div>
            <!-- /.conainer-fluid -->
        </main>
        
<div class="modal" id="addstud" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Schedule Maker</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <div class="card-block">
                                    <form action="data4.php" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Grade Level</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="gradelvl" name="gradelvl">
                                                <option value='0'>GRADE LEVEL</option>
                                                <option>Grade 1</option>
                                                <option>Grade 2</option>
                                                <option>Grade 3</option>
                                                <option>Grade 4</option>
                                                <option>Grade 5</option>
                                                <option>Grade 6</option>
                                                <option>Grade 7</option>
                                                <option>Grade 8</option>
                                                <option>Grade 9</option>
                                                <option>Grade 10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Subject ID</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="subjid" name="subjid">
                                        <option value='0'>SUBJECT</option>
                                        <option>Mother Tongue</option>
                                        <option>Filipino</option>
                                        <option>English</option>
                                        <option>Mathematics</option>
                                        <option>Science</option>
                                        <option>Araling Panlipunan</option>
                                        <option>Edukasyon sa Pagkatao</option>
                                        <option>Music</option>
                                        <option>Arts</option>
                                        <option>Physical Education</option>
                                        <option>Health</option>
                                        <option>Edukasyong Pantahanan at Pangkabuhayan</option>
                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="password-input">Time</label>
                                            <div class="col-md-4">
                                                <select class="form-control" id="stime" name="stime" size="2" onchange="month(this.value)">
                                                    <option value='0'>HH:MM</option>
                                                    <option>7:30 AM</option>
                                                    <option>8:00 AM</option>
                                                    <option>8:30 AM</option>
                                                    <option>9:00 AM</option>
                                                    <option>9:30 AM</option>
                                                    <option>10:00 AM</option>
                                                    <option>10:30 AM</option>
                                                    <option>11:00 AM</option>
                                                    <option>11:30 AM</option>
                                                    <option>12:00 PM</option>
                                                    <option>12:30 PM</option>
                                                    <option>1:00 PM</option>
                                                    <option>1:30 PM</option>
                                                    <option>2:00 PM</option>
                                                    <option>2:30 PM</option>
                                                    <option>3:00 PM</option>
                                                    <option>3:30 AM</option>
                                                    <option>4:00 PM</option>
                                                    <option>4:30 PM</option>
                                                    <option>5:00 PM</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" name="etime" id="etime" size="2">
                                                    <option value='0'>HH:MM</option>
                                                    <option>7:30 AM</option>
                                                    <option>8:00 AM</option>
                                                    <option>8:30 AM</option>
                                                    <option>9:00 AM</option>
                                                    <option>9:30 AM</option>
                                                    <option>10:00 AM</option>
                                                    <option>10:30 AM</option>
                                                    <option>11:00 AM</option>
                                                    <option>11:30 AM</option>
                                                    <option>12:00 PM</option>
                                                    <option>12:30 PM</option>
                                                    <option>1:00 PM</option>
                                                    <option>1:30 PM</option>
                                                    <option>2:00 PM</option>
                                                    <option>2:30 PM</option>
                                                    <option>3:00 PM</option>
                                                    <option>3:30 AM</option>
                                                    <option>4:00 PM</option>
                                                    <option>4:30 PM</option>
                                                    <option>5:00 PM</option>
                                                </select>
                                            </div>
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

     
    <script type="text/javascript">
        function validate(){

        }


        var select=document.getElementById('dd');


        function month(value){
            switch(value){
                case '0': select.innerHTML="<option>DD</option>";
                          break;
                case '1':
                case '3':
                case '5':
                case '7':
                case '8':
                case '10':
                case '12': select.innerHTML="<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>";
                    break;
                case '2': select.innerHTML="<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option>";
                    break;
                default: select.innerHTML="<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option>";
                    break;

            }
            return value;
        }
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