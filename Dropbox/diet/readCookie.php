<?php

    /**
    //-----------------------------------------------------
    // File:        readCookie.php
    // Description: read all the food the users has eaten for the day.
    // param (string)($customer_name) name of the user
    // param (string/date)  particular day that we want to know about.
    // returns (text) returns a list of all food items and their stats. separated with `~` and newlines.
    //---------------------------------------------------------------------
    */

    session_start();

    require_once('../passwords/db_const.php');
    $dbname = "diet";
    $date = $_GET['date'];
    
    
     $customer_name = $_SESSION["customer_name"];

  
   date_default_timezone_set('America/Denver');

     
    $today = date("Y/m/d");

    $today = new DateTime($today);
    date_add($today, date_interval_create_from_date_string("$date days"));

    $today = $today->format('Y/m/d');
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * from diet where date='$today' and customer_name='$customer_name' ORDER BY  custom_sort ASC ";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
        echo($row["name"]." ~ ".$row["total_cals"]." ~ ".$row["total_amount_unit"].$row["total_amount_label"].
             " ~ ".$row["cal_per_serv"]."~".$row["amount_per_serv_unit"].$row["amount_per_serv_label"].'~'.$row['date']." ~ ".$row["custom_sort"]." ~ ".$row["id"]."  <br/>\n"
             );
      
    }

    

    $conn->close();
    ?>