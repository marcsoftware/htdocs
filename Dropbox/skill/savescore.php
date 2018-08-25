<?php
    /**
    //-----------------------------------------------------
    // File:        savescore.php
    // Description: saves users results from the skill game
    // param (text)   (width)          width of the canvas. differnet computers will have different sizes
    // param (number) (height)         height of the canvas.
    // param (text)   (milliseconds)   the amount in milliseconds it took the user to complete the round
    //-----------------------------------------------------
    */

    session_start();
    $customer_name = $_SESSION["customer_name"];
    error_reporting(E_ALL);

    date_default_timezone_set('America/Denver');
    $date=date("Y/m/d");

    require_once('../passwords/db_const.php');
    $dbname = "skill";

    //id  time    size    pattern     date 
    
    $time=$_GET['time'];
    $size=$_GET['size'];
    $pattern=$_GET['pattern'];
    $date = date("m.d.y");   

    // customer_name is made from login.php


    if(!$customer_name){
        $customer_name='temp';

    }


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    // 
    $sql = "INSERT INTO $dbname
            VALUES (
                    NULL,'$time','$size','$pattern','$date'
            )";

echo $sql;
    $result = $conn->query($sql);

    $conn->close();
