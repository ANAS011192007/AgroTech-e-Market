<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

      if(isset($_GET['auction_id']) && !empty($_GET['auction_id'])){
            $auction_id=$_GET['auction_id'];
            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sqlquary="SELECT* FROM bid_room AS bid JOIN product AS pro ON bid.p_id = pro.p_id WHERE auction_id = $auction_id";
              $pdo_obj=$conn->query($sqlquary);
              $table_data=$pdo_obj->fetchAll();

                foreach ($table_data as $row) {
                  $availablequantity = $row['AvailableQuantity'] + $row['totalQuantity'];
                  $p_id = $row['p_id'];
                }

              $sqlquary="DELETE FROM bid_room WHERE auction_id = $auction_id";
              $conn->exec($sqlquary);

              $sqlquary="UPDATE product SET AvailableQuantity = $availablequantity WHERE p_id = $p_id";
              $conn->exec($sqlquary);



              ?>
              <script>location.assign("bid_room.php");</script>
              <?php
            }
            catch(PDOException $ex){
                ?>
                    <script>location.assign("bid_room.php");</script>
                <?php
            }
        }
        else{
          ?>
          <script>location.assign("bid_room.php");</script>
          <?php
        }
    }
    else{
      ?>
      <script>location.assign("login.php");</script>
      <?php
    }
?>
