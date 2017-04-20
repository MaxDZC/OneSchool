
                            <?php
                                $gradelvl=$_POST["gradelvl"];
                                $subjid=$_POST["subjid"];
                                $stime=$_POST['stime'];
                                $etime=$_POST['etime'];
                                $mysqli=new mysqli("localhost","root","","oneschool");
                                $sql="INSERT INTO schedule (gradelvl,subject,time) VALUES ('$gradelvl','$subjid','$stime - $etime')";
                                $mysqli->query($sql);
                                header("Location: createsched.php");
                            ?>