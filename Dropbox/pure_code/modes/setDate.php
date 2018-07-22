<?php session_start(); 
    
$date = htmlspecialchars($_GET["date"]);
$color = htmlspecialchars($_GET["color"]);


error_reporting(E_ALL);
ini_set('display_errors', 1);
// when user completes selfttest.php mode
// save words to database

//create table if it doesn't already exsist

//make session varibale
 $_SESSION["color"]=$color;
 $_SESSION["date"]=$date;
 
