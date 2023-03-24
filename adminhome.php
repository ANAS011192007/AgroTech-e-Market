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

                  <input id="button" type="button" value="My Profile" onclick="profile()">
                  <input type="button" id="button" value="Logout" onclick="logout();">
                </right>

              </h1>

                <br><br>



                <br>
                <br>

                <form id="box" action="search.php" method="GET">

                <div style="font-size: 20px;margin: 10px;">Welcome
                <?php

                ?></div>

                    <input class="text" type="search" id="search" name="search" placeholder="Product/Farmer">
                    <br><br>
                    <select class="text" id="choose" name="choose">
                    <option value="product">Product</option>
                    <option value="farmer">Farmer</option>
                    </select>
                    <br><br>
                    <input id="button" type="submit" value="Search">
                </form>
                <br>
                <br>
                <input id="button" type="button" value="all Product" onclick="allproduct();">
                <input id="button" type="button" value="all buyers" onclick="allbuyers();">
                <input id="button" type="button" value="all sellers" onclick="allsellers();">
                <input id="button" type="button" value="refund_list" onclick="refund_list();">
                <input id="button" type="button" value="Order History" onclick="orderhistory()">

                <div>
                  <br>
                  <br>


                  <?php
                  try{
                      ///PDO = PHP Data Object
                      $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
                      ///setting 1 environment variable
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                      ///mysql query string
                      $mysqlquery1="SELECT * FROM product";
                      $returnobj1=$conn->query($mysqlquery1);

                      $mysqlquery2="SELECT * FROM farmer";
                      $returnobj2=$conn->query($mysqlquery2);

                      $mysqlquery3="SELECT * FROM buyer";
                      $returnobj3=$conn->query($mysqlquery3);


                      ?>

                      <h2> Total Products : <?php echo $returnobj1->rowCount()?></h2>
                      <h2> Total Sellers : <?php echo $returnobj2->rowCount()?></h2>
                      <h2> Total Buyers : <?php echo $returnobj3->rowCount()?></h2>


                  <?php
                  }
                  catch(PDOException $ex){
                      ?>
                          <tr>
                              <td colspan="6">No values found</td>
                          <tr>
                      <?php
                  }


                  ?>

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

                    function refund_list(){
                    location.assign('allreturn_history.php');   ///default GET method
                    }


                    function orderhistory(){
                    location.assign('allorders.php');
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
