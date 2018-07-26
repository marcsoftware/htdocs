<?php 
  /**
    //-----------------------------------------------------
    // File:        getUsersTime.php
    // Description: This php file will return a TIME  from the database 
    // doesn't display them.
    //              
    // param  (string)   ($book) the folder that the $chapter is in.
    // param (string)    ($mode) the mode that the user has selected with the radio buttons
    // param (string)    ($chapter) the name of the file.
    // param (string)    ($customer_name) the name of the user.
    // return (text)      parses the user time in the format ->  "$record_time , $current_score/$maxScore ". formatTime($timer)
    // 
    //-----------------------------------------------------
    */

  
  function formatTime($time){
       if(!$time){
         return '-';
       }
        $seconds = ($time/1000);//
        $minutes =floor($seconds / 60);
        $seconds = ($seconds % 60);//
        $hours = floor($seconds / 3600);

        return $hours.':'.$minutes.':'.$seconds;
    }
    
    /**
    //----------------------------------------------------------
    //
    //----------------------------------------------------------
    */
    function getTime($file,$folder,$mode){
    
        require('../passwords/db_const.php');
    
        $dbname = "spelling";



        $subject=$file; // this is the file name that user is learning.
        
        
        $book=$folder; // this is the folder that $subject or the FILE is in

        $customer_name=$_SESSION["customer_name"];



        $conn = new PDO("mysql:host=".$servername.";dbname=".$dbname.";charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


       // TODO edit this $sql to get the time
        $sql = "SELECT * FROM $dbname where game_type='$mode' and chapter='$subject' and book='$book' and completed=1  and customer_name='$customer_name' limit 1"; 
        $stmt = $conn->query($sql);


        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $row_count = $stmt->rowCount();

        if ($row_count > 0) {

          $record_time = $result['timer'];


        }else{

            $record_time = '.';
        }


        //TODO get the current progress
        $sql = "SELECT * FROM $dbname where game_type='$mode' and chapter='$subject' and book='$book' and completed=0  and customer_name='$customer_name' limit 1";
        
        $stmt = $conn->query($sql); 
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $row_count = $stmt->rowCount();


        if ($row_count > 0) {

          $current_score = $result['score'];
          $maxScore = $result['maxScore'];
          $timer = $result['timer'];


        }else{

            $current_score = '.';
            $maxScore='.';
            $timer='';
        }


    	print("$record_time , $current_score/$maxScore ". formatTime($timer));

    	

    }

  


?>