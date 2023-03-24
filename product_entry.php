<?php
    session_start();
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
        $username=$_SESSION['username'];
      ?>
      <!DOCTYPE html>

      <html>
          <head>
            <title>Poduct Entry</title>
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
            <body>
              <h1 class="header">

                <left>Product Entry</left>
                <right><input type="button" id="button" value="Logout" onclick="logout();"></right>
                <right>Current User: <?php echo $_SESSION['username'];?></right>
              </h1>



            <form action="product_insert.php" method="post" enctype="multipart/form-data" id="box">
              <label for="p_name">Product Name</label>:
              <br>
              <input type="text" id="p_name" name="p_name">
              <br><br>
              <label for="p_image">Product Image</label>
              <input type="file" id="p_image" name="p_image">
              <br><br>
              <label for="p_quantity">Product Quantity</label>:
              <br>
              <input type="number" id="p_quantity" name="p_quantity" min="0">
              <select id="unit" name="unit">
                <option value="Kg">Kg</option>
                <option value="g">g</option>
                <option value="Piece">Piece</option>
              </select>
              <br><br>
              <label for="p_price">Unit Price</label>:
              <br>
              <input type="text" id="p_price" name="p_price" min="0">
              <br><br>
              <input type="submit" id="button" value="ADD">
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
    else{
      ?>
      <script>location.assign("login.php");</script>
      <?php
    }
?>
