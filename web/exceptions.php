<?php
    class EmailExistException extends Exception{
        //101->DBmethods/SecurityOperation/addNewUserIntoSecurityTable
        public function errorMessage(){
            $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
            .': <b>'.$this->getMessage().'</b> this email allrady exist';
            return $errorMsg;
        }
    }
    
    class LoginException extends Exception{
        //201-> no email exists
        public function errorMessage(){
            $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
            .': <b>'.$this->getMessage()."and error code is ".$this->getCode();
            return $errorMsg;
        }
    }

    class SQLException extends Exception{
        //301->lastAccesed updation error
        //302->erroe in adding new row in user info table
        //402->erroe in adding new row in apikey table
        public function errorMessage(){
            $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
            .': <b>'.$this->getMessage()."and error code is ".$this->getCode();
            return $errorMsg;
        }
    }
?>