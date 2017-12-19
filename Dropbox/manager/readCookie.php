<?php

    /**
    //-----------------------------------------------------
    // File:        readCookie.php
    // Description: returns records from database that match
    //              $filter condition, $projectName condition 
    //              and have the right customer name
    //              
    // param  (text)   ($customer_name)
    // param  (text)   ($filter)                    selects records records that are marked as done, marked as not done, or both. 
    // param  (text)   ($projectName)               select tasks with a particular projectname if desired.
    // return (text)   deliniated list of records. 
    //-----------------------------------------------------
    */

    session_start(); 
    if(isset($_SESSION["customer_name"])){
        $customer_name =  $_SESSION["customer_name"];
    }else{
        $customer_name = '';
    }

    require_once('../passwords/db_const.php');
    $dbname = "manager";


    $filter=$_GET["filter"]; 
    $projectName=$_GET["projectName"]; 

  
   
    date_default_timezone_set('America/Denver');
     
    $today = date("m/d/Y");
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // filter the results based on isDone field
    $condition = 'isDone >= 0';
    if($filter=='active'){
        $condition = 'isDone = false';

    }else if($filter=='completed'){
        $condition = 'isDone = true';
    }

    //filter by projectname
    $secondCondition = 1;
    if($projectName){ //$projectname is assumed to be a valid name
        $secondCondition = "project='$projectName'";
    }
    

    //delete empty records
    $sql = "DELETE FROM manager WHERE name = '' and project='' and  body=''";
    $conn->query($sql);

    $sql = "SELECT * from manager where $condition AND $secondCondition AND customer_name='$customer_name' order by date DESC ";
  
    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {

        echo($row["id"]."{comma}" .$row["project"]."{comma}".$row["name"]."{comma}".$row["body"]."{comma}".$row["date"]."{comma}".$row["isDone"]." {END}");
      
    }

    $conn->close();
?>