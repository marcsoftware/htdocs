<?php session_start(); 
    if($_SESSION["customer_name"]){
        
    }
$date = $_SESSION["date"];
$color = $_SESSION["color"];


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
$customer_name_calendar = $customer_name . '_calendar';

 if($color == 1){
 	$condition = 'difficulty!=0' ;
 }else{
 	$condition = 'difficulty=0' ;
 }   
 $sql = "SELECT * FROM $customer_name_calendar where $condition AND first_look_date='$date' ";


$result = $conn->query($sql);
$response = $result->fetch_all(MYSQLI_ASSOC);


for($i=0;$i<count($response);$i++){
    
    $german = ($response[$i]['german']);
    $english = ($response[$i]['english']);
    echo "$german \t $english \n";
 
 
}