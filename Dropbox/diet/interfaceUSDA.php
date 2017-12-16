<?php
    /**
    //-----------------------------------------------------
    // File:        interfaceUSDA.php
    // Description: reads file 'food_des.txt' for a
    // 				returns the name of item
    // 				and the item_code of every item. 
    // return (string)          returns name of item plus the 
    // 							item_code in parenthesis. the item_code		
    //     						can be used to look up calories in a different file.
    //---------------------------------------------------------------------
    */

	error_reporting(E_ALL); ini_set('display_errors', 1);
	
	$database = 'USDA_database/FOOD_DES.txt';
	$reading = fopen($database, 'r');
			
	while (!feof($reading) ) { //has too loop through whole file even if already found
		  
		  $line = fgets($reading); 
		  $line = str_replace("~","",$line);
		  
		  // extact name from the line
		  $fields = explode("^", $line); //11 12 13
		  
		  $name = $fields[2];
		  $code = $fields[0];

		  

		  //ECHO all items in the database  
		    echo "$name [$code] `";
	 
	}

?>