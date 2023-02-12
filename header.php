<?php
session_start();
if(!isset($_SESSION['username']))
{
    
    header('location:login.php');
}

?>

<link rel="stylesheet" href="stylesIndex.css">
<div class="header">
            <h1>ZHCET Forum</h1>
            <div class="menu">
                <form action="header.php" method="POST">
                    <button type="submit" name="logoutbutton">Logout</button>
                </form>
                <a href="index.php">Home Page</a>
                |
                <a href="account.php">My Account</a>
                |
                <a href="members.php">Members</a>

            </div>
        </div>

        <?php

            if(isset($_POST['logoutbutton']))
            {
                session_destroy();
                header('location: login.php');

            }
        
        ?>