<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

      if( isset($_POST['p_id']) &&
          isset($_POST['p_name']) &&
          isset($_POST['p_quantity']) &&
          isset($_POST['p_price']) &&
          isset($_POST['unit']) &&
          !empty($_POST['p_id']) &&
          !empty($_POST['p_name']) &&
          !empty($_POST['p_quantity']) &&
          !empty($_POST['p_price']) &&
          !empty($_POST['unit'])
        ){
            $p_id=$_POST['p_id'];
            $p_name=$_POST['p_name'];
            $p_quantity=$_POST['p_quantity'];
            $p_price=$_POST['p_price'];
            $unit=$_POST['unit'];

            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sqlquary="SELECT* FROM bid_room WHERE p_id = $p_id";
              $pdo_obj=$conn->query($sqlquary);
              $table_data=$pdo_obj->fetchAll();

              if($pdo_obj->rowCount() == 0){
                $availablequantity = $p_quantity;
              }
              else{
                foreach ($table_data as $row) {
                  $availablequantity = $p_quantity - $row['totalQuantity'];
                }
              }

              $sqlquary="UPDATE product SET productName = '$p_name', Quantity = $p_quantity, AvailableQuantity = $availablequantity, Unit = '$unit', Price_perUnit = $p_price WHERE p_id = $p_id";
              $conn->exec($sqlquary);

              ?>
              <script>location.assign("myproduct.php");</script>
              <?php
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
          <script>location.assign("product_update.php");</script>
          <?php
        }
    }
    else{
      ?>
      <script>location.assign("login.php");</script>
      <?php
    }
?>
