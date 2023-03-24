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

            

            ///mysql query string
            $mysqlquerystring="SET foreign_key_checks = 0;
            DELETE FROM wishlist WHERE p_id = '".$pid."' && b_username = '".$username."'&& totalQuantity = '".$Quantity."';
            SET foreign_key_checks = 1;";

            
            $conn->exec($mysqlquerystring);

            ?>
            <script>alert("Product removed from wishlist!");</script>
            <script>location.assign("wishlist.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
            echo "hi pdo";
                <script>location.assign("wishlist.php");</script>
            <?php
        }

    }
    else{
        ?>
            <script>location.assign("wishlist.php");</script>
        <?php
    }


?>