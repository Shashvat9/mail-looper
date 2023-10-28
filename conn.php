<?php
    $hostname="localhost";
    $uname="root";
    $dbname="drishtiprabha";
    $pass="";

    $con=mysqli_connect($hostname,$uname,$pass,$dbname);
    if($con->connect_error)
    {
        echo mysqli_connect_error();
    }
?>