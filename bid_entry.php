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

              if($pdo_obj->rowCount() == 0){
                ?>
                <script>location.assign("b_bidRoom_All.php");</script>
                <?php
              }
              else{
                foreach ($table_data as $row) {
                  ?>

                  <!DOCTYPE html>
                  <html>
                    <head>
                      <title>Place Bid</title>
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
                        <left>Place Bid</left>
                        <right><input type="button" id="button" value="Logout" onclick="logout();"></right>
                        <right>Current User: <?php echo $_SESSION['username'];?></right>
                      </h1>

                      <form action="bid_insert.php" method="POST" enctype="multipart/form-data" id="box">
                        <label for="auction_id">Auction ID</label>
                        <input type="text" id="auction_id" name="auction_id" value="<?php echo $row['auction_id'] ?>" readonly>
                        <br><br>
                        <label for="p_id">Product ID</label>
                        <input type="text" id="p_id" name="p_id" value="<?php echo $row['p_id'] ?>" readonly>
                        <br><br>
                        <label for="p_name">Product Name</label>
                        <input type="text" id="p_name" name="p_name" value="<?php echo $row['productName'] ?>" readonly>
                        <br><br>
                        <label for="bid_quantity">Bid Quantity</label>
                        <input type="number" id="bid_quantity" name="bid_quantity" value="<?php echo $row['lowest_bidQuantity'] ?>" min="<?php echo $row['lowest_bidQuantity'] ?>">
                        <input id="unit" name="unit" value="<?php echo $row['Unit'] ?>" size="5" readonly>
                        <br><br>
                        <label for="p_price">Price/Unit</label>
                        <input type="number" id="p_price" name="p_price" value="<?php echo $row['lowestPrice_perUnit'] ?>" min="<?php echo $row['lowestPrice_perUnit'] ?>">
                        <br><br>
                        <input type="submit" id="button" value="Submit">
                        <input type="button" id="button" value="Back" onclick="back();">
                      </form>
                      <script>
                        function back(){
                          location.assign('b_bidRoom_All.php');
                        }
                        function logout(){
                          location.assign('logout.php');
                        }
                      </script>
                    </body>
                    </html>

                  <?php
                }
              }
            }

            catch(PDOException $ex){
                ?>
                   <script>location.assign("b_bidRoom_All.php");</script>
                <?php
            }
          }
          else{
            ?>
            <script>location.assign("b_bidRoom_All.php");</script>
            <?php
          }
    }
    else{
      ?>
      <script>location.assign("login.php");</script>
      <?php
    }
?>
