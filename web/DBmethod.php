<?php

use Random\Engine\Secure;

    include("./DynamicObjectDispacture.php");

    class GetUserInfoData{
        function getEmail(): array{
            $basicQuery=new BasicQuery("userinfo");
            $getEmailQuery=$basicQuery->selectQuery("email");
            $emailOBJ=$basicQuery->executeQueryAccos($getEmailQuery);
            return $emailOBJ;
        }
        function getEmailfromId($id): string{
            $basicQuery=new BasicQuery("userinfo");
            $getEmailQuery=$basicQuery->selectQuery("email","id='".base64_decode($id)."'");
            $emailOBJ=$basicQuery->executeQueryAccos($getEmailQuery);
            return $emailOBJ["email"];
        }
        function getEmailCount($email): int{
            $basicQuery=new BasicQuery("userinfo");
            $getEmailQuery=$basicQuery->selectQuery("email","email='".$email."'");
            $emailOBJ=$basicQuery->executeQueryRowNum($getEmailQuery);
            return $emailOBJ;
        }
        function getNumber(){
            $basicQuery=new BasicQuery("userinfo"); 
            $getNumberQuery=$basicQuery->selectQuery("number");
            $numberOBJ=$basicQuery->executeQueryAccos($getNumberQuery);
            return $numberOBJ;
        }
        function getPassword($id){
            $basicQuery=new BasicQuery("userinfo");
            $getPasswordQuery=$basicQuery->selectQuery("password","id='".$id."'");
            $passworrdOBJ=$basicQuery->executeQueryAccos($getPasswordQuery);
            return $passworrdOBJ;
        }
        function getDateOfCreation(){
            $basicQuery=new BasicQuery("userinfo");
            $getDateOfCreationQuery=$basicQuery->selectQuery("dateOfCreation");
            $dateOfCreationOBJ=$basicQuery->executeQueryAccos($getDateOfCreationQuery);
            return $dateOfCreationOBJ;
        }
        function getLastAccessed(){
            $basicQuery=new BasicQuery("userinfo");
            $getLastAccessedQuery=$basicQuery->selectQuery("lastAccessed");
            $lastAccessedOBJ=$basicQuery->executeQueryAccos($getLastAccessedQuery);
            return $lastAccessedOBJ;
        }
        function isEmailExists($email) : bool {
            $basicQuery=new BasicQuery("userinfo");
            $getIdQuery=$basicQuery->selectQuery("email","email='".$email."'");
            // echo $getIdQuery;
            $idOBJ=$basicQuery->executeQueryRowNum($getIdQuery);
            // echo $idOBJ;
            if($idOBJ==1){
                return true;
            }
            else{
                return false;
            } 
        }
        function isNumberExists($email) : bool {
            $basicQuery=new BasicQuery("userinfo");
            $getIdQuery=$basicQuery->selectQuery("email","email='".$email."'");
            // echo $getIdQuery;
            $idOBJ=$basicQuery->executeQueryRowNum($getIdQuery);
            // echo $idOBJ;
            if($idOBJ==1){
                return true;
            }
            else{
                return false;
            } 
        }
    }

    class SetUserInfoData{
        function setLastAccesedate($email):bool {
            $basicQuery=new BasicQuery("userinfo");
            return $basicQuery->updateLastAccessed($email);
        }
        function addNewRow(string $id,string $email,string $number,string $password,string $name):bool {
            $basicQuery=new BasicQuery("userinfo");
            return $basicQuery->insertIntoUserInfo($id,$email,$number,$password,$name);
        }
    }

    class SecurityTable{
        function getkey(string $id) : string {
            $basicQuery = new BasicQuery("security");
            $getKeyQuerry=$basicQuery->selectQuery("incKey","id='".$id."'");
            // echo $getKeyQuerry;
            $getKeyONJ=$basicQuery->executeQueryAccos($getKeyQuerry);
            return $getKeyONJ["incKey"];
        }
        function getalgo(string $id) : string {
            $basicQuery = new BasicQuery("security");
            $getAlgoQuerry=$basicQuery->selectQuery("incalgo","id='".$id."'");
            $getAlgoONJ=$basicQuery->executeQueryAccos($getAlgoQuerry);
            return $getAlgoONJ["incalgo"];
        }
        function getemail(string $id) : string {
            $basicQuery = new BasicQuery("security");
            $getEmailQuerry=$basicQuery->selectQuery("email","id='".$id."'");
            $getEmailONJ=$basicQuery->executeQueryAccos($getEmailQuerry);
            return $getEmailONJ["email"];
        }
        function getid($email) : string {
            $basicQuery=new BasicQuery("security");
            $getIdQuery=$basicQuery->selectQuery("id","email='".$email."'");
            // echo $getIdQuery;
            $idOBJ=$basicQuery->executeQueryAccos($getIdQuery);
            return $idOBJ["id"];
        }
        function getiv($id){
            $basicQuery=new BasicQuery("security");
            $getIvQuery=$basicQuery->selectQuery("iv","id='".$id."'");
            $ivOBJ=$basicQuery->executeQueryAccos($getIvQuery);
            return $ivOBJ["iv"];
        }
        function getAll($id) : array {
            $basicQuery=new BasicQuery("security");
            $getIvQuery=$basicQuery->selectQuery("*","id='".$id."'");
            $ivOBJ=$basicQuery->executeQueryAccos($getIvQuery);
            return $ivOBJ;
        }

        function isEmailExists($email) : bool {
            $basicQuery=new BasicQuery("security");
            $getIdQuery=$basicQuery->selectQuery("id","email='".$email."'");
            $idOBJ=$basicQuery->executeQueryRowNum($getIdQuery);
            if($idOBJ!=1){
                return false;
            }
            else{
                return true;
            } 
        }
        function addRow(string $id,string $email,string $encKey,string $encAlgo,string $iv=""):bool{
            $basicQuery=new BasicQuery("security");
            if(strtolower($encAlgo)=="shift"){
                $getIdQuery=$basicQuery->insertIntoSecurityshift($id,$email,$encKey,$encAlgo,$iv);
            }
            else{
                $getIdQuery=$basicQuery->insertIntoSecurity($id,$email,$encKey,$encAlgo,$iv);
            }
            return $getIdQuery;
        }

    }
    
    class SecurityTableOperation{
        function addNewUserIntoSecurityTable(string $email,string $id){
            $securety=new SecurityTable();
            if($securety->isEmailExists($email)){
                throw new EmailExistException("",101);
            }
            else{
                $dynamicAlgoOBJ=new DynamicAlgoSelect();
                $dynamicAlgo=$dynamicAlgoOBJ->select();
                new DynamicObjectDispacture($dynamicAlgo);
                if(strtolower($dynamicAlgo)=="aes"){
                    list($key, $iv) = $GLOBALS["encAlgo"]->generate_key_and_iv();
                    echo $iv;
                    if(!$securety->addRow($id,$email,$key,"AES",$iv)){
                        throw new SQLException("there is an error in sql exception",301);
                    }
                    else return true;
                }
                elseif(strtolower($dynamicAlgo)=="shift")
                {
                    $key=mt_rand(0,99);
                    if(!$securety->addRow($id,$email,$key,"SHIFT")){
                        throw new SQLException("there is an error in sql exception",301);
                    }
                    else return true;
                }
            }
        }
    }

    class APIkeymethods{

        function generateApiKey(){
            $bytes = random_bytes(16);
            $apiKey = bin2hex($bytes);
            $apiKey = substr($apiKey, 0, 25);
            $apiKey = strtolower($apiKey);
            return $apiKey;
        }

        function addRow(string $email){
            $basicQuery= new BasicQuery("apikeys");
            $apikeymethodes=new APIkeymethods();
            if(!$basicQuery->insertIntoAPIkey($email,$apikeymethodes->generateApiKey())){
                throw new SQLException("there is an error in sql exception",401);
            }
            else{
                return true;
            }
        }
    }

    class UserInfoOperation{

        function login($email,$pass):bool{
            //obj creation
            $getUserInfo=new GetUserInfoData();
            $setUserInfo = new SetUserInfoData();
            $securityOBJ=new SecurityTable();

            

            if(!$securityOBJ->isEmailExists($email)){
                throw new LoginException("there is no such email exists.",201);
            }
            else{
                $getId=$securityOBJ->getid($email);
                $algo=$securityOBJ->getalgo($getId);

                new DynamicObjectDispacture($algo);

                // get data from security table
                $encKey=$securityOBJ->getkey($getId);
                // $getId=$securityOBJ->getid($email);
                // $algo=$securityOBJ->getalgo($id);

                //get data from userinfo table
                $iv=$securityOBJ->getiv($getId);

                $incemail=$GLOBALS["encAlgo"]->encrypt($email,$encKey,$iv);
                if(!$getUserInfo->isEmailExists($incemail)){
                    throw new LoginException("there is no such account with this email",201);
                }
                else{
                    $passFromTable=$getUserInfo->getPassword($getId);
                    $decpass=$GLOBALS["encAlgo"]->decrypt($passFromTable["password"],$encKey,$iv);
                    if($pass==$decpass){
                        // return true;
                        if($setUserInfo->setLastAccesedate($email)){
                            return true;
                        }
                        else{
                            throw new SQLException("An error occured while Exicuting update query for last accesed update",301);
                        }
                    }
                    else{
                        return false;
                    }
                }
            }
        }
        // do exepction hendling after 
        function signUp(string $email,int $number,string $password,string $name){
            $securityTabeloperation= new SecurityTableOperation();
            $securityTable = new SecurityTable();
            $setUserInfoData = new SetUserInfoData();
            $uniqueId=uniqid();

            //it will add and set security perameaters.
            $securityTabeloperation->addNewUserIntoSecurityTable($email,$uniqueId);

            // echo $GLOBALS["encAlgo"];

            //it will fetch a row from security table where email matches
            $getId=$securityTable->getid($email);
            if($securityArr=$securityTable->getall($getId)){
            
                // print_r($securityArr);

                //it will make a object of given algo from taht class
                new DynamicObjectDispacture($securityArr["incalgo"]);


                if(strtolower($securityArr["incalgo"])=="aes"){
                    //now we have to encript all the perameaters to store it in table
                    $encEmail=$GLOBALS["encAlgo"]->encrypt($email,$securityArr["incKey"],$securityArr["iv"]);
                    $encNumber=$GLOBALS["encAlgo"]->encrypt($number,$securityArr["incKey"],$securityArr["iv"]);
                    $encPassword=$GLOBALS["encAlgo"]->encrypt($password,$securityArr["incKey"],$securityArr["iv"]);
                    $encName=$GLOBALS["encAlgo"]->encrypt($name,$securityArr["incKey"],$securityArr["iv"]);
                }
                else{
                    //now we have to encript all the perameaters to store it in table
                    $encEmail=$GLOBALS["encAlgo"]->encrypt($email,$securityArr["incKey"]);
                    $encNumber=$GLOBALS["encAlgo"]->encrypt((string)$number,$securityArr["incKey"]);
                    $encPassword=$GLOBALS["encAlgo"]->encrypt($password,$securityArr["incKey"]);
                    $encName=$GLOBALS["encAlgo"]->encrypt($name,$securityArr["incKey"]);
                }

                //now we have to make a entry of encripted data in userinfo table 

                $isAdded=$setUserInfoData->addNewRow($uniqueId,$encEmail,$encNumber,$encPassword,$encName);
                if(!$isAdded){
                    throw new SQLException("there is a error in database",302);
                }
                else{
                    return true;
                }
            }
        }
    }

    class APIkeyOperaations{
        function addAPIkey($id){
            $getuserinfodata=new GetUserInfoData();
            $apikeymethodes=new APIkeymethods();

            $email=$getuserinfodata-> getEmailfromId($id);
            $apikeymethodes->addRow($email);
        }
        function displayAllkey($id){
            $basicQuery = new BasicQuery("apikeys");
            $getUserInfoData = new GetUserInfoData();
            $email=$getUserInfoData->getEmailfromId($id);
            $keys=$basicQuery->displayAllKey($email);
            return $keys;
        }
        function changeAPIstate(string $APIkey){
            $basicQuery = new BasicQuery("apikeys");
            $query=$basicQuery->selectQuery("isactive","apikey='".$APIkey."'");
            $fire = mysqli_query($GLOBALS["con"],$query);
            $row = mysqli_fetch_assoc($fire);
            if($row["isactive"]==1){
                $flag = $basicQuery->changeIsActive(0,$APIkey);
                if(!$flag){
                    throw new SQLException("there is a error in database",402);
                }
            }
            else{
                $flag = $basicQuery->changeIsActive(1,$APIkey);
                if(!$flag){
                    throw new SQLException("there is a error in database",402);
                }
            }
        }
    }   
?>