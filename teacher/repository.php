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

$ulibT=mysqli_query($mysqli, "SELECT book_id, title, author, date_added FROM univ_library WHERE active = 1");

?>

<!DOCTYPE html>
<html lang="en" ng-app>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - Repository</title>

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
                  <strong>Repository</strong>
              </div>

              <div class="card-block">

                <form action="delRepo.php" method="POST">
                  <input type="hidden" name="subj" required>
                </form>

                <form action="viewRepo.php" method="POST">
                  <input type="hidden" name="subj" required>
                </form>

                <table class="table table-bordered table-striped">
                  <thead>
                    <th>Subject</th>
                    <th>Date Last Modified</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                  <?php
                    while($repo=mysqli_fetch_array($repos)) {
                      $subject=mysqli_fetch_array($subjects);
                      $lastDateT=mysqli_query($mysqli, "SELECT MAX(date_added) FROM REPOSITORY WHERE subj_id = ".$repo[2]." AND teacher_id = '".$id."' ");

                      $lastDate=mysqli_fetch_array($lastDateT);

                      $date = date("F j, Y", strtotime($lastDate[0]));

                      echo
                      "<tr>
                        <td><i class='icon-folder'></i> ".$subject[0]."</td>
                        <td>".$date."</td>
                        <td>
                          <a href='javascript: viewSubmit(".$repo[2].")'>
                            <button class='btn btn-sm btn-primary'><i class='fa fa-circle-o'></i> View</button>
                          </a>

                          <a href='javascript: delSubmit(".$repo[2].")'>
                            <button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button>
                          </a>
                        </td>
                      </tr>";

                      $stats = true;
                    }
                  ?>
                  </tbody>
                </table>
                <button data-target="#add" data-toggle="modal" class="btn btn-sm btn-success"><i class="icon-plus"></i> Add Folder</button>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <i class="fa fa-book"></i> Recent Books
              </div>

              <div class="card-block">
                <form action="viewBook.php" method="POST">
                  <input type="hidden" name="book_id" value="" required>
                </form>

                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Date Registered</th>
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

  <div class="modal" id="add">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Add a Folder</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="addFolder.php" method="POST">

            <select name="subject" class="form-control">
              <option value="" selected>Choose a subject... </option>
              <?php
                while($subj=mysqli_fetch_array($subjs)) {
                  $names=mysqli_query($mysqli, "SELECT subject from subjects WHERE subj_id = ".$subj[0]." ");
                  $subjectName=mysqli_fetch_array($names);
                  echo 
                  "<option value=".$subj[0].">".$subjectName[0]."</option>";
                }
              ?>
            </select>


            <div class="modal-footer">
              <button type="submit" class="btn btn-success"><i class="icon-plus"></i> Add</button>
              <button data-dismiss="modal" type="button" class="btn btn-primary">Exit</button>
            </div>

          </form>

        </div>
      </div>
    </div>
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

          <form action="addBook.php" method="POST" enctype="multipart/form-data">

            <p style="color: red"> ** Only files in the PDF format are supported ** </p>

            <table>
              <span class="form-control">
                <tr>
                  <td>PDF:</td>
                  <td><input type="file" accept="application/pdf" required></td>
                </tr>
              </span>
              <span class="form-control">
                <tr>
                  <td>Book Cover:</td>
                  <td><input type="file" accept="image/*" required></td>
                </tr>
              </span>
            </table>



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
    function delSubmit(subj)
    {
      document.forms[0].subj.value = subj;
      document.forms[0].submit();
    }

    function viewSubmit(subj)
    {
      document.forms[1].subj.value = subj;
      document.forms[1].submit();
    }
  </script>

</body>
</html>
