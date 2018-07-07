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
 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //TODO edit $sql to update if entry already exsists
    $sql = "SELECT distinct name  from diet where customer_name='$customer_name'  and (name != 0) and
            ( (total_cals != 0) and (total_amount_unit !=0)) or ((cal_per_serv !=0) and (amount_per_serv_unit!=0 ))
            ORDER BY date DESC  ";
    

    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
        echo $row["name"].",";
      
    }

    $conn->close();
    ?>