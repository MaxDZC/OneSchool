

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
        <?php include("header.php"); ?>
    </header>

    <div class="app-body">
        <?php include("sidebar.php"); ?>

        
        <main class="main">

            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Learning Resources</li>

                <li class="breadcrumb-item active">Teachers' Repositories</li>

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
                   <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-folder"></i> Repositories
                                </div>
                                <div class="card-block">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Teacher</th>
                                                <th>Subject</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <tr>  
                                            <td>Dolores H. Ramirez</td>
                                            <td>Science</td>
                                            <td><button type="button" class="btn btn-sm btn secondary">Open</button></td>
                                          </tr>
                                          <tr>
                                            <td>Jane G. Villanueva</td>
                                            <td>Filipino</td>
                                            <td><button type="button" class="btn btn-sm btn secondary">Open</button></td>
                                          </tr>
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