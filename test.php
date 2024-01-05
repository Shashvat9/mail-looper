<?php
    $array = array("api_key"=>"mailre123",
    "type"=>"1",
    "api_key"=>"dp123",
    "from_email"=>"your email",
    "application_pass"=>"",
    "subject"=>"hi",
    ["email"=>"abc@gmail.com","message"=>"hithere"],["email"=>"abc@gmail.com","message"=>"hithere"]);

    // Get the keys of the array.
    $keys = array_keys($array);
    
    // Get the last key.
    $lastKey = $keys[count($keys) - 1];
    
    // Print the last key.
    // echo $lastKey; // 1
    
    print_r(json_encode($array));
    $jsonarr=json_encode($array);

    // print_r($array);

    // $jsio="'api_key':'dp123','type':'1','from_email':'vidya.gmit@gmail.com','application_pass':'uwrxrdoyqcrbgecb','subject':'hi','0':{'email':'rajyagurushashvat@gmail.com','message':'hithere'},'1':{'email1':'dhruvjoshidj20@gmail.com','message':'hithere'}";

    // if(array_key_exists(0,json_decode($jsonarr,true))){
    //     for($i = 0 ; $i<=1 ; $i++){
    //         $arr = json_decode($jsonarr,true)[0];
    //         if(array_key_exists("email",$arr)){
    //             echo "ok";
    //         }
    //     }
    //     // print_r($arr);

    // }
    // else{
    //     echo "not";
    // }

    // include "libraryx.php";

    // function sendMail(string $email,string $subject,string $message){
    //     // $obmail= new mail_to_send($from_mail,$from_pass);
    //     $obmail= new mail_to_send("vidya.gmit@gmail.com","uwrxrdoyqcrbgecb");
    //     try
    //     {
    //         $obmail->send_email($email,$subject,$message,"0","0","done");
    //     }
    //     catch(Exception $e)
    //     {
    //         echo $e;
    //     }

    // }

    // sendMail("rajyagurushashvat@abc.com","hi","hithere");
?>
