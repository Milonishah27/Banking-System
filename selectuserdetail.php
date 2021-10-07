<?php
include('config.php');
include('bank.php');

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
 
 $sql = "CREATE TABLE `users` ( `id` INT(3) NOT NULL AUTO_INCREMENT , `name` VARCHAR NOT NULL , `amount` INT(8) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
 $sql = "INSERT INTO `users` (`id`, `name`, `amount`) VALUES ('1', 'tulsi', '1000');";
 $sql = "INSERT INTO `users` (`id`, `name`, `amount`) VALUES ('2', 'priyanka', '700');";
 $sql = "SELECT * FROM 'users'";
 $result = mysqli_query($conn, $sql);
 
 
 
 
 if($result){
     echo "Table was created";
 }
 else{
     echo "table was not created.";
     ($conn);

     if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];
    
    $sql= "CREATE DATABASE selectuser";
    $sql = "CREATE TABLE `selectuser`.`users` ( `id` INT(3) NOT NULL AUTO_INCREMENT , `name` VARCHAR NOT NULL , `amount` INT(8) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    
    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transactionhistory.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
 }
?>



 

 