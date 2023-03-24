<html>
   <head>
     <title>REVIEWS</title>
   </head>
    <body>

           <h1><center>Apply for returning/refunding product</center></h1>
     <?php
     session_start();
     $username = $_SESSION['username'];
     $conn= mysqli_connect("localhost","root","");
     $database= mysqli_select_db($conn,'emarket');

     $order_id=$_GET['orderid'];


 ?>


     <form action = "" method = "post">

     <label for="type"><b>Choose if you want refund or return:</b></label>
<select name="type" id="type">
<option value="return">replacement</option>
<option value="refund">refund</option>

</select>
<br><br>

<label for="type1"><b>Select reason behind refund or return:</b></label>
<select name="type1" id="type1">
<option value="None">None</option>
<option value="product is arriving late">product is arriving late</option>
<option value="Arrived product is defective">Arrived product is defective</option>
<option value="Product Does Not Match Description on Website or in Catalog">Product Does Not Match Description on Website or in Catalog</option>
<option value="Wrong information about product was provided in website">Wrong information about product was provided in website</option>
</select>

<br>

<p><b>Contact number:<input type="text" name="contact" placeholder=" contact-number"></b></p>

        <h4>If anything else you would like to inform</h4>

         <textarea rows = "15" cols = "70" name = "description">

         </textarea><br><br><br>

         <input type = "submit" name="a" value = "submit" />

      </form>
      <form action="orderhistory.php">

      <input type = "submit" name="b" value = "back to orderhistory" />
      </form>
      <?php
      if(isset($_POST['a'])) {
         $comment= $_POST['description'];
         $action=$_POST['type'];
         $status=$_POST['type1'];
         $contact=$_POST['contact'];
         //$pid=$_POST['pid'];


         $sql = "INSERT INTO `returnn`(`b_username`, `comment`, `contact_number`, `action`, `status`, order_id) VALUES ('$username','$comment','$contact','$action','$status', $order_id)";
         if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
      } else {
            echo "Error: " . $sql . mysqli_error($conn);
      }
      }


      ?>


    </body>
</html>