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
    
    
    $item_name = ($_GET["item_name"]);

    if(!$item_name){
        return; // if name is empty don't do anything
    }

    $customer_name = $_SESSION["customer_name"];
    $pantry_name = $customer_name . '_pantry';
  
    date_default_timezone_set('America/Denver');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    





    $sql = "SELECT * from $pantry_name where name='$item_name' and
        (( (total_cals != 0) and (total_amount_unit !=0)) or ((cal_per_serv !=0) and (amount_per_serv_unit!=0 )))
        ORDER BY date DESC  ";


    $result = $conn->query($sql);
    

    while($row = $result->fetch_assoc()) {
        
        

       echo($row["name"].",".$row["total_cals"].",".$row["total_amount_unit"].$row["total_amount_label"].
             ",".$row["cal_per_serv"].",".$row["amount_per_serv_unit"].$row["amount_per_serv_label"].","."  {END}\n"
             );

      
    }

    $conn->close();
    ?>