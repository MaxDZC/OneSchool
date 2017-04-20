
                            <?php
                                $gradelvl=$_POST["gradelvl"];
                                $sect=$_POST["sect"];
                                $studs=$_POST["studs"];
                                $mysqli=new mysqli("localhost","root","","oneschool");
                                $sql="INSERT INTO class (gradelvl,section,studs) VALUES ('$gradelvl','$sect','$studs')";
                                $mysqli->query($sql);

                                header("Location: createclass.php");
                            ?>