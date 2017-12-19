<?php
  /**
  //-----------------------------------------------------
  // File:        getStats.php
  // Description: counts the total number of task that a user as enter. And
  //              counts the number of those tasks that are marked as done.
  //              
  // param (text)   ($customer_name)                    
  // param (text)   ($projectName)                      the new value that will be stored in $field
  // return (text)   ($completed/$total $remainder)
  //-----------------------------------------------------
  */

  session_start(); 
  if(isset($_SESSION["customer_name"])){
    $customer_name =  $_SESSION["customer_name"];
  }else{
    $customer_name = '';
  }

  require_once('../passwords/db_const.php');
  $dbname = "todo";

  $projectName=$_GET["projectName"]; 

  date_default_timezone_set('America/Denver');

  $today = date("m/d/Y");
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }

  $condition = 1;
  
  if($projectName){
    $condition="project='$projectName'";
  }

  //get all records that have the right costomer_name and count them.
  $sql = "SELECT COUNT(isDone) as total from todo where $condition AND customer_name='$customer_name'";

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $total =  $row['total']; //save total


  //get all records that have the right costomer name and that are marked as done.
  $sql = "SELECT COUNT(isDone) as total from todo where isDone=1 AND $condition AND customer_name='$customer_name'";

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $completed =  $row['total']; //count competed
  $remainder = $total-$completed;
  echo "$completed/$total...$remainder";
  $conn->close();

?>