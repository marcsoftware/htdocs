<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// when user completes selfttest.php mode
// save words to database

//create table if it doesn't already exsist
session_start();
$customer_name = $_SESSION["customer_name"];
echo $customer_name;
$dbname='diet';
$records=$_GET["records"];

require_once('../passwords/db_const.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//create table if it doesn't already exsist
$customer_pantry = $customer_name.'_pantry';
$sql = "CREATE TABLE $customer_pantry LIKE _clone_pantry";

$result = $conn->query($sql);

$date=date("Y/m/d");

//turn array into 3 array to make it easier to save
$records=str_replace("'","Z",$records); // turn quotes into HTML so they don't break the SQL command
$records = preg_split("/,/", $records);

//get letters
$template = " insert INTO $customer_pantry (name,upc,date) VALUES('{NAME}','{UPC}',$date);";
$list_sql='';
$name='';
for ($i = 0; $i < count($records); $i+=1) {
   	//get letters
 	//get letters

   	preg_match('/[a-z\ ]+/', $records[$i], $matches); //get letts from UPC
    
   	$matches=join('',$matches); //convert to STRING

    $records[$i]=str_replace($matches,"",$records[$i]); // delete name from UPC
   	

   	$new_sql =str_replace("{UPC}", $records[$i], $template);
    $new_sql =str_replace("{NAME}", $matches, $new_sql);
   	$list_sql.=$new_sql;
}
//save words to the table

//$list_sql=  json_encode($list_sql);
//$result = $conn->query($list_sql);
//mysqli_multi_query($conn,$list_sql);




echo $list_sql;
// execute queries

if ($conn->multi_query($list_sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error . '<br/>';
   // echo $list_sql;
}




$conn->close();