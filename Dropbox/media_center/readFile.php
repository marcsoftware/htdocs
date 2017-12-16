<?php
//$dir = "/var/www/html/Dropbox/pure_code/material";
ini_set('display_errors', 1); error_reporting(E_ALL);
$dir = $_GET["path"];



$myfile = fopen($dir, "r") or die("Unable to open file!");
echo fread($myfile,filesize($dir));
fclose($myfile);






?>