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
    //$customer_name = $_SESSION["customer_name"];
    $customer_name="bob";
    error_reporting(E_ALL);

    date_default_timezone_set('America/Denver');
    

    require_once('../passwords/db_const.php');
    $dbname = "diet";

    //
    if(!isset($_GET["name"])){
        $name='';
    }else{
         $name=$_GET["name"]; 
    }

    if(!isset($_GET["total_cals"])){
        $total_cals='null';
    }else{
        $total_cals=$_GET["total_cals"]; 
    }

    if(!isset($_GET["id"])){
        $id='';
    }else{
         $id=$_GET["id"]; 
    }


    if(!isset($_GET["total_amount"])){
        $total_amount='';
    }else{
         $total_amount=$_GET["total_amount"]; 
    }

    if(!isset($_GET["cal_per_serv"])){
        $cal_per_serv='';
    }else{
        $cal_per_serv=$_GET["cal_per_serv"]; 
    }

    if(!isset($_GET["amount_per_serv"])){
        $amount_per_serv='';
    }else{
        $amount_per_serv=$_GET["amount_per_serv"]; 
    }


  //  $date=date("Y/m/d");
$date=$_GET["date"];


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
    if($total_amount_unit){
        $total_amount_unit=number_format($total_amount_unit, 2, '.', ''); 
    }
    preg_match('/[0-9\.]+/', $amount_per_serv, $matches);
    $amount_per_serv_unit=implode(',',$matches);
    if($amount_per_serv_unit){
       $amount_per_serv_unit=number_format($amount_per_serv_unit, 2, '.', ''); ///----
    }
    //get the labels
    preg_match('/[a-zA-Z]+/', $total_amount, $matches);
    $total_amount_label=implode(',',$matches);
    preg_match('/[a-zA-Z]+/', $amount_per_serv, $matches);
    $amount_per_serv_label=implode(',',$matches);
 //echo "-> $total_amount , $amount_per_serv_label";

    //if variable is empty set it to null
    function test(&$x){
        if(empty($x)){
            $x="' '";
            return true;
        }

        return false;
    }


    //check for emtpy variables that will break the $sql
    test($total_cals);
    test( $total_amount_unit );
    test( $amount_per_serv_unit );
    test( $cal_per_serv );

    
    //if doen't have a name then dont add to database
    if(!isset($name)){
        return;
    }

    if(!$total_amount_unit && $total_amount_label ){ // check if need to add label to total_amount
        $total_amount_label='serving';
    }

    
    if(!$amount_per_serv_unit && $amount_per_serv_label){ // check if need to add label to total_amount
        $amount_per_serv_label='serving';
    }
    

       
    // 
      $time = (int) date("His");
//id  date    name    total_cals  total_amount_label
// custom_sort total_amount_unit   amount_per_serv_unit 
//   amount_per_serv_label   cal_per_serv    customer_name
    if($id == 0){ //insert a new record
        $sql = "INSERT INTO diet
            VALUES (
                    NULL, '$date', '$name', '$total_cals', '$total_amount_label',
                    $total_amount_unit ,$amount_per_serv_unit, 
                    '$amount_per_serv_label', $cal_per_serv,'$customer_name',$time
            )";
       
    }else{ //update an old record. If user updates an old record this will work and not change date. 
        //TODO need to just pass date from js. then we can make this file more

        $sql = "select date from diet where id=$id"; // preserve the date
        $result = $conn->query($sql); //TODO need to process $date before we use it
        


        $row = $result->fetch_assoc();
        
        
        $conn->query($sql);

        if(!$row){
          $sql = "insert into diet
    set
                    date='$date',
                    name='$name',

                    total_cals='$total_cals',
                    total_amount_label='$total_amount_label',
                    total_amount_unit=$total_amount_unit,
                    
                    amount_per_serv_unit=$amount_per_serv_unit,
                    amount_per_serv_label='$amount_per_serv_label',
                    cal_per_serv=$cal_per_serv,
                    customer_name='$customer_name',
                 id=$id";
        }else{
$date=$row['date'];
        //$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

         $sql = "update diet
    set
                    date='$date',
                    name='$name',

                    total_cals='$total_cals',
                    total_amount_label='$total_amount_label',
                    total_amount_unit=$total_amount_unit,
                    
                    amount_per_serv_unit=$amount_per_serv_unit,
                    amount_per_serv_label='$amount_per_serv_label',
                    cal_per_serv=$cal_per_serv,
                    customer_name='$customer_name'
                where id=$id";
            
    }  }     

echo $sql;
    $result = $conn->query($sql);

    $conn->close();
