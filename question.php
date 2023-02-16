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
                    

                    <?php

                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        require "connect.php";
                        $q_id = $_GET['id'];
                        

                        $query = "select * from questions where q_id = '$q_id'";


                        /*
                        Returns FALSE on failure in running query (not on null or empty set).
                        For successful SELECT, SHOW, DESCRIBE or EXPLAIN
                        queries mysqli_query() will return a mysqli_result object.
                        For other successful queries mysqli_query() will return TRUE.
                        */ 
                        if ($result = mysqli_query($conn, $query))
                        {
                            $rowcount = mysqli_num_rows($result);

                            if($rowcount != 1)
                            {
                                echo "couldn't find question";
                            }
                            else
                            {
                                $user_row = mysqli_fetch_assoc($result);

                                $dateOnly = date("Y-m-d",strtotime($user_row['date']));

                                
                                ?>
                                <form action='postreply.php' method='post' id='questionpageform'>
                                
                                    
                                    <h2><?php echo $user_row['q_title'] ?></h2>
                                    <br><br>
                                    
                                    <p><?php echo $user_row['q_content']?></p>
                                    <br><br>


                                    <span id="questionmetadata">
                                    <?php echo "Posted On: ".$dateOnly."<br>"?>
                                    <?php echo "Replies: ".$user_row['replies']."<br>"?>
                                    </span>

                                    <input type="hidden" name="qid" value= <?php echo $q_id;?>>

                                  

                                    <br><br><br><br>
                                    <label for="reply">Have answer?</label><br>
                                    <textarea name="reply" id="reply"></textarea>
                                
                                    <input type="submit" value="Post Reply" name="replybutton" id="replybutton" class="postbutton">
                                </form>

                                <?php

                                    $q_id = $_GET['id'];
                                        
                                    $query = "select * from replies where q_id = '$q_id'";

                                    $result = mysqli_query($conn, $query);

                                    $rowcount = mysqli_num_rows($result);
                                    

                                    if($result)
                                    {
                                       

                                       while( $user_row = mysqli_fetch_assoc($result) )
                                       {
                                        
                                            echo "<div class ='reply'> ";

                                            echo "<p>".$user_row['reply']."<br>";
                                            echo $user_row['date']."  ";
                                            echo $user_row['respondent']."  ";
                                            echo $user_row['upvotes']."  ";
 
                                            

                                            echo "</div>";
                                       }


                                    }
                                    else
                                    {
                                        echo "Problem 1";
                                    }
                                ?>

                                <?php

                            }

                               
                            
                        }
                        else
                        {
                            echo mysqli_error($conn);
                            echo "Cannot Connect to database";
                        }

                    ?>

           
        </div>
    </div>
    
</body>
</html>



