<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    //    echo  $_POST['f_username'];
    //    echo  $_POST['choose'];
    //    echo  $_POST['rating'];

      if( 
        
            isset($_POST['f_username']) &&
            isset($_POST['rating'])&&
            isset($_POST['choose'])&&  
            !empty($_POST['f_username']) &&
            !empty($_POST['choose']) &&
            !empty($_POST['rating']) 
          ){ 
            
              $f_username=$_POST['f_username'];
              $rating=$_POST['rating'];
              $choose=$_POST['choose'];

              $avg = ($rating + $choose)/2;
            try{

              $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;", "root", "");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sqlquary="UPDATE farmer SET rating = $avg WHERE f_username = '$f_username'";
              $conn->exec($sqlquary);

             

              ?>
              <script>location.assign("home.php");</script>
              <?php
            }
            catch(PDOException $ex){
                ?>
                    <script>location.assign("home.php");</script>
                <?php
            }
        }

        else{
            ?>
            <!-- <script>location.assign("login.php");</script> -->
            <?php
        }
    }
    
    else{
      ?>
      <script>location.assign("login.php");</script>
      <?php
    }

?>
