<?php
    /**
    //-----------------------------------------------------
    // File:        getProgress.php
    // Description: get milliseconds form skill database
    //---------------------------------------------------------------------
    */


    session_start();

    require_once('../passwords/db_const.php');
    $dbname = "skill";
    
    $customer_name = $_SESSION["customer_name"];
    date_default_timezone_set('America/Denver');
 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //TODO edit $sql to update if entry already exsists
    $sql = "SELECT  *,AVG(time) AS avg, DATE_FORMAT(date, '%Y,%m,%d') as duration   from skill where customer_name='$customer_name'  
             group by DATE_FORMAT(date, '%Y,%m,%d') ";
    

    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
        echo $row["avg"].";".$row["date"].':';
      
    }

    $conn->close();
    ?>