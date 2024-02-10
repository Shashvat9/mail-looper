<?php
    $host="localhost";
    $userName="root";
    $password="";
    $dbname="maillooper";
    // $con=mysqli_connect($host, $userName, $password, $dbname);
    $GLOBALS["con"]= mysqli_connect($host, $userName, $password, $dbname);

    class BasicQuery{

        function __construct(string $tablenane)
        {
            $GLOBALS["_TABLE"]=$tablenane;
            // echo $tablenane;
        }

        function selectQuery($fild,$where="1") : string{
            return "SELECT ". $fild . " FROM " . $GLOBALS["_TABLE"] . " WHERE ". $where ." ;";
        }

        function executeQueryAccos($query) {
            // echo $query;
            $fire = mysqli_query($GLOBALS["con"],$query);
            return mysqli_fetch_assoc($fire);
        }
        function executeQueryRowNum($query) {
            // echo "row num ".$query;
            $fire = mysqli_query($GLOBALS["con"],$query);
            return mysqli_num_rows($fire);
        }

        function insertIntoUserInfo(string $id,string $email,string $number,string $password,string $name) {
            $query= "INSERT INTO ".$GLOBALS["_TABLE"]." (id, email, number, password,dateOfCreation,name) VALUES ('".$id."','".$email."','". $number ."','". $password."','".time()."','".$name."');";
            return mysqli_query($GLOBALS["con"],$query);
        }

        function insertIntoSecurity(string $id,string $email,string $encKey,string $encAlgo,string $iv) {
            $query= "INSERT INTO ".$GLOBALS["_TABLE"]." (id,email, incKey, incalgo, iv) VALUES ('".$id."','".$email."','".$encKey."','".$encAlgo."','".$iv."');";
            // echo $query;
            return mysqli_query($GLOBALS["con"],$query);
        }
        function insertIntoSecurityshift(string $id,string $email,string $encKey,string $encAlgo) {
            $query= "INSERT INTO ".$GLOBALS["_TABLE"]." (id,email, incKey, incalgo) VALUES ('".$id."','".$email."','".$encKey."','".$encAlgo."');";
            // echo $query;
            return mysqli_query($GLOBALS["con"],$query);
        }

        function updateLastAccessed($email): bool{
            $query="UPDATE ".$GLOBALS["_TABLE"]." SET lastAccessed=".time()." WHERE email='".$email."'";
            // echo $query;
            return mysqli_query($GLOBALS["con"],$query);
        }

        function insertIntoAPIkey(string $email,string $APIkey) {
            $query= "INSERT INTO ".$GLOBALS["_TABLE"]." (apikey,email,createdOn) VALUES ('".$APIkey."','".$email."','".time()."');";
            return mysqli_query($GLOBALS["con"],$query);
        }
        function displayAllKey(string $email): array {
            $basicQuery=new BasicQuery("apikeys");
            $query=$basicQuery->selectQuery("*","email='".$email."'");
            $fire = mysqli_query($GLOBALS["con"],$query);
            $ar=[];
            while($row = mysqli_fetch_assoc($fire)){
                array_push($ar,[
                    'apiKey' => $row["apiKey"],
                    'email' => $row["email"],
                    'lastUsed' => $row["lastUsed"],
                    'createdOn' => $row["createdOn"],
                    'isactive' => $row["isactive"]
                ]);
            }
            return $ar;
        }

        function changeIsActive(int $state,string $APIkey): bool{
            $basicQuery = new BasicQuery("apikeys");
            $query="UPDATE ".$GLOBALS["_TABLE"]." SET isactive=".$state." WHERE apiKey='".$APIkey."'";
            return mysqli_query($GLOBALS["con"],$query);
        }

        

        
    }
?>