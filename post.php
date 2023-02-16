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

            <form action="post.php" method="post">
                <label for="title" ><h2><b>Title Your Question</b></h2></label><br>
                <input type="text" name="title" id="title">
                <br><br><br>
                <label for="question"><h3><b>Type your question in detail</b></h3></label><br>
                <textarea name="question" id="question" cols="70" rows="15" maxlength="24000"></textarea>
                <br><br>
               
                <input type="submit" value="Post" name="postbutton" id="postbutton" class="postbutton">
            </form>        
        </div>
    </div>
    
</body>
</html>



<?php

require "connect.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
    if( isset($_POST['postbutton']) )
    {
        if(  empty($_POST['title'])  ||  empty($_POST['question']) )
        {
            echo "fill all fields";
        }
        else
        {
           $title = $_POST['title'];
           $question = $_POST['question'];

           $username = $_SESSION['username'];

           /*
            *q_id       | int          | NO   | PRI | NULL    | auto_increment |
            *q_title    | varchar(800) | YES  |     | NULL    |                |
            *q_content  | mediumtext   | YES  |     | NULL    |                |
            *questioner | varchar(500) | YES  |     | NULL    |                |
            *date       | datetime     | YES  |     | NULL    |                |
            *tags       | varchar(500) | YES  |     | NULL    |                |
            *category   | varchar(500)
            *replies    | int          | YES  |     | 0 
            */

           $query = "insert into questions (q_title, q_content, questioner) values ('$title', '$question', '$username')";

           if (mysqli_query($conn, $query)) {
                echo "Question posted succesfully";

            }
            else
            {
                echo "Some problem occcured, Couldn't post question";
            }
        }
    }

    
    

?>