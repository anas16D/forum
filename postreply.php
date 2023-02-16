<?php

/**
 * Field      | Type         | Null | Key | Default           | Extra             |
*+------------+--------------+------+-----+-------------------+-------------------+
*| r_id       | bigint       | NO   | PRI | NULL              | auto_increment    |
*| q_id       | int          | YES  | MUL | NULL              |                   |
*| reply      | mediumtext   | YES  |     | NULL              |                   |
*| respondent | varchar(500) | YES  |     | NULL              |                   |
*| date       | datetime     | YES  |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
*| upvotes    | int          | YES  |     | 0                 |                 
 */

 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require "connect.php";
session_start();
if( isset($_POST['replybutton']) )
{

    $q_id = $_POST['qid'];
    $reply = $_POST['reply'];
    $username = $_SESSION['username'];

    if(!empty($reply))
    {

                                              
        $query = "insert into replies (q_id, reply, respondent) values( '$q_id', '$reply', '$username')";

        $result = mysqli_query($conn, $query);

        if($result)
        {
            echo "reply posted succesfully";
        }
        else
        {
            echo "Coudn't connect to database";
        }
    }

    header("location:question.php?id=$q_id");
    

}
else
{
    echo "Problem occured";
}
    

?>