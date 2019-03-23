<!DOCTYPE html>
<html>
<body>


 <script>



</script> 
<?php include '../header.php';?>
<?php

    require_once("../passwords/db_const.php");
    $mysqli = new mysqli($servername, $username, $password, $db_name);
    # check connection

    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }




//URL parameters : t=? n = ?
     $check_token=   $_POST['token'];
      $check_name=  $_POST['username'];
      $newPassword=  $_POST['newPassword']; 
      $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
// databasefields : token   token_date

$today = date("d/m/Y");
$yesterday = date("d/m/Y", strtotime( '-1 days' ) );

//echo "$check_token \n $check_name \n $today \n $yesterday";

//get token and token_date from database

$sql  = "select * from user where username='$check_name' AND token='$check_token'";
$result = $mysqli->query($sql);
 $row = $result->fetch_assoc();
        $expiration_date =  $row["token_date"]; // security: never echo email.

     

        
        
    if($expiration_date==$today || $expiration_date==$yesterday){


        
        $sql = "UPDATE user SET password='$newPassword' WHERE username='$check_name' AND token='$check_token'";
        $result = $mysqli->query($sql);

        //
        echo 'password changed. ';

        $sql = "UPDATE user SET token='' , token_date='' WHERE username='$check_name' AND token='$check_token'";
        $result = $mysqli->query($sql);

        // send newpassword to database

    }else{
        echo 'ERROR: Request is invalid or expired.';        
    }

?>

</body>
</html>