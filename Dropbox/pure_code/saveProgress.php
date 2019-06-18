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


 require_once('../passwords/db_const.php');

    $fileName=$_GET["fileName"];
    $modeName=$_GET["modeName"];
$customer_name=$_SESSION["customer_name"];
    echo "$fileName ----  $modeName";


     $conn = new mysqli($servername, $username, $password, 'flashcards');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

  $sql = "INSERT INTO completed (user,chapter,mode,isDone)
                        VALUES (
                            '$customer_name','$fileName','$modeName',1
                        )";

    $result = $conn->query($sql);



    $conn->close();
