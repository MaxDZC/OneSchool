<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Login Page</title>

  <link rel="icon" href="img/favicon.ico" type="image/x-icon">

  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/simple-line-icons.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="app flex-row align-items-center" ng-app="login">
  <div class="container">

    <div class="row justify-content-center"> <!-- To make it center -->
      <div class="col-md-8">
        <center>
          <img src="img/LogoT.png" style="height: 50px;background-color: transparent;"><br><br>
        </center>
        <div class="card-group mb-0">
          
          <div class="card p-2">
            <div class="card-block">

              <form action="database/validate.php" method="POST">
                <h1>Login Form</h1>
                <p class="text-muted">Sign In to your account</p>
                <?php if(isset($_SESSION["newID"])) { echo "Your ID # is ".$_SESSION["newID"]." and the default password is 123."; } ?>
                <div class="input-group mb-1">
                  <span class="input-group-addon"><i class="icon-user"></i>
                  </span>
                  <input type="text" name="id" class="form-control" <?php if(isset($_SESSION["newID"])) { echo "value='".$_SESSION["newID"]."'"; } else echo "placeholder='ID Number'"; ?> autocomplete="off">
                </div>
                <div class="input-group mb-2">
                  <span class="input-group-addon"><i class="icon-lock"></i>
                  </span>
                  <input type="password" name="pass" class="form-control" placeholder="Password">
                </div>
                <div class="row">
                  <div class="col-10">
                    <button type="submit" class="btn btn-primary px-2">Login</button>
                  </div>
                </div>
              </form>
              <hr>
              <a href="registration.php">
                <button class="btn btn-sm btn-success">Register: Student</button>
              </a>
              <a href="registrationT.php">
                <button class="btn btn-sm btn-success">Register: Teacher</button>
              </a>       

            </div>
          </div>

          <div class="card card-inverse card-primary py-3 hidden-md-down" style="width:44%">
            <div class="card-block text-center">
              <br><br>
              <p><h3>Re-imagine Education</h3></p>
              <h3>
                <i class="icon-note"></i>
                <i class="icon-wallet"></i>
                <i class="icon-chart"></i>
                <i class="icon-book-open"></i>
              </h3>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div> <!-- Close container -->
  
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/tether/dist/js/tether.min.js"></script>
  <script src="js/angular.js"></script>
  <script src="js/views.js"></script>
</body>
</html>