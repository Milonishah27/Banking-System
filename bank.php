 <?php
 

 $servername= "localhost";
 $username= "root";
 $password= "";
 $database = "selectuser";

 $conn = mysqli_connect($servername, $username, $password, $database);

 if(!$conn){
     die("connection failed".mysqli_connect_error());

 }
 else{
     echo "connection was successful.";
 }
 ?>
 
 
 