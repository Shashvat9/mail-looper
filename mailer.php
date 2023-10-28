<?php 
    // include "conn.php";
    include "libraryx.php";

    $api_key_value="dp123";

    if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
        $json_st = $_POST["json"];
        $json = json_decode($json_st, true);
        $api_key = $json["api_key"];
        
        if (getdata($api_key) == $api_key_value) {
            
            // deffrient message but same subject
            if ($json["type"]==1) {
                diffMessageSameSubject($json);
            }
            
            // deffrient message and same subject
            if ($json["type"]==2) {
                diffMessageDeffSubject($json);
            }

            // same message and same subject
            if ($json["type"]==3) {
                sameMessageSameSubject($jsonArr);
            }
            
        } else {
            echo "wrong api key";
        }
    } 
    else {
        echo "wrong request. error code = ". http_response_code();
        echo error_get_last();
    }

    function getdata($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function sendMail(string $email,string $subject,string $message,string $from_mail,string $from_pass){
        $obmail= new mail_to_send($from_mail,$from_pass);
        // $obmail= new mail_to_send("vidya.gmit@gmail.com","uwrxrdoyqcrbgecb");
        try
        {
            $obmail->send_email($email,$subject,$message);
        }
        catch(Exception $e)
        {
            echo $e;
        }

    }

    function diffMessageSameSubject($jsonArr){
        $lastKey=getLastKey($jsonArr);
        for($i=0;$i<=$lastKey;$i++){
            sendMail($jsonArr[$i]["email"],$jsonArr["subject"],$jsonArr[$i]["message"],$jsonArr["from_email"],$jsonArr["from_pass"]);
        }
    }

    function diffMessageDeffSubject($jsonArr) {
        $lastKey=getLastKey($jsonArr);
        for($i=0;$i<=$lastKey;$i++){
            sendMail($jsonArr[$i]["email"],$jsonArr[$i]["subject"],$jsonArr[$i]["message"],$jsonArr["from_email"],$jsonArr["from_pass"]);
        }
    }
    function sameMessageSameSubject($jsonArr) {
        $lastKey=getLastKey($jsonArr);
        for($i=0;$i<=$lastKey;$i++){
            sendMail($jsonArr[$i]["email"],$jsonArr["subject"],$jsonArr["message"],$jsonArr["from_email"],$jsonArr["from_pass"]);
        }
    }

    function json_send($code,$message)
    {
        $json_arr=array("code"=>$code,"message"=>$message);
        $json=json_encode($json_arr);
        echo $json;
    }

    function getLastKey($jsonArr) : int {
        $keys = array_keys($jsonArr);
        return $keys[count($keys) - 1];
    }


?>