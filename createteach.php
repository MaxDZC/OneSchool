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
                <li class="breadcrumb-item active">Teacher Creation</li>
            </ol>


            <div class="container-fluid">
                <div class="row col-lg-16 card">
                    <div class="card-header">
                        <strong>Registered Teachers</strong>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>ID Number</th>
                                <th>Teacher's Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                              <?php
                                $teacherT=mysqli_query($mysqli, "SELECT * FROM teacher WHERE active = 1");
                                  while($row=mysqli_fetch_array($teacherT)) {
                                    $name = $row[4].", "." ".$row[2]; if($row[3]) { $name.=" ".$row[3][0]."."; }
                                    echo "<tr>
                                            <td>
                                              ".$row[0]."
                                            </td>
                                            <td>
                                              ".$name."
                                            </td>
                                            <td>
                                              <a href='data10.php?idnum=".$row[0]."&name=".$row[1]."'>
                                              <button class='btn btn-sm btn-danger'>
                                                <i class='icon-minus'></i> Delete
                                              </button>
                                              </a>
                                            </td>
                                          </tr>";
                                  }
                              ?>
                            </tbody>
                        </table>
                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addstud"><i class="icon-plus"></i> Add Teacher</button>                        
                    </div>
                </div>                
            </div>
            <!-- /.conainer-fluid -->
        </main>

<div class="modal" id="addstud" role="dialog">
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
                            <form name="createstud" action="insertTeach.php" method="post" enctype="multipart/form-data" class="form-horizontal ">
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