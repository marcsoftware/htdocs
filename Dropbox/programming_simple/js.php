<?php session_start(); 
    if($_SESSION["customer_name"]){
        echo $_SESSION["customer_name"] . "<br/>";
    }
?>
<meta charset="UTF-8">
<html>
<title>JS:NOTES</title>
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

Read:
<a href='https://github.com/getify/You-Dont-Know-JS'>You don't know JS</a> 2017<br/>
<a href='https://github.com/getify/You-Dont-Know-JS/blob/master/up%20%26%20going/ch1.md'>chapter 1</a><br/>
PART1: CH1 CH2 CH3 CH4 CH5
<br/>----<br/>
1. Just re-type the code snippets<br/>
<a class="hyperlink" onclick="nextPage(this,'code_type.php')" rel="ch1.txt" name="../pure_code/material/you_dont_know_js">ch1 type</a>
<?php getTime('ch1.txt','../pure_code/material/you_dont_know_js','code_type')?> <br/> 




</html>