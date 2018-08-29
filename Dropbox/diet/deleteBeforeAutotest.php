<?php

    /**
    //-----------------------------------------------------
    // File:        getstats.php
    // Description: returns the stats of a food_item from a particular users history.
    // param (string)($customer_name) name of the user
    // param ($item_name)  name of the item
    // returns (text) returns a list of the food stats separated with commas.
    //---------------------------------------------------------------------
    */


    session_start();
    //this gets the stats of an item name

    require_once('../passwords/db_const.php');
    $dbname = "diet";
    
    
    

   

    $customer_name = $_SESSION["customer_name"];

   
    date_default_timezone_set('America/Denver');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
     $date=date("Y/m/d");
    $sql = "delete from diet where customer_name='$customer_name' and date='$date' ";

    $result = $conn->query($sql);
    

  
    

    $conn->close();
    ?>