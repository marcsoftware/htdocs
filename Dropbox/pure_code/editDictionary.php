<?php 
    /**
    //-----------------------------------------------------
    // File:        editDictionary.php
    // Description: Edits a word in the dictionary.
    //              
    // param  (string)   ($german)  a german word
    // param (string)  ($newDefinition) the correct definition of the $german word.
    //
    // 
    //-----------------------------------------------------
    */


    error_reporting(E_ALL); ini_set('display_errors', 1);

    $germanWord = ($_GET["germanWord"]);
    $germanWord=strtolower($germanWord);
    $newDefinition = ($_GET["newDefinition"]);


    $dictionary = 'smallDictionary.csv';
    $reading = fopen($dictionary, 'r');
    $writing = fopen('smallDictionary.tmp', 'w');

    $replaced = false;

    while (!feof($reading) ) { //has too loop through whole file even if already found
        
        $line = fgets($reading);
        if (preg_match("/".$germanWord."\t/",$line) && (! $replaced) ) { //
            $line = "$germanWord\t$newDefinition\n";
            echo 'new: '.$line;

            $replaced = true;
        }else if(preg_match("/".$germanWord."\t/",$line)){   //if another match, then the word as a redundent entry so delete it.

            $line=''; //delete repeats
        }
    
        fputs($writing, $line);
    }


    fclose($reading); fclose($writing);
    // might as well not overwrite the file if we didn't replace anything
    if ($replaced) {
        rename('smallDictionary.tmp', 'smallDictionary.csv');
    } else {
        unlink('smallDictionary.tmp');
    }

    //if not already found. append it to end of the file.
    if( ! $replaced){

        $my_file = $dictionary;
        $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
        $line = "$germanWord\t$newDefinition\n";
        echo $line;
        fwrite($handle, $line);

    }



