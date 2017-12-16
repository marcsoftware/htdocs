<?php
    /**
    //-----------------------------------------------------
    // File:        lookup.php
    // Description: looks up the translations of german words and returns their english synonym(s).
    //              
    // param  (string)   ($german)  a german word
    // return (string)   a lost of english words separated with a ':' character.
    //-----------------------------------------------------
    */

    
    $german = ($_GET["german"]);

    $german=strtolower($german);

    $file = 'smallDictionary.csv';
    $searchfor = $german;

    // the following line prevents the browser from parsing this as HTML.
    header('Content-Type: text/plain');

    // get the file contents, assuming the file to be readable (and exist)
    $contents = file_get_contents($file);
    // escape special characters in the query
    $pattern = preg_quote($searchfor, '/');
    // finalise the regular expression, matching the whole line
    $pattern = "/^$pattern\b.*\$/mi";
    // search, and store all matching occurences in $matches
    if(preg_match_all($pattern, $contents, $matches)){  //returns one match. preg_match_all() would return all matches.
       
       echo implode(":", $matches[0]); //returns all matches
       
    }
    else{
       echo "?"; //No match found
    }

              