<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION["name"])){
    header("location: index.php");
}

$table=mysqli_query($mysqli,"SELECT grade_level FROM STUDENT WHERE student_id = '".$_SESSION["id"]."'");
$row=mysqli_fetch_row($table);
$level=$row[0] - 1;
$check=pow(2, $level);

$ann=mysqli_query($mysqli, "SELECT * FROM ANNOUNCEMENT WHERE (visibility & ".$check.") != 0 AND active = 1");

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

    <title>One School - Welcome Page</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

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
                    ?>
                    <?php
                      if($num != 0){
                        echo '<table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date Published</th>
                            </tr>
                        </thead><tbody>';

                        while($anns=mysqli_fetch_row($ann)){
                            $date=date("Y/m/d", strtotime($anns[4]));
                            echo '<tr>
                                    <td>
                                      <a href="#">
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
                        echo "</table>";
                      }
                    ?>
                     
                  <!--  <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Prev</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>

 


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