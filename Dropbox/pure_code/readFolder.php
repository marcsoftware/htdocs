<?php
    /**
    //-----------------------------------------------------
    // File:        readFolder.php
    // Description:	reads the list of filenames in a folder.
    //              
    // param  (text)   ($dir) 	the folder that we want to read.
    // return (text)   commoa separated list of filenames and the filetype(file or folder).
    //-----------------------------------------------------
    */

	$dir = $_GET["path"];


	$dir = $_GET["path"];


	$fileNames=array();
	
	// Open a known directory, and proceed to read its contents
	if (is_dir($dir)) {

	    if ($dh = opendir($dir)) {
	        
	        while (($file = readdir($dh)) !== false) {


	    if ($dh = opendir($dir)) {
	        
	        while (($file = readdir($dh)) !== false) {


	            echo $file.':'.filetype($dir.'/'.$file).',';
	            
	        }
	        
	        closedir($dh);
	    }

	}else{
	    echo 'not a directory.<br/>';
	}


	}else{
	    echo 'not a directory.<br/>';
	}



?>