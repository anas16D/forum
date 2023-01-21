<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Your Account</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="formcontainer">
            <h1>ZHCET Forum</h1>
            <h2 class="registerheading">Login to Your Account</h2>
            <form action="login.php" method="post" id="registerform">
                <!-- label connects for value witth the input whose id is same as for value
                clicking on label will select thhat input element whose id is same as for value of
                 that label -->
                <label for="uname">UserName</label><br>
                <input type="text" name="username" id="uname">
                <br><br>
                <label for="pass">Password</label><br>
                <input type="password" name="password" id="pass">
                <br><br>
        
                <input type="submit" value="Login" name="login" class="loginbutton" id="loginbutton">
                OR
                <input type="button" value="Register" name="register" id="registerbutton">

            </form>
        </div>
    </div>
</body>

<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "connect.php";

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $pass = $_POST['password'];

    if($username && $pass)
    {
        $encrypted_pass = sha1($pass);
        $query = "select * from users where username = '$username'";
                if ($result = mysqli_query($conn, $query)) {
                    //echo $result;

                    $user_row = mysqli_fetch_assoc($result);

                    //$user_row = mysqli_fetch_row($result);

                    //echo sha1($pass)." ".$user_row['password'];

                    if($user_row != null)
                    {

                    if($user_row['password'] == sha1($pass) )
                    {
                        echo "Login Successful";
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['id'] = $user_row['id'];
                        $_SESSION['authority'] = $user_row['authority']; 
                        header("location: index.php");
                    }
                }
                else
                {
                    echo "User Not Found";
                }

                    
                }
    }
    else
    {
        echo "Fill all the fields";
    }

}

?>

<script type="text/javascript">
    registerButton = document.getElementById("registerbutton")
    registerButton.onclick = function(){
        document.location="register.php";
        console.log("clicked");
    }
</script>

</html>