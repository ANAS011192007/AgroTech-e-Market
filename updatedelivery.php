<?php
/*
step 1: to receive the email and password data from register.php
step 2: to store the data within the database
step 3: if data store is successful then forward to login.php
        else forward to register.php
*/

session_start();

if(
    isset($_SESSION['username'])
    && isset($_SESSION['role'])
    && !empty($_SESSION['username'])
    && !empty($_SESSION['role']))
    {

    $role = $_SESSION['role'];
    $username = $_SESSION['username'];


    if(isset($_GET['orderid'])
    && !empty($_GET['orderid'])
    && isset($_GET['status'])
    && !empty($_GET['status'])
        )
        {
            $orderid = $_GET['orderid'];
            $status = $_GET['status'];

                    ///store the data to database
                try{
                    // PHP Data Object
                    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
                    ///setting 1 environment variable
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $orderquery="SELECT * FROM orders
                    WHERE orders_id = '$orderid'";

                    $returnobj=$conn->query($orderquery);
                    $returntable=$returnobj->fetchAll();

                    if($returnobj->rowCount() >= 1)
                    {
                    foreach($returntable as $row){

                        $name = null;
                        $pid = $row[7];
                        $b_username = $row[4];

                        $cartquery1 = "SELECT productName FROM Product
                        WHERE p_id = $pid";

                            $returnobj1=$conn->query($cartquery1);
                            $returntable1=$returnobj1->fetchAll();

                            if($returnobj1->rowCount() == 1)
                            {
                                foreach($returntable1 as $row1){
                                    $name = $row1[0];
                                }
                            }

                            $orderquery="UPDATE orders SET delivery_status = '".$status."', order_time = NOW()
                                    WHERE orders_id = $orderid;";
                            echo $orderquery;

                            $msg1 = "Delevary of product $name is $status. <br>Check your order history for more details.";
                            $msg2 = "Delevary of product $name is $status";

                            //update home
                            $notifycart="INSERT INTO notification VALUES (NULL, '$msg1', NOW(), '$username', '$b_username', '$msg2')";
                            echo $notifycart;

                            $conn->exec($orderquery);
                            $conn->exec($notifycart);


                        }
                    }


                    ?>
                    <script>alert("Update successful");</script>
                    <script>location.assign("orderhistory.php");</script>
                    <?php


                }
                catch(PDOException $ex){
                    ?>
                        <script>alert("Database Error!");</script>
                    <?php
                }

                }

                else{
                ///if email and password data is empty or not set
                /// register.php --> registeruser.php --> register.php
                ?>
                <script>alert("Fill up all required fields!");</script>
                <script>location.assign("home.php");</script>
                <?php

                }

            }
            else{
                ///if email and password data is empty or not set
                /// register.php --> registeruser.php --> register.php
                ?>
                <script>location.assign("home.php");</script>
                <?php

            }



?>
order
