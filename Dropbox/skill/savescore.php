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

   $canvas_width=$_GET['width'];
   $canvas_height=$_GET['height'];
   $milliseconds=$_GET['milliseconds'];

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
                    NULL,'$customer_name', '$date', $canvas_width, $canvas_height, $milliseconds
            )";


    $result = $conn->query($sql);

    $conn->close();
