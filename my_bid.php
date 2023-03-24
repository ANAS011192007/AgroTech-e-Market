<?php
    date_default_timezone_set( 'Asia/Dhaka' );
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
      ?>
      <!DOCTYPE html>
      <html>
          <head>
            <title>My Bids</title>
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
              <left class="active">My Bids</left>
              <right><input type="button" id="button" value="Logout" onclick="logout();"></right>
              <right>Current User: <?php echo $_SESSION['username'];?></right>
            </h1>
            <input type="button" id="button" value="Back" onclick="back();">
            <div>
              <h2>My Products</h2>
              <table id="p_table">
                <thead>
                  <tr>
                    <th>Bid ID</th>
                    <th>Auction ID</th>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Bid Quantity</th>
                    <th>Unit</th>
                    <th>Price/Unit</th>
                    <th>Bid Start At</th>
                    <th>Bid End At</th>
                    <th>Actions</th>
                  </tr>

                  <?php
                  try{

                    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sqlquary="SELECT* FROM all_bid AS abid JOIN bid_room AS bid ON abid.auction_id = bid.auction_id JOIN product AS pro ON pro.p_id = bid.p_id WHERE abid.b_username = '$_SESSION[username]'";
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
                          <td><?php echo $row['bid_id'] ?></td>
                          <td><?php echo $row['auction_id'] ?></td>
                          <td><?php echo $row['p_id'] ?></td>
                          <td><?php echo $row['productName'] ?></td>
                          <td><img src="<?php echo $row['productImage'] ?>" width="300" height="200"?> </td>
                          <td><?php echo $row['b_bidQuantity'] ?></td>
                          <td><?php echo $row['Unit'] ?></td>
                          <td><?php echo $row['b_bidPrice_perUnit'] ?></td>
                          <td><?php echo $row['bid_start'] ?></td>
                          <td><?php echo $row['bid_end'] ?></td>
                          <td>
                            <?php
                            if(date('Y-m-d H:i:s') > $row['bid_start'] && date('Y-m-d H:i:s') < $row['bid_end']){
                            ?>
                            <input type="button" id="button" value="UPDATE" onclick="update_Bdata(<?php echo $row['bid_id'] ?>);">
                            <br><br>
                            <?php
                            }
                            $user = strtolower($_SESSION['username']);
                            $id=$row['auction_id'];
                            $sqlquary="SELECT bid_id, auction_id, b_username, lastcheck
                                        FROM all_bid
                                        WHERE farmer_profit = ALL(SELECT MAX(farmer_profit) FROM all_bid GROUP BY auction_id HAVING auction_id = $id)";
                            $pdo_obj=$conn->query($sqlquary);
                            $table_data=$pdo_obj->fetchAll();
                            foreach ($table_data as $row1) {

                              if($row['lastcheck'] > $row['bid_end'] && strtolower($row1['b_username']) == $user && $row['totalQuantity'] > 0){
                                ?>
                                <input type="button" id="button" value="ADD TO CART" onclick="add_to_cart(<?php echo $row['bid_id'] ?>);">
                                <br><br>
                                <?php
                                }
                              }
                              ?>
                            <input type="button" id="button" value="DELETE" onclick="delete_data(<?php echo $row['bid_id'] ?>);">
                          </td>
                        </tr>

                        <?php
                      }
                    }
                  }
                  catch(PDOExeption $e){
                    ?>
                    <tr>
                      <td colspan="11">No Data</td>
                    </tr>
                    <?php
                  }
                   ?>
                </thead>
              </table>
            </div>

            <script>
              function back(){
                location.assign('b_bidRoom_All.php');
              }

              function logout(){
                location.assign('logout.php');
              }

              function update_Bdata(bid_id){
                location.assign('bid_update_entry.php?bid_id='+bid_id);
              }

              function delete_data(bid_id){
                location.assign('bid_delete.php?bid_id='+bid_id);
              }
              function add_to_cart(bid_id){
                location.assign('next_bid_cart_entry.php?bid_id='+bid_id);
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
