<?php
    /**
    //-----------------------------------------------------
    // File:        searchHistory.php
    // Description:  searches the mysql database called diet for a 
    //               item_name or similar name. that a user has entered before. 
    //              
    //                
    // param (string)  ($item_name)        the items name that we are looking for.  
    // param (string)  ($customer_name)    the user_name so we can look up his history.      
    // return (string)                     returns a comma separates list of all matching names.    
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
    $sql = "SELECT distinct name  from diet where customer_name='$customer_name' and name LIKE '%$item_name%' and
        (( (total_cals != 0) and (total_amount !=0)) or ((cal_per_serv !=0) and (amount_per_serv!=0 )))
        ORDER BY date DESC  ";


    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
        echo $row["name"]." , ";
      
    }

    $conn->close();
    ?>