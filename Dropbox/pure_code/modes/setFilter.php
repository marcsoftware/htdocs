<?php session_start(); 
    
$filter = htmlspecialchars($_GET["diffs"]);


error_reporting(E_ALL);
ini_set('display_errors', 1);
// when user completes selfttest.php mode
// save words to database

//create table if it doesn't already exsist

//make session varibale
 $_SESSION["filter"]=$filter;
 echo $_SESSION["filter"];
