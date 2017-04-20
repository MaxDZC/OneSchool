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

    <title>One School - Repository</title>

    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

    <style type="text/css">
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
    </style>

</head>



<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <?php include("header-teacher.php"); ?>
    </header>

    <div class="app-body">
        <?php include("sidebar-teacher.php") ?>

        
        <main class="main">

            
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Repository</li>

                <li class="breadcrumb-item active">Manage</li>

                
            </ol>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" style="padding-left:50px; padding-right:50px">
                    <div class="card">
                        <div class="card-header">
                            Folders
                        </div>
                        <div class="card-block">
                            <table class="table table-striped" id="TableA">
                                <thead>
                                        <th>Subject</th>
                                        <th>Date Modified</th>
                                        <th>Action</th>
                                </thead>
                                <tbody id='folders'>
                                    <tr>
                                        <td><i class="icon-folder"></i> Mother Tongue</td>
                                        <td>August 11, 2017</td>
                                        <td>
                                        <button  data-target="#files" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-circle-o"></i> View</button>
                                        <button class="btn btn-sm btn-danger" onclick="removerow()"><i class="icon-minus" ></i> Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-sm btn-success" onclick="addrow()"><i class="icon-plus"></i> Add Folder</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /.conainer-fluid -->
        </main>


<script type="text/javascript">
function removerow(){
    var tableRef=document.getElementById('folders');
    tableRef.deleteRow(0);
}   

function addrow(){
    var tableRef=document.getElementById('folders');
    var newRow = tableRef.insertRow(0);
    var newCell=newRow.insertCell(0);
    newCell.innerHTML="<i class='icon-folder'></i> Untitled";
    var newCell=newRow.insertCell(1);
    newCell.innerHTML="April 4, 2017";
    var newCell=newRow.insertCell(2);
    newCell.innerHTML='<button  data-target="#files" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-circle-o"></i> View</button> <button class="btn btn-sm btn-danger" onclick="removerow()"><i class="icon-minus"></i> Delete</button>'
}
</script>


<div class="modal" id="files">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Files</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <td><a href="#">Grading System.pdf</a></td>
                    <td>August 11, 2017</td>
                    <td><button class="btn btn-sm btn-danger"><i class="icon-minus"></i> Delete</button></td>                    
                </tbody>
        </table>

        <label class="btn-bs-file btn btn-sm btn-primary">
            Browse
            <input type="file"/>
        </label>

        </div>
      <div class="modal-footer">
        <button data-dismiss="modal" type="button" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="editrec">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Enrolled Students</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <em>Hussain Max Zuorba</em><br><br>
        
        <form action="#" method="post">
            <div class="form-group">
                <label for="gradingperiod">Grading Period</label>
                <select class="form-control" id="grdprd">
                    <option>First Grading</option>
                    <option>Second Grading</option>
                    <option>Third Grading</option>
                    <option>Fourth Grading</option>
                </select>
            </div>
            <div class="row">
            <div class="form-group col-sm-3">
                <label for="sw">Seatwork</label>
                <input type="text" class="form-control" id="seatworks">
            </div>
            <div class="form-group col-sm-3">
                <label for="qz">Quizzes</label>
                <input type="text" class="form-control" id=quizzes>
            </div>
            <div class="form-group col-sm-3">
                <label for="pr">Projects</label>
                <input type="text" class="form-control" id=projects>
            </div>
            <div class="form-group col-sm-3">
                <label for="ex">Exams</label>
                <input type="text" class="form-control" id="exams">
            </div>
            </div>
            <center>
            <div class="form-group col-sm-3">
                <label for="gradept">Grade</label>
                <input type="text" class="form-control" id="gradept">
            </div>
            </center>
        </form>
            <button type="submit" class="btn btn-sm btn-success"><i class="icon-check"></i> Save Record</button>
        </div>
      <div class="modal-footer">
        <button data-dismiss="modal" type="button" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>

        
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
