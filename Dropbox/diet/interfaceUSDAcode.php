<?php

    /**
    //-----------------------------------------------------
    // File:        interfaceUSDAcode.php
    // Description: uses $item_code to lookup calories in the NUT_DATA.txt
    // param (number)($item_code) every food has a unique item_code
    // returns (number)	the amount of calories in 100 grams of a food item_item.			
    //---------------------------------------------------------------------
    */

	error_reporting(E_ALL); ini_set('display_errors', 1);
	$item_code=$_GET["item_code"]; 
	
	$database = 'USDA_database/NUT_DATA.txt';
	$reading = fopen($database, 'r');
			
	while (!feof($reading) ) { //has too loop through whole file even if already found

			$line = fgets($reading); 

			$fields = explode("^", $line);


			$code = $fields[0]; //code for food item
			$nut_code = $fields[1]; 
			$amount_per_100_grams=$fields[2];
			$target_nut_code = 208;// 208 is the code for calories_per_100_grams.

			if (preg_match("/$item_code/",$code) && preg_match("/$target_nut_code/",$nut_code) ) { // if extact match for code
				
				
				echo "$amount_per_100_grams";
				return;

				
				
			}
		  
		 
	}

?>