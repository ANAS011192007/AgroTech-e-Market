<html>
    
    <?php
session_start();
$username = $_SESSION['username'];
     $product_id=$_GET['prodid'];
     $conn= mysqli_connect("localhost","root",""); 
     $database= mysqli_select_db($conn,'emarket');
     $sql="SELECT comments, u_name FROM review where productID=$product_id";
     $query_run=(mysqli_query($conn,$sql));
     ?>
     <head><title>See all reviews for <?php echo $product_id ?></title></head>
     <body>
         <h1> reviews for product # <?php echo $product_id ?></h1>
     <?php
     if($query_run->num_rows >0){
        while($result=mysqli_fetch_array($query_run)){
            ?>
            <form action="" method="post">
            <input type="text" name="search" placeholder="user" value="<?php echo $result['u_name'].":"?>"size=15>
            <?php echo $result['comments']?>
            
            
           
        </form>

            <?php
            
        }
        
    }
    else
    echo "NO REVIEWS YET"

?>
</body>
</html>