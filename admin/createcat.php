<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$subjT=mysqli_query($mysqli,"SELECT * FROM subjects WHERE active = 1");
$subjT2=mysqli_query($mysqli,"SELECT * FROM subjects WHERE active = 1");

?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Create Teacher</title>

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
        <li class="breadcrumb-item active">Subject Management</li>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">

              <div class="card-header">
                <strong>Created Subjects</strong>
              </div>

              <form action="delSubj.php" method="POST">
                <input type="hidden" name="id" value="">
              </form>

              <div class="card-block">
                <table class="table table-striped table-bordered">
                  <thead>
                    <th>Subject</th>
                    <th>Delete</th>
                  </thead>
                  <tbody>
                  <?php 
                    while($row=mysqli_fetch_array($subjT)) {
                      echo 
                      "<tr>
                        <td>".$row[1]."</td>
                        <td>
                          <center>
                            <a href='javascript: delSubj(".$row[0].")'>
                              <button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button>
                            </a>
                          </center>
                        </td>
                      </tr>";
                    }
                  ?>
                  </tbody>
                </table>

              <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addSubject">
                <i class="icon-plus"></i> Add Subject
              </button>                    
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">

              <div class="card-header">
                <strong>Edit Weights</strong>
              </div>

              <div class="card-block">

                <form action="editWeights.php" method="POST" class="form-horizontal">

                  <div class="form-group row">
                    <label class="col-md-3">
                        Grade
                    </label>
                    <div class="col-md-9">
                      <select name="grade" class="form-control" required>
                        <option value="">Select Grade Level...</option>
                        <option ng-repeat="i in [1,2,3,4,5,6,7,8,9,10]" value="{{i}}">Grade {{i}}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3" for="subjid">
                        Subject
                    </label>
                    <div class="col-md-9">
                      <select name="subject" class="form-control" required>
                        <option value="">Select a Subject...</option>
                        <?php
                          while($subj2=mysqli_fetch_array($subjT2)) {
                            echo "
                            <option value='".$subj2[0]."'>".$subj2[1]."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="card-footer">
                    <button class="btn btn-md btn-success"><i class="icon-check"></i> Update</button>
                  </div>
                
                </form>

              </div>

            </div>
          </div>
        </div>

      </div> <!-- Container End -->

    </main>
  </div>

  <div class="modal" id="addSubject" role="dialog">
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

                  <form action="addSubject.php" onsubmit="return validate();" method="POST" class="form-horizontal">
                                
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="section">Subject: </label>
                      <div class="col-md-9">
                        <input type="text" name="subject" class="form-control" placeholder="Subject Name">
                      </div>
                    </div>
                    <hr>

                    <center><label class="form-control-label"><strong>Default Weights for All Grades (Must sum up to 100)</strong></label></center>
                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Quiz (%):</label>
                      <div class="col-md-6">
                        <input type="number" name="quiz" class="form-control" value="<?php echo $ga[7]; ?>" placeholder="Quiz Weight" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Seatwork (%):</label>
                      <div class="col-md-6">
                        <input type="number" name="sw" class="form-control" value="<?php echo $ga[8]; ?>" placeholder="Seatwork Weight" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Assignment (%):</label>
                      <div class="col-md-6">
                        <input type="number" name="assign" class="form-control" value="<?php echo $ga[9]; ?>" placeholder="Assignment Weight" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Project (%):</label>
                      <div class="col-md-6">
                        <input type="number" name="proj" class="form-control" value="<?php echo $ga[10]; ?>" placeholder="Project Weight" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Midterm (%):</label>
                      <div class="col-md-6">
                        <input type="number" name="mexam" class="form-control" value="<?php echo $ga[11]; ?>" placeholder="Midterm Exam Weight" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 form-control-label">Periodical (%):</label>
                      <div class="col-md-6">
                        <input type="number" name="pexam" class="form-control" value="<?php echo $ga[12]; ?>" placeholder="Periodical Exam Weight" required>
                      </div>
                    </div>

                    <div class="card-footer">
                      <button class="btn btn-md btn-primary"><i class="icon-plus"></i> Add</button>
                    </div>

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
    function delSubj(id)
    {
      document.forms[0].id.value = id;
      document.forms[0].submit();
    }

    function validate()
    {
      quiz = parseFloat(document.forms[2].quiz.value);
      sw = parseFloat(document.forms[2].sw.value);
      assign = parseFloat(document.forms[2].assign.value);
      proj = parseFloat(document.forms[2].proj.value);
      mexam = parseFloat(document.forms[2].mexam.value);
      pexam = parseFloat(document.forms[2].pexam.value);

      if(quiz + sw + assign + proj + mexam + pexam != 100) {
        alert("The sum must be 100!");
        return false;
      } else {
        return true;
      }
    }
  </script>
</body>
</html>