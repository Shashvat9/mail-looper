<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" id="" placeholder="NAME">
        <br><br>

        <input type="email" name="email" id="" placeholder="EMAIL">
        <br><br>

        <input type="number" name="number" id="" placeholder="PHONE NUMBER">
        <br><br>

        <input type="password" name="pass" id="" placeholder="PASSWORD">
        <br><br>

        <input type="password" name="repass" id="" placeholder="CONFORM PASSWORD">
        <br><br>

        <input type="submit" name="otp" value="send otp">

    </form>
</body>
</html>

<?php   
    include("./DBmethod.php");

    if (isset($_POST["otp"])){

        $pass=$_POST["pass"];
        $repass=$_POST["repass"];
        
        if($pass!=$repass){
            echo "<script>alert('Please caheck Passworrd and Re-password')</script>";
        }
        else{
            $name=$_POST["name"];
            $email=$_POST["email"];
            $numebr=$_POST["number"];        
            $sendrequest=new SendRequest();

            $json=$sendrequest->setjsonOtp($email);
            // echo $json;
            $response=$sendrequest->sendRequest($json);
            print_r($response);
            // echo $response;
            // $response_arr=json_decode($response,true);


            $signupMethod=new UserInfoOperation();

            try{
                ?>
                <br>
                <form action="" method="post">
                    <input type="number" name="otp" id="" placeholder="OTP">
                    <input type="submit" name="signup" value="Sign Up">
                </form>
                <?php

                    if(isset($_POST["signup"])){
                        if($response_arr["code"]==401){
                            if($signupMethod->signUp($email,$numebr,$pass,$name)){
                                echo "<script>alert('success')</script>";
                                header("location:login.php");
                            }
                            else{
                                echo "<script>alert('error at server side.')</script>";
                            }
                        }elseif ($response_arr["code"]==402) {
                            echo "<script>alert('error at mail server side.')</script>";
                        }
                        else{
                            echo "<script>alert('there has been an error on server side please try to connect to the developers.')</script>";
                        }
                    }

            }
            catch(SQLException $sqle){
                if($sql->getCode()==301){
                    echo "<script>alert('an sql error has occured.')</script>";   
                }
            }
            catch(EmailExistException $email){
                if($email->getCode()==101){
                    echo "<script>alert('There is a account with same email.')</script>";   
                }
            }
            catch(Exception $e){
                echo "<script>alert('There is some unexpacted error occured.')</script>";
            }
        }


    }
?>