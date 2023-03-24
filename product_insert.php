<?php
    date_default_timezone_set( 'Asia/Dhaka' );
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

        $username=$_SESSION['username'];

      if( isset($_POST['p_name']) &&
          isset($_FILES['p_image']) &&
          isset($_POST['p_quantity']) &&
          isset($_POST['p_price']) &&
          isset($_POST['unit']) &&
          !empty($_POST['p_name']) &&
          !empty($_FILES['p_image']) &&
          !empty($_POST['p_quantity']) &&
          !empty($_POST['p_price']) &&
          !empty($_POST['unit'])
        ){
            $p_name=$_POST['p_name'];
            $p_image=$_FILES['p_image'];
            $p_quantity=$_POST['p_quantity'];
            $p_price=$_POST['p_price'];
            $unit=$_POST['unit'];
            $datetime=date('Y-m-d H:i:s');

            $img_name=$p_image['name'];

            echo $img_name;
            $img_tmp_path=$p_image['tmp_name'];
            echo $img_tmp_path;
            $img_dst_path="productimage/$img_name";
            echo $img_dst_path;

            move_uploaded_file($img_tmp_path,$img_dst_path);


            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sqlquary="INSERT INTO product VALUES(NULL, '$p_name', '$img_dst_path', $p_quantity, $p_price, '$unit', '$datetime', '$_SESSION[username]', $p_quantity)";
              $conn->exec($sqlquary);

              ?>
              <script>alert("Product Added");
              location.assign("myproduct.php");</script>
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
          <script>location.assign("product_entry.php");</script>
          <?php
        }
    }
    else{
      ?>
      <script>location.assign("login.php");</script>
      <?php
    }
?>
