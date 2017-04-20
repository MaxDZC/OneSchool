
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
    <?php include ("record.php"); ?>
    <header class="app-header navbar">
        <?php include("header-teacher.php"); ?>
    </header>

    <div class="app-body">
        <?php include("sidebar-teacher.php") ?>

        
        <main class="main">

            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Class Record</li>

                <li class="breadcrumb-item"><?php echo $_GET["level"].' - '.$_GET["section"];?></li>
                <li class="breadcrumb-item active"><?php echo $_GET["stud"]?></li>
                
            </ol>


            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-12">
                          <?php 
                            $id=$_GET["stud"];
                            $teacher=$_GET["name"];
                            $section=$_GET["section"];
                            $level=$_GET["level"];
                            $mysqli=new mysqli("localhost","root","","oneschool");
                            $list=mysqli_query($mysqli,"SELECT * FROM schedule WHERE gradelvl='$level' AND section='$section' AND teacher='$teacher'");
                            while($row=mysqli_fetch_array($list)){
                              echo "<a href='updaterecord2.php?name=$teacher&level=$level&section=$section&stud=$id&subj=$row[1]'><button class='btn btn-md btn-primary'>".$row[1]."</button></a> ";
                            }

                          ?>
                    </div>    
                </div><br>
                <div class="card col-sm-3">
                <div class="card-block form-group row">
                <label class="form-control-label" for="gradeprd">Grading Period</label>
                <select class="form-control" onchange="receive(this.value)">
                  <option value='0'>Select...</option>
                  <option value='1'>First Grading</option>
                  <option value='2'>Second Grading</option>
                  <option value='3'>Third Grading</option>
                  <option value='4'>Fourth Grading</option>
                  <option value='5'>Overall</option>
                </select>
                </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                  <div class="card">
                  <div class="card-header"><strong>Records</strong></div>
                  <div class="card-block">
                  <table class="table table-striped table-bordered">
                    <thead id='head'>
                      <th>Type</th>
                      <th>Title</th>
                      <th>Total Score</th>
                      <th>Accumulated Score</th>
                      <th>Action</th>
                    </thead>
                    <tbody id="grades"></tbody>
                  </table>
                  </div>
                  <div class="card-footer">
                  <div id="add"></div></div>
                  </div>
                </div>
            </div>
            <!-- /.conainer-fluid -->
        </main>

                
    </div>
    <div class="modal" id="addrecord" role="dialog">
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

                                    <form action="addrecord.php?<?php 
                                     $subj=$_GET["subj"]; $name=$_GET["name"]; $level=$_GET["level"]; $section=$_GET["section"]; $stud=$_GET["stud"];

                                      echo "name=$name&level=$level&section=$section&stud=$stud&subj=$subj";

                                     ?>"
                                    " method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Grade Level</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="gradeprd" name="gradeprd">
                                                <option value='0'>GRADING PERIOD</option>
                                                <option>First Grading</option>
                                                <option>Second Grading</option>
                                                <option>Third Grading</option>
                                                <option>Fourth Grading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="text-input">Type</label>
                                            <div class="col-md-4">
                                                <select class="form-control" id="type" name="type" onchange="get(this.value);">
                                                <option value='0'>ACTIVITY TYPE</option>
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


    <script type="text/javascript">
    var g=document.getElementById('grades');
    var a=document.getElementById('add');
    var h=document.getElementById('head');
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


      function receive(value){
        switch(value){
          case '0': h.innerHTML=''; g.innerHTML=''; a.innerHTML=''; break;
          case '1': h.innerHTML="<th><center>Type</center></th><th><center>No</center></th><th><center>Title</center></th><th><center>Total Score</center></th><th><center>Accumulated Score</center></th><th><center>Action</center></th>";

          g.innerHTML="<?php 
          $idnum=$_GET["stud"];
          $level=$_GET["level"];
          $period="First Grading";
          $subj=$_GET["subj"];
          $name=$_GET["name"];
          $section=$_GET["section"];

          $mysqli=new mysqli("localhost","root","","oneschool");
          $table=mysqli_query($mysqli,"SELECT *FROM studentgrades WHERE idnum='$idnum' AND gradelvl='$level' AND gradingper='$period' AND subject='$subj'");

           while($row=mysqli_fetch_array($table)){

          echo "<tr><td>".$row[4]."</td><td>".$row[9]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td><button class='btn btn-sm btn-warning'>Edit</button> <a href='deleterecord.php?name=$name&level=$level&stud=$idnum&subj=$subj&type=$row[4]&title=$row[5]&gradingper=$row[2]&section=$section&no=$row[9]'><button class='btn btn-sm btn-danger'>Delete</button></a></td></tr>";
            }
          ?>"
        a.innerHTML="<button data-target='#addrecord' data-toggle='modal' class='btn btn-md btn-success'><i class='icon-plus'></i> Add</button";;
          break;
          case '2': h.innerHTML="<th><center>Type</center></th><th><center>No</center></th><th><center>Title</center></th><th><center>Total Score</center></th><th><center>Accumulated Score</center></th><th><center>Action</center></th>";

          g.innerHTML="<?php 
          $idnum=$_GET["stud"];
          $level=$_GET["level"];
          $period="Second Grading";
          $subj=$_GET["subj"];
          $section=$_GET["section"];

          $mysqli=new mysqli("localhost","root","","oneschool");
          $table=mysqli_query($mysqli,"SELECT *FROM studentgrades WHERE idnum='$idnum' AND gradelvl='$level' AND gradingper='$period' AND subject='$subj'");

           while($row=mysqli_fetch_array($table)){ 

         
          echo "<tr><td>".$row[4]."</td><td>".$row[9]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td><button class='btn btn-sm btn-warning'>Edit</button> <a href='deleterecord.php?name=$name&level=$level&stud=$idnum&subj=$subj&type=$row[4]&title=$row[5]&gradingper=$row[2]&section=$section&no=$row[9]><button class='btn btn-sm btn-danger'>Delete</button></a></td></tr>";
            }
          ?>"

        a.innerHTML="<button data-target='#addrecord' data-toggle='modal' class='btn btn-md btn-success'><i class='icon-plus'></i> Add</button";;
          break;

      case '3': h.innerHTML="<th><center>Type</center></th><th><center>No</center></th><th><center>Title</center></th><th><center>Total Score</center></th><th><center>Accumulated Score</center></th><th><center>Action</center></th>";

      g.innerHTML="<?php 
          $idnum=$_GET["stud"];
          $level=$_GET["level"];
          $period="Third Grading";
          $subj=$_GET["subj"];
          $section=$_GET["section"];


          $mysqli=new mysqli("localhost","root","","oneschool");
          $table=mysqli_query($mysqli,"SELECT *FROM studentgrades WHERE idnum='$idnum' AND gradelvl='$level' AND gradingper='$period' AND subject='$subj'");

           while($row=mysqli_fetch_array($table)){

          echo "<tr><td>".$row[4]."</td><td>".$row[9]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td><button class='btn btn-sm btn-warning'>Edit</button> <a href='deleterecord.php?name=$name&level=$level&stud=$idnum&subj=$subj&type=$row[4]&title=$row[5]&gradingper=$row[2]&section=$section&no=$row[9]'><button class='btn btn-sm btn-danger'>Delete</button></a></td></tr>";
          }
          ?>"

        a.innerHTML="<button data-target='#addrecord' data-toggle='modal' class='btn btn-md btn-success'><i class='icon-plus'></i> Add</button";;
          break;

case '4': h.innerHTML="<th><center>Type</center></th><th><center>No</center></th><th><center>Title</center></th><th><center>Total Score</center></th><th><center>Accumulated Score</center></th><th><center>Action</center></th>";
g.innerHTML="<?php 
          $idnum=$_GET["stud"];
          $level=$_GET["level"];
          $period="Fourth Grading";
          $subj=$_GET["subj"];
          $section=$_GET["section"];


          $mysqli=new mysqli("localhost","root","","oneschool");
          $table=mysqli_query($mysqli,"SELECT *FROM studentgrades WHERE idnum='$idnum' AND gradelvl='$level' AND gradingper='$period' AND subject='$subj'");

           while($row=mysqli_fetch_array($table)){ 

          echo "<tr><td>".$row[4]."</td><td>".$row[9]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td><button class='btn btn-sm btn-warning'>Edit</button> <a href='deleterecord.php?name=$name&level=$level&stud=$idnum&subj=$subj&type=$row[4]&title=$row[5]&gradingper=$row[2]&section=$section&no=$row[9]'><button class='btn btn-sm btn-danger'>Delete</button></a></td></tr>";}

          ?>"

        a.innerHTML="<button data-target='#addrecord' data-toggle='modal' class='btn btn-md btn-success'><i class='icon-plus'></i> Add</button";
          ;
          break;
          case '5': h.innerHTML="<th>Grading Period</th><th>HW & A</th><th>Seatworks</th><th>Quizzes</th><th>Projects</th><th>Midterm</th><th>Periodical</th><th>Equiv. Grade</th>";
g.innerHTML="<?php 
          $idnum=$_GET["stud"];
          $level=$_GET["level"];
          $subj=$_GET["subj"];


          $mysqli=new mysqli("localhost","root","","oneschool");
          $table=mysqli_query($mysqli,"SELECT *FROM studentgrading WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subj'");

           while($row=mysqli_fetch_array($table)){ 

          echo "<tr><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$row[10]."</td></tr>";}

          ?>"

        a.innerHTML="";

            break;

        }

      }
    </script>

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