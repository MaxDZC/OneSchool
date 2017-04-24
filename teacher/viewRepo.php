<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T') {
  header("location: ../index.php");
}

$id=$_SESSION['id'];
$subject=$_POST['subj'];

$subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$subject." ");
$subjName=mysqli_fetch_array($subjT);

$reposT=mysqli_query($mysqli, "SELECT * FROM REPOSITORY WHERE teacher_id = '".$id."' AND subj_id = ".$subject." AND file IS NOT NULL AND active = 1 ORDER BY date_added");

$count=mysqli_num_rows($reposT);

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
        <li class="breadcrumb-item"><a href="repository.php">Manage</a></li>
        <li class="breadcrumb-item active"><?php echo $subjName[0]; ?>
        </li>
      </ol>

      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <div class="card">

              <div class="card-header">
                  <strong>Repository - <?php echo $subjName[0]; ?></strong>
              </div>

              <div class="card-block">

              <form action="delFile.php" method="POST">
                  <input type="hidden" name="id" required>
                  <input type="hidden" name="filename" required>
                  <input type="hidden" name="subj" required>
              </form>

              <?php
                if($count != 0) {
                  echo "
                   <table class='table table-bordered table-striped'>
                  <thead>
                    <th>Filename</th>
                    <th>Date Added</th>
                    <th>Action</th>
                  </thead>

                  <tbody>";
                
               
                  while($repo=mysqli_fetch_array($reposT)) {
                    $date = date("F j, Y", strtotime($repo[4]));

                    echo
                    "<tr>
                      <td><i class='icon-folder'></i> 
                        <a target='_blank' href='".$repo[3]."'>".basename($repo[3])."</a>
                      </td>
                      <td>".$date."</td>
                      <td>
                        <a href='".$repo[3]."' download>
                          <button class='btn btn-sm btn-primary'><i class='fa fa-download'></i> Download</button>
                        </a>

                        <a href='javascript: deleteFile(".$repo[0].", \"".basename($repo[3])."\", ".$subject.")'>
                          <button class='btn btn-sm btn-danger'><i class='icon-minus'></i> Delete</button>
                        </a>
                      </td>
                    </tr>";
                  }
                  
                  echo 
                    "</tbody>
                  </table>";
                } else {
                  echo "<h3>There are no files to display!</h3><hr>";
                }
              ?>

              <form id="form" method="POST" action="addFile.php" enctype="multipart/form-data">
                <input type="hidden" name="subj" value="<?php echo $subject ?>">
                <label class="btn-bs-file btn btn-sm btn-primary">Add File
                  <input type="file" id="file" name="file">
                </label>
              </form>
               
              </div>
            </div>
          </div>
        </div>
      
      </div> <!-- end container -->
    </main>
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
    function deleteFile(id, filename, subj)
    {
      document.forms[0].id.value = id;
      document.forms[0].filename.value = filename;
      document.forms[0].subj.value = subj;
      document.forms[0].submit();
    }

    document.getElementById("file").onchange = function() {
      document.getElementById("form").submit();
    };
  </script>

</body>
</html>
