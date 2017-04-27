<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$table=mysqli_query($mysqli,"SELECT * FROM student WHERE active = 1 ORDER BY student_id");

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Create Student</title>

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
          <li class="breadcrumb-item active">Student Creation</li>
        </ol>
        <div class="container-fluid">

          <div class="row col-lg-16 card">
            <div class="card-header">
              <strong>List of Students</strong>
            </div>
            <div class="card-block">

              <form action="delStud.php" method="POST">
                <input type="hidden" name="id" value="" required>
              </form>

              <form action="editStud.php" method="POST">
                <input type="hidden" name="id" value="" required>
              </form>

              <table class="table table-striped table-bordered">
                <thead>
                  <th>ID Number</th>
                  <th>Student Name</th>
                  <th>Current Grade Level</th>
                  <th>Action</th>
                </thead>
                <tbody>
                <?php 
                  while($row=mysqli_fetch_array($table)){
                    $name = $row[4].", ".$row[2]." "; if($row[3]) { $name.=$row[3][0]."."; };
                    echo 
                    "<tr>
                      <td>".$row[0]."</td>
                      <td>".$name."</td>
                      <td><center>".$row[6]."</center></td>
                      <td>
                        <center>
                          <a href='javascript: editStud(\"".$row[0]."\")'>
                            <button class='btn btn-sm btn-warning'>
                              <i class='icon-pencil'></i> Edit
                            </button>
                          </a>
                          <a href='javascript: delStud(\"".$row[0]."\")'>
                            <button class='btn btn-sm btn-danger'>
                              <i class='icon-minus'></i> Delete
                            </button>
                          </a>
                        </center>
                      </td>
                    </tr>";
                  }
                ?>
                </tbody>
              </table>
              <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addstud"><i class="icon-plus"></i> Add Student </button>                        
            </div>
          </div>                
        
        </div> <!-- End of container -->
      </main>
    </div>

  <div class="modal" id="addstud" role="dialog">

    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">
            <strong>Student Registration</strong>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                
                <div class="card-block">
                  <form action="insertStud.php" method="POST" class="form-horizontal">

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">First Name:</label>
                      <div class="col-md-9">
                        <input type="text" name="fname" class="form-control" placeholder="Enter Student First Name" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Mid Name:</label>
                      <div class="col-md-9">
                          <input type="text" name="mname" class="form-control" placeholder="Enter Student Middle Name">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Last Name:</label>
                      <div class="col-md-9">
                        <input type="text" name="lname" class="form-control" placeholder="Enter Student Last Name" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Address:</label>
                      <div class="col-md-9">
                        <input type="text" name="address" class="form-control" placeholder="Enter Student Address" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Birthdate:</label>
                      <div class="col-md-9">
                        <input type="date" name="bday" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Grade Level</label>
                      <div class="col-md-9">
                        <select name="grade_level" class="form-control" required>
                          <option value='' selected>Select Level</option>
                          <option ng-repeat="i in [1,2,3,4,5,6,7,8,9,10]" value='{{i}}'>Grade {{i}}</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Gender: </label>
                      <div class="col-md-9">
                        <span for="input1">Male:</span>
                        <input type="radio" name="gender" value="M" required><br>
                        <span for="input2">Female:</span>
                        <input type="radio" name="gender" value="F">
                      </div>
                    </div>

                    <div class="card-footer">
                      <button  type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                    </div>

                  </form>
                </div>
              </div> <!-- Modal's Card -->       
            </div>
          </div> <!-- End Row -->

        </div> <!-- Modal Body -->
      </div> <!-- Content -->
    </div> <!-- Dialog -->
  </div> <!-- End modal -->

  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>     
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>

  <script>
    function delStud(id)
    {
      document.forms[0].id.value = id;
      document.forms[0].submit();
    }

    function editStud(id)
    {
      document.forms[1].id.value = id;
      document.forms[1].submit();
    }
  </script>

</body>
</html>