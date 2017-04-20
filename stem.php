

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

    <title>One School - View Assessment</title>

    
    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
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
                <li class="breadcrumb-item">Progress Report</li>

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
                    <div class="col-lg-8">
                    <div class="card"><div class="card-block">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="icon-graph"></i> SCIENCE, TECHNOLOGY, ENGINEERING AND MATHEMATICS  </h4>
                            </div>
                            <div class="panel-body">
                                <canvas id="pie" class="pie" width="100px" height="50px"></canvas>
                            </div>
                        </div>
                    </div></div>
                    </div>
                    <div class="col-lg-4">
                    <div class="card">
                        <div class="card-block">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-bar-chart-o"></i> TRACKS</h4>
                            </div>
                                    <canvas id="line" class="line"></canvas>
                                    <hr class="mt-0">
                                    <center>
                                    <strong style='padding: 10px;' class='btn-primary'>Status: Passed</strong></center>
                    </div>
                    </div>
                    </div>
                    
            </div>
            <!-- /.conainer-fluid -->
        </main>

 


    </div>

    <footer class="app-footer">

    </footer>

         <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/views/Chart.js"></script>
    <script src="js/views/Charts.js"></script>  
    <script src="js/views/main.js"></script>
    <script src="js/app.js"></script>


    <!-- Bootstrap and necessary plugins -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
     
    <script src="bower_components/pace/pace.min.js"></script>


    <!-- Plugins and scripts required by all views -->
    <script src="bower_components/chart.js/dist/Chart.min.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- GenesisUI main scripts -->

    <script src="js/app.js"></script>

    <!-- Plugins and scripts required by all views -->
    <script src="bower_components/chart.js/dist/Chart.min.js"></script>
</body>
</html>

<script>

$(document).ready(function() {    
    var options = {
        legend: {
            position: "bottom",
            labels: {
                padding: 20
            }
        }
    };
    var ctx = $("#pie");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: [
            "Mother Tongue",
            "Filipino",
            "English",
            "Mathematics",
            "Science",
            "Araling Panlipunan",
            "Edukasyon sa Pagpakatao",
            "Music",
            "Arts",
            "Physical Education",
            "Health",
            "Edukasyong Pantahanan at Pangkabuhayan"
        ],
        datasets: [
            {
                data:[2, 5, 10, 30, 30, 5, 5, 2, 2, 2, 2, 5],
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9],
                    colors[10],
                    colors[11]
                ],
                hoverBackgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9],
                    colors[10],
                    colors[11]
                ]
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'pie',
        data: data,
        options: options
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

    ctx = $("#line");
    data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6", "Grade 7", "Grade 8", "Grade 9", "Grade 10"],
        datasets: [{
            label: "Track Grade",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [90.86,91.21,91.01,89.1,90.86,91.21,91.01,89.1,90.86,91.21],
            spanGaps: false,
        }]
    };


    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {}
    });
});


</script>