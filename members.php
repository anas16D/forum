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

        <div class="container">
            <table id="membersdetails">
                <caption>Members in the forum</caption>
                <br><br>
                <tr>
                    <th>Member ID</th>
                    <th>Username</th>
                    <th>Profile</th>

                    <?php
                        require "connect.php";


                        $query = "select * from users";

                        /*
                        Returns FALSE on failure in running query (not on null or empty set).
                        For successful SELECT, SHOW, DESCRIBE or EXPLAIN
                        queries mysqli_query() will return a mysqli_result object.
                        For other successful queries mysqli_query() will return TRUE.
                        */ 
                        if ($result = mysqli_query($conn, $query))
                        {
                            while( $user_row = mysqli_fetch_assoc($result) )
                            {
                                echo "<tr>";
                                echo "<td>".$user_row['id']."</td>";
                                echo "<td>".$user_row['username']."</td>";
                                echo "<td><a href = 'profile.php?id=$user_row[id]'>Profile</a></td>";
                                echo "</tr>";
                            }
                        }
                        else
                        {
                            echo "Cannot Connect to database";
                        }


                    ?>
                    
                </tr>
        </div>
    </div>

</body>

</html>