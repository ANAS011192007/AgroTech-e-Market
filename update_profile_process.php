<?php
/*
step 1: to receive the email and password data from register.php
step 2: to store the data within the database
step 3: if data store is successful then forward to login.php
        else forward to register.php
*/

session_start();

if(
    isset($_SESSION['username'])
    && isset($_SESSION['role'])
    && !empty($_SESSION['username'])
    && !empty($_SESSION['role']))
    {

    $role = $_SESSION['role'];
    $username = $_SESSION['username'];


    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST['myname'])
            && isset($_POST['address'])
            && isset($_POST['contact'])
            && isset($_POST['district'])
            && isset($_POST['city'])

            && !empty($_POST['myname'])
            && !empty($_POST['address'])
            && !empty($_POST['contact'])
            && !empty($_POST['district'])
            && !empty($_POST['city'])
            )
            {

                $name=$_POST['myname'];
                $address=$_POST['address'];
                $contact=$_POST['contact'];
                $bKash=$_POST['bKash'];
                $district=$_POST['district'];
                $city=$_POST['city'];


                    ///store the data to database
                try{
                    // PHP Data Object
                    $conn=new PDO("mysql:host=localhost:3306;dbname=eMarket;","root","");
                    ///setting 1 environment variable
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                if( isset($_POST['oldpass'])
                    && isset($_POST['mypass'])
                    && !empty($_POST['oldpass'])
                    && !empty($_POST['mypass'])
                ){
                    $oldpass=$_POST['oldpass'];
                    $pass=$_POST['mypass'];

                    $enc_password = md5($oldpass);
                    $new_enc_password = md5($pass);

                    $myquery="SELECT * FROM ".$role." WHERE ".$role[0]."_username = '".$username."' and password ='".$enc_password."'";

                    $returnobj = $conn->query($myquery);  // the return object is pdo statement object

                    if($returnobj->rowCount() == 1){

                        ///executing mysql query
                        if($role == 'farmer'){
                          $signupquery="UPDATE ".$role." SET Name='$name', password='$new_enc_password', Address='$address', Contact_no=$contact, bKash_no=$bKash, District='$district', City='$city' WHERE ".$role[0]."_username='$username'";

                          $conn->exec($signupquery);
                        }
                        else{
                          $signupquery="UPDATE ".$role." SET Name='$name', password='$new_enc_password', Address='$address', Contact_no=$contact, District='$district', City='$city' WHERE ".$role[0]."_username='$username'";

                          $conn->exec($signupquery);
                        }


                        ?>
                        <script>alert("Profile Updated!");</script>
                        <script>location.assign("login.php");</script>
                        <?php
                    }

                }

                if($role == 'farmer'){
                  $signupquery="UPDATE ".$role." SET Name='$name', Address='$address', Contact_no=$contact, bKash_no=$bKash, District='$district', City='$city' WHERE ".$role[0]."_username='$username'";

                  $conn->exec($signupquery);
                }
                else{
                  $signupquery="UPDATE ".$role." SET Name='$name', Address='$address', Contact_no=$contact, District='$district', City='$city' WHERE ".$role[0]."_username='$username'";

                  $conn->exec($signupquery);
                }
                ?>
                    <script>alert("Profile Updated!");</script>
                    <script>location.assign("profile.php");</script>
                <?php






                }
                catch(PDOException $ex){
                    ?>
                        <script>alert("Database Error!");</script>
                        <script>location.assign("updateprofile.php");</script>
                    <?php
                }

                }

                else{
                ///if email and password data is empty or not set
                /// register.php --> registeruser.php --> register.php
                ?>
                <script>alert("Fill up all required fields!");</script>
                <script>location.assign("updateprofile.php");</script>
                <?php

                }

            }
            else{
                ///if email and password data is empty or not set
                /// register.php --> registeruser.php --> register.php
                ?>
                <script>location.assign("updateprofile.php");</script>
                <?php

            }

    }

?>
