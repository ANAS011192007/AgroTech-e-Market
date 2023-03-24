<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

      if(isset($_GET['p_id']) && !empty($_GET['p_id'])){
            $p_id=$_GET['p_id'];
            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sqlquary="DELETE FROM Product WHERE p_id = $p_id";
              $conn->exec($sqlquary);

              ?>
              <script>location.assign("myproduct.php");</script>
              <?php
            }
            catch(PDOException $ex){
                ?>
                    <script>location.assign("myproduct.php");</script>
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
