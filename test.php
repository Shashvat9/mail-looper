<?php
    $array = array("api_key"=>"mailre123",
    "type"=>1,
    "api_key"=>"dp123",
    "from_email"=>"vidya.gmit@gmail.com",
    "from_pass"=>"uwrxrdoyqcrbgecb",
    "subject"=>"hi",
    array("email"=>"hi@123","message"=>"hithere"),
    array("email1"=>"hi@123","message"=>"hithere"));

    // Get the keys of the array.
    $keys = array_keys($array);
    
    // Get the last key.
    $lastKey = $keys[count($keys) - 1];
    
    // Print the last key.
    // echo $lastKey; // 1
    
    print_r(json_encode($array));

    // print_r($array[0]["email"]);

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