<?php 
      
      $level=$_GET["level"];
      $subject=$_GET["subj"];
      $mysqli=new mysqli("localhost","root","","oneschool");
      
      $hwa=0; $sw=0; $qz=0; $prj=0; $me=0; $fe=0;
      $hwat=0; $swt=0; $qzt=0; $prjt=0; $met=0; $fet=0;
      $hwap=0; $swp=0; $qzp=0; $prjp=0; $mep=0; $fep=0;
      
      $table=mysqli_query($mysqli,"SELECT * FROM studentgrades WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subject' AND gradingper='First Grading'");

      while($row=mysqli_fetch_array($table)){
          if($row[4]=="Homeworks and Assignments"){
            $hwa=$hwa+$row[7];
            $hwat=$hwat+$row[6];
          }else if($row[4]=="Seatworks"){
            $sw=$sw+$row[7];
            $swt=$swt+$row[6];
          }else if($row[4]=="Quizzes"){
            $qz=$qz+$row[7];
            $qzt=$qzt+$row[6];
          }else if($row[4]=="Projects"){
            $prj=$prj+$row[7];
            $prjt=$prjt+$row[6];
          }else if($row[4]=="Midterm Exam"){
            $me=$me+$row[7];
            $met=$met+$row[6];
          }else if($row[4]=="Periodical Exam"){
            $fe=$fe+$row[7];
            $fet=$fet+$row[6];
          }
      }

      if($hwat!=0){
        $hwap=($hwa/$hwat)*100;
      }
      if($swt!=0){
        $swp=($sw/$swt)*100;
      }
      if($qzt!=0){
        $qzp=($qz/$qzt)*100;
      }
      if($prjt!=0){
        $prjp=($prj/$prjt)*100;
      }
      if($met!=0){
        $mep=($me/$met)*100;
      }
      if($fet!=0){
        $fep=($fe/$fet)*100;
      }

      $table=mysqli_query($mysqli,"SELECT `hwa`, `sw`, `qz`, `prj`, `me`, `fe` FROM `category` WHERE subjid='$subject' AND grdlvl='$level'");

      $row=mysqli_fetch_array($table);

      $hwag=$hwap/2+50;
      $swg=$swp/2+50;
      $qzg=$qzp/2+50;
      $prjg=$prjp/2+50;
      $meg=$mep/2+50;
      $feg=$fep/2+50;

      $hwax=$row[0]/100;
      $swx=$row[1]/100;
      $qzx=$row[2]/100;
      $prjx=$row[3]/100;
      $mex=$row[4]/100;
      $fex=$row[5]/100;

      $grade=$hwag*$hwax+$swg*$swx+$qzg*$qzx+$prjg*$prjx+$meg*$mex+$feg*$fex;


      $table=mysqli_query($mysqli,"SELECT * FROM graderecord WHERE idnum='$idnum' AND gradelevel='$level' AND subject='$subject'");

      $check=false;


      while($row=mysqli_fetch_array($table)){
        if($row[0]==$idnum){
          $check=true;
        }
      }

      if($check==true){
        $sql="UPDATE graderecord SET first='$grade' WHERE idnum='$idnum' AND  subject='$subject' AND gradelevel ='$level'";
       }else{
        $sql="INSERT INTO graderecord(idnum,gradelevel,subject,first) VALUES ('$idnum','$level','$subject','$grade')";
       }
      
      $mysqli->query($sql);


      $table=mysqli_query($mysqli,"SELECT * FROM studentgrading WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subject' AND gradingper='First Grading'");

      $check=false;

      while($row=mysqli_fetch_array($table)){
        if($row[0]==$idnum){
          $check=true;
        }
      }

      if($check==true){
        $sql="UPDATE studentgrading SET hwa='$hwap',qz='$qzp',sw='$swp',proj='$prjp',me='$mep',fe='$fep',grade='$grade' WHERE idnum='$idnum' AND  subject='$subject' AND gradingper='First Grading' AND gradelvl ='$level'";
       }else{
        $sql="INSERT INTO studentgrading(idnum,gradelvl,subject,gradingper,hwa,sw,qz,proj,me,fe,grade) VALUES ('$idnum','$level','$subject','First Grading','$hwap','$swp','$qzp','$prjp','$mep','$fep','$grade')";
       }
      
      $mysqli->query($sql);

  //SECOND GRADING

      $hwa=0; $sw=0; $qz=0; $prj=0; $me=0; $fe=0;
      $hwat=0; $swt=0; $qzt=0; $prjt=0; $met=0; $fet=0;
      $hwap=0; $swp=0; $qzp=0; $prjp=0; $mep=0; $fep=0;
      $table=mysqli_query($mysqli,"SELECT * FROM studentgrades WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subject' AND gradingper='Second Grading'");

      while($row=mysqli_fetch_array($table)){
          if($row[4]=="Homeworks and Assignments"){
            $hwa=$hwa+$row[7];
            $hwat=$hwat+$row[6];
          }else if($row[4]=="Seatworks"){
            $sw=$sw+$row[7];
            $swt=$swt+$row[6];
          }else if($row[4]=="Quizzes"){
            $qz=$qz+$row[7];
            $qzt=$qzt+$row[6];
          }else if($row[4]=="Projects"){
            $prj=$qz+$row[7];
            $prjt=$prjt+$row[6];
          }else if($row[4]=="Midterm Exam"){
            $me=$me+$row[7];
            $met=$met+$row[6];
          }else if($row[4]=="Periodical Exam"){
            $fe=$fe+$row[7];
            $fet=$fet+$row[6];
          }
      }

      if($hwat!=0)
        $hwap=($hwa/$hwat)*100;
      if($swt!=0)
        $swp=($sw/$swt)*100;
      if($qzt!=0)
        $qzp=($qz/$qzt)*100;
      if($prjt!=0)
        $prjp=($prj/$prjt)*100;
      if($met!=0)
        $mep=($me/$met)*100;
      if($fet!=0)
        $fep=($fe/$fet)*100;

      $table=mysqli_query($mysqli,"SELECT `hwa`, `sw`, `qz`, `prj`, `me`, `fe` FROM `category` WHERE subjid='$subject' AND grdlvl='$level'");

      $row=mysqli_fetch_array($table);

      $hwag=$hwap/2+50;
      $swg=$swp/2+50;
      $qzg=$qzp/2+50;
      $prjg=$prjp/2+50;
      $meg=$mep/2+50;
      $feg=$fep/2+50;

      $hwax=$row[0]/100;
      $swx=$row[1]/100;
      $qzx=$row[2]/100;
      $prjx=$row[3]/100;
      $mex=$row[4]/100;
      $fex=$row[5]/100;

      $grade=$hwag*$hwax+$swg*$swx+$qzg*$qzx+$prjg*$prjx+$meg*$mex+$feg*$fex;

      $table=mysqli_query($mysqli,"SELECT * FROM graderecord WHERE idnum='$idnum' AND gradelevel='$level' AND subject='$subject'");
      $check=false;


      while($row=mysqli_fetch_array($table)){
        if($row[0]==$idnum){
          $check=true;
        }
      }

      if($check==true){
        $sql="UPDATE graderecord SET second='$grade' WHERE idnum='$idnum' AND  subject='$subject' AND gradelevel ='$level'";
       }else{
        $sql="INSERT INTO graderecord(idnum,gradelevel,subject,second) VALUES ('$idnum','$level','$subject','$grade')";
       }
      
      $mysqli->query($sql);

      
      $table=mysqli_query($mysqli,"SELECT * FROM studentgrading WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subject' AND gradingper='Second Grading'");

      $check=false;

      while($row=mysqli_fetch_array($table)){
        if($row[0]==$idnum){
          $check=true;
        }
      }

      if($check==true){
        $sql="UPDATE studentgrading SET hwa='$hwap',qz='$qzp',sw='$swp',proj='$prjp',me='$mep',fe='$fep',grade='$grade' WHERE idnum='$idnum' AND  subject='$subject' AND gradingper='Second Grading' AND gradelvl ='$level'";
       }else{
        $sql="INSERT INTO studentgrading(idnum,gradelvl,subject,gradingper,hwa,sw,qz,proj,me,fe,grade) VALUES ('$idnum','$level','$subject','Second Grading','$hwap','$swp','$qzp','$prjp','$mep','$fep','$grade')";
       }
      
      $mysqli->query($sql);
//THIRD GRADING

      $hwa=0; $sw=0; $qz=0; $prj=0; $me=0; $fe=0;
      $hwat=0; $swt=0; $qzt=0; $prjt=0; $met=0; $fet=0;
      $hwap=0; $swp=0; $qzp=0; $prjp=0; $mep=0; $fep=0;
      $table=mysqli_query($mysqli,"SELECT * FROM studentgrades WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subject' AND gradingper='Third Grading'");

      while($row=mysqli_fetch_array($table)){
          if($row[4]=="Homeworks and Assignments"){
            $hwa=$hwa+$row[7];
            $hwat=$hwat+$row[6];
          }else if($row[4]=="Seatworks"){
            $sw=$sw+$row[7];
            $swt=$swt+$row[6];
          }else if($row[4]=="Quizzes"){
            $qz=$qz+$row[7];
            $qzt=$qzt+$row[6];
          }else if($row[4]=="Projects"){
            $prj=$qz+$row[7];
            $prjt=$prjt+$row[6];
          }else if($row[4]=="Midterm Exam"){
            $me=$me+$row[7];
            $met=$met+$row[6];
          }else if($row[4]=="Periodical Exam"){
            $fe=$fe+$row[7];
            $fet=$fet+$row[6];
          }
      }

      if($hwat!=0)
        $hwap=($hwa/$hwat)*100;
      if($swt!=0)
        $swp=($sw/$swt)*100;
      if($qzt!=0)
        $qzp=($qz/$qzt)*100;
      if($prjt!=0)
        $prjp=($prj/$prjt)*100;
      if($met!=0)
        $mep=($me/$met)*100;
      if($fet!=0)
        $fep=($fe/$fet)*100;

$table=mysqli_query($mysqli,"SELECT `hwa`, `sw`, `qz`, `prj`, `me`, `fe` FROM `category` WHERE subjid='$subject' AND grdlvl='$level'");

      $row=mysqli_fetch_array($table);

      $hwag=$hwap/2+50;
      $swg=$swp/2+50;
      $qzg=$qzp/2+50;
      $prjg=$prjp/2+50;
      $meg=$mep/2+50;
      $feg=$fep/2+50;

      $hwax=$row[0]/100;
      $swx=$row[1]/100;
      $qzx=$row[2]/100;
      $prjx=$row[3]/100;
      $mex=$row[4]/100;
      $fex=$row[5]/100;

      $grade=$hwag*$hwax+$swg*$swx+$qzg*$qzx+$prjg*$prjx+$meg*$mex+$feg*$fex;

    $table=mysqli_query($mysqli,"SELECT * FROM graderecord WHERE idnum='$idnum' AND gradelevel='$level' AND subject='$subject'");

      $check=false;


      while($row=mysqli_fetch_array($table)){
        if($row[0]==$idnum){
          $check=true;
        }
      }

      if($check==true){
        $sql="UPDATE graderecord SET third='$grade' WHERE idnum='$idnum' AND  subject='$subject' AND gradelevel ='$level'";
       }else{
        $sql="INSERT INTO graderecord(idnum,gradelevel,subject,third) VALUES ('$idnum','$level','$subject','$grade')";
       }
      
      $mysqli->query($sql);

      
      $table=mysqli_query($mysqli,"SELECT * FROM studentgrading WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subject' AND gradingper='Third Grading'");

      $check=false;

      while($row=mysqli_fetch_array($table)){
        if($row[0]==$idnum){
          $check=true;
        }
      }

      if($check==true){
        $sql="UPDATE studentgrading SET hwa='$hwap',qz='$qzp',sw='$swp',proj='$prjp',me='$mep',fe='$fep',grade='$grade' WHERE idnum='$idnum' AND  subject='$subject' AND gradingper='Third Grading' AND gradelvl ='$level'";
       }else{
        $sql="INSERT INTO studentgrading(idnum,gradelvl,subject,gradingper,hwa,sw,qz,proj,me,fe,grade) VALUES ('$idnum','$level','$subject','Third Grading','$hwap','$swp','$qzp','$prjp','$mep','$fep','$grade')";
       }
      
      $mysqli->query($sql);
//FOURTH GRADING
      $hwa=0; $sw=0; $qz=0; $prj=0; $me=0; $fe=0;
      $hwat=0; $swt=0; $qzt=0; $prjt=0; $met=0; $fet=0;
      $hwap=0; $swp=0; $qzp=0; $prjp=0; $mep=0; $fep=0;
      $table=mysqli_query($mysqli,"SELECT * FROM studentgrades WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subject' AND gradingper='Fourth Grading'");

      while($row=mysqli_fetch_array($table)){
          if($row[4]=="Homeworks and Assignments"){
            $hwa=$hwa+$row[7];
            $hwat=$hwat+$row[6];
          }else if($row[4]=="Seatworks"){
            $sw=$sw+$row[7];
            $swt=$swt+$row[6];
          }else if($row[4]=="Quizzes"){
            $qz=$qz+$row[7];
            $qzt=$qzt+$row[6];
          }else if($row[4]=="Projects"){
            $prj=$qz+$row[7];
            $prjt=$prjt+$row[6];
          }else if($row[4]=="Midterm Exam"){
            $me=$me+$row[7];
            $met=$met+$row[6];
          }else if($row[4]=="Periodical Exam"){
            $fe=$fe+$row[7];
            $fet=$fet+$row[6];
          }
      }

      if($hwat!=0)
        $hwap=($hwa/$hwat)*100;
      if($swt!=0)
        $swp=($sw/$swt)*100;
      if($qzt!=0)
        $qzp=($qz/$qzt)*100;
      if($prjt!=0)
        $prjp=($prj/$prjt)*100;
      if($met!=0)
        $mep=($me/$met)*100;
      if($fet!=0)
        $fep=($fe/$fet)*100;

      $table=mysqli_query($mysqli,"SELECT `hwa`, `sw`, `qz`, `prj`, `me`, `fe` FROM `category` WHERE subjid='$subject' AND grdlvl='$level'");

      $row=mysqli_fetch_array($table);

      $hwag=$hwap/2+50;
      $swg=$swp/2+50;
      $qzg=$qzp/2+50;
      $prjg=$prjp/2+50;
      $meg=$mep/2+50;
      $feg=$fep/2+50;

      $hwax=$row[0]/100;
      $swx=$row[1]/100;
      $qzx=$row[2]/100;
      $prjx=$row[3]/100;
      $mex=$row[4]/100;
      $fex=$row[5]/100;

      $grade=$hwag*$hwax+$swg*$swx+$qzg*$qzx+$prjg*$prjx+$meg*$mex+$feg*$fex;

$table=mysqli_query($mysqli,"SELECT * FROM graderecord WHERE idnum='$idnum' AND gradelevel='$level' AND subject='$subject'");

      $check=false;


      while($row=mysqli_fetch_array($table)){
        if($row[0]==$idnum){
          $check=true;
        }
      }

      if($check==true){
        $sql="UPDATE graderecord SET fourth='$grade' WHERE idnum='$idnum' AND  subject='$subject' AND gradelevel ='$level'";
       }else{
        $sql="INSERT INTO graderecord(idnum,gradelevel,subject,fourth) VALUES ('$idnum','$level','$subject','$grade')";
       }
      
      $mysqli->query($sql);

      
      $table=mysqli_query($mysqli,"SELECT * FROM studentgrading WHERE idnum='$idnum' AND gradelvl='$level' AND subject='$subject' AND gradingper='Fourth Grading'");

      $check=false;

      while($row=mysqli_fetch_array($table)){
        if($row[0]==$idnum){
          $check=true;
        }
      }

      if($check==true){
        $sql="UPDATE studentgrading SET hwa='$hwap',qz='$qzp',sw='$swp',proj='$prjp',me='$mep',fe='$fep',grade='$grade' WHERE idnum='$idnum' AND  subject='$subject' AND gradingper='Fourth Grading' AND gradelvl ='$level'";
       }else{
        $sql="INSERT INTO studentgrading(idnum,gradelvl,subject,gradingper,hwa,sw,qz,proj,me,fe,grade) VALUES ('$idnum','$level','$subject','Fourth Grading','$hwap','$swp','$qzp','$prjp','$mep','$fep','$grade')";
       }
      
      $mysqli->query($sql);

      $table=mysqli_query($mysqli,"SELECT `first`, `second`, `third`, `fourth` FROM `graderecord` WHERE idnum='$idnum' AND gradelevel='$level' AND subject='$subject'");

      $row=mysqli_fetch_array($table);

      $ave=($row[0]+$row[1]+$row[2]+$row[3])/4;

      $sql="UPDATE graderecord SET average='$ave' WHERE idnum='$idnum' AND gradelevel='$level' AND subject='$subject'";

      $mysqli->query($sql);

?>




