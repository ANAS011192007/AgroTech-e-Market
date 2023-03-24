<?php

session_start();

if(
    isset($_SESSION['username'])
    && isset($_SESSION['role'])
    && isset($_GET['search'])
    && !empty($_SESSION['username'])
    && !empty($_SESSION['role'])
    && !empty($_GET['search'])
){
    ///already logged in user
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    $search = $_GET['search'];
    $choose = $_GET['choose'];

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
                </style>

            </head>

            <body>

                <input id="button" type="button" value="Home Page" onclick="home()">
                <input id="button" type="button" value="My Profile" onclick="profile()">


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
                if($choose == 'farmer')
                {?>

                <div>
                <div style="font-size: 20px;margin: 10px;">All Farmers List</div>

                    <table id="ptable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Address</th>
                                <th>District</th>
                                <th>City</th>
                                <th>Phone Number</th>
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
                                $mysqlquery="SELECT * FROM farmer WHERE name LIKE '%".$search."%'";


                                $returnobj=$conn->query($mysqlquery);
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
                                            <td><?php echo $row['f_username'] ?></td>
                                            <td><?php echo $row['Name'] ?></td>
                                            <td><?php echo $row['Address'] ?></td>
                                            <td><?php echo $row['District'] ?></td>
                                            <td><?php echo $row['City'] ?></td>
                                            <td><?php echo "+880".$row['Contact_no'] ?></td>
                                        </tr>

                                        <?php
                                    }
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="5">No values found</td>
                                    <tr>
                                <?php
                            }


                            ?>

                        </tbody>
                    </table>
                </div>

                <?php
                }
                else
                {
                ?>

                <div>
                <div style="font-size: 20px;margin: 10px;">All Product List</div>

                    <table id="ptable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Available Quantity</th>
                                <th>Price per Unit</th>
                                <th>Unit</th>
                                <th>Added Time</th>
                                <th>Farmer Name</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            try{
                                ///PDO = PHP Data Object
                                $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket2;","root","");
                                ///setting 1 environment variable
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                ///mysql query string
                                $mysqlquery="SELECT * FROM product WHERE productName LIKE '%".$search."%'";

                                $returnobj=$conn->query($mysqlquery);
                                $returntable=$returnobj->fetchAll();




                                if($returnobj->rowCount()==0){
                                    ?>
                                        <tr>
                                            <td colspan="8">No values found</td>
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
                                                <img src="<?php echo $row['productImage'] ?>" width="150" height="150">
                                            </td>
                                            <td><?php echo $row['AvailableQuantity'] ?></td>
                                            <td><?php echo $row['Price_perUnit']." taka" ?></td>
                                            <td><?php echo $row['Unit'] ?></td>
                                            <td><?php echo $row['Added_date'] ?></td>
                                            <td><?php echo $row['f_username'] ?></td>

                                            <td>

                                                <?php if($role != 'farmer'){
                                                    ?>
                                                    <input id="button" type="button" value="Add to Cart" onclick="gotocart(<?php echo $row['p_id']?>, <?php echo $row['AvailableQuantity']?>);">
                                                    <?php
                                                }
                                                else if($row['f_username'] == $username){
                                                    ?>
                                                    <input id="button" type="button" value="My Products" onclick="myproduct();">
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

                <?php
                }
                ?>

                <br>
                <input id="button" type="button" value="Click to Logout" onclick="logoutfn();">




                <script>
                    function home(){
                        location.assign('home.php');   ///default GET method
                    }
                    function logoutfn(){
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

                    function notification(){
                        location.assign('notification.php');
                    }

                    function payhistory(){
                        location.assign('payhistory.php');
                    }

                    function myproduct()
                    {
                        location.assign('myproduct.php');
                    }

                    function product_entry(){
                location.assign('product_entry.php');
              }

              function allBid(){
                location.assign('b_bidRoom_All.php');
              }
                </script>


            </body>
        </html>

    <?php
}
else{
     ?>
        <script>alert("Search box is empty!");</script>
        <script>location.assign("home.php");</script>
    <?php
}


?>
