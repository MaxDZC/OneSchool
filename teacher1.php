

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

    <title>One School - Teachers' Repositories</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
</head>



<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <?php include("header.php") ?>
    </header>

    <div class="app-body">
        <div class="sidebar">
            <?php include("sidebar.php") ?>
        </div>

        
        <main class="main">

            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Learning Resources</li>

                <li class="breadcrumb-item active">Teachers' Repositories</li>
<!--                 <li class="breadcrumb-item active">Mother Tongue</li>
 -->
                <!-- Breadcrumb Menu-->
                <!-- <li class="breadcrumb-menu hidden-md-down">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                        <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                        <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                    </div>
                </li> -->
            </ol>


            <div class="container-fluid">
                 <div class="row">
                     <div class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <strong>Teacher's Profile</strong>
                            </div>
                            <div class="card-block">
                            <center>
                                <img src="img/lecture-1.png" width="300px">
                            </center>
                            </div>
                        </div>                         
                     </div>
                     <div class="col-lg-6">
                         <div class="card card-warning">
                             <div class="card-header">
                                 <strong>Details</strong>
                             </div>
                             <div class="card-block">
                                <center>
                                 <div class="card col-lg-10">
                                     <center><strong>Name:</strong> Janette A. Saban</center>
                                 </div>
                                 <div class="card col-lg-10">
                                     <center><strong>Subject:</strong> Mother Tongue</center>
                                 </div>
                                 <div class="card col-lg-10">
                                     <center><strong>Schedule:</strong> MWF 10:00 AM - 11:30 AM</center>
                                 </div>
                                </center>
                             </div>
                         </div>
                    </div>
                 </div>
                <div class="row">
                   <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-folder"></i> Files
                                </div>
                                <div class="card-block">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Date Published</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                    </table>
                                    
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

    <!-- Plugins and scripts required by this views -->

    
    <!-- GenesisUI main scripts -->

    <script src="js/app.js"></script>

    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
    <script src="js/views/main.js"></script>

</body>

</html>