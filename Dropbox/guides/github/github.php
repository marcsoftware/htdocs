<?php session_start(); 
    if($_SESSION["customer_name"]){
        echo $_SESSION["customer_name"] . "<br/>";
    }
?>
<meta charset="UTF-8">
<html>
<title>german</title>
<?php include '../../header.php';?>
<?php include '../../pure_code/getUsersTime.php';?>

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


<br/><br/>



Read paper: 
<a href='https://lifehacker.com/5983680/how-the-heck-do-i-use-github'>Do this first : from lifehacker</a><br/><br/>
Interactive:
<a href='https://www.codecademy.com/courses/learn-git/lessons/git-workflow/exercises/git-add?action=lesson_resume'>codeacademy.com</a>
<a href='https://try.github.io/levels/1/challenges/1'>try.githubio</a>
<a href='https://www.codeschool.com/account'>codeschool</a>

<br/>
TYPE:<br/>
<a class="hyperlink" onclick="nextPage(this,'de_spell.php')" rel="try_git.txt" name="../pure_code/material/github">try_git.txt</a> <br/>
<a class="hyperlink" onclick="nextPage(this,'de_spell.php')" rel="git_real_manual.txt" name="../pure_code/material/github">git_real_manual.txt</a> <br/>
<a class="hyperlink" onclick="nextPage(this,'de_spell.php')" rel="more_git.txt" name="../pure_code/material/github">more_git.txt</a> <br/>





</html>