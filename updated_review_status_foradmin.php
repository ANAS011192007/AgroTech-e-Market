<?php

session_start();

if(
    isset($_SESSION['username'])
    && !empty($_SESSION['username'])
){
    $username = $_SESSION['username'];
    $ordersid = $_GET['orders_id'];
    $trxid = $_GET['trxid'];


                try{
                    // PHP Data Object
                    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
                    ///setting 1 environment variable
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sqlquary="UPDATE orders SET delivery_status = 'Refunded, TrxID : $trxid' WHERE orders_id = $ordersid";
                    $conn->exec($sqlquary);

                    $sqlquary1="DELETE FROM returnn WHERE order_id = $ordersid";
                    $conn->exec($sqlquary1);

                    ?>
                        <script>location.assign("allorders.php");</script>
                    <?php


                }
                catch(PDOException $ex){
                    ?>
                        <script>location.assign("allbuyers.php");</script>
                    <?php
                }
  }
