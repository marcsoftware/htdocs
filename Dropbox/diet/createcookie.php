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
    $id=$_GET["id"]; 

    $total_amount=$_GET["total_amount"]; 
    $cal_per_serv=$_GET["cal_per_serv"]; 
    $amount_per_serv=$_GET["amount_per_serv"]; 



    $date=date("Y/m/d");



    // customer_name is made from login.php


    if(!$customer_name){
        $customer_name='temp';

    }



    $comment = '';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //get the units
    preg_match('/[0-9\.]+/', $total_amount, $matches);
    $total_amount_unit=implode(',',$matches);
    $total_amount_unit=number_format($total_amount_unit, 2, '.', '');
    preg_match('/[0-9\.]+/', $amount_per_serv, $matches);
    $amount_per_serv_unit=implode(',',$matches);
    $amount_per_serv_unit=number_format($amount_per_serv_unit, 2, '.', '');
    //get the labels
    preg_match('/[a-zA-Z]+/', $total_amount, $matches);
    $total_amount_label=implode(',',$matches);
    preg_match('/[a-zA-Z]+/', $amount_per_serv, $matches);
    $amount_per_serv_label=implode(',',$matches);
 //echo "-> $total_amount , $amount_per_serv_label";

    //if variable is empty set it to null
    function test(&$x){
        if(empty($x)){
            $x='Null';
            return true;
        }

        return false;
    }


    //check for emtpy variables that will break the $sql
    test($total_cals);
    test( $total_amount_unit );
    test( $amount_per_serv_unit );
    test( $cal_per_serv );

    if(test(  $total_amount_label)){
        $total_amount_label='serving';
    }

    //if doen't have a name then dont add to database
    if(test($name)){
        return;
    }
    if(test( $amount_per_serv_label)){
        $amount_per_serv_label='serving';
    }
    
    
       
    // 

    if($id == 0){ //insert a new record
        $sql = "INSERT INTO diet
            VALUES (
                    NULL, '$date', '$name', $total_cals, '$total_amount_label',$total_amount_unit ,$amount_per_serv_unit, '$amount_per_serv_label', $cal_per_serv,'$customer_name'
            )";
       
    }else{ //update an old record

        $sql = "select date from diet where id=$id"; // preserve the date
        $result = $conn->query($sql); //TODO need to process $date before we use it
        

        while($row = $result->fetch_assoc()) {
            $date= $row['date'];
        }


        $sql = "delete from diet where id=$id";
        $conn->query($sql);

         $sql = "INSERT INTO diet
            VALUES (
                    $id, '$date', '$name', $total_cals, '$total_amount_label',$total_amount_unit ,$amount_per_serv_unit, '$amount_per_serv_label', $cal_per_serv,'$customer_name'
            )";
            
    }       

echo $sql;
    $result = $conn->query($sql);

    $conn->close();
