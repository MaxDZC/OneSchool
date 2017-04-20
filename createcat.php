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

                <li class="breadcrumb-item active">Subject Creation</li>
            </ol>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="card">
                    <div class="card-header">
                        <strong>Created Subjects</strong>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>Subject</th>
                                <th>Action</th>
                            </thead>
                        <tbody><?php 
                                $table=mysqli_query($mysqli,"SELECT*FROM subjects");
                                while($row=mysqli_fetch_array($table)){
                                  echo "<tr>
                                        <td>
                                          ".$row[1]."
                                        </td>
                                        <td> 
                                          <a href='data12.php?lvl=".$row[0]."&subj=".$row[1]."'>
                                            <button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button></a></td></tr>";
                                }
                                ?>
                        </tbody>
                        </table>                        
                    </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="card">
                    <div class="card-header">
                        <strong>Add Category</strong>
                    </div>
                    <div class="card-block">
                        <form action="data3.php" method="post" class="form-horizontal">
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
                                <label class="col-md-3" for="subjid">
                                    Subject
                                </label>
                                <div class="col-md-9">
                                    <select class="form-control" id="subjid" name="subjid">
                                        <option value='0'>Subject</option>
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
                            <div class="form-group">
                                <center><label class="col-md-12">PERCENTAGE DISTRIBUTION</label></center>
                                <div class="row">
                                    <label class="col-md-3" for="hwa">Homeworks & Assignments</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="hwa" id="hwa"><span>in %</span>
                                    </div>
                                    <label class="col-md-3" for="sw">Seatworks</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="sw" id="sw"><span>in %</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3">Quizzes</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="qz" id="qz"><span>in %</span>
                                    </div>
                                    <label class="col-md-3">Projects</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="prj" id="prj"><span>in %</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3">Midterm Exam</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="me" name="me"><span>in %</span>
                                    </div>
                                    <label class="col-md-3">Periodical Exam</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="fe" id="fe"><span>in %</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-success"><i class="icon-check"></i> SUBMIT</button>
                            </div>
                        </form>                        
                    </div>
                    </div>
                    </div>
                </div>                
            </div>
            <!-- /.conainer-fluid -->
        </main>

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