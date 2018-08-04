<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// when user completes selfttest.php mode
// save words to database

//create table if it doesn't already exsist
session_start();
$customer_name = $_SESSION["customer_name"];
echo $customer_name;
$dbname='flashcards';
$records=$_GET["records"];

require_once('../passwords/db_const.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//create table if it doesn't already exsist
$sql = "CREATE TABLE $customer_name LIKE _clone_user";

$result = $conn->query($sql);



//turn array into 3 array to make it easier to save
$records=str_replace("'","Z",$records); // turn quotes into HTML so they don't break the SQL command
$records = preg_split("/,/", $records);

$template = " insert INTO $customer_name VALUES('GERMAN','ENGLISH','NULL',DIFF,'null','null','null') ON DUPLICATE KEY UPDATE  english='ENGLISH', difficulty=DIFF;";
$list_sql='';
for ($i = 0; $i < count($records)-1; $i+=3) {
   $new_sql =str_replace("GERMAN", $records[$i], $template);
   $new_sql =str_replace("ENGLISH", $records[$i+1], $new_sql);
   $new_sql =str_replace("DIFF", $records[$i+2], $new_sql);
   $list_sql.=$new_sql;
}
//save words to the table

//$list_sql=  json_encode($list_sql);
//$result = $conn->query($list_sql);
//mysqli_multi_query($conn,$list_sql);



//create calendar_table if it doesn't already exsist also
$calendar_name = $customer_name . '_calendar';
$sql = "CREATE TABLE $calendar_name LIKE _clone_user";

$result = $conn->query($sql);


//turn array into 3 array to make it easier to save
$today =  date("Y/m/d");
$template = " insert INTO $calendar_name VALUES('GERMAN','ENGLISH','NULL',DIFF,'null','null','$today') ;";
$list_sql='';
for ($i = 0; $i < count($records)-1; $i+=3) {
   $new_sql =str_replace("GERMAN", $records[$i], $template);
   $new_sql =str_replace("ENGLISH", $records[$i+1], $new_sql);
   $new_sql =str_replace("DIFF", $records[$i+2], $new_sql);
   $result = $conn->query($new_sql);
}




$conn->close();