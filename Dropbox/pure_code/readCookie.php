<?php
    /**
    //-----------------------------------------------------
    // File:        readCookie.php
    // Description: returns stats on a users study session for a incomplete study session so the user can continue where he left off.  
    //              
    // param  (text) ($chapter)       name of the file
    // param  (text) ($mode)          type of study mode
    // param  (text) ($book)          name of the folder
    // param  (text) ($customer_name) name of the user
    // return (text)    lost of `~` tilde separated values. 
    //-----------------------------------------------------
    */

    session_start(); 
    require_once('../passwords/db_const.php');

    $dbname = "cookie";

    $chapter=$_GET["chapter"];
    $mode=$_GET["mode"];
    $book=$_GET["book"];
    $customer_name=$_SESSION["customer_name"];
    


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //TODO edit $sql to update if entry already exsists
     $sql = "SELECT * from cookie where chapter='$chapter' and game_type='$mode' and customer_name='$customer_name' and book='$book'and completed=0";

    $result = $conn->query($sql);



    $sql = "SELECT * from cookie where chapter='$chapter' and game_type='$mode' and customer_name='$customer_name' and book='$book'and completed=0";


    $result = $conn->query($sql);


    if($row = $result->fetch_assoc()) {
        echo($row["timeRibbon"].'~'.$row["saveLine"].'~'.$row["missed_words"] .'~'.$row["score"].'~'.$row["timer"]);

    }else{
       echo "~1,1";

    }



    $conn->close();
?>
