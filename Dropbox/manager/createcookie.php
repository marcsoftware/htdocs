<?php
  /**
    //-----------------------------------------------------
    // File:        createCookie.php
    // Description: saves a record of a task into the manager database
    //              
    //              
    // param (text)   ($name)            name of the task or a summary
    // param (text)   ($project)         name of the project that the task belongs to
    // param (date)   ($date)            todays date
    // param (text)   ($body)             description of the task.            
    //-----------------------------------------------------
    */
    session_start(); 
    if(isset($_SESSION["customer_name"])){
        $customer_name =  $_SESSION["customer_name"];
    }else{
        $customer_name = '';
    }
    date_default_timezone_set('America/Denver');
    error_reporting(E_ALL);

    require_once('../passwords/db_const.php');
    $dbname = "manager";
    
    

    $name=$_GET["name"]; 
    $project=$_GET["project"]; 
    $body=$_GET["body"]; 
    $date=date("m/d/Y");
    
    $comment = '';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
       
    $today = date("Y-m-d H:i:s");

        //  record doesn't already exsist so create ti
    $sql = "INSERT INTO manager
            VALUES (
                NULL, '$today', '$name', '$body', '$project',0,'$customer_name'
                    )";
        
                
    $result = $conn->query($sql);

    echo $sql;

    $conn->close();
    
?>