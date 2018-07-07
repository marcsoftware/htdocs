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
	

			
	require_once('../passwords/db_const.php');
    $dbname = "diet";
	$conn = new mysqli($servername, $username, $password, $dbname);

	$item_code = $_GET["item_code"];
			
	$sql = "SELECT * from usda where id='$item_code' ";
	
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
        // NOTE: id has to be the last field and be seperated by comma
        echo($row["cal_per_100g"]);
      
    }

$conn->close();
?>