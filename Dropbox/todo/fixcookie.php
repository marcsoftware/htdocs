<?php
  /**
    //-----------------------------------------------------
    // File:        fixcookie.php
    // Description: 
    //              
    //              
    // param (text)   ($field)                    name of the field that will be edited
    // param (text)   ($value)                    the new value that will be stored in $field
    // param (number)   ($id)                     a unique id for the task or database record.
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
    $dbname = "todo";
        
    $field=$_GET["field"]; 
    $value=$_GET["value"]; 
    $id=$_GET["id"]; 

    date_default_timezone_set('America/Denver');
     
    $today = date("Y-m-d H:i:s");

    $comment = '';
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if($field !=='isDone'){
        $value = "'$value'";
    }  

    //  record doesn't already exsist so create ti
    $sql = "UPDATE todo
            SET $field = $value , date='$today'
            WHERE id=$id;
                    ";
        
    $result = $conn->query($sql);

    echo $sql;

    $conn->close();
    ?>