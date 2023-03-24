
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>

            body {
            background-color: lightblue;
            }

            .text{

            height: 20px;
            border-radius: 5px;
            padding: 2px;
            border: solid thin #aaa;
            width: 90%;
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
            width: 300px;
            padding: 20px;
            }

        </style>
</head>

<body>

    <form id="box" action="loginprocess.php" method="POST">

    <div style="font-size: 20px;margin: 10px;">Log In</div>

        <label for="username">Username</label>:
        <input class="text" type="text" id="username" name="username">
        <br>
        <label for="mypass">Password</label>:
        <input class="text" type="password" id="mypass" name="mypass">
        <br>
        Are you a :
        <div>
        <input type="radio" name="role" value="buyer"> Buyer<br>
	    <input type="radio" name="role" value="farmer"> Farmer<br>
		</div>
        <br>
        <input id="button" type="submit" value="Click to Login"> 
        <input id="button" type="button" value="Log In As Admin" onclick="a_login()">
    </form>




    <form id="box" action="b_register.php" method="POST">  
    <div style="font-size: 20px;margin: 10px;">Don't have an account? Register!</div>

            <button id="button" type="submit">Register</button> 
           

    </form>
    <script>
                    function a_login(){
                        location.assign('a_login.php');   ///default GET method
                    }
     </script>               
</body>

</html>
