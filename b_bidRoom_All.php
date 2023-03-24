<?php
    session_start();
    if(isset($_SESSION['username'])
    && isset($_SESSION['role'])
    && !empty($_SESSION['username'])
    && !empty($_SESSION['role'])){

        $username = $_SESSION['username'];
        $role = $_SESSION['role'];

      ?>
      <!DOCTYPE html>
      <html>
          <head>
            <title>Bid Room</title>
            <style>

                body {
                    background-color: lightblue;
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
                    width: 400px;
                    padding: 20px;
                }

                #p_table{
                    width: 100%;
                    border: 1px solid blue;
                    border-collapse: collapse;
                }

                #p_table th, #p_table td{
                    border: 1px solid blue;
                    border-collapse: collapse;
                    text-align: center;
                }

                #p_table tr:hover{
                  background-color: cyan;
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
              <left class="active">AgroTech eMarket</left>
              <right>
                <input id="button" type="button" value="Home Page" onclick="home()">
                <input type="button" id="button" value="My Bids" onclick="bidRoom_My();">
                <input id="button" type="button" value="My Notifications" onclick="notification()">
                <input type="button" id="button" value="Logout" onclick="logout();">
              </right>
            </h1>

            <input type="button" id="button" value="Check Bid Status" onclick="bid_stat();">

            Current DateTime :
            <?php
            date_default_timezone_set( 'Asia/Dhaka' );
            echo date('Y-m-d H:i:s')
            ?>

            <div>
              <h2>Products on Auction:</h2>
              <table id="p_table">
                <thead>
                  <tr>
                    <th>Auction ID</th>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Available Quantity</th>
                    <th>Minimum Quantity</th>
                    <th>Unit</th>
                    <th>Price/Unit</th>
                    <th>Bid Start At</th>
                    <th>Bid End At</th>
                    <th>Seller</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>

                  <?php
                  try{

                    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sqlquary="SELECT* FROM product AS pro JOIN bid_room AS bid ON pro.p_id = bid.p_id";
                    $pdo_obj=$conn->query($sqlquary);
                    $table_data=$pdo_obj->fetchAll();

                    if($pdo_obj->rowCount() == 0){
                      ?>
                      <tr>
                        <td colspan="11">No Data</td>
                      </tr>
                      <?php
                    }
                    else{
                      foreach ($table_data as $row) {

                        ?>

                        <tr>
                          <td><?php echo $row['auction_id'] ?></td>
                          <td><?php echo $row['p_id'] ?></td>
                          <td><?php echo $row['productName'] ?></td>
                          <td><img src="<?php echo $row['productImage'] ?>" width="300" height="200" ?> </td>
                          <td><?php echo $row['totalQuantity'] ?></td>
                          <td><?php echo $row['lowest_bidQuantity'] ?></td>
                          <td><?php echo $row['Unit'] ?></td>
                          <td><?php echo $row['lowestPrice_perUnit'] ?></td>
                          <td><?php echo $row['bid_start'] ?></td>
                          <td><?php echo $row['bid_end'] ?></td>
                          <td><?php echo $row['f_username'] ?></td>
                          <td>
                          <?php
                            $id=$row['auction_id'];
                            $sqlquary="SELECT bid_id, auction_id, b_username, b_bidQuantity, b_bidPrice_perUnit
                                      FROM all_bid
                                      WHERE farmer_profit = ALL(SELECT MAX(farmer_profit) FROM all_bid GROUP BY auction_id HAVING auction_id = $id)";
                            $pdo_obj=$conn->query($sqlquary);
                            $table_data=$pdo_obj->fetchAll();
                              foreach ($table_data as $row1) {
                                if($row1['auction_id'] == $id){
                                ?>
                                  Quantity :
                                  <?php echo $row1['b_bidQuantity'];?>
                                  <br><br>
                                  Unit Price :
                                  <?php echo $row1['b_bidPrice_perUnit'];
                                }
                                else{
                                  ?>
                                  NO BIDS
                                  <?php
                                }
                            }

                            ?>


                          </td>
                          <td>
                              <?php
                              if(date('Y-m-d H:i:s') > $row['bid_start'] && date('Y-m-d H:i:s') < $row['bid_end']){
                                  $auction_id=$row['auction_id'];
                                  $sqlquary1="SELECT* FROM all_bid WHERE auction_id = $auction_id AND b_username = '$username'";
                                  $pdo_obj1=$conn->query($sqlquary1);
                                  $table_data1=$pdo_obj1->fetchAll();

                                  if($pdo_obj1->rowCount() == 0){
                                      ?>
                                      <input type="button" id="button" value="Place Bid" onclick="place_bid(<?php echo $row['auction_id'] ?>);">

                                      <?php
                                    }
                                  else{
                                    ?>
                                    Bid Placed
                                    <?php
                                  }
                                    ?>

                              <?php
                              }
                              ?>
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
                                        <td colspan="11">No values found</td>
                                    <tr>
                                <?php
                            }
                   ?>
                </thead>
              </table>
            </div>

            <script>
              function home(){
                location.assign('home.php');
              }

              function logout(){
                location.assign('logout.php');
              }

              function bidRoom_My(){
                location.assign('my_bid.php');
              }

              function place_bid(auction_id){
                location.assign('bid_entry.php?auction_id='+auction_id);
              }

              function bid_stat(){
                location.assign("bid_cart_entry.php");
              }

              function notification(){
                  location.assign('notification.php');
              }

              function orderhistory(){
                  location.assign('orderhistory.php');
              }

            </script>

          </body>
      </html>

      <?php
    }
    else{
        ?>
        <script>location.assign("login.php");</script>
        <?php
    }
?>
