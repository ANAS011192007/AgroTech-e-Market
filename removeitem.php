<?php

session_start();
if(
    isset($_SESSION['username'])
    && isset($_SESSION['role'])
    && !empty($_SESSION['username'])
    && !empty($_SESSION['role']))
{
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    $pid = $_GET['prodid'];
    $Quantity = $_GET['Quantity'];


        try{
            ///PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $signupquery="SELECT * FROM Product
                            WHERE p_id = '$pid'";

            echo $signupquery;
            $returnobj = $conn->query($signupquery);

            $returntable = $returnobj->fetchAll();

            if($returnobj->rowCount() == 1)
            {
                foreach($returntable as $row){
                $high = $row[3];
            }
            }

            $newquery = "UPDATE Product SET Quantity = $high+$Quantity, AvailableQuantity = $high+$Quantity WHERE p_id = '$pid'";

            ///mysql query string
            $mysqlquerystring="SET foreign_key_checks = 0;
            DELETE FROM cart WHERE p_id = '".$pid."' && b_username = '".$username."';
            SET foreign_key_checks = 1;";

            $conn->exec($newquery);
            $conn->exec($mysqlquerystring);

            ?>
            <script>alert("Product removed from cart!");</script>
            <script>location.assign("cart.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
            echo "hi pdo";
                <script>location.assign("cart.php");</script>
            <?php
        }

    }
    else{
        ?>
            <script>location.assign("cart.php");</script>
        <?php
    }


?>
