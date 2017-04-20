<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="welcome-teacher.php"><i class="icon-home"></i> Home </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-note"></i>Teacher Tasks</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="manage-class.php"><i class="icon-arrow-right-circle"></i>Schedule</a>
                            </li>
                            <?php
                              $sideT=mysqli_query($mysqli, "SELECT sched_id, sec_id, class_id FROM class WHERE teacher_id = '".$_SESSION['id']."'");

                              if(mysqli_num_rows($sideT) != 0) {
                                echo '<li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-arrow-right-circle"></i>Gradebook</a>
                                  <ul class="nav-dropdown-items">'; 

                                  while($side=mysqli_fetch_array($sideT)) {
                                    $sectionT=mysqli_query($mysqli, "SELECT section_name, grade_level FROM subsection WHERE sec_id = ".$side[1]." ");
                                    $section=mysqli_fetch_array($sectionT);

                                    $schedT=mysqli_query($mysqli, "SELECT subj_id FROM schedule WHERE sched_id = ".$side[0]." ");
                                    $sched=mysqli_fetch_array($schedT);

                                    $subjT=mysqli_query($mysqli, "SELECT subject FROM subjects WHERE subj_id = ".$sched[0]." ");
                                    $subj=mysqli_fetch_array($subjT);

                                    echo "<li class='nav-item'>
                                            <a class='nav-link' href='updaterecord.php?classid=".$side[2]."&gper=1&level=".$section[1]."&section=".$section[0]."&subject=".$subj[0]."&subj=".$sched[0]." '>
                                              <i class='icon-minus'></i>
                                              ".$section[0]." : ".$subj[0]."
                                            </a>
                                          </li>";
                                  }

                                  echo '</ul></li>';
                              }
                            ?>

                            <li class="nav-item">
                                <a class="nav-link" href="studentprog.php"><i class="icon-arrow-right-circle"></i>Performance Tracker</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-note"></i>Management</a>
                        <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="repository.php"><i class="icon-arrow-right-circle">
                        </i>Repository</a>
                    </li>
                        </ul>
                    </li>
                    
                </ul>
            </nav>
        </div>