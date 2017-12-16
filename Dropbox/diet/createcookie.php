<?php
    /**
    //-----------------------------------------------------
    // File:        createCookie.php
    // Description: saves a consumed food item's stats in
    //              the database called "diet". It is called by the 
    //              diet.php
    // param (text)   ($name)            name of item
    // param (number) ($total_cals)      total cals eaten by the user. 
    // param (text)   ($total_amount)    total amount eaten. might be number with label appended like "1 cup"
    // param (number) ($cal_per_serv)    amount of calories in a serving.    
    // param (text)   ($amount_per_serv) might be number with label appended like "1 cup"
    //-----------------------------------------------------
    */
    session_start();
    $customer_name = $_SESSION["customer_name"];
    error_reporting(E_ALL);

    date_default_timezone_set('America/Denver');
    

    require_once('../passwords/db_const.php');
    $dbname = "diet";


    $name=$_GET["name"]; 
    $total_cals=$_GET["total_cals"]; 

    $total_amount=$_GET["total_amount"]; 
    $cal_per_serv=$_GET["cal_per_serv"]; 
    $amount_per_serv=$_GET["amount_per_serv"]; 



    $date=date("m/d/Y");



    // customer_name is made from login.php


    if(!$customer_name){
        $customer_name='temp';

    }

    echo '-> ' . $customer_name;

    $comment = '';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    // 
    $sql = "INSERT INTO diet
            VALUES (
                    NULL, '$date', '$name', $total_cals, '$total_amount' , '$amount_per_serv', $cal_per_serv,'$customer_name'
            )";

    $result = $conn->query($sql);

    $conn->close();
?>