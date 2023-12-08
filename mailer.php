<?php 
    // include "conn.php";
    include "libraryx.php";

    $api_key_value="need 69";

    if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
        $json_st = $_POST["json"];
        $json = json_decode($json_st, true);
        $api_key = $json["api_key"];
        
        if (getdata($api_key) == $api_key_value) {
            
            // deffrient message but same subject
            if ($json["type"]==1) {
                if(validate_jason_diffMessageSameSubject($json)){
                    diffMessageSameSubject($json);
                }
                else{
                    json_send(102,"wrong json");
                }
            }
            
            // deffrient message and same subject
            else if ($json["type"]==2) {
                if(validate_jason_diffMessageDeffSubject($json)){
                    diffMessageDeffSubject($json);
                }
                else{
                    json_send(202,"wrong json");
                }
            }

            // same message and same subject
            else if ($json["type"]==3) {
                if(validate_jason_sameMessageSameSubject($json)){
                    sameMessageSameSubject($json);
                }
                else{
                    json_send(302,"wrong json");
                }
            }
            
            

            // otp on mail
            else if (strtolower($json["type"])=="otp") {
                if(validate_jason_send_mail_otp($json)){
                    send_mail_otp($json);
                }
                else{
                    json_send(402,"wrong json.");
                }
            }

            else{
                json_send(4004,"not a valid request types.");
            }
            
        } else {
            echo "wrong api key";
        }
    } 
    else {
        // echo "wrong request. error code = ". http_response_code();
        json_send(4005,"wrong request method http code = ".http_response_code());
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
            sendMail($jsonArr[$i]["email"],$jsonArr["subject"],$jsonArr[$i]["message"],$jsonArr["from_email"],$jsonArr["application_pass"]);
        }
        json_send(101,"mail sent");
    }
    
    function diffMessageDeffSubject($jsonArr) {
        $lastKey=getLastKey($jsonArr);
        for($i=0;$i<=$lastKey;$i++){
            sendMail($jsonArr[$i]["email"],$jsonArr[$i]["subject"],$jsonArr[$i]["message"],$jsonArr["from_email"],$jsonArr["application_pass"]);
        }
        json_send(201,"mail sent");
    }
    function sameMessageSameSubject($jsonArr) {
        $lastKey=getLastKey($jsonArr);
        for($i=0;$i<=$lastKey;$i++){
            sendMail($jsonArr[$i]["email"],$jsonArr["subject"],$jsonArr["message"],$jsonArr["from_email"],$jsonArr["application_pass"]);
        }
        json_send(301,"mail sent");
    }

    function lowerBound(int $min): int{
        $bound ="1";
        for ($i=0;$i<$min-1;$i++){
            $bound=$bound."0";
        }
        return (int)$bound;
    }
    function upperBound(int $max): int{
        $bound ="9";
        for ($i=0;$i<$max-1;$i++){
            $bound=$bound."9";
        }
        return (int)$bound;
    }
    
    function genRandom(int $length): int{
        return rand(lowerBound($length),upperBound($length));
    }
    
    function send_mail_otp($jsonArr)
    {
        $otp = genRandom($jsonArr["length"]);
        sendMail($jsonArr["email"],$jsonArr["subject"],$jsonArr["message"]." ".$otp,$jsonArr["from_email"],$jsonArr["application_pass"]);
        json_send(401,$otp);
    }

    function validate_jason_diffMessageSameSubject($jsonArr) : bool
    {
        $flag = false;
        if(array_key_exists("from_email",$jsonArr) && array_key_exists("application_pass",$jsonArr) && array_key_exists("subject",$jsonArr) && array_key_exists(0,$jsonArr)){
            for($i=0;$i<=getLastKey($jsonArr);$i++){
                $interArr = $jsonArr[$i];
                if(array_key_exists("email",$interArr) && array_key_exists("message",$interArr)){
                    $flag = true;
                }
                else{
                    $flag = false;
                }
            }
        }
        else{
            $flag = false;
        }

        return $flag;
    }

    function validate_jason_diffMessageDeffSubject($jsonArr) : bool
    {
        $flag = false;
        if(array_key_exists("from_email",$jsonArr) && array_key_exists("application_pass",$jsonArr)&& array_key_exists(0,$jsonArr)){
            for($i=0;$i<=getLastKey($jsonArr);$i++){
                $interArr = $jsonArr[$i];
                if(array_key_exists("email",$interArr) && array_key_exists("message",$interArr) && array_key_exists("subject",$interArr) ){
                    $flag = true;
                }
                else{
                    $flag = false;
                }
            }
        }
        else{
            $flag = false;
        }

        return $flag;
    }

    function validate_jason_sameMessageSameSubject($jsonArr) : bool
    {
        $flag = false;
        if(array_key_exists("from_email",$jsonArr) && array_key_exists("application_pass",$jsonArr)&& array_key_exists(0,$jsonArr) && array_key_exists("message",$jsonArr) && array_key_exists("subject",$jsonArr)){
            for($i=0;$i<=getLastKey($jsonArr);$i++){
                $interArr = $jsonArr[$i];
                if(array_key_exists("email",$interArr) ){
                    $flag = true;
                }
                else{
                    $flag = false;
                }
            }
        }
        else{
            $flag = false;
        }

        return $flag;
    }

    function validate_jason_send_mail_otp($jsonArr) : bool
    {
        $flag = false;
        if(array_key_exists("length",$jsonArr) && array_key_exists("from_email",$jsonArr) && array_key_exists("application_pass",$jsonArr) && array_key_exists("message",$jsonArr) && array_key_exists("subject",$jsonArr)&& array_key_exists("email",$jsonArr)){
            $flag=true;
        }
        else{
            $flag = false;
        }

        return $flag;
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
    function getdata($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


?>