 <?php
 // DB connection info
 $host = "ap-cdbr-azure-southeast-b.cloudapp.net";
 $user = "ba6c086e8940fd";
 $pwd = "a5c3978a";
 $db = "oneschool";
 try{
    $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
     
    $sql = "drop oneschool";
    $result = $conn->query($sql);

 }
 catch(Exception $e){
     die(print_r($e));
 }
 echo "<h3>Tables DELETED.</h3>";
 ?>