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


    $comment = '';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //  record doesn't already exsist so create ti
    $sql = "UPDATE diet
            SET $field = '$value'
            WHERE id=$id and customer_name='$customer_name';
           ";

    $result = $conn->query($sql);

    echo $sql;

    $conn->close();
?>