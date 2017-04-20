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
                <li class="breadcrumb-item active">Create Class</li>
            </ol>
            <div class="container-fluid">
                <div class="row col-lg-16 card">
                    <div class="card-header">
                        <strong>Created Class</strong>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>Grade Level</th>
                                <th>Section</th>
                                <th>Adviser</th>
                                <th>No. of Enrolled Students</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php 
                                $table=mysqli_query($mysqli,"SELECT * FROM subsection");
                                while($row=mysqli_fetch_array($table)){
                                  $teacherT=mysqli_query($mysqli, "SELECT t_fName, t_mName, t_lName FROM teacher WHERE teacher_id = '".$row[1]."'");
                                  $adv=mysqli_fetch_array($teacherT);

                                  $name=$adv[2].", ".$adv[0];
                                  if($adv[1]) {
                                    $name .= " ".$adv[1][0].".";
                                  }

                                  $classT=mysqli_query($mysqli, "SELECT class_id FROM class WHERE sec_id = ".$row[0]." AND active = 1");
                                  $classArray = array();
                                  while($class=mysqli_fetch_array($classT)) {
                                    array_push($classArray, $class[0]);
                                  }
                                  $answer=implode(", ", $classArray);

                                  $enrolledT=mysqli_query($mysqli, "SELECT COUNT(*) FROM section WHERE class_id IN ($answer) ");
                                  $enrolled=mysqli_fetch_array($enrolledT);

                                  echo "<tr>
                                          <td>
                                            ".$row[2]."
                                          </td>
                                          <td>
                                            ".$row[3]."
                                          </td>
                                          <td>
                                            ".$name."
                                          </td>
                                          <td>
                                            ".$enrolled[0]."/".$row[4]."
                                          </td><td>
                                  <a href='viewmodal.php?level=".$row[0]."&sect=".$row[1]."'><button class='btn btn-sm btn-success'><i class='fa fa-circle-o'></i> View</button></a> <a href='data14.php?level=".$row[0]."&sect=".$row[1]."'><button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button></a>
                                  </td></tr>";
                                }

                            ?>
                            </tbody>
                        </table>
                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addstud"><i class="icon-plus"></i> Add Class</button>                        
                    </div>
                </div>                
            </div>
            <!-- /.conainer-fluid -->
        </main>

<div class="modal" id="addstud" role="dialog">
  <div class="modal-dialog modal-md">
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
                                    <form action="data13.php" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        <div class="form-group row">
                                <label class="col-md-3" for="grade">
                                    Grade
                                </label>
                                <div class="col-md-9">
                                    <select class="form-control" id="gradelvl" name="gradelvl">
                                        <option value='0'>Grade Level</option>
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
                                            <label class="col-md-3 form-control-label" for="section">Section</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="sect" name="sect" placeholder="Section">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 form-control-label" for="studs">Allowable No. of Students</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" id="studs" name="studs">
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

<div class="modal" id="modal1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>View Class</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                        <div id="yeah"></div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button onclick="studlist()" class="btn btn-md btn-primary">Student List</button>
                                            <button onclick="schedlist()" class="btn btn-md btn-secondary">Schedule List</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12" id="table"></div>
                                    </div>
                                </div>
                    </div>
                </div>        
      </div>
    </div>
  </div>
</div>

</div>

<div class="modal" id="addmodal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Enroll Student (Admin)</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <div class="card-block">
                                    
                                </div>
                    </div>
                </div>        
      </div>
    </div>
  </div>
</div>

</div>

     
    <script type="text/javascript">


        var table=document.getElementById('table');
            
        function studlist(){
            table.innerHTML="<table class='table table-striped table-bordered'><thead><th>ID Number</th><th>Student Name</th><th>Action</th></thead><tbody>"+'<?php echo '<tr><td>what</td><td>Hello</td><td><button class="btn btn-sm btn-danger"><i class="icon-minus"></i> Delete</button></td></tr>'; ?>'+"</tbody></table><button class='btn btn-md btn-success' data-dismiss='modal' data-toggle='modal' data-target='#addmodal'><i class='icon-plus'></i> Add</button>";
        }

        function schedlist(){
            table.innerHTML="<table class='table table-striped table-bordered'><thead><th>Subject</th><th>Time</th><th>Action</th></thead><tbody>"+'<?php echo '<tr><td>what</td><td>Hello</td><td><button class="btn btn-sm btn-danger"><i class="icon-minus"></i> Delete</button></td></tr>'; ?>'+"</tbody></table><button class='btn btn-md btn-success'  data-dismiss='modal'><i class='icon-plus'></i> Add</button>";
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