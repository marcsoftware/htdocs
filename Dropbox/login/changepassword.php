<!DOCTYPE html>
<html>
<body>


 <script>


function checkInput(){
        //get newPassword 
    //get confirmPassword
    var x = document.getElementById('newPassword').value;
    var y = document.getElementById('confirmPassword').value;
    var feedback_handle=document.getElementById('feedback');
    var message='';
    if(x === y){
        document.getElementById("submit").disabled=false;
      message='passwords match.';
    }else{
        document.getElementById("submit").disabled=true;
        message="wrong: passwords don't match.";
    }

    feedback_handle.innerHTML=message; //render message
}
</script> 
<?php

    require_once("../passwords/db_const.php");

    $mysqli = new mysqli($servername, $username, $password, $db_name);
    
    # check connection

    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }


    //TODO get token from URL


//URL parameters : t=? n = ?
     $check_token=   $_GET['t'];
      $check_name=  $_GET['n'];
// databasefields : token   token_date

$today = date("d/m/Y");
$yesterday = date("d/m/Y", strtotime( '-1 days' ) );

//echo "$check_token \n $check_name \n $today \n $yesterday";

//TODO get token and token_date from database

$sql  = "select * from user where username='$check_name' AND token='$check_token'";
$result = $mysqli->query($sql);
 $row = $result->fetch_assoc();
        $expiration_date =  $row["token_date"]; // security: never echo email.

     

        
        
    if($expiration_date==$today || $expiration_date==$yesterday){
        //
        echo '<h1>Change Password</h1>

<form method="post" action="changepassword_confirmed.php">

<label for="newPassword">New Password:</label>
<input type="password" id="newPassword"  onkeyup="checkInput()" name="newPassword" title="New password" />

<label for="confirmPassword" >Confirm Password:</label>
<input type="password" id="confirmPassword" onkeyup="checkInput()" name="confirmPassword" title="Confirm new password" />
<p id="feedback"></p>
 <input type="text" hidden value='. $check_token.' name="token" />
<input type="text" hidden value='. $check_name.' name="username" />
<p class="form-actions">
<input type="submit" value="Change Password" id="submit" disabled title="Change password" />
</p>

</form> ';

    }else{
        echo 'Request is invalid or expired.';        
    }

?>

</body>
</html>