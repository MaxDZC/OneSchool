<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$teacherT=mysqli_query($mysqli, "SELECT * FROM teacher WHERE active = 1");

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
        <li class="breadcrumb-item active">Teacher Creation</li>
      </ol>

      <div class="container-fluid">

        <div class="row col-lg-16 card">
          <div class="card-header">
            <strong>Registered Teachers</strong>
          </div>

          <div class="card-block">

            <form action="viewTeach.php" method="POST">
              <input type="hidden" name="id" value="" required>
            </form>

            <form action="delTeach.php" method="POST">
              <input type="hidden" name="id" value="" required>
            </form>

            <form action="editTeach.php" method="POST">
              <input type="hidden" name="id" value="" required>
            </form>

            <table class="table table-striped table-bordered">
              <thead>
                <th>ID Number</th>
                <th>Teacher's Name</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                  while($row=mysqli_fetch_array($teacherT)) {
                    $name = $row[4].", "." ".$row[2]; if($row[3]) { $name.=" ".$row[3][0]."."; }
                    echo "
                    <tr>
                      <td>".$row[0]."</td>
                      <td>".$name."</td>
                      <td>
                        <center>
                          <a href='javascript: viewTeach(\"".$row[0]."\")'>
                            <button class='btn btn-sm btn-success'>
                              <i class='icon-pencil'></i> View Schedule
                            </button>
                          </a>
                          <a href='javascript: editTeach(\"".$row[0]."\")'>
                            <button class='btn btn-sm btn-warning'>
                              <i class='icon-pencil'></i> Edit
                            </button>
                          </a>
                          <a href='javascript: delTeach(\"".$row[0]."\")'>
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
            <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addTeach"><i class="icon-plus"></i> Add Teacher</button>                        
          </div>
        </div>                
      
      </div> <!-- End of Container -->
    </main>
  </div>

  <div class="modal" id="addTeach" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Teacher Registration</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-block">
                  <form action="insertTeach.php" method="POST" class="form-horizontal">

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">First Name:</label>
                      <div class="col-md-9">
                        <input type="text" name="fname" class="form-control" placeholder="Enter Teacher First Name" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Mid Name:</label>
                      <div class="col-md-9">
                        <input type="text" name="mname" class="form-control" placeholder="Enter Teacher Middle Name">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Last Name:</label>
                      <div class="col-md-9">
                        <input type="text" name="lname" class="form-control" placeholder="Enter Teacher Last Name" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Address:</label>
                      <div class="col-md-9">
                        <input type="text" name="address" class="form-control" placeholder="Enter Teacher Address" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Email Address:</label>
                      <div class="col-md-9">
                        <input type="email" name="email" class="form-control" placeholder="Enter Teacher Email Address" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Birthdate:</label>
                      <div class="col-md-9">
                        <input type="date" name="bday" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Educational Attainment: </label>
                      <div class="col-md-9">
                        <select name="ed_att" class="form-control" required>
                          <option value="" selected>Select an Educational Attainment</option>
                          <option value="High School">High School Graduate</option>
                          <option value="Bachelor">College Undergraduate</option>
                          <option value="Master">Master's Graduate</option>
                          <option value="Doctorate">PhD Graduate</option>
                        </select>
                      </div>
                    </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>    
          </div>
        </div> <!-- End modal body -->

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
    function viewTeach(id)
    {
      document.forms[0].id.value = id;
      document.forms[0].submit();
    }

    function delTeach(id)
    {
      document.forms[1].id.value = id;
      document.forms[1].submit();
    }

    function editTeach(id)
    {
      document.forms[2].id.value = id;
      document.forms[2].submit();
    }
  </script>

</body>
</html>