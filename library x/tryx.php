<?php


    include "libraryx.php";

    
    $obmail= new mail_to_send("vidya.gmit@gmail.com","uwrxrdoyqcrbgecb");
    $pdf="C:/Users/rajya/Downloads/DI-SEM5REGULARWINTEREXAMINATION-2022_204520307017.pdf";
    try
    {
        $id = $obmail->send_email("rajyagurushashvat@gmail.com","subject","message0000");
    }
    catch(Exception $e)
    {
        echo $e;
    }
    echo $id;

    // if(isset($_POST["submit"]))
    // {
    //     $obfile= new file_mani();
    //     $obfile->uplode("ex",array("jpg","png","jpeg"),"C:/wamp64/www/library x/");
    // }

    // if(isset($_POST["try"]))
    // {
    //     print_r($_FILES["ex"]);
    // }

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="ex" id="">
        <input type="submit" value="submit" name="submit">
        <input type="submit" value="try" name="try">


    </form>
</body>
</html>

