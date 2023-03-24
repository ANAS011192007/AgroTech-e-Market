<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
      if( isset($_POST['bid_id']) &&
          isset($_POST['auction_id']) &&
          isset($_POST['bid_quantity']) &&
          isset($_POST['p_price']) &&
          !empty($_POST['bid_id']) &&
          !empty($_POST['auction_id']) &&
          !empty($_POST['bid_quantity']) &&
          !empty($_POST['p_price'])
        ){

          $bid_id=$_POST['bid_id'];
          $bid_quantity=$_POST['bid_quantity'];
          $p_price=$_POST['p_price'];
          $farmer_profit = $bid_quantity * $p_price;


            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sqlquary="UPDATE all_bid SET b_bidQuantity=$bid_quantity, b_bidPrice_perUnit=$p_price, farmer_profit=$farmer_profit WHERE bid_id=$bid_id";
              $conn->exec($sqlquary);

              ?>
              <script>location.assign('my_bid.php');</script>
              <?php
            }

            catch(PDOException $ex){
                ?>
                    <script>location.assign('bid_update_entry.php');</script>
                <?php
            }
        }
        else{
          ?>
          <script>location.assign('bid_update_entry.php');</script>
          <?php
        }
    }
    else{
      ?>
      <script>location.assign('b_login.php');</script>
      <?php
    }
?>
