
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">

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

    <form id="box" action="a_loginprocess.php" method="POST">

    <div style="font-size: 20px;margin: 10px;">Login As Admin</div>

        <label for="username">Username</label>:
        <input class="text" type="text" id="username" name="username">
        <br>
        <label for="mypass">Password</label>:
        <input class="text" type="password" id="mypass" name="mypass">
        <br>
        <br>
        <input id="button" type="submit" value="Log In" onclick="a_login()">
    </form>






</body>

</html>
