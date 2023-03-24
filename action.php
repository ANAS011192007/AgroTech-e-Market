<html>
   <head>
     <title>REVIEWS</title>  
   </head>    
    <body> 
        <center>   
     <?php
     session_start();
     $username = $_SESSION['username'];
     $product_id=$_GET['prodid'];
     $conn= mysqli_connect("localhost","root",""); 
     $database= mysqli_select_db($conn,'emarket');


 ?> 

     <form action = "" method = "post">
        <h1>Write a review on this product.......</h1>
         <textarea rows = "20" cols = "100" name = "description">
        
         </textarea><br><br><br>
         <input type = "submit" name="a" value = "submit" />
         
      </form> 
      <form action="home.php">
      <input type = "submit" name="b" value = "back to home page" />
      </form>
      <?php
      if(isset($_POST['a'])) {
         $comment= $_POST['description']; 
         $sql = "INSERT INTO `review`(`comments`, `productID`, `u_name`) VALUES ('$comment','$product_id','$username')";
         if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
      } else {
            echo "Error: " . $sql . mysqli_error($conn);
      }
      }
        

      ?>

      </center> 
    </body>    
</html>