<?php
session_start();
if(
    isset($_SESSION['username'])
    && isset($_SESSION['role'])
    && !empty($_SESSION['username'])
    && !empty($_SESSION['role'])
)
{
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    ?>

    <!DOCTYPE html>

    <html lang="en">
        <head>
        <title>Cart</title>

        <style>

                body {
                        background-color: lightblue;
                    }

                .text{

                            height: 25px;
                            border-radius: 5px;
                            padding: 2px;
                            border: solid thin #aaa;
                            width: 90%;
                        }


                        #button{

                            padding: 10px;
                            width: 130px;
                            color: white;
                            background-color: FireBrick;
                            border: none;
                        }

                        #box{

                            background-color: AliceBlue;
                            margin: auto;
                            width: 300px;
                            padding: 20px;
                        }


                    #ptable{
                        width: 100%;
                        border: 1px solid blue;
                        border-collapse: collapse;
                    }

                    #ptable th, #ptable td{
                        border: 1px solid blue;
                        border-collapse: collapse;
                        text-align: center;
                    }

                    #ptable tr:hover{
                        background-color: bisque;
                    }

                    .text{
                        height: 25px;
                        border-radius: 5px;
                        padding: 2px;
                        border: solid thin #aaa;
                        width: 90%;
                    }

                    .header {
                      background-color: #333;
                      overflow: hidden;
                    }

                    .header left {
                      float: left;
                      color: #f2f2f2;
                      text-align: center;
                      padding: 14px 16px;
                      text-decoration: none;
                      font-size: 30px;
                    }

                    .header right {
                      float: right;
                      color: #f2f2f2;
                      text-align: center;
                      padding: 14px 16px;
                      text-decoration: none;
                      font-size: 20px;
                    }


                </style>

        </head>

        <body>


          <h1 class="header">
            <left>AgroTech eMarket</left>
            <right>
              <input id="button" type="button" value="Home Page" onclick="home()">
              <input id="button" type="button" value="My Profile" onclick="profile()">
              <input id="button" type="button" value="My Notifications" onclick="notification()">
              <input id="button" type="button" value="Order History" onclick="orderhistory()">
              <input type="button" id="button" value="Logout" onclick="logout();">
            </right>

          </h1>


        <h2> Pre Book </h2>

        <?php $total = 0; ?>

                    <table id="ptable">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product name</th>
                                <th>Total Amount</th>
                                <th>Total Cost</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            try{
                                ///PDO = PHP Data Object
                                $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
                                ///setting 1 environment variable
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                ///mysql query string
                                $cartquery="SELECT * FROM pre_book WHERE b_username = '$username'";

                                $returnobj=$conn->query($cartquery);
                                $returntable=$returnobj->fetchAll();


                                if($returnobj->rowCount()==0){
                                    ?>
                                        <tr>
                                            <td colspan="5">No values found</td>
                                        <tr>
                                    <?php
                                }
                                else{
                                    foreach($returntable as $row){
                                        ?>

                                        <tr>
                                            <td><?php echo $row[1] ?></td>
                                            <td><?php echo $row[2] ?></td>
                                            <td><?php echo $row[3]. " kg" ?></td>
                                            <td><?php echo $row[4]." BDT" ?></td>
                                            <td>
                                                <br>
                                                <?php
                                                if ($row[5] == 1)
                                                {?>
                                                    <input id="button" type="button" value="Not Removable" onclick="">
                                                <?php
                                                }
                                                else{?>
                                                    <input id="button" type="button" value="Remove Item" onclick="removeprebookitem(<?php echo $row[1]?>, <?php echo $row[3]?>);">
                                                <?php
                                                }
                                                ?>

                                                <br><br>
                                            </td>
                                        </tr>
                                        <?php

                                        $total += $row[4];
                                    }
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="6">No values found</td>
                                    <tr>
                                <?php
                            }

                            ?>

                        </tbody>
                    </table>


                    <div id="box" style="font-size: 20px;margin: 10px;">
                <br>

                <?php

                try{
                    // PHP Data Object
                    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
                    ///setting 1 environment variable
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    ///executing mysql query
                    // $buyeracc = "SELECT buyer_acc_no FROM Buyer WHERE b_username = '".$username."'";

                //
                //     // $signupquery="SELECT b.buyer_acc_no, f.farmer_acc_no, f.f_username
                //     //         FROM
                //     //         Buyer as b
                //     //         JOIN Buyer_Product as bp
                //     //         ON bp.Buyerb_username = b.b_username
                //     //         JOIN Product as p
                //     //         ON p.p_id = bp.Productp_id
                //     //         JOIN farmer as f
                //     //         ON f.f_username = p.farmerf_username
                //
                //     //     WHERE b.b_username = '".$username."' && bp.Productp_id = 2";     // && bp.Productp_id = 2 selling to only one farmer
                //
                //
                //     $returnobj = $conn->query($buyeracc);
                //     $returntable = $returnobj->fetchAll();
                //
                //     if($returnobj->rowCount() == 1)
                //     {
                //         foreach($returntable as $row){
                //
                //         $buyeracc = $row[0];
                //
                //         }
                //     }

                ?>

                <form action="paycart.php" method="GET">

                <br>

                <label for="paymentType">Payment Methode</label>:
                <select class="text" id="paymentType" name="paymentType">
                    <option selected="selected" value="">Select Payment Methode</option>
                    <option value="bKash">bKash</option>
                    <option value="Cash">Cash</option>
                </select>

                <br>

                <label for="total">Total Amount</label>:
                <input class="text" type="text" id="total" name="total" value="<?php echo $total; ?>" readonly>
                <br>



                <input id="button" type="submit" value="Place Order">

                </form>




<?php


                }
                catch(PDOException $ex){
                    ?>
                        <script>location.assign("pre_book.php");</script>
                    <?php
                }

                ?>

        <br>


      <br>

        <script>
                    function home(){
                        location.assign('home.php');   ///default GET method
                    }

                    function profile(){
                        location.assign('profile.php');   ///default GET method
                    }
                    function logout(){
                        location.assign('logout.php');   ///default GET method
                    }

                    function update(){
                        location.assign('updateprofile.php');   ///default GET method
                    }

                    function notification(){
                        location.assign('notification.php');
                    }

                    function removeprebookitem(pid, quantity){
                        location.assign('removeprebookitem.php?prodid='+pid+'&Quantity='+quantity);
                    }

                    function orderhistory(){
                        location.assign('orderhistory.php');
                    }

        </script>



        </body>
    </html>

    <?php
}
else
{
    ?>
            <script>location.assign("login.php");</script>
    <?php
}

?>
