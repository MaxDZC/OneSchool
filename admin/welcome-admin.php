<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$ann=mysqli_query($mysqli, "SELECT * FROM announcement WHERE active = 1 ORDER BY timestamp desc");
$num=mysqli_num_rows($ann);

?>
<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Welcome Page</title>

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
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Welcome</li>
      </ol>

      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                 <i class="fa fa-align-justify"></i> News and Announcements
              </div>
              <div class="card-block">

                <form action="viewAnn.php" method="POST">
                  <input type="hidden" name="ann_id" value="" required>
                </form>

                <form action="delAnn.php" method="POST">
                  <input type="hidden" name="ann_id" value="" required>
                </form>

              <?php
                if($num != 0){
                  echo 
                  "<table class='table table-bordered table-striped table-condensed'>
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Date Published</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  <tbody>";

                  while($anns=mysqli_fetch_row($ann)) {
                    $date=date("Y/m/d", strtotime($anns[4]));
                    echo 
                    "<tr>
                      <td><a href='javascript:formAnn(".$anns[0].")'>".$anns[2]."</a></td>
                      <td>".$date."</td>
                      <td>
                        <center>
                          <a href='javascript: delAnn(".$anns[0].")'>
                            <button class='btn btn-sm btn-danger'>
                              <i class='icon-minus'></i> Delete
                            </button>
                          </a>
                        </center>
                      </td>
                    </tr>";
                  }

                  echo "</tbody>";
                } else {
                  echo "There are no announcements to display!";
                }

                if($num != 0){
                  echo "</table>";
                }
              ?>
                <a href="addAnn.php">
                  <button class="btn btn-sm btn-success">
                    <span class="icon-plus"></span> Post Announcement
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
      
      </div> <!-- End of container -->
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
    function formAnn(ann_id) 
    {
      document.forms[0].ann_id.value = ann_id;
      document.forms[0].submit();
    }

    function delAnn(ann_id) 
    {
      document.forms[1].ann_id.value = ann_id;
      document.forms[1].submit();
    }
  </script>
</body>
</html>