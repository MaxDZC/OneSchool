<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Registration</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>

<body>
  <br><br>
  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <strong>Registration Form</strong>
        </div>
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

  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>     
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>

</body>
</html>