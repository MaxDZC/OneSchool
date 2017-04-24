<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'S'){
  header("location: ../index.php");
}

$ulibT=mysqli_query($mysqli, "SELECT book_id, title, author, date_added from univ_library WHERE active = 1");

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
    <?php include("header.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar.php"); ?>
    <main class="main">   
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Learning Resources</li>
        <li class="breadcrumb-item"><a href="resources.php">Visit</a></li>
        <li class="breadcrumb-item active">Universal Library</li>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <i class="fa fa-book"></i> Recent Books
              </div>

              <div class="card-block">
                <form action="viewBook.php" method="POST">
                  <input type="hidden" name="book_id" value="" required>
                </form>

                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Date Registered</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    while($book=mysqli_fetch_array($ulibT)) {
                      echo 
                      "<tr>
                        <td>
                          <a href='javascript:formSubmit(".$book[0].")'>".$book[1]."</a>
                        </td>
                        <td>".$book[2]."</td>
                        <td>".date("F j, Y", strtotime($book[3]))."</td>
                      </tr>";
                    }

                  ?>
                  </tbody>
                </table>
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
  <script> 
    function formSubmit(book_id) 
    {     
      document.forms[0].book_id.value = book_id;
      document.forms[0].submit();
    }
  </script>
</body>
</html>