
<?php include '../header.php';?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// when user completes selfttest.php mode
// save words to database

function valid($var)
{
    // returns whether the input integer is odd

    return strlen($var)==0;
}

//create table if it doesn't already exsist

$customer_name = $_SESSION["customer_name"];

$dbname='diet';
$records=$_POST["records"];

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
$records = explode("\n", $records);




$records = implode(",", $records);
$records=str_replace("'","Z",$records); // turn quotes into HTML so they don't break the SQL command
$records = preg_split("/,/", $records);

//get letters
$template = " insert INTO $customer_pantry (name,upc,date,total_cals) VALUES('{NAME}','{UPC}','$date','{TOTAL_CALS}');";
$list_sql='';
$name='';
for ($i = 0; $i < count($records); $i+=1) {
   	//get letters
 	//get letters
    if(strlen($records[$i])==0){
      continue;
    }
   	preg_match('/[a-z\ ]+/', $records[$i], $matches); //get letts from UPC
    
   	$name=join('',$matches); //convert to STRING
     
    $records[$i]=str_replace($matches,"",$records[$i]); // delete name from UPC
    $upc = trim($records[$i]);
   	/*
      SELECT *
  FROM bob_pantry a, shared b
  where b.total_cals is not null;


    */
     $both=getPantryData($upc);
     $total_cals=$both[0];
     $name=$both[1];
     if(!isset($total_cals) ){
        $both=getSharedData($upc);
        $total_cals=$both[0];
        $new_name=$both[1];
     }

     if(!isset($name) && isset($new_name)){
        $name=$new_name;

     }
  
   	$new_sql =str_replace("{UPC}", $upc, $template);
    $new_sql =str_replace("{NAME}", $name, $new_sql);
    $new_sql =str_replace("{TOTAL_CALS}", $total_cals, $new_sql);
   	$list_sql.=$new_sql;

}

//save words to the table

//$list_sql=  json_encode($list_sql);
//$result = $conn->query($list_sql);
//mysqli_multi_query($conn,$list_sql);




// execute queries

if ($conn->multi_query($list_sql) === TRUE) {
    echo "New records created successfully<br/>";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error . '<br/>';
   // echo $list_sql;
}

//--------------------------------------------------------------------
//  look for totcal_cals in the shared database
//--------------------------------------------------------------------
function getSharedData($upc){
   global $servername;
   global $username;
   global $password;
   global $dbname;
   global $customer_pantry;
    // Create connection
    $conn = new mysqli( $servername,  $username,  $password,  $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    





    $sql = "SELECT * from shared where upc='$upc' and
        total_cals is not null
          ;";


    $result = $conn->query($sql);
    

    while($row = $result->fetch_assoc()) {
        
    

       return([$row["total_cals"],$row['name']]);

      
    }

    return null; // none found
}


//--------------------------------------------------------------------
//  look for totcal_cals in the shared database
//--------------------------------------------------------------------
function getPantryData($upc){
   global $servername;
   global $username;
   global $password;
   global $dbname;
   global $customer_pantry;
    // Create connection
    $conn = new mysqli( $servername,  $username,  $password,  $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    





    $sql = "SELECT * from $customer_pantry where upc='$upc' and
        total_cals is not null
          ;";


    $result = $conn->query($sql);
    

    while($row = $result->fetch_assoc()) {
        
     

       return([$row["total_cals"],$row['name']]);
       
      
    }
  return null;
   
}

$conn->close();
?>
<a href="javascript:history.back()">Go Back</a>
