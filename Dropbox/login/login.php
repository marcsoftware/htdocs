<?php include '../header.php';?>
<?php 


    if($_SESSION){
        echo $_SESSION["customer_name"] . "<br/>";
    }
?>







<?php
if (!isset($_POST['submit'])){
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
    if (!$result->num_rows == 1) {
        echo "<p>Invalid username/password combination</p>";
    } else {
        echo "<p>$username: Logged in successfully</p><br/>";
        
        $_SESSION["customer_name"] = $username; 
        
        
        
    }
}
?>

<html>
<head>
    <title>Login Form</title>
</head>
<body>



<!-- The HTML login form -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        Username<input type="text" name="username" /><br />
        Password: <input type="password" name="password" /><br />

        <input type="submit" name="submit" value="Login" />
        <a href='forgotpassword.php'>forgot password</a>
    </form>
    </body>
</html>
