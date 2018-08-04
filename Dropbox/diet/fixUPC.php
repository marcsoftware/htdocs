<?php

    /**
    //-----------------------------------------------------
    // File: fixcookie.php
    // Description: edits a field value of a record in the
    // database "diet". 
    // @param (text) ($field) name of the field to be 
    //                        edited
    // @param (text) ($value) the new value to be stored
    //                        in the $field 
    // @param (integer) ($id) id of the record that will be
    //                        edited.
    //-----------------------------------------------------
    */
    session_start();
    date_default_timezone_set('America/Denver');
    error_reporting(E_ALL);

    require_once('../passwords/db_const.php');
    $dbname = "diet";

    $field=$_GET["field"]; 
    $value=$_GET["value"]; 
    $id=$_GET["id"]; 

    $customer_name = $_SESSION["customer_name"];
    $customer_pantry = $customer_name.'_pantry';

    $comment = '';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    

    //  record doesn't already exsist so create ti
    $sql = "UPDATE $customer_pantry
            SET $field = '$value'
            WHERE id=$id ;
           ";



    //if field == 'total_amount' or 
    // total_amount_label   total_amount_unit   amount_per_serv_unit    amount_per_serv 
   
    if( $field=='total_amount' || $field=='amount_per_serv'){
    
        
        preg_match("/[0-9\.]+/", $value, $unit);
        preg_match("/[a-zA-Z]+/", $value, $label);
       
        $unit=implode("",$unit);
        $label=implode("",$label);
        echo $label;

        $fieldUnit=$field.'_unit'; 
        $fieldLabel=$field.'_label';


        $sql = "UPDATE $customer_pantry
            SET $fieldUnit = '$unit', $fieldLabel='$label'
            WHERE id=$id ;
           ";

    }

   

    $result = $conn->query($sql);

    echo $sql;

    $conn->close();
?>