<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesIndex.css">
    <title>Forum</title>
</head>
<body>
    <div class="maincontainer">
        <?php require "header.php" ?>

        <div class="container">
        </div>
    </div>
    
</body>
</html>



<?php

require "connect.php";

    session_start();
    if(!isset($_SESSION['username']))
    {
        header('location:login.php');
    }
    
    //echo "Hello ".$_SESSION['username']." ".$_SESSION['id']." ".$_SESSION['authority'];
    //echo "<br>";
    print_r($_SESSION);

    if(isset($_POST['logoutbutton']))
    {
        session_destroy();
        header('location: login.php');

    }
    

?>