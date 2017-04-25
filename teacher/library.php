<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T') {
  header("location: ../index.php");
}

$id=$_SESSION['id'];

$scheds=mysqli_query($mysqli, "SELECT sched_id FROM class WHERE teacher_id = '".$id."' and active = 1");
$reps=mysqli_query($mysqli, "SELECT DISTINCT subj_id FROM repository WHERE teacher_id = '".$id."' AND active = 1 ORDER BY subj_id");

$schedArray = array();
while($sched = mysqli_fetch_array($scheds)) {
  array_push($schedArray, $sched[0]);
}

$repArray = array();
while($rep = mysqli_fetch_array($reps)) {
  array_push($repArray, $rep[0]);
}

$subjs=mysqli_query($mysqli, "SELECT DISTINCT subj_id FROM schedule WHERE sched_id IN (".implode(", ", $schedArray).") AND subj_id NOT IN (".implode(", ", $repArray).") AND active = 1 ORDER by subj_id");

$subjects=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id IN (".implode(", ", $repArray).")");
$repos=mysqli_query($mysqli, "SELECT * FROM repository WHERE teacher_id = '".$id."' AND file IS NULL AND active = 1 ORDER BY subj_id");

$ulibT=mysqli_query($mysqli, "SELECT book_id, title, author, date_added FROM univ_library WHERE active = 1 ORDER BY date_added desc");

?>

<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Universal Library</title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">

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
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <i class="fa fa-book"></i> Recent Books
              </div>

              <div class="card-block">
                <form action="viewBook.php" method="POST">
                  <input type="hidden" name="id" value="" required>
                </form>

                <form action="delBook.php" method="POST">
                  <input type="hidden" name="id" value="" required>
                </form>

                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Date Registered</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    while($book=mysqli_fetch_array($ulibT)) {
                      echo 
                      "<tr>
                        <td>
                          <a href='javascript:formSubmit(".$book[0].")'>".$book[1]."</a>
                        </td>
                        <td>".$book[2]."</td>
                        <td>".date("F j, Y", strtotime($book[3]))."</td>
                        <td>
                          <center>
                            <a href='javascript: delForm(".$book[0].")'>
                              <button class='btn btn-sm btn-danger'>
                                <span class='icon-minus'></span> Delete
                              </button>
                            </a>
                          </center>
                        </td>
                      </tr>";
                    }

                  ?>
                  </tbody>
                </table>

                <button data-target="#addBook" data-toggle="modal" class="btn btn-sm btn-success"><i class="icon-plus"></i> Add Book</button>

              </div>
            </div>
          </div>                
        </div>

      </div> <!-- end container -->
    </main>
  </div>

  <div class="modal" id="addBook">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Add a Book</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <form action="addBook.php" method="POST" enctype="multipart/form-data" class="form-horizontal">

            <p style="color: red"> ** Only files in the PDF format are supported ** </p>

            <div class="form-group row">
              <label class="col-md-3 form-control-label">Book title: </label>
              <div class="col-md-9">
                <input class="form-control" name="title" type="text" placeholder="Enter the Name of the Book Here" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 form-control-label">Book Info: </label>   
              <div class="col-md-9">
                <textarea class="form-control" rows="8" name="summary" type="text" placeholder="Enter a summary or description of the book here" required></textarea>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 form-control-label">Author(s): </label>   
              <div class="col-md-9">
                <input class="form-control" name="author" type="text" placeholder="Enter the name(s) of the author(s) here" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 form-control-label">PDF: </label>    
              <div class="col-md-9">
                <input class="form-control" name="book" type="file" accept="application/pdf" required>
              </div>                  
            </div>

            <div class="form-group row">
              <label class="col-md-3 form-control-label">Book Cover: </label>
              <div class="col-md-9">
                <input class="form-control" name="bookCover" type="file" accept="image/*" required>
              </div>                
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-success"><i class="icon-plus"></i> Add</button>
              <button data-dismiss="modal" type="button" class="btn btn-primary">Exit</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>   
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>

  <script>
    function formSubmit(id)
    {
      document.forms[0].id.value = id;
      document.forms[0].submit();
    }

    function delForm(id)
    {
      document.forms[1].id.value = id;
      document.forms[1].submit();
    }
  </script>

</body>
</html>
