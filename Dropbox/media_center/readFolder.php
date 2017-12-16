<?php
//$dir = "/var/www/html/Dropbox/pure_code/material";
$dir = $_GET["path"];

$fileNames=array();
// Open a known directory, and proceed to read its contents

if (is_dir($dir)) {

    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            //echo "$file,";

            //echo $file.':'.filetype($dir.'/'.$file).',';
            echo $file.',';
            //array_push($fileNames,$file);

            
        }
        
        
        
        closedir($dh);
    }
}else{
    echo 'not a directory.<br/>';
}


?>