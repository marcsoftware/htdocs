<?php
  /**
    //-----------------------------------------------------
    // File:        getFolderStats.php
    // Description: when user opens a folder there progress on each file is shown, and this file looks up the actualy stats it 
    // doesn't display them.
    //              
    // param  (string)   ($folder) the folder that the user is looking at.
    // param (string)    ($mode) the mode that the user has selected with the radio buttons
    // param (string)    ($customer_name) name of the user
    // return (text)
    // 
    //-----------------------------------------------------
    */

    require_once('../passwords/db_const.php');
    $dbname = "cookie";

    $folder=$_GET["folder"]; // 
    $mode=$_GET["mode"]; // 
    $customer_name=$_GET["customer_name"]; // 

    $comment ='';
    

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //TODO edit $sql to update if entry already exsists
     $sql = "SELECT * from cookie where book='$folder' and game_type='$mode' and customer_name='$customer_name' ORDER BY timer ASC";


    $result = $conn->query($sql);
    
    while($row = $result->fetch_assoc()) {
        echo $row["chapter"].",".$row["timer"].','.$row["completed"].',';
      
    }

    $conn->close();
?>