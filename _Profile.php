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
        <title>Profile</title>

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
              <input id="button" type="button" value="My Notifications" onclick="notification()">
              <input id="button" type="button" value="My Order History" onclick="orderhistory()">
              <input type="button" id="button" value="Logout" onclick="logoutfn();">
            </right>

          </h1>

         <?php 
          $pid = $_GET['pid'];
          ?>

        <br><br>
        <div id="box" style="font-size: 22px;margin: 10px;">Welcome To The Farmer's Profile
       
        
        <?php
        

        try{
            // PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            ///executing mysql query
            $signupquery1="SELECT * FROM product WHERE p_id = $pid";
        
            $returnobj1 = $conn->query($signupquery1);
            $returntable1 = $returnobj1->fetchAll();

            
            if($returnobj1->rowCount() == 1){
                foreach($returntable1 as $row1){
                    $f_user = $row1['f_username'];
                }
            }

            $signupquery="SELECT * FROM farmer WHERE f_username = '$f_user'";
        
            $returnobj = $conn->query($signupquery);
            $returntable = $returnobj->fetchAll();

            if($returnobj->rowCount() == 1)
            {

                foreach($returntable as $row){
                ?><br>
                
                <form action="_Profileprocess.php" method="POST">
                <br>
               
             
                <label for="myname">Username</label>:
                <input class="text" type="text" id="f_username" name="f_username" value="<?php echo $row['f_username'];?>"readonly>
                
                <label for="myname">Full name</label>:
                <input class="text" type="text" id="myname" name="myname" value="<?php echo $row['Name'];?>"readonly>

                <br>

                <label for="address">Address</label>:
                <input class="text" type="text" id="address" name="address" value="<?php echo $row['Address'];?>"readonly>


                <br>

              
                <label for="district">District</label>:
                    <input class="text" type="text" id="district" name="district" value="<?php echo $row['District'];?>"readonly>
                <br>

                <label for="city">City</label>:
                <input class="text" type="text" id="city" name="city" value="<?php echo $row['City'];?>"readonly>

                <br>

                <label for="contact">Contact No</label>:
                <input class="text" type="number" id="contact" name="contact" value="<?php echo "0".$row['Contact_no'];?>"readonly>

                <br>

                <?php
                if($role == 'farmer'){
                  ?>
                  <label for="bKash">bKash No</label>:
                  <input class="text" type="number" id="bKash" name="bKash" value="<?php echo "0".$row['bKash_no'];?>"readonly>
                  <?php
                }
                ?>

                <br>

                <label for="rating">Total Rating</label>:
                <input class="text" type="number" id="rating" name="rating" value="<?php echo $row['rating'];?>"readonly>

                <br>
                       
<div style="font-size: 30px;margin: 10px;">Rate The Farmer
<?php

?></div>

  
    <select class="number" id="choose" name="choose">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
    <br><br>
  
    <input id="button" type="submit" value="Submit">


        

        </div>


                <br>
               


                </form>


                <?php
              

            }
            }
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign("login.php");</script>
            <?php
        }

        ?>

       


        <br>

        <script>
                    function home(){
                        location.assign('home.php');   ///default GET method
                    }

                    function submit(pid){
                        
                        location.assign('_Profile.php?pid='+pid);   ///default GET method
                    }


                    function profile(){
                        location.assign('profile.php');   ///default GET method
                    }
                    function logoutfn(){
                        location.assign('logout.php');   ///default GET method
                    }

                    function rating(){
                        location.assign('rating.php');   ///default GET method
                    }

                    function notification(){
                        location.assign('notification.php');
                    }

                    function payhistory(){
                        location.assign('payhistory.php');
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
