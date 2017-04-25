<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
    header("location: ../index.php");
}

$book_id=$_POST['id'];

$ulibT=mysqli_query($mysqli, "SELECT * from univ_library WHERE book_id = ".$book_id." AND active = 1");
$book=mysqli_fetch_array($ulibT);

?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>One School - Universal Library</title>

    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/simple-line-icons.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style type="text/css">
        input[type=text]{
            width: 130px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-image: url('img/search.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            background-color: white;
            padding: 12px 20px 12px 40px;
            -webskit-transition: width 0.4s ease-in-out;
        }
        input[type=text]{
            width: 100%;
        }
    </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header-teacher.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar-teacher.php"); ?>    
    <main class="main">  

      <ol class="breadcrumb">
        <li class="breadcrumb-item">Learning Resources</li>
        <li class="breadcrumb-item"><a href="library.php">Universal Library</a></li>
        <li class="breadcrumb-item active">
          <?php if(strlen($book[1]) > 10) { echo substr($book[1], 0, 10)." ... "; } else { echo $book[1]; }  ?>
        </li>
      </ol>

      <div class="container-fluid">  
        <div class="row">
          <div class="col-md-6">
            <div class="card">

              <div class="card-header">
                <strong>Book Description</strong>
              </div>

              <div class="card-block">
                <p>
                  <h5><?php echo $book[1]; ?></h5>
                </p>

                <p>
                  <h6><em>By <?php echo $book[3]; ?></em></h6>               
                </p>

                <p>
                  <form target="_blank" action="../<?php echo $book[5]; ?>">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-dot-circle-o"></i> View</button>
                  </form>
                </p>

                <img src="../<?php echo $book[6]; ?>" width="480px">   

              </div>

            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <strong>Summary</strong>
              </div>
              <div class="card-block">
                <p><?php echo $book[2]; ?></p>
              </div>
            </div>
          </div>

        </div>
      </div>

    </main>
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