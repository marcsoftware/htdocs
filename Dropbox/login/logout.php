<?php session_start(); 
    if($_SESSION["customer_name"]){
    	$_SESSION["customer_name"]='';
        echo $_SESSION["customer_name"] . "<br/>";
    }

    

?>


<?php include '../header.php';?>

You are now logged out.