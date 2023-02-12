<?php

use function PHPSTORM_META\type;

    if(!isset($_GET['id']))
    {
        $previous = "javascript:history.go(-1)";
        header("location: $previous");  
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Forum</title>
</head>
<body>
    <div class="maincontainer">
        <?php require "header.php" ?>

        
   
   


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require "connect.php";
    $id = $_GET['id'];
    $query = "select * from users where id = '$id'";

    if(  $result = mysqli_query($conn, $query)  ) 
    {
        $rowcount = mysqli_num_rows($result);

        if($rowcount != 1)
        {
            header("location: index.php");
        }
        else
        {
            echo "<div class = 'profileContainer'>";
            //echo "<center>";

            $user_row = mysqli_fetch_assoc($result);
            //echo $user_row['id'];
            $profilePicPath = $user_row['picPath'];

            
            echo "<img src='$profilePicPath' height=60rem width=60rem style=border-radius:50%>";

            echo "<h1 style= color:#EA7601>".$user_row['username']."</h1>";

            echo "<b> Email: </b>". $user_row['email']."<br>";

            $dateOnly = date("Y-m-d",strtotime($user_row['date']));

            echo "<b> Date of Joining: </b>".$dateOnly."<br>";




            //echo "</center>";

            echo "</div>";
            
            
        }
        
    }


    //$id = $user_row['id'];

?>

</div>

</body>
</html>
