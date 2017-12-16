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

     
    $today = date("m/d/Y");

    $today = new DateTime($today);
    date_add($today, date_interval_create_from_date_string("$date days"));

    $today = $today->format('m/d/Y');
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * from diet where date='$today' and customer_name='$customer_name' ";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
        echo($row["name"]." ~ ".$row["total_cals"]." ~ ".$row["total_amount"].
             " ~ ".$row["cal_per_serv"]."~".$row["amount_per_serv"].'~'.$row['date']." ~ ".$row["id"]."  <br/>\n"
             );
      
    }

    

    $conn->close();
    ?>