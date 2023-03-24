<?php

session_start();

if(
    isset($_SESSION['username'])
    && !empty($_SESSION['username'])
){
    ///already logged in user
    $username = $_SESSION['username'];

    ?>
        <!DOCTYPE html>

        <html lang="en">
            <head>
                <meta charset="utf-8">
                <title>Home</title>

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
                            width: 120px;
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
                  <input id="button" type="button" value="Home" onclick="home();">



                  <input id="button" type="button" value="My Profile" onclick="profile()">
                  <input type="button" id="button" value="Logout" onclick="logout();">
                </right>
              </h1>
                <br><br>
                <input id="button" type="button" value="all Product" onclick="allproduct();">
                <input id="button" type="button" value="all buyers" onclick="allbuyers();">
                <input id="button" type="button" value="all sellers" onclick="allsellers();">
                <input id="button" type="button" value="refund_list" onclick="refund_list();">
                <input id="button" type="button" value="Order History" onclick="orderhistory()">

                <div>
                  <br>
                  <br>
                <h2> All Products </h2>

                    <table id="ptable">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>bkash_no</th>
                                <th>Address</th>
                                <th>District</th>
                                <th>City</th>

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
                                $mysqlquery="SELECT * FROM farmer";

                                $returnobj=$conn->query($mysqlquery);
                                $returntable=$returnobj->fetchAll();




                                if($returnobj->rowCount()==0){
                                    ?>
                                        <tr>
                                            <td colspan="8">No Buyers info Available</td>
                                        <tr>
                                    <?php
                                }


                                else{
                                    foreach($returntable as $row){
                                        ?>

                                        <tr>

                                            <td><?php echo $row['f_username'] ?></td>

                                            <td><?php echo $row['Name'] ?></td>
                                            <td><?php echo $row['Contact_no'] ?></td>
                                            <td><?php echo $row['bKash_no'] ?></td>
                                            <td><?php echo $row['Address'] ?></td>
                                            <td><?php echo $row['City'] ?></td>
                                            <td><?php echo $row['District'] ?></td>

                                            <td>
                                                    <br>
                                                    <input type="button" id="button" value="BLOCK" onclick="block(<?php echo $row['f_username']?>);">
                                                    <br><br>
                                                    <input type="button" id="button" value="DELETE" onclick="delete_data(<?php echo $row['f_username']?>);">
                                                    <br><br>

                                            </td>
                                        </tr>

                                        <?php
                                    }
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="6">No Info found</td>
                                    <tr>
                                <?php
                            }

                            ?>

                        </tbody>
                    </table>
                </div>

                <script>

                    function home(){
                        location.assign('adminhome.php');   ///default GET method
                    }
                    function logout(){
                        location.assign('logout.php');   ///default GET method
                    }

                    function profile(){
                        location.assign('profile.php');   ///default GET method
                    }

                    function allproduct(){
                        location.assign('allproduct.php');
                    }
                    function allbuyers(){
                        location.assign('allbuyers.php');
                    }
                    function allsellers(){
                        location.assign('allsellers.php');
                    }

                    function block(f_username){
                      location.assign('block.php?>f_username='+f_username);
                    }

                    function delete_data(f_username){
                      location.assign('user_delete.php?f_username='+f_username);
                    }

                    function orderhistory(){
                        location.assign('allorders.php');
                    }

                    function refund_list(){
                        location.assign('allreturn_history.php');
                    }


                    function deletef(username){

                        location.assign('admin_delete_farmer.php?username='+username);
                    }

                </script>


            </body>
        </html>

    <?php
}
else{
     ?>
        <script>alert("login first!");</script>
        <script>location.assign("login.php");</script>
    <?php
}


?>
