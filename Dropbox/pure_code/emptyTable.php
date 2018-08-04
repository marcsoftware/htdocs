<?php

    /**
    //-----------------------------------------------------
    // File:        createCookie.php
    // Description: saves the users progress on a particular file and mode.
    //              
    // param  (text)   
    //   
    //-----------------------------------------------------
    */
    session_start(); 
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    require_once('../passwords/db_const.php');

    $dbname = "flashcards";
    $tablename="bob_calendar";



    

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "delete FROM $tablename where 1";
    echo $sql;
    $result = $conn->query($sql);

    


        
     

    $conn->close();
?>
