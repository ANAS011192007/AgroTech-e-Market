<?php
date_default_timezone_set( 'Asia/Dhaka' );
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
  try{


    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlquary="SELECT all_bid.bid_id AS 'bid_id', all_bid.auction_id AS 'auction_id', all_bid.b_username AS 'b_username',
                all_bid.b_bidQuantity AS 'quantity', all_bid.b_bidPrice_perUnit, all_bid.farmer_profit AS 'price', all_bid.lastcheck AS 'lastcheck',
                bid.bid_start AS 'bidstart', bid.bid_end AS 'bidend', bid.totalQuantity AS 'bidQuantity', bid.lowest_bidQuantity AS 'lowestbidQuantity', pro.p_id AS 'p_id', pro.productName AS 'p_name',
                pro.quantity AS 'totalquantity', pro.f_username AS 'f_username'
                FROM all_bid AS all_bid JOIN bid_room AS bid ON all_bid.auction_id = bid.auction_id
                JOIN product AS pro ON bid.p_id = pro.p_id
                WHERE farmer_profit = ANY(SELECT MAX(all_bid.farmer_profit) FROM all_bid GROUP BY all_bid.auction_id)";
    $pdo_obj=$conn->query($sqlquary);
    $table_data=$pdo_obj->fetchAll();

    if($pdo_obj->rowCount() == 0){
      ?>
      <script>location.assign("b_bidRoom_All.php");</script>
      <?php
    }
    else{
      foreach ($table_data as $row) {


        if(date('Y-m-d H:i:s') > $row['bidend'] && $row['lastcheck'] < $row['bidend']){
          $user=$row['b_username'];
          $pid=$row['p_id'];
          $auction_id=$row['auction_id'];
          $pname=$row['p_name'];
          $quantity=$row['quantity'];
          $price=$row['price'];
          $sqlquary1="INSERT INTO cart VALUES('$user', $pid, '$pname', $quantity, $price, 1)";
          $conn->exec($sqlquary1);

          if($row['totalquantity']>0){
            $new_quantity=$row['totalquantity'] - $row['quantity'];
            $sqlquary2="UPDATE product SET Quantity = $new_quantity WHERE p_id = $pid";
            $conn->exec($sqlquary2);
          }
          else{
            $new_quantity=0;
            $sqlquary2="UPDATE product SET Quantity = $new_quantity WHERE p_id = $pid";
            $conn->exec($sqlquary2);
          }

          $aid=$row['auction_id'];
          if($row['bidQuantity']>0){
            $new_bidquantity=$row['bidQuantity'] - $row['quantity'];
            $sqlquary3="UPDATE bid_room SET totalQuantity = $new_bidquantity WHERE auction_id = $aid";
            $conn->exec($sqlquary3);

          }
          else{
            $new_bidquantity=0;
            $sqlquary3="UPDATE bid_room SET totalQuantity = $new_bidquantity WHERE auction_id = $aid";
            $conn->exec($sqlquary3);
          }


          if ($new_bidquantity<$row['lowestbidQuantity']){
            $sqlquary4="UPDATE bid_room SET lowest_bidQuantity = $new_bidquantity WHERE auction_id = $aid";
            $conn->exec($sqlquary4);
          }

          $date = date('Y-m-d H:i:s');
          $user=$row['b_username'];
          $a_id=$row['auction_id'];
          $message= "You won Auction $a_id check cart";
          $sqlquary5="INSERT INTO notification VALUES(NULL, '$message', '$date', '$row[f_username]', '$user', null)";
          $conn->exec($sqlquary5);

          $bid_id=$row['bid_id'];
          $sqlquary="DELETE FROM all_bid WHERE bid_id = $bid_id";
          $conn->exec($sqlquary);

          if($row['bidQuantity']>0){
            $date = date('Y-m-d H:i:s');
            $user=$row['b_username'];
            $a_id=$row['auction_id'];
            $message= "Please check Auction $a_id";
            $sqlquary5="INSERT INTO notification VALUES(NULL, '$message', '$date', '$row[f_username]', '$user', null)";
            $conn->exec($sqlquary5);

          }

        }

        // else if((date('Y-m-d H:i:s') - $row['lastcheck'])>60){
        //   $bid_id=$row['bid_id'];
        //   $sqlquary="DELETE FROM all_bid WHERE bid_id = $bid_id";
        //   $conn->exec($sqlquary);
        //
        //   if($row['bidQuantity']>0){
        //     $date = date('Y-m-d H:i:s');
        //     $user=$row['b_username'];
        //     $a_id=$row['auction_id'];
        //     $message= "Please check Auction $a_id";
        //     $sqlquary5="INSERT INTO notification VALUES(NULL, '$message', '$date', '$row[f_username]', '$user')";
        //     $conn->exec($sqlquary5);
        //
        //   }
        // }

        $date = date('Y-m-d H:i:s');
        $sqlquary6="UPDATE all_bid SET lastcheck = '$date'";
        $conn->exec($sqlquary6);
      }
      ?>
      <script>location.assign("b_bidRoom_All.php");</script>
      <?php
    }
  }
  catch(PDOExeption $e){
    ?>
    <script>location.assign("error.php");</script>
    <?php
  }
}
else{
?>
<script>location.assign("login.php");</script>
<?php
}
?>
