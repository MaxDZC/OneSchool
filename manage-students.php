
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

    <title>One School - Manage Class</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

</head>



<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <?php include("header-teacher.php"); ?>
    </header>

    <div class="app-body">
        <?php include("sidebar-teacher.php") ?>

        
        <main class="main">

            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Class Record</li>

                <li class="breadcrumb-item"><?php echo $_GET["level"].' - '.$_GET["section"];?></li>
                <li class="breadcrumb-item active"><?php echo $_GET["subj"];?></li>

                
            </ol>


            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Enrolled Students</strong>
                            </div>
                            <div class="card-block">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Number</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablebody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.conainer-fluid -->
        </main>

        <script type="text/javascript">
            var t=document.getElementById('tablebody');
            t.innerHTML="<?php 
                $level=$_GET["level"];
                $section=$_GET["section"];
                $teacher=$_GET["name"];

                $mysqli=new mysqli("localhost","root","","oneschool");
                $table=mysqli_query($mysqli,"SELECT * FROM studentlist WHERE section='$section' AND status!='Done'");
                while($row=mysqli_fetch_array($table)){
                    echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td><a href='updaterecord.php?name=$teacher&level=$level&section=$section&stud=$row[0]'><button class='btn btn-sm btn-primary'> View</button></a></td></tr>";

                }

            ?>"
                

        </script>


<div class="modal" id="addrecord" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <div class="form-group">
                      <label for="grdprd">Grading Period</label>
                      <select style="width:100px" class="form-control" id="grdprd" onchange="periodchange(this.value)">
                          <option value='0'>Select...</option>
                          <option value='1'>1st</option>
                          <option value='2'>2nd</option>
                          <option value='3'>3rd</option>
                          <option value='4'>4th</option>
                      </select>
                  </div>
              <table class="table table-striped table-bordered">
                  <thead>
                          <th>HW & A</th>
                          <th>Quizzes</th>
                          <th>Seatworks</th>
                          <th>Projects</th>
                          <th>Midterm</th>
                          <th>Periodical</th>
                          <th>Grade</th>
                  </thead>
              <tbody id="grades-edit"></tbody>
              </table> 
            <div id="button">
            <button onclick="change()" class="btn btn-md btn-warning"> Edit</button>
            </div>
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" type="button" class="btn btn-primary">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function periodchange(value){
        switch(value){
            case '0': document.getElementById('grades-edit').innerHTML="";
                      break;
            case '1': document.getElementById('grades-edit').innerHTML="<tr><td><center>93</center></td><td><center>93</center></td><td><center>93</center></td><td><center>93</center></td><td><center>93</center></td><td><center>93</center></td><td><center>93</center></td></tr>";
                break;
            case '2': document.getElementById('grades-edit').innerHTML="<tr><td><center>94</center></td><td><center>94</center></td><td><center>94</center></td><td><center>94</center></td><td><center>94</center></td><td><center>94</center></td><td><center>94</center></td></tr>";
                break;
            case '3': document.getElementById('grades-edit').innerHTML="<tr><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td></tr>";
            break;
            case '4': document.getElementById('grades-edit').innerHTML="<tr><td><center>95</center></td><td><center>95</center></td><td><center>95</center></td><td><center>95</center></td><td><center>95</center></td><td><center>95</center></td><td><center>95</center></td></tr>";
            break;
        }
    }

    function change(){
        document.getElementById('button').innerHTML="<button onclick='save()' class='btn btn-md btn-danger'> Save</button>";
        document.getElementById('grades-edit').innerHTML="<tr><td><center><select style='width:75px' class='form-control' id='no'><option value='0'>...</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></center><center><input type='text' style='width:75px' id='hwa'><center><button class='btn btn-sm btn-success' onclick='cell(1)'><i class='fa fa-plus-circle'></i></button></center></td><td><center><select style='width:75px' class='form-control' id='no'><option value='0'>...</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></center><center><input type='text' style='width:75px' id='hwa'><center><button class='btn btn-sm btn-success' onclick='cell(1)'><i class='fa fa-plus-circle'></i></button></center></td><td><center><select style='width:75px' class='form-control' id='no'><option value='0'>...</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></center><center><input type='text' style='width:75px' id='hwa'><center><button class='btn btn-sm btn-success' onclick='cell(2)'><i class='fa fa-plus-circle'></i></button></center></td><td><center><select style='width:75px' class='form-control' id='no'><option value='0'>...</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></center><center><input type='text' style='width:75px' id='hwa'><center><button class='btn btn-sm btn-success' onclick='cell(3)'><i class='fa fa-plus-circle'></i></button></center></td><td><center><input type='text' style='width:75px' id='hwa'><center></td><td><center><input type='text' style='width:75px' id='hwa'></td><td><center><input type='text' style='width:75px' id='hwa'></td>"
    }
    var table=document.getElementById('grades-edit');        
    var row=table.insertRow(1);
    function cell(value){
        var cell=row.insertCell(value);
        cell.innerHTML="<center><input type='text' style='width:75px' id='hwa'><center><button class='btn btn-sm btn-success' onclick='cell(value)'><i class='fa fa-plus-circle'></i></button></center>";
    }

    function view(){
        document.getElementById('grades-edit').innerHTML="<tr><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td><td><center>92</center></td></tr>";
    }
    function save(){
        view();
        document.getElementById('button').innerHTML="<button onclick='change()' class='btn btn-md btn-warning'> Edit</button>";
    }
</script>        
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