<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION["name"])){
    header("location: ../index.php");
}

$table=mysqli_query($mysqli,"SELECT grade_level FROM STUDENT WHERE student_id = '".$_SESSION["id"]."'");
$row=mysqli_fetch_row($table);
$level=$row[0] - 1;
$check=pow(2, $level);

$ann=mysqli_query($mysqli, "SELECT * FROM ANNOUNCEMENT WHERE (visibility & ".$check.") != 0 AND active = 1");

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
    <?php include("header.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar.php"); ?>
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
                <?php
                  $num=mysqli_num_rows($ann);
                  if($num != 0){
                    echo 
                    '<form action="viewAnn.php" method="POST">
                    <input type="hidden" name="ann_id" value="-1">';
                    echo 
                    '<table class="table table-bordered table-striped table-condensed">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Date Published</th>
                        </tr>
                      </thead>
                      <tbody>';

                    while($anns=mysqli_fetch_row($ann)){
                        $date=date("Y/m/d", strtotime($anns[4]));
                        echo 
                        '<tr>
                          <td>
                            <a href="javascript:formSubmit('.$anns[0].');">
                              '.$anns[2].'
                            </a>
                          </td>
                          <td>
                            '.$date.'
                          </td>
                        </tr>';
                    }

                    echo '</tbody>';
                  } else {
                    echo "There are no announcements to display!";
                  }

                  if($num != 0){
                    echo "</table></form>";
                  }
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
  
  <script> 
    function formSubmit(ann_id) 
    {
      document.forms[0].ann_id.value = ann_id;
      document.forms[0].submit();
    }
  </script>
</body>
</html>