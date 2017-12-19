<?php session_start(); 
    if($_SESSION["customer_name"]){
        echo $_SESSION["customer_name"] . "<br/>";
    }
?>
<meta charset="UTF-8">
<html>
<title>german duolingo</title>
<?php include '../header.php';?>
<?php include '../pure_code/getUsersTime.php';?>

<script type='text/javascript'>
	// this functin is called by an href element. that element has properties name and value
    // value should have the filename
    // name should be the filepath
    /// mode : global variable
    function nextPage(handle,mode){

        // these variables come from the href elements properties


        name = handle.rel;
        path = handle.name;

        //make url
        var page_template='/Dropbox/pure_code/modes/MODE?fileName=FILENAME&folder=PATH&mode=MODE';
        var new_page = page_template.replace(/FILENAME/g,name);
        new_page = new_page.replace(/PATH/g,path);
        new_page = new_page.replace(/MODE/g,mode);
        //new_page = "http://127.0.1.1"+new_page;


        //go to a new web page

        window.location.href=new_page; 

        

    }
</script>
<style>



		.hyperlink{
		    text-decoration: underline;
		    cursor: pointer;
		    color:blue;


		}


</style>



<?php
    $folder = '../pure_code/material/german/duolingo';
    $file = 'basics1.txt';
?>

<?php  $folder ;?>

<h4>Duolingo flashcards</h4>
<h5>basics 1</h5>

STEP 1: multiple choice
<a class="hyperlink" onclick="nextPage(this,'de_easy_mc.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>"><?php  echo $file ;?></a>
 <?php getTime($file,$folder,'de_easy_mc.php')?> <br/> 

STEP 2: short answere
<a class="hyperlink" onclick="nextPage(this,'de_easy_blank.php')" rel="<?php  echo $file ;?>"name="<?php  echo $folder ;?>"><?php  echo $file ;?></a>
 <?php getTime($file,$folder,'de_easy_blank.php')?> <br/> 

<h5>basics 2</h5>

<?php
    
    $file = 'basics2.txt';
?>

STEP 1: multiple choice
<a class="hyperlink" onclick="nextPage(this,'de_easy_mc.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>"><?php  echo $file ;?></a>
 <?php getTime($file,$folder,'de_easy_mc.php')?> <br/> 

STEP 2: short answere
<a class="hyperlink" onclick="nextPage(this,'de_easy_blank.php')" rel="<?php  echo $file ;?>"name="<?php  echo $folder ;?>"><?php  echo $file ;?></a>
 <?php getTime($file,$folder,'de_easy_blank.php')?> <br/> 

<h5>common phrases</h5>
<?php
    
    $file = 'common_phrases.txt';
?>

STEP 1: multiple choice
<a class="hyperlink" onclick="nextPage(this,'de_easy_mc.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>"><?php  echo $file ;?></a>
 <?php getTime($file,$folder,'de_easy_mc.php')?> <br/> 

STEP 2: short answere
<a class="hyperlink" onclick="nextPage(this,'de_easy_blank.php')" rel="<?php  echo $file ;?>"name="<?php  echo $folder ;?>"><?php  echo $file ;?></a>
 <?php getTime($file,$folder,'de_easy_blank.php')?> <br/> 

<h5> Accusative Case</h5>
 <?php
    
    $file = 'accusative_case.txt';
?>
STEP 1: multiple choice
<a class="hyperlink" onclick="nextPage(this,'de_easy_mc.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>"><?php  echo $file ;?></a>
 <?php getTime($file,$folder,'de_easy_mc.php')?> <br/> 

STEP 2: short answere
<a class="hyperlink" onclick="nextPage(this,'de_easy_blank.php')" rel="<?php  echo $file ;?>"name="<?php  echo $folder ;?>"><?php  echo $file ;?></a>
 <?php getTime($file,$folder,'de_easy_blank.php')?> <br/> 


</html>