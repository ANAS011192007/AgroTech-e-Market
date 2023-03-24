<?php

session_start();

if(
    isset($_SESSION['username'])
    && isset($_SESSION['role'])
    && !empty($_SESSION['username'])
    && !empty($_SESSION['role'])
){
    ///already logged in user
    $role = $_SESSION['role'];
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

                        #button2{

                        padding: 10px;
                        width: 120px;
                        color: black;
                        background-color: greenyellow;
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
                  <input id="button" type="button" value="Bid Room" onclick="allBid();">
                  <input id="button" type="button" value="My Profile" onclick="profile()">
                  <input id="button" type="button" value="My Notifications" onclick="notification()">
                  <input id="button" type="button" value="Order History" onclick="orderhistory()">
                  <input type="button" id="button" value="Logout" onclick="logout();">
                </right>

              </h1>

                <br><br>



                <br>
                <br>

                <form id="box" action="search.php" method="GET">

                <div style="font-size: 20px;margin: 10px;">Welcome
                <?php

                try{
                    // PHP Data Object
                    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
                    ///setting 1 environment variable
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    ///executing mysql query
                    $signupquery="SELECT * FROM ".$role." WHERE ".$role[0]."_username = '".$username."'";


                    $returnobj = $conn->query($signupquery);
                    $returntable = $returnobj->fetchAll();

                    if($returnobj->rowCount() == 1)
                    {
                        foreach($returntable as $row){
                        ?><br><?php
                        echo $row['Name'];
                    }
                    }
                }
                catch(PDOException $ex){
                    ?>
                        <script>location.assign("login.php");</script>
                    <?php
                }

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


                <?php

                if($role == 'farmer'){
                    ?>
                    <input id="button" type="button" value="My Products" onclick="myproduct();">
                    <input id="button" type="button" value="My Prebook" onclick="myprebook();">
                    <?php
                }
                else{
                    ?>
                    <input id="button" type="button" value="My Cart" onclick="cart()">
                    <input id="button" type="button" value="My PreBook" onclick="pre_book()">
                    <input id="button" type="button" value="My WishList" onclick="wish()">
                <?php
                }
                ?>



                <div>
                  <br>
                  <br>
                <h2> All Products </h2>

                    <table id="ptable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Available Quantity</th>
                                <th>Unit</th>
                                <th>Unit Price</th>
                                <th>Added Time</th>
                                <th>Farmer Name</th>
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
                                $mysqlquery="SELECT * FROM product";

                                $returnobj=$conn->query($mysqlquery);
                                $returntable=$returnobj->fetchAll();




                                if($returnobj->rowCount()==0){
                                    ?>
                                        <tr>
                                            <td colspan="8">No Products Available</td>
                                        <tr>
                                    <?php
                                }


                                else{
                                    foreach($returntable as $row){
                                        ?>

                                        <tr>
                                            <td><?php echo $row['p_id'] ?></td>
                                            <td><?php echo $row['productName'] ?></td>
                                            <td>
                                                <img src="<?php echo $row['productImage'] ?>" width="300" height="200">
                                            </td>
                                            <td><?php echo $row['AvailableQuantity'] ?></td>
                                            <td><?php echo $row['Unit'] ?></td>
                                            <td><?php echo $row['Price_perUnit']." BDT" ?></td>
                                            <td><?php echo $row['Added_date'] ?></td>
                                            <td><?php echo $row['f_username'] ?></td>

                                            <td>

                                                <?php if($role != 'farmer'){
                                                    if($row['AvailableQuantity'] == 0){
                                                    ?>
                                                    <input id="button2" type="button" value="Pre Book" onclick="gotoprebook(<?php echo $row['p_id']?>);">
                                                    <?php
                                                    }
                                                    else{
                                                        ?>
                                                    <input id="button" type="button" value="Add to Cart" onclick="gotocart(<?php echo $row['p_id']?>, <?php echo $row['AvailableQuantity']?>);"><br>
                                                         <?php
                                                    }
                                                    ?>
                                                    <input id="button" type="button" value="SEE ALL reviews" onclick="gotocart2(<?php echo $row['p_id']?>);"><br>
                                                    <input id="button" type="button" value="Add to WishList" onclick="gotocart3(<?php echo $row['p_id']?>, <?php echo $row['AvailableQuantity']?>);">
                                                    <?php
                                                }
                                                else if($row['f_username'] == $username){
                                                    ?>
                                                    <br>
                                                    <input type="button" id="button" value="UPDATE" onclick="update_data(<?php echo $row['p_id'] ?>);">
                                                    <br><br>
                                                    <input type="button" id="button" value="DELETE" onclick="delete_data(<?php echo $row['p_id'] ?>);">
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <?php
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
                </div>


                <script>
                    function home(){
                        location.assign('home.php');   ///default GET method
                    }
                    function logout(){
                        location.assign('logout.php');   ///default GET method
                    }

                    function profile(){
                        location.assign('profile.php');   ///default GET method
                    }

                    function uploadfn(){
                        location.assign('upload.php');
                    }

                    function cart(){
                        location.assign('cart.php');
                    }

                    function wish(){
                        location.assign('wishlist.php');
                    }

                    function pre_book(){
                        location.assign('pre_book.php');
                    }

                    function deletefn(pid){

                        location.assign('delete.php?prodid='+pid);
                    }

                    function gotocart(pid, high){
                        var amount = prompt("Enter the amount: ");
                        if (amount != "" && amount <= high){
                            location.assign('gotoCart.php?prodid='+pid+'&amount='+amount+'&high='+high);
                        }
                        else{
                            alert("Please enter a value less than "+high);
                        }
                    }

                    function gotocart2(pid){
                        
                        location.assign('watch.php?prodid='+pid);
                    
                
                }
                function gotocart3(pid, high){
                    var amount = prompt("Enter the amount: ");
                    if (amount != "" && amount <= high){
                        location.assign('addwish.php?prodid='+pid+'&amount='+amount+'&high='+high);
                    }
                    else{
                        alert("Please enter a value less than "+high);
                    }
                }

                    function gotoprebook(pid,high){
                        var amount = prompt("Enter the amount: ");
                        location.assign('gotoPrebook.php?prodid='+pid+'&amount='+amount+'&high='+high);
 
                    }

                    function notification(){
                        location.assign('notification.php');
                    }

                    function pre_book(){
                        location.assign('pre_book.php');
                    }

                    function orderhistory(){
                        location.assign('orderhistory.php');
                    }

                    function myproduct()
                    {
                        location.assign('myproduct.php');
                    }

                    function myprebook()
                    {
                        location.assign('myprebook.php');
                    }

                    function product_entry(){
                        location.assign('product_entry.php');
                    }

              function allBid(){
                location.assign('b_bidRoom_All.php');
              }

              function update_data(p_id){
                location.assign('product_update.php?p_id='+p_id);
              }

              function delete_data(p_id){
                location.assign('product_delete.php?p_id='+p_id);
              }


                </script>

<script>(function(w, d) { w.CollectId = "61ea845cbe19f1762af029be"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
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
