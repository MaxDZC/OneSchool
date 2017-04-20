
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

    <title>One School - Universal Library</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

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

                <li class="breadcrumb-item active">Universal Library</li>

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
                   <div class="col-md-6">
                       <div class="card">
                           <div class="card-header">
                               <strong>Book Review</strong>
                           </div>

                           <div class="card-block">
                               <p>
                                   <h5>Fundamentals of Logic Design 7th Edition</h5>
                               </p>
                               <p>
                                   <h6><em>By Charles H. Roth, Jr.</em></h6>
                               </p>
                               <p>
                                   <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>+5 Stars
                               </p>
                               <p>
                                   <form action="pdf/Roth Fundamentals of Logic Design 7th c2014 txtbk.pdf">
                                   <button type="submit" class="btn btn-danger"><i class="fa fa-dot-circle-o"></i>Download</button>
                                   </form>
                               </p>
                               <img src="img/roth.png" width="480px"/>
                               
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">
                        <div class="card">
                       <div class="card-header">
                            <strong>Summary</strong>
                       </div>
                       <div class="card-block">
                           <p>
                               After studying this text, student should be able to apply switching theory to the solution of logic design problems. They will learn both the basic theory of switching circuits and how to apply it.
                           </p>
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