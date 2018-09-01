<?php

    /**
    //-----------------------------------------------------
    // File:        
    // get all custom labels associated with an item_name
    //---------------------------------------------------------------------
    */

    session_start();

    require_once('../passwords/db_const.php');
    $dbname = "diet";
    
    
    $item_name = $_GET['item_name'];
    
    
     $customer_name = $_SESSION["customer_name"];

  



    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //DISTINCT c1, c2, c3
    $sql = "SELECT DISTINCT total_amount_label,total_cals,total_amount_unit from $dbname where customer_name='$customer_name' and 
            name='$item_name' and total_cals!=0 ORDER BY date DESC";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
       //echo( $row['name'].','. $row['label'].','. $row['label_unit']       .','. $row['calories'].','. $row['equivilent_label'].','. $row['equivilent_label_unit']."{END}" );
        echo(  $row['total_amount_label'].','.$row['total_amount_unit'].','.$row['total_cals'].',' );

             
      
    }



    //DISTINCT c1, c2, c3
    $sql = "SELECT DISTINCT amount_per_serv_label,cal_per_serv,amount_per_serv_unit from $dbname where customer_name='$customer_name' and
            name='$item_name' and cal_per_serv!=0 ORDER BY date ASC";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
       //echo( $row['name'].','. $row['label'].','. $row['label_unit']       .','. $row['calories'].','. $row['equivilent_label'].','. $row['equivilent_label_unit']."{END}" );
        echo(  $row['amount_per_serv_label'].','.$row['amount_per_serv_unit'].','.$row['cal_per_serv'].',' );

             
      
    }

    

    $conn->close();
