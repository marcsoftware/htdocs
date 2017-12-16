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

    $customer_name = $_SESSION["customer_name"];

  
    date_default_timezone_set('America/Denver');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $sql = "SELECT * from diet where customer_name='$customer_name' and name='$item_name' and
        (( (total_cals != 0) and (total_amount !=0)) or ((cal_per_serv !=0) and (amount_per_serv!=0 )))
        ORDER BY date ASC  ";

    $result = $conn->query($sql);
    

    //make sure the insert worked



    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
        echo $row["name"].",".$row["total_cals"].",".$row["total_amount"].",".$row["cal_per_serv"].",".$row["amount_per_serv"]."{END}";
      
    }

    $conn->close();
    ?>