<?php
  include 'nav.php';
?>

	<div class="container">
        <h2 class="text-center pt-4">Transaction History</h2>
        
       <br>
       <div class="table-responsive-sm">
    <table class="table table-hover table-striped table-condensed table-bordered">
        <thead>
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
            </tr>
        </thead>
        <tbody>
        <?php

            include 'config.php';

            $sql ="select * from transaction";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr>
            <td class="py-2"><?php echo $rows['sno']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2"><?php echo $rows['balance']; ?> </td>
            }
                
        <?php
            $servername= "localhost";
            $username= "root";
            $password= "";
            $database= "sparks_bank";
           
            $conn = mysqli_connect($servername,$username,$password,$database);
           
            if (!mysqli_query($conn,$sql))
            {
            die('Error: ' . mysqli_error($conn));
            }
            echo "1 Filter Added";

            $sql = "INSERT INTO transaction(`sno`, `sender`, `reciever`, `balance`) VALUES ('1', 'Tulsi', 'Miloni', '500');";
            $result = "mysqli_query($conn, $sql);";
            echo $result;
            mysqli_close($conn);


        ?>
        </tbody>
    </table>

    </div>
</div>

<?php include('footer.php'); ?>

</body>
        }
    