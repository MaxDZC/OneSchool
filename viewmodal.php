
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

                <li class="breadcrumb-item">Class View</li>
                <li class="breadcrumb-item active"><?php
                    $level=$_GET["level"];
                    $sect=$_GET["sect"];
                    echo $level." - ".$sect;
                ?></li>
                
            </ol>


            <div class="container-fluid">
                <div class="row">
                    <?php 
                        $level=$_GET["level"];
                        $section=$_GET["sect"];
                        $var=0;

                        $mysqli=new mysqli("localhost","root","","oneschool");
                        $table=mysqli_query($mysqli,"SELECT * from studentlist WHERE currentgr='$level' AND section='$section' AND status!='Done'");
                        while($row=mysqli_fetch_array($table)){
                            $var++;
                        }
                        $sql="UPDATE class SET nos='$var' WHERE gradelvl='$level' AND section='$section'";
                        $mysqli->query($sql);
                    ?>
                    <div class="col-lg-12">
                            <button onclick="schedlist()" class="btn btn-md btn-primary">Schedule List</button>
                            <button onclick="studlist()" class="btn btn-md btn-secondary">Student List</button>
                            <br>
                            <br>
                            <div id="table"></div>
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
                        <div id="yeah"></div>
                                <div class="card-header">
                                    <strong><?php echo $_GET["level"];?> Students</strong>
                                </div>
                                <div class="card-block">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>ID Number</th>
                                            <th>Student Name</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $level=$_GET["level"];
                                                $sect=$_GET["sect"];
                                                $mysqli=new mysqli("localhost","root","","oneschool");
                                                $table=mysqli_query($mysqli,"SELECT * FROM studentlist WHERE currentgr='$level' AND section=''");
                                                while($row=mysqli_fetch_array($table)){
                                                    echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td>
                                                    <td><a href='viewmodalre.php?idnum=".$row[0]."&name=".$row[1]."&sect=".$sect."&level=".$level."'><button class='btn btn-sm btn-success'><i class='icon-check'></i> Select</button></a></td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                </div>        
      </div>
    </div>
  </div>
</div>

</div>
<div class="modal" id="addmodal2" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Add Schedule</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                        <div id="yeah"></div>
                                <div class="card-header">
                                    <strong><?php echo $_GET["level"]." - ".$_GET["sect"];?></strong>
                                </div>
                                <div class="card-block">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Subject</th>
                                            <th>Time</th>
                                            <th>Teacher</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $level=$_GET["level"];
                                                $sect=$_GET["sect"];
                                                $mysqli=new mysqli("localhost","root","","oneschool");
                                                $table=mysqli_query($mysqli,"SELECT * FROM schedule WHERE gradelvl='$level' AND section=''");
                                                while($row=mysqli_fetch_array($table)){
                                                    echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td>
                                                    <td><a href='viewmodelre2.php?subject=".$row[1]."&time=".$row[2]."&sect=".$sect."&level=".$level."'><button class='btn btn-sm btn-success'><i class='icon-check'></i> Select</button></a></td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
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
            
        function schedlist(){
            table.innerHTML="<div class='card'><div class='card-header'><strong>"+'<?php echo $_GET["level"]." - ".$_GET["sect"];?>'+"</strong></div><div class='card-block'><table class='table table-striped table-bordered'><thead><th>Subject</th><th>Time</th><th>Teacher</th><th>Action</th></thead><tbody>"+'<?php $level=$_GET["level"]; $section=$_GET["sect"]; $mysqli=new mysqli("localhost","root","","oneschool"); $table=mysqli_query($mysqli,"SELECT * FROM schedule WHERE gradelvl='$level' AND section='$section'"); while($row=mysqli_fetch_array($table)){echo '<tr><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td><a href="viewmodald2.php?level='.$level.'&sect='.$section.'&subject='.$row[1].'"><button class="btn btn-sm btn-danger"><i class="icon-minus"></i> Delete</button></a></td></tr>';} ?>'+"</tbody></table><button class='btn btn-md btn-success' data-dismiss='modal' data-toggle='modal' data-target='#addmodal2'><i class='icon-plus'></i> Add</button></div></div>";
        }

        function studlist(){
            table.innerHTML="<div class='card'><div class='card-header'><strong>"+'<?php echo $_GET["level"]." - ".$_GET["sect"];?>'+"</div><div class='card-block'><table class='table table-striped table-bordered'><thead><th>ID Number</th><th>Student Name</th><th>Action</th></thead><tbody>"+'<?php $level=$_GET["level"]; $section=$_GET["sect"]; $mysqli=new mysqli("localhost","root","","oneschool"); $table=mysqli_query($mysqli,"SELECT * FROM studentlist WHERE currentgr='$level' AND section='$section' AND status!='Done'"); while($row=mysqli_fetch_array($table)){echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td><a href="viewmodalde.php?level='.$level.'&sect='.$section.'&idnum='.$row[0].'"><button class="btn btn-sm btn-danger"><i class="icon-minus"></i> Delete</button></a></td></tr>';} ?>'+"</tbody></table><button class='btn btn-md btn-success' data-toggle='modal' data-target='#addmodal'><i class='icon-plus'></i> Add</button></div></div>";
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