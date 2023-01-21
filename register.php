<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Your Account</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="formcontainer">
            <h1>ZHCET Forum</h1>
            <h2 class="registerheading">Register yourself</h2>
            <form action="register.php" method="post" id="registerform">
                <!-- label connects for value witth the input whose id is same as for value
                clicking on label will select thhat input element whose id is same as for value of
                 that label -->
                <label for="uname">UserName</label><br>
                <input type="text" name="username" id="uname">
                <br><br>
                <label for="id">Enrollment No./Faculty No.</label><br>
                <input type="text" name="id" id="id">
                <br><br>
                <label for="pass">Password</label><br>
                <input type="password" name="password" id="pass">
                <br><br>
                <label for="repass">Confirm Password</label><br>
                <input type="password" name="repass" id="repass">
                <br><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email">
                <br><br>
                <input type="submit" value="Register" name="register" id="registerbutton">
                OR
                <input type="button" value="Login" id="loginbutton" class="loginbutton">

            </form>
        </div>
    </div>
</body>

<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "connect.php";

if (isset($_POST["register"])) {

    $username = $_POST["username"];
    $pass = $_POST['password'];
    $repass = $_POST['repass'];
    $email = $_POST['email'];
    $id = $_POST['id'];


    if ($username && $pass && $repass && $email && $id) {
        if ($pass == $repass) {

            if (strlen($username) >= 30) {
                echo "Username should be of less than 30 charachters";
            } 
            else if(strlen($pass) >= 500)
            {
                echo "Password must be less than 500 charahters";
            }
            else {
                $encrypted_pass = sha1($pass);
                $query = "insert into users (username, password, email, id) values ('$username', '$encrypted_pass', '$email', '$id')";

                if (mysqli_query($conn, $query)) {
                    echo "You are registered successfuly";
?>
                    <script>
                        document.location = "login.php";
                    </script>
<?php
                } else {
                    echo "Some problem occured<br>Couldn't regitster";
                }
            }
        } else {
            echo "Passwords doesn't match";
        }
    } else {
        echo "All fields are required";
    }





    //         INSERT INTO table_name (column1, column2, column3, ...)
    // VALUES (value1, value2, value3, ...); 





}

?>

<script type="text/javascript">
    loginButton = document.getElementById("loginbutton")
    loginButton.onclick = function() {
        document.location = "login.php";
        console.log("clicked");
    }
</script>

</html>