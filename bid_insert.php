<?php
    date_default_timezone_set( 'Asia/Dhaka' );
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
      if( isset($_POST['auction_id']) &&
          isset($_POST['bid_quantity']) &&
          isset($_POST['p_price']) &&
          !empty($_POST['auction_id']) &&
          !empty($_POST['bid_quantity']) &&
          !empty($_POST['p_price'])
        ){
          $auction_id=$_POST['auction_id'];
          $bid_quantity=$_POST['bid_quantity'];
          $p_price=$_POST['p_price'];
          $farmer_profit = $bid_quantity * $p_price;


            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $date = date('Y-m-d H:i:s');
              $sqlquary="INSERT INTO all_bid VALUES(NULL, $auction_id, '$_SESSION[username]', $bid_quantity, $p_price, $farmer_profit, '$date')";
              $conn->exec($sqlquary);

              $sqlquary="SELECT f_username FROM product AS pro JOIN bid_room AS bid_room ON pro.p_id = bid_room.p_id WHERE bid_room.auction_id = $auction_id";
              $pdo_obj=$conn->query($sqlquary);
              $table_data=$pdo_obj->fetchAll();
              if($pdo_obj->rowCount() == 0){
                ?>
                <script>location.assign("error.php");</script>
                <?php
              }
              else{
                foreach ($table_data as $row) {
                  $date = date('Y-m-d H:i:s');
                  $user=$_SESSION['username'];
                  $message= "A bid is placed for Auction $auction_id by $user";
                  $sqlquary="INSERT INTO notification VALUES(NULL, '$message', '$date', '$row[f_username]', '$user', null)";
                  $conn->exec($sqlquary);
                }
              }

              ?>
              <script>location.assign('my_bid.php');</script>
              <?php
            }
            catch(PDOExeption $e){
              ?>
              <script>location.assign('b_bidRoom_All.php');</script>
              <?php
            }
        }
        else{
          ?>
          <script>location.assign('b_bidRoom_All.php');</script>
          <?php
        }
    }
    else{
      ?>
      <script>location.assign('login.php');</script>
      <?php
    }
?>
