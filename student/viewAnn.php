<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION["name"])){
    header("location: ../index.php");
}

$annT=mysqli_query($mysqli, "SELECT * FROM ANNOUNCEMENT WHERE ann_id = ".$_POST['ann_id']." ");
$ann=mysqli_fetch_array($annT);

$adminT=mysqli_query($mysqli, "SELECT * FROM admin WHERE admin_id = '".$ann[1]."' ");
$admin=mysqli_fetch_array($adminT);

$adminName=$admin[2]." ";
if($admin[3]) {
  $admin.=$admin[3][0]." ";
}
$adminName.=$admin[4];

?>

<!DOCTYPE html>
<html lang="en" ng-app>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - <?php echo $ann[2]; ?></title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar.php"); ?>
    <main class="main">
        
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
          <a href="welcome.php">
            Welcome
          </a>
        </li>
        <li class="breadcrumb-item active">
        <?php if(strlen($ann[2]) > 10) { echo substr($ann[2], 0, 10)." ... "; } else { echo $ann[2]; }  ?>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i>
                <?php echo $ann[2]; ?>
              </div>
              <div class="card-block">
                <?php
                  $date=date("l, F j, Y", strtotime($ann[4]));
                  $date.=" "."at"." ";
                  $date.=date("h:i A", strtotime($ann[4]));
                  echo '<p>'.$ann[3].'</p>
                        <hr>
                        <img src="../'.$admin[5].'" class="img-avatar" height="25px">
                        <br>
                        <span>
                          <em>
                            Posted by '.$adminName.'<br>
                            Posted on '.$date.'
                          </em>
                        </span>';
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

  </div> <!-- close body -->

  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>     
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>