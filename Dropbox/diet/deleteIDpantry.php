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
    
    
    $item_id = ($_GET["id"]);

    if(!$item_id){
        return; // if name is empty don't do anything
    }

    $customer_name = $_SESSION["customer_name"];

  
    date_default_timezone_set('America/Denver');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
   $table_name = $customer_name.'_pantry';
    $sql = "delete from $table_name where  id='$item_id' ";

    $result = $conn->query($sql);
    

  
    

    $conn->close();
    ?>