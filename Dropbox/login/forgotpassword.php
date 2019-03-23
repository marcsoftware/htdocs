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
    
    if($username === ''){
        echo 'please enter your username';
    }

    $sql = "SELECT * from user WHERE username LIKE '{$username}' LIMIT 1";
    $result = $mysqli->query($sql);
    if (!$result->num_rows == 1) {
        echo "<p> the username $username  does not exsist.</p>";
    } else {
       

        $row = $result->fetch_assoc();
        $email =  $row["email"]; // security: never echo email.
        
        if(!$email){
            echo "<p> the username $username  does not have an email.</p>";
           
        }else{
            echo "email sent to $username";
        }

//
$token = bin2hex(openssl_random_pseudo_bytes(64));
$token = strtr($token, '+/', '-_');

$date = date("d/m/Y"); 
$token_date = date("d/m/Y");


//save token and token_date to the user databse

$sql  = "update user set token='$token' , token_date='$token_date' where username='$username'";
        if ($mysqli->query($sql)) {
            //echo "New Record has id ".$mysqli->insert_id;
           
        } else {
       
            
        }

        
//send email to user
$to = $email;
$subject = "password reset";
$hyperlink='<a href="https://www.marcdmelcher.com/Dropbox/login/changepassword.php?t='.$token.'&n='.$username.'.php" >confirm password reset </a>';

$url='https://www.marcdmelcher.com/Dropbox/login/changepassword.php?t='.$token.'&n='.$username;
$hyperlink= sprintf('<a href="%s">%s</a>', $url, 'confirm password reset');
$hyperlink=stripslashes($hyperlink);
$txt = "click link to reset password. ".$hyperlink;
$headers = "From: passwordreset@marcdmelcher.com" . "\r\n" .
"CC: marcdmelcher@gmail.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($to,$subject,$txt,$headers);
        
        
        
        
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
        Username: <input type="text" name="username" /><br />
        

        <input type="submit" name="submit" value="reset password" />
        
    </form>
    </body>
</html>
