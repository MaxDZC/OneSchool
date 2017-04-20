<?php
session_start();
include("sql_connect.php");

if(!isset($_SESSION['name'])){
    header("location: index.php");
}

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

    <title>One School - School Data</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

</head>



<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <?php include("header-admin.php"); ?>
    </header>

    <div class="app-body">
        <?php include("sidebar-admin.php") ?>

        
        <main class="main"> 

            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Management</li>

                <li class="breadcrumb-item active">Data Analytics</li>

                
            </ol>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <strong>STUDENT POPULATION</strong>
                            </div>
                            <div class="card-block">
                                <canvas id="line" class="line"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <strong>PER GRADE LEVEL</strong>
                            </div>
                            <div class="card-block"><hr class="mt-0">
                                            <ul class="horizontal-bars">
                                                <li>
                                                    <div class="title">
                                                        Grade 1
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 2
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 3
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 4
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 5
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 6
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 7
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 69%" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 8
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 9
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        Grade 10
                                                    </div>
                                                    <div class="bars">
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="legend">
                                                    <span class="badge badge-pill badge-info"></span>
                                                    <small>Failing</small>&nbsp;
                                                    <span class="badge badge-pill badge-danger"></span>
                                                    <small>Passing</small>
                                                </li>
                                            </ul></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>ENROLLED STUDENTS</strong>
                            </div>
                            <div class="card-block">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Grade Level</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $table=mysqli_query($mysqli,"SELECT * FROM student WHERE active = 1");
                                            while($row=mysqli_fetch_array($table)){
                                                $name=$row[4].", ".$row[2]." ".$row[3][0].".";
                                                echo "<tr><td>".$row[0]."</td><td>".$name."</td>
                                                <td>".$row[6]."</td>
                                                    <td><a href='analytics-1.php' target='_blank'><button class='btn btn-sm btn-primary'><i class='fa fa-circle-o'></i> View</button></a></td></tr>";
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
                data:[9, 9, 35, 9, 15, 9, 9, 1, 1, 1, 1, 1],
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
        labels: ["2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017"],
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
            data: [200,252,380,389,412,420,500,750,730,800],
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


    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
    <script src="js/views/main.js"></script>

</body>

</html>