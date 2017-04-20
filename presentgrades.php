
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

    <title>One School - View Grades</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

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
                <li class="breadcrumb-item">Grade Reports</li>

                <li class="breadcrumb-item active">View</li>

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
                                 <i class="icon-doc"></i> Grade 7 - First Grading
                            </div>
                            <div class="card-block">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Seatworks</th>
                                                <th>Quizzes</th>
                                                <th>Projects</th>
                                                <th>Grade Point</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            
                                        ?>
                                            <tr>
                                                <td>Religious Education</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>English</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Filipino</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Mathematics</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Science</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Technological and Livelihood Edcation</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Social Studies</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Music, Arts and Physical Education</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <nav>
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
                        <div class="card">
                            <div class="card-header">
                                 <i class="icon-doc"></i> Grade 7 - Second Grading
                            </div>
                            <div class="card-block">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Seatworks</th>
                                                <th>Quizzes</th>
                                                <th>Projects</th>
                                                <th>Grade Point</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Religious Education</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>English</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Filipino</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Mathematics</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Science</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Technological and Livelihood Edcation</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Social Studies</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Music, Arts and Physical Education</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <nav>
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
                        <div class="card">
                            <div class="card-header">
                                 <i class="icon-doc"></i> Grade 7 - Third Grading
                            </div>
                            <div class="card-block">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Seatworks</th>
                                                <th>Quizzes</th>
                                                <th>Projects</th>
                                                <th>Grade Point</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Religious Education</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>English</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Filipino</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Mathematics</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Science</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Technological and Livelihood Edcation</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Social Studies</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Music, Arts and Physical Education</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <nav>
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
                        <div class="card">
                            <div class="card-header">
                                 <i class="icon-doc"></i> Grade 7 - Fourth Grading
                            </div>
                            <div class="card-block">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Seatworks</th>
                                                <th>Quizzes</th>
                                                <th>Projects</th>
                                                <th>Grade Point</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Religious Education</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>English</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Filipino</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Mathematics</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Science</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Technological and Livelihood Edcation</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Social Studies</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                            <tr>
                                                <td>Music, Arts and Physical Education</td>
                                                <td>85</td>
                                                <td>89</td>
                                                <td>88</td>
                                                <td>88</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <nav>
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
                        
                                    <nav>
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
                                    </nav>
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
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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