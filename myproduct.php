<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
        $username = $_SESSION['username'];
      ?>
      <!DOCTYPE html>
      <html>
          <head>
            <title>Seller Home</title>

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
              <left>AgroTech eMarket</left>
              <right>
                <input id="button" type="button" value="Home Page" onclick="home()">
                <input id="button" type="button" value="My Profile" onclick="profile()">
                <input id="button" type="button" value="My Notifications" onclick="notification()">
                <input id="button" type="button" value="Order History" onclick="orderhistory()">
                <input type="button" id="button" value="Logout" onclick="logout();">
              </right>

            </h1>


                <br><br>

            <input type="button" id="button" value="Product Entry" onclick="product_entry();">
            <input type="button" id="button" value="My Auctions" onclick="bidRoom_entry();">
            <div>
              <h2>My Products</h2>
              <table id="p_table" class=".text">
                <thead>
                  <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Available</th>
                    <th>Unit</th>
                    <th>Price/Unit</th>
                    <th>Added On</th>
                    <th>Actions</th>
                  </tr>

                  <?php
                  try{

                    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sqlquary="SELECT* FROM product WHERE f_username = '$_SESSION[username]'";
                    $pdo_obj=$conn->query($sqlquary);
                    $table_data=$pdo_obj->fetchAll();

                    if($pdo_obj->rowCount() == 0){
                      ?>
                      <tr>
                        <td colspan="8">No Data</td>
                      </tr>
                      <?php
                    }
                    else{
                      foreach ($table_data as $row) {
                        ?>

                        <tr>
                          <td><?php echo $row['p_id'] ?></td>
                          <td><?php echo $row['productName'] ?></td>
                          <td><img src="<?php echo $row['productImage'] ?>" width="300" height="200"?> </td>
                          <td><?php echo $row['Quantity'] ?></td>
                          <td><?php echo $row['AvailableQuantity'] ?></td>
                          <td><?php echo $row['Unit'] ?></td>
                          <td><?php echo $row['Price_perUnit'] ?></td>
                          <td><?php echo $row['Added_date'] ?></td>
                          <td>
                          <?php
                            $p_id=$row['p_id'];
                            $sqlquary1="SELECT* FROM bid_room WHERE p_id = $p_id";
                            $pdo_obj1=$conn->query($sqlquary1);
                            $table_data1=$pdo_obj1->fetchAll();

                            if($pdo_obj1->rowCount() == 0){
                                ?>
                                <input type="button" id="button" value="AUCTION" onclick="add_to_auction(<?php echo $row['p_id'] ?>);">

                                <?php
                              }
                              ?>
                            <br><br>
                            <input type="button" id="button" value="UPDATE" onclick="update_data(<?php echo $row['p_id'] ?>);">
                            <br><br>
                            <input type="button" id="button" value="DELETE" onclick="delete_data(<?php echo $row['p_id'] ?>);">
                          </td>
                        </tr>

                        <?php
                      }
                    }
                  }
                  catch(PDOException $ex){
                    ?>
                        <tr>
                            <td colspan="8">No Products Available</td>
                        <tr>
                    <?php
                }
                   ?>
                </thead>
              </table>
            </div>

            <script>
              function product_entry(){
                location.assign('product_entry.php');
              }

              function logout(){
                location.assign('logout.php');
              }

              function update_data(p_id){
                location.assign('product_update.php?p_id='+p_id);
              }

              function delete_data(p_id){
                location.assign('product_delete.php?p_id='+p_id);
              }

              function add_to_auction(p_id){
                location.assign('auction_entry.php?p_id='+p_id);
              }

              function bidRoom_entry(){
                location.assign('bid_room.php');
              }

              function notification(){
                        location.assign('notification.php');
                    }

                    function orderhistory(){
                        location.assign('orderhistory.php');
                    }

                    function home(){
                        location.assign('home.php');   ///default GET method
                    }


                    function profile(){
                        location.assign('profile.php');   ///default GET method
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
