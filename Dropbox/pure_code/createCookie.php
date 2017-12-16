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

    session_start(); 
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    require_once('../passwords/db_const.php');

    $dbname = "cookie";


    $subject=$_GET["subject"];
    $mode=$_GET["mode"];
    $score=$_GET["score"];
    
    $maxScore=$_GET["maxScore"];  
    $completed=$_GET["completed"];
    $timer=$_GET["timer"];

    $timeRibbon=$_GET["timeRibbon"];
    $totalTime=$_GET["totalTime"];
    $book=$_GET["book"];
    $saveLines=$_GET["saveLines"];
    $missed_words=$_GET["missed_words"];

    $customer_name=$_SESSION["customer_name"];

    echo $customer_name . " ::username<br/><br/>";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM cookie where game_type='$mode' and chapter='$subject' and book='$book' and completed=0  and customer_name='$customer_name' limit 1";
    $result = $conn->query($sql);

    $num_rows= 0;

    if ($row =$result->fetch_assoc()) {
        
        $id = $row['id'];

        //record already exsist so update it
        $sql = "UPDATE cookie
                SET book='$book', score=$score, maxScore=$maxScore,game_type='$mode', timeRibbon='$timeRibbon', timer='$timer', missed_words='$missed_words',
                completed=$completed, saveLine='$saveLines'
                WHERE id=$id ";


    }else {

        //  record doesn't already exsist so create it
        $sql = "INSERT INTO cookie
                        VALUES (
                            '$book', '$subject', $score, $maxScore, '$mode', $completed,'$timeRibbon','$timer',$totalTime,NULL,'$saveLines','$missed_words','$customer_name'
                        )";


    }

    print("<br/>" . $sql);
    $result = $conn->query($sql);

    $conn->close();
?>
