<?php

session_start();
if(
    isset($_SESSION['username'])
    && isset($_SESSION['role'])
    && !empty($_SESSION['username'])
    && !empty($_SESSION['role'])
){


        $username = $_SESSION['username'];

        $product_id=$_GET['prodid'];
        $amount=$_GET['amount'];
        $high=$_GET['high'];



        try{
            ///PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            ///executing mysql query
            $signupquery="SELECT f.f_username, p.Price_perUnit, p.productName FROM farmer as f
                            JOIN product as p
                            ON p.f_username = f.f_username
                            WHERE p.p_id = ".$product_id;



            $returnobj = $conn->query($signupquery);

            $returntable = $returnobj->fetchAll();


            if($returnobj->rowCount() == 1)
            {
                foreach($returntable as $row){
                ?><br><?php
                $fusername = $row[0];

                ?><br><?php
                $perUnit = $row[1];

                ?><br><?php
                $product = $row[2];

                ?><br><?php
            }
            }


            ///mysql query string
            $mysqlquerystring="INSERT INTO wishlist VALUES ('$username', $product_id, '$product', $amount, $amount*$perUnit,$high)";

            $msg1 = "$product added to your cart. <br>Please check your cart and complete the payment.";
            $msg2 = "$product is sold. <br>Check your product list.";


            $mynotification="INSERT INTO notification VALUES (NULL, '$msg1', NOW(), '$fusername', '$username', '$msg2')";

            

            $conn->exec($mysqlquerystring);
            $conn->exec($mynotification);
            

            ?>
                <script>location.assign("home.php");</script>
            <?php


        }
        catch(PDOException $ex){
            ?>
            <script> alert("This product is already in Cart.");
                location.assign("home.php");</script>
            <?php
        }





}
else{
    ?>
        <script>location.assign("login.php");</script>
    <?php
}

?>