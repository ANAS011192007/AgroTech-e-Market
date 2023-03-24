<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

      if(isset($_GET['bid_id']) && !empty($_GET['bid_id'])){
            $bid_id=$_GET['bid_id'];
            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sqlquary="DELETE FROM all_bid WHERE bid_id = $bid_id";
              $conn->exec($sqlquary);

              ?>
              <script>location.assign("my_bid.php");</script>
              <?php
            }

            catch(PDOException $ex){
                ?>
                    <script>location.assign("my_bid.php");</script>
                <?php
            }
        }
        else{
          ?>
          <script>location.assign("my_bid.php");</script>
          <?php
        }
    }
    else{
      ?>
      <script>location.assign("b_login.php");</script>
      <?php
    }
?>
