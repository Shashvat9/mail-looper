<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <form action="" method="post">
        <input type="submit" value="hi" name="hi">
    </form>
</body>
</html>
<?php
include("./DBmethod.php");
include("./Params.php");


session_start();
if(isset($_POST["hi"])){
    header("location:apikeys.php");
}
?>