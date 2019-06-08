<?php
    /**
    //-----------------------------------------------------
    // File:        getAllHistory.php
    // Description: get alls unique food item that a user has enters.
    // param (string)($customer_name) name of the user
    // returns (text) returns a comma separated list of all the unique names in a users history.
    //---------------------------------------------------------------------
    */


    session_start();

    require_once('../passwords/db_const.php');
    $dbname = "diet";
    
    $customer_name = $_SESSION["customer_name"];
    date_default_timezone_set('America/Denver');
 
    $customer_pantry = $customer_name.'_pantry';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $date=date("Y/m/d");

    //TODO edit $sql to update if entry already exsists
    $sql = "SELECT * from $customer_pantry where date='$date'
            ";//ORDER BY article_rating DESC, article_time DESC
    

    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma

        echo $row["upc"].",".$row["name"].",".
             $row["amount_per_serv_unit"].",".
             $row["amount_per_serv_label"].",".
             $row["cal_per_serv"].",".
             $row["total_cals"].",".
             $row["id"].",".
             "{END}";
      
    }

    $conn->close();
    ?>