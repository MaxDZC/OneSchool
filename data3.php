
                            <?php
                                $gradelvl=$_POST["gradelvl"];
                                $subjid=$_POST["subjid"];
                                $hwa=$_POST["hwa"];
                                $sw=$_POST["sw"];
                                $qz=$_POST["qz"];
                                $prj=$_POST["prj"];
                                $me=$_POST["me"];
                                $fe=$_POST["fe"];
                                
                                $mysqli=new mysqli("localhost","root","","oneschool");
                                $sql="INSERT INTO category (grdlvl,subjid,hwa,sw,qz,prj,me,fe) VALUES ('$gradelvl','$subjid','$hwa','$sw','$qz','$prj','$me','$fe')";
                                $mysqli->query($sql);

                                header("Location: createcat.php");
                            ?>