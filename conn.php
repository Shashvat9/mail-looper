<?php
    $hostname="Your host name";
    $uname="your user name";
    $dbname="your database name";
    $pass="";

    $con=mysqli_connect($hostname,$uname,$pass,$dbname);
    if($con->connect_error)
    {
        echo mysqli_connect_error();
    }
?>
