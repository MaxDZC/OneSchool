<?php
session_start();
include("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'A'){
  header("location: ../index.php");
}

$id = $_POST["ann_id"];

$annT=mysqli_query($mysqli, "SELECT * FROM ANNOUNCEMENT WHERE ann_id = ".$id." ");
$ann=mysqli_fetch_array($annT);

$adminT=mysqli_query($mysqli, "SELECT * FROM admin WHERE admin_id = '".$ann[1]."' ");
$admin=mysqli_fetch_array($adminT);

$adminName=$admin[2]." ";
if($admin[3]) {
  $admin.=$admin[3][0]." ";
}
$adminName.=$admin[4];

?>

<!DOCTYPE html>
<html lang="en" ng-app>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>One School - <?php echo $ann[2]; ?></title>

  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/simple-line-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">

  <style>
    pre {
      font-family: "Verdana";
      font-size: 1.1em;
      white-space: pre-wrap;
      white-space:  -moz-pre-wrap;
      white-space: -pre-wrap;
      white-space: -o-pre-wrap;
      word-wrap: break-word;
    }
  </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <?php include("header-admin.php"); ?>
  </header>

  <div class="app-body">
    <?php include("sidebar-admin.php"); ?>
    <main class="main">
        
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
          <a href="welcome-admin.php">
            Welcome
          </a>
        </li>
        <li class="breadcrumb-item active">
        <?php if(strlen($ann[2]) > 10) { echo substr($ann[2], 0, 10)." ... "; } else { echo $ann[2]; }  ?>
        </li>
      </ol>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <form action="updateAnn.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="card-header">
                  <i id="icon" class="fa fa-align-justify"></i>
                  <span id ="title"><?php echo $ann[2]; ?></span>
                </div>
                <div class="card-block">
                  <?php
                    $date=date("l, F j, Y", strtotime($ann[4]));
                    $date.=" "."at"." ";
                    $date.=date("h:i A", strtotime($ann[4]));
                    echo 
                    "<pre id='ann'>".$ann[3]."</pre>
                    ";
                  ?>
                  <fieldset class='form-group'>
                    Who can see this? <br>
                    <?php
                      for($i=0; $i < 10; $i++) {
                        echo 
                        "<span class='col-md-6'>
                          <input id='".($i+1)."' type='checkbox' name='".($i+1)."' value='".($i+1)."' ";
                        $check = pow(2, $i);
                        if(($check & $ann[5]) != 0) { echo "checked"; }
                        echo " disabled> Grade ".($i+1)." </span>";
                      }
                    ?>
                  </fieldset>

                  <?php
                  echo "
                    <hr>
                    <img src='../".$admin[5]."' class='img-avatar' height='25px'>
                    <br>
                    <span>
                      <em>
                        Posted by ".$adminName."<br>
                        Posted on ".$date."
                      </em>
                    </span>";
                  ?>
                  <br><br>
                  <button id="button" onclick="edit();" class="btn btn-sm btn-primary">
                    <span class="icon-pencil"></span> Edit 
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

  </div> <!-- close body -->

  <script src="../js/angular.js"></script>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../bower_components/tether/dist/js/tether.min.js"></script>     
  <script src="../bower_components/pace/pace.min.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app.js"></script>

  <script>
    function edit()
    {
      var elems = document.getElementById("title");
      var ann = document.getElementById("ann");
      var edit = document.createElement("input");
      var editAnn = document.createElement("textarea");

      edit.setAttribute("name", "title");
      editAnn.setAttribute("name", "ann");
      editAnn.setAttribute("rows", "10");

      edit.className = "form-control";
      editAnn.className = "form-control";

      edit.value = elems.innerHTML;
      editAnn.value = ann.innerHTML;

      elems.parentNode.insertBefore(edit, elems);
      elems.parentNode.removeChild(document.getElementById("icon"));
      elems.parentNode.removeChild(elems);

      ann.parentNode.insertBefore(editAnn, ann);
      ann.parentNode.removeChild(ann);

      for(x = 1; x < 11; x++) {
        document.getElementById(x).disabled = false;
      }

      document.getElementById("button").outerHTML = "<button type='submit' class='btn btn-sm btn-warning'><span class='icon-note'></span> Update</button>";
    }
  </script>

</body>
</html>