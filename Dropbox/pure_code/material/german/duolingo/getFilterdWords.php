<?php session_start(); 
    if($_SESSION["customer_name"]){
        
    }
$filter = $_SESSION["filter"];


error_reporting(E_ALL);
ini_set('display_errors', 1);
// when user completes selfttest.php mode
// save words to database

//create table if it doesn't already exsist
$customer_name = $_SESSION["customer_name"];

$dbname='flashcards';

require_once('../../../../passwords/db_const.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//get stats
if(preg_match("/[a-z]/i", $filter)){ // if $filter has a letter than select all words from database
    
    $sql ="SELECT * FROM $customer_name;";
    
}else{
    
    $sql = "SELECT * FROM $customer_name where difficulty in ($filter);";
}

$result = $conn->query($sql);
$response = $result->fetch_all(MYSQLI_ASSOC);


for($i=0;$i<count($response);$i++){
    
    $german = ($response[$i]['german']);
    $english = ($response[$i]['english']);
    echo "$german \t $english \n";
 
 
}