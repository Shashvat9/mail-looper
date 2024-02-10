<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="" method="post">
        <input type="email" name="email" value="" placeholder="Email">
        <br><br>
        <input type="password" name="pass" placeholder="Password">
        <br><br>
        <label for="">Stay signedin ?</label>
        <input type="checkbox" name="stay" id="" placeholder>
        <br><br>
        <input type="submit" value="Login" name="login">
        <input type="submit" value="Signup" name="signup">
    </form>
</body>
<body>
  
</body>
</html>




<?php   
include("./DBmethod.php");
session_start();
    if (isset($_POST["signup"])){ 
        header("location:signup.php");
    }
    elseif(isset($_POST["login"])){
        
        //remove this comments in production
        // if($_POST["email"]!=null){
            $email=$_POST["email"];
            // if($_POST["pass"]!=null){
                $pass=$_POST["pass"];
                $myMethodes=new UserInfoOperation();
                try{
                    $flag=$myMethodes->login($email,$pass);
                    if($flag){
                        //this are the credentionals for cookie or session
                        $security= new SecurityTable();
                        $iddec=$security->getid($email); 
                        $id=base64_encode($iddec);
                        $cName=$__SESSIONID;
                        // echo $cName;

                        if(array_key_exists("stay",$_POST))
                        {
                            $exp = time() + 60 * 60 * 24 * 30;
                            if(setcookie($cName,$id,$exp)){
                                header("location:index.php");
                                echo "<script>alert('Login succesfull.')</script>";
                            }
                            else {
                                echo "<script>alert('there is some error occured while setting cookie.')</script>";
                            }
                        }
                        else{
                            $_SESSION[$cName]=$id;
                            header("location:index.php");
                            echo "<script>alert('Login succesfull.')</script>";
                        } 
                    }
                    else{
                        echo "<script>alert('Wrong credentials.')</script>";   
                    }
                }
                catch (LoginException $l){
                    if($l->getCode()==201){
                        echo "<script>alert('There is no such email exiest.')</script>";
                    }
                }
                catch(SQLException $sql){
                    if($sql->getCode()==301){
                        echo "<script>alert('an sql error has occured.')</script>";   
                    }
                }
            }
        //     else{
        //         echo "<script>alert('password fild is empty')</script>";
        //     }
        // }
        // else{
        //     echo "<script>alert('email fild is empty')</script>";
        // }
    // }
?>