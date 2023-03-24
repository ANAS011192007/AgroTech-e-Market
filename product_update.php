<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
      if( isset($_GET['p_id']) && !empty($_GET['p_id'])){
            $p_id=$_GET['p_id'];

            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sqlquary="SELECT* FROM bid_room AS bid JOIN product AS pro ON bid.p_id = pro.p_id WHERE pro.p_id = $p_id";
              $pdo_obj=$conn->query($sqlquary);
              $table_data=$pdo_obj->fetchAll();

              if($pdo_obj->rowCount() == 0){
                $minQuantity = 0;
              }

              else{
                foreach ($table_data as $row) {
                  $minQuantity = $row['totalQuantity'];
                }
              }


              $sqlquary1="SELECT* FROM product WHERE p_id = $p_id";
              $pdo_obj1=$conn->query($sqlquary1);
              $table_data1=$pdo_obj1->fetchAll();

              if($pdo_obj1->rowCount() == 0){
                ?>
                <script>location.assign("myproduct.php");</script>
                <?php
              }
              else{
                foreach ($table_data1 as $row) {
                  ?>

                  <!DOCTYPE html>
                  <html>
                    <head>
                      <title>Poduct Update</title>
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
                        <left>Product Update</left>
                        <right><input type="button" id="button" value="Logout" onclick="logout();"></right>
                        <right>Current User: <?php echo $_SESSION['username'];?></right>
                      </h1>

                      <form action="product_update_insert.php" method="post" enctype="multipart/form-data" id="box">
                        <label for="p_id">Product ID</label>:
                        <input type="text" id="p_id" name="p_id" value="<?php echo $row['p_id'] ?>" readonly>
                        <br><br>
                        <label for="p_name">Product Name</label>:
                        <br>
                        <input type="text" id="p_name" name="p_name" value="<?php echo $row['productName'] ?>">
                        <br><br>
                        <label for="p_quantity">Product Quantity</label>:
                        <br>
                        <input type="number" id="p_quantity" name="p_quantity" value="<?php echo $row['Quantity'] ?>" min= "<?php echo $minQuantity ?>">
                        <select id="unit" name="unit" value="<?php echo $row['Unit'] ?>">
                          <option value="Kg">Kg</option>
                          <option value="g">g</option>
                          <option value="Piece">Piece</option>
                        </select>
                        <br><br>
                        <label for="p_price">Unit Price</label>:
                        <br>
                        <input type="number" id="p_price" name="p_price" value="<?php echo $row['Price_perUnit'] ?>" min="0">
                        <br><br>
                        <input type="submit" id="button" value="UPDATE">
                        <input type="button" id="button" value="Back" onclick="back();">
                      </form>
                      <script>
                        function back(){
                          location.assign('myproduct.php');
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
                    <tr>
                        <td colspan="6">No values found</td>
                    <tr>
                <?php
            }
          }
          else{
            ?>
            <script>location.assign("myproduct.php");</script>
            <?php
          }
    }
    else{
      ?>
      <script>location.assign("login.php");</script>
      <?php
    }
?>
