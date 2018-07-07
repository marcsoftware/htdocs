<?php

    /**
    //-----------------------------------------------------
    // File:        uploadUSDAslowly.php
    // Description: insert USDA database into diet/usda database 1 item at a time to overcome an max_file_size prohibition
    // param (number)($item_code) every food has a unique item_code
    // returns (number)	the amount of calories in 100 grams of a food item_item.			
    //---------------------------------------------------------------------
    */

	error_reporting(E_ALL); ini_set('display_errors', 1);
	
	
	$database = 'USDA_database/NUT_DATA.txt';
	$reading = fopen($database, 'r');
			
	require_once('../passwords/db_const.php');
    $dbname = "diet";
	$conn = new mysqli($servername, $username, $password, $dbname);
echo 'start';
	while (!feof($reading) ) { //has too loop through whole file even if already found

			$line = fgets($reading); 
			$line = str_ireplace("~", "", $line); //delte ~ tile signs
			$fields = explode("^", $line);

			if(count($fields)<3){
				continue;
			}
			$code='';
			$code = $fields[0]; //code for food item
			$nut_code = $fields[1]; 
			
			$amount_per_100_grams=$fields[2];
			$target_nut_code = 208;// 208 is the code for calories_per_100_grams.

			
				
			if($nut_code == '208'){
				
				$sql = "INSERT INTO usda
						VALUES (
						'$code', $amount_per_100_grams
					)";

				
				$result = $conn->query($sql);
			}
 	 
	}
echo 'done';
$conn->close();
?>