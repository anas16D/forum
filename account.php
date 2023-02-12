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

        $username = $_SESSION['username'];

        $query = "select * from users where username = '$username'";

        if ($result = mysqli_query($conn, $query)) {
            $rowcount = mysqli_num_rows($result);

            if ($rowcount != 1) {
                header("location: index.php");
            } else {
                echo "<div class = 'profileContainer'>";
                //echo "<center>";

                $user_row = mysqli_fetch_assoc($result);
                //echo $user_row['id'];
                $profilePicPath = $user_row['picPath'];


                echo "<img src='$profilePicPath' height=60rem width=60rem style=border-radius:50%>";

                echo "<h1 style= color:#fc5203; >" . $user_row['username'] . "</h1>";

                echo "<b> Email: </b>" . $user_row['email'] . "<br>";

                $dateOnly = date("Y-m-d", strtotime($user_row['date']));

                echo "<b> Date of Joining: </b>" . $dateOnly . "<br>";




                //echo "</center>";

                echo "</div>";
            }
        }


        //$id = $user_row['id'];

        ?>


        <div class="settingscontainer">
            <form action="account.php" method="post">

                <h2>Change Settings</h2><br>

                <label for="uname" value=<?php echo $user_row['username'] ?>>UserName</label><br>
                <input type="text" name="username" id="uname">
                <br><br>
                <label for="id">Enrollment No./Employee Id</label><br>
                <input type="text" value=<?php echo $user_row['id'] ?> name="id" id="id">
                <br><br>
                <label for="pass" placeholder="Type Your Current Password"> Current Password</label><br>
                <input type="password" name="curpass" id="curpass">
                <br><br>
                <label for="newpass" placeholder="Type Your Current Password">New Password</label><br>
                <input type="password" name="newpass" id="newpass">
                <br><br>
                <label for="email">Email</label><br>
                <input type="email" value=<?php echo $user_row['email'] ?> name="email" id="email">
                <br><br>
                <input type="submit" value="Save" name="save" id="updatesettigsbutton">



            </form>
        </div>




    </div>

</body>

</html>

<?php

$username = $_SESSION['username'];

$query = "select * from users where username = '$username'";
if ($result = mysqli_query($conn, $query)) {

    $user_row = mysqli_fetch_assoc($result);


    $pass = $user_row['password'];
    $email = $user_row['email'];
    $id = $user_row['id'];
}
else
{
    echo "Can't fetch user's details";
}
if (isset($_POST['save'])) {

    if (!isset($_POST['curpass']) || !(sha1($_POST['curpass']) == $pass)) {

        echo "Current password doesn't match";
    } else {
        if (isset($_POST['username'])) {
            $username = $_POST["username"];
        }

        if (isset($_POST['newpass'])) {
            $pass = sha1($_POST['newpass']);
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }


        if (strlen($username) >= 30) {
            echo "Username should be of less than 30 charachters";
        } else if (strlen($_POST['newpass']) >= 500) {
            echo "Password must be less than 500 charahters";
        } else {

            $query = "update users set username='$username', password='$pass', email='$email' where id='$id'";

            if (mysqli_query($conn, $query)) {
                echo "Changes Saved successfuly";
            } else {
                //just to check errror in sql query
                //echo mysqli_error($conn);
                echo "Some problem occured<br>Couldn't update acccount settings";
            }
        }
    }
}





?>