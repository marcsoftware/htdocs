<?php session_start(); 
    if($_SESSION["customer_name"]){
        echo $_SESSION["customer_name"] . "<br/>";
    }
?>
<meta charset="UTF-8">
<html>
<title>german stories</title>
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
    $folder = '../pure_code/material/german';
?>

<h5>A dual language youtube video: <a href='https://www.youtube.com/watch?v=IwUuBYrlYy0'>YOUTUBE LINK</a></h5>
step 1: audio not made yet.<br/>
step 2: audio not made yet.<br/>
step 3: <a class="hyperlink" onclick="nextPage(this,'de_easy_mc_smart.php')" rel="yt_german.txt" name="../pure_code/material/german">yt_german.txt</a><br/>
step 4: <a class="hyperlink" onclick="nextPage(this,'de_easy_blank_smart.php')" rel="yt_german.txt" name="../pure_code/material/german">yt_german.txt</a><br/>
 EDIT:
 <a class="hyperlink" onclick="nextPage(this,'de_edit.php')" rel="yt.csv" name="../pure_code/material/german">yt.csv</a>
 <?php getTime('yt.csv',$folder,'de_edit.php')?> <br/> 
----
<h5>short story: the kitchen clock</h5>

<a href='https://therhinocolumn.wordpress.com/2014/05/01/the-kitchen-clock/'>human translation</a><br/>
<a href='http://www.academia.edu/24526662/The_Kitchen_Clock_Die_K%C3%BCchenuhr_'> another human translation</a><br/>
<br/><br/>

1. retype the german words list. Show german word and then user types the word.When user begins typing hide the german word so that they have to sort of memorize it. <br/>
<a class="hyperlink" onclick="nextPage(this,'de_spell.php')" rel="vocab_list_no_eng.txt" name="../pure_code/material/german">vocab_list_no_eng.txt</a> 
 <?php getTime('vocab_list_no_eng.txt',$folder,'de_spell.php') ?> <br/> 

2. spelling test. Play a german word in audio file. User types the german word.The german word is never shown.<br/>
<a class="hyperlink" onclick="nextPage(this,'de_ear.php')" rel="vocab_list_no_eng.txt" name="../pure_code/material/german">vocab_list_no_eng.txt</a>
 <?php getTime('vocab_list_no_eng.txt',$folder,'de_ear.php')?> <br/> 

3. Show german word. And then user clicks the answere choice that is correct.<br/>
<a class="hyperlink" onclick="nextPage(this,'de_easy_mc.php')" rel="detoen.csv" name="../pure_code/material/german">detoen.csv</a>
 <?php getTime('detoen.csv',$folder,'de_easy_mc.php')?> <br/> 

4. Short ansere. user types in the translation of the word without the Multiple choice crutch.<br/>
<a class="hyperlink" onclick="nextPage(this,'de_easy_blank.php')" rel="detoen.csv" name="../pure_code/material/german">detoen.csv</a>
 <?php getTime('detoen.csv',$folder,'de_easy_blank.php')?> <br/> 

5. try to read short story.<br/>
<a class="hyperlink" onclick="nextPage(this,'de_read.php')" rel="full_story.csv" name="../pure_code/material/german">full_story.csv</a>
 <?php getTime('full_story.csv',$folder,'de_read.php')?> <br/> 

<br/><br/>
EDIT :
<br/>
<a class="hyperlink" onclick="nextPage(this,'de_edit.php')" rel="full_story.csv" name="../pure_code/material/german">full_story.csv</a>
 <?php getTime('full_story.csv',$folder,'de_edit.php')?> <br/> 


</html>