<?php
    /**
    //-----------------------------------------------------
    // return the last used label
    //---------------------------------------------------------------------
    */
    session_start();
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
    
    // search users history and 
    //return all items that have a similar name, 
    $sql = "SELECT  total_amount_label  from diet where customer_name='$customer_name' and name LIKE '%$item_name%' and
         (total_cals != 0) 
        ORDER BY id  DESC ";




   if($result = $conn->query($sql)){
    
        $row = $result->fetch_assoc();
        echo $row["total_amount_label"];
    }
    

    $conn->close();
    ?>