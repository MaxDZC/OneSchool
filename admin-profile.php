<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])){
    header("location: index.php");
}

$selectT=mysqli_query($mysqli,"SELECT * FROM admin WHERE admin_id='".$_SESSION['id']."'");
$select=mysqli_fetch_array($selectT);

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
    <title>One School - Profile Page</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        div.fileinputs {
      position: relative;
    }

    div.fakefile {
      position: absolute;
      top: 0px;
      left: 0px;
      z-index: 1;
    }

    input.file {
      position: relative;
      text-align: right;
      -moz-opacity:0 ;
      filter:alpha(opacity: 0);
      opacity: 0;
      z-index: 2;
    }
        .btn-bs-file{
       position:relative;
        }
    .btn-bs-file input[type="file"]{
        position: absolute;
        top: -9999999;
        filter: alpha(opacity=0);
        opacity: 0;
        width:0;
        height:0;
        outline: none;
        cursor: inherit;
    }
        td:nth-child(1) {
      width: 40%;
    }
    td:nth-child(2) {
      width: 60%;
    }
    </style>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <?php include("header-admin.php"); ?>
    </header>

    <div class="app-body">
        <?php include("sidebar-admin.php") ?>
        
        <main class="main">            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Profile</li>
                <li class="breadcrumb-item active">View</li>
            </ol>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                    <div class="card card-default">
                        <div class="card-header">
                            Administrator Details
                        </div>
                       <!-- <form id="form" method="POST" action="updateProfPic-admin.php" enctype="multipart/form-data">
                                <div class="fileinputs" style="margin: 2%">
                                  <input type="file" name="photo" id="file" class="file" accept="image/*">
                                  <div class="fakefile">

                                    <label class="btn-bs-file btn btn-sm btn-primary" style="width:110%; height:120%;">
                                      <i class="icon-camera"> Change Profile</i>
                                    <input type="file"/>
                                    </label>
                                  </div>
                                </div>
                        </form>/-->
                        <center>
                        <img src="
                          <?php
                            if($select[5]) {
                              echo $select[5];
                            } else {
                              echo "img/lecture-1.png";
                            }
                          ?>" 
                          class="img-avatar" width="20%" style="padding: 2%">
                        </center>
                        <div class="card-block">
                        <table class="table table-striped table-bordered">
                        <tr>
                        <td style="padding-right:50px;padding-left:50px;">Name: </td>
                        <td><?php echo $select[2]." "; if($select[3]) { echo $select[3][0].". "; } echo $select[4]; ?></td>
                        </tr>
                        <tr>
                        <td style="padding-right:50px;padding-left:50px;">ID Number:</td>
                        <td>  <?php echo $select[0]; ?></td>
                        </tr>
                        </table>
                        </div>
                    </div>   
                    </div>
                    </div>
                </div>
            </div>
            <!-- /.conainer-fluid -->
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
<script>
document.getElementById("file").onchange = function() {
  document.getElementById("form").submit();
};
</script>