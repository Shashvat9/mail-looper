<?php
    include("./con_maillooper.php");
    include("./exceptions.php");
    include("./security.php");
    include("./DynamicAlgoSelector.php");
    include("./Params.php");
    include("./callapi.php");

    
    class DynamicObjectDispacture{
        function __construct(string $className)
        {
            if(strtolower($className)=="shift"){
                $GLOBALS["encAlgo"]=new Shift();
            }
            elseif(strtolower($className)=="aes"){
                $GLOBALS["encAlgo"]=new AES();
            }
        }
    }
?>