        <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
        <img src="img/Logo.png" width="200px" height="30px" style="width: 8%; margin-left: 1%; margin-top: 1%">
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item hidden-md-down">
                <a class="nav-link" href="#"><i class="icon-bell"></i></a>
            </li>
            <li class="nav-item hidden-md-down">
                <a class="nav-link" href="#"><i class="icon-envelope"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="
                    <?php
                        $avaT=mysqli_query($mysqli, "SELECT s_idPic FROM student WHERE student_id = '".$_SESSION['id']."'");
                        $ava=mysqli_fetch_array($avaT);

                        if($ava[0]) {
                            echo $ava[0];
                        } else {
                            echo "img/student.png";
                        }        
                    ?>
                    " class="img-avatar">
                    <span class="hidden-md-down"><?php echo $_SESSION["name"];?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item" href="studentprofile.php"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>
        </ul>