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
            <a href="post.php"><button id="postpagebutton" class="postbutton">Post Question</button></a>


            
            
                <table id="questiontable">
                    <tr>
                    <th>S. No.</th>
                    <th>Question</th>
                    <th>Date</th>
                    <th>Asked by</th>
                    <th>Category</th>
                    </tr>

                    <?php
                        require "connect.php";
                        

                        $query = "select q_title, questioner, date, tags, category, replies, q_id from questions";

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

                        /*
                        Returns FALSE on failure in running query (not on null or empty set).
                        For successful SELECT, SHOW, DESCRIBE or EXPLAIN
                        queries mysqli_query() will return a mysqli_result object.
                        For other successful queries mysqli_query() will return TRUE.
                        */ 
                        if ($result = mysqli_query($conn, $query))
                        {
                            $count = 1;
                            while( $user_row = mysqli_fetch_assoc($result) )
                            {
                                $dateOnly = date("Y-m-d",strtotime($user_row['date']));

                                echo "<tr>";
                                echo "<td>".$count++."</td>";
                                echo "<td><a href='question.php?id=$user_row[q_id]'>".$user_row['q_title']."</a></td>";
                                echo "<td>".$dateOnly."</td>";
                                echo "<td>".$user_row['questioner']."</td>";
                                echo "<td>".$user_row['category']."</td>";
                                
                                echo "</tr>";
                            }
                        }
                        else
                        {
                            echo "Cannot Connect to database";
                        }


                    ?>


                </table>
           
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
    

    
    

?>