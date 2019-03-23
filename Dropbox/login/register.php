<?php session_start(); 
    if($_SESSION["customer_name"]){
        echo $_SESSION["customer_name"] . "<br/>";
    }
?>
<?php include '../header.php';?>
<html>
<head>
    <title>Login Form</title>
</head>
<body>

<?php

    if (!isset($_POST['submit'])){
?>




<!-- The HTML login form -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        Username: <input type="text" name="username" /><br />
        Password: <input type="password" name="password" /><br />

        <input type="submit" name="submit" value="Login" />
    </form>

<?php
            } else {
                require_once("../passwords/db_const.php");
                $mysqli = new mysqli($servername, $username, $password, $db_name);
                # check connection
                if ($mysqli->connect_errno) {
                    echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
                    exit();
                }

                $username = $_POST['username'];
                $password = $_POST['password'];

                $sql = "SELECT * from user WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
                $result = $mysqli->query($sql);

                //TODO use (password_verify($unhashed_password, $hashed_password)) {
                if (!$result->num_rows == 1) {
                    echo "<p>Invalid username/password combination</p>";
                } else {
                    echo "<p>Logged in successfully</p>";
                    // do stuffs
                }
            }
?>   


</body>
</html>



<html>
<head>
    <title>Registration</title>
</head>
<body>  
<?php
require_once("../passwords/db_const.php");
if (!isset($_POST['submit'])) {
?>  <!-- The HTML registration form -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        Username: <input type="text" name="username" /><br />
        Password: <input type="password" name="password" /><br />
  
        Email: <input type="type" name="email" /><br />

        <input type="submit" name="submit" value="Register" />
    </form>
<?php
} else {
## connect mysql server
    //$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    # check connection
    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }
## query database
    # prepare data for insertion
    $username   = $_POST['username'];
    $password   = $_POST['password'];
 $password = password_hash($password, PASSWORD_DEFAULT);
    $email      = $_POST['email'];

    # check if username and email exist else insert
    $exists = 0;
    $result = $mysqli->query("SELECT username from user WHERE username = '{$username}' LIMIT 1");
    if ($result->num_rows == 1) {
        $exists = 1;
        $result = $mysqli->query("SELECT email from user WHERE email = '{$email}' LIMIT 1");
        if ($result->num_rows == 1) $exists = 2;    
    } else {
        $result = $mysqli->query("SELECT email from user WHERE email = '{$email}' LIMIT 1");
        if ($result->num_rows == 1) $exists = 3;
    }

    if ($exists == 1) echo "<p>Username already exists!</p>";
    else if ($exists == 2) echo "<p>Username and Email already exists!</p>";
    else if ($exists == 3) echo "<p>Email already exists!</p>";
    else {
        # insert data into mysql database

        $sql = "INSERT  INTO `user` (`id`, `username`, `password`,  `email`) 
                VALUES (NULL, '{$username}', '{$password}', '{$email}')";

        if ($mysqli->query($sql)) {
            //echo "New Record has id ".$mysqli->insert_id;
            echo "<p>Registred successfully!</p>";
        } else {
            echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
            exit();
        }
    }
}
?>      
</body>
</html>