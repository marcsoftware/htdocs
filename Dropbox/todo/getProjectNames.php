<?php
  /**
    //-----------------------------------------------------
    // File:        getProjectNames.php
    // Description: get a list of distinct project names that a user has.
    //              
    //              
    // param (text)   ($customer_name)            name of the user
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
    
    
    date_default_timezone_set('America/Denver');
     
    $today = date("m/d/Y");
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // filter the results based on isDone field
    $filter='active';
    $condition = 'where isDone >= 0';
    if($filter=='active'){
        $condition = 'where isDone = false';

    }else if($filter=='completed'){
        $condition = 'where isDone = true';
    }

    //TODO edit $sql to update if entry already exsists
    $sql = "SELECT DISTINCT project from todo where customer_name='$customer_name' order by project";

    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
        echo($row["project"]."{END}");
      
    }

    $conn->close();
    ?>