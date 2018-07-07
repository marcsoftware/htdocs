<?php session_start(); 
    if($_SESSION["customer_name"]){
        echo $_SESSION["customer_name"] . "<br/>";
    }

$folder = '../pure_code/material/timelines';
    //make the buttons
    //global var : mode
    function makeButtons($file){

        //  getTime($file,$folder,'read.php')
        $folder = '../pure_code/material/timelines';
        $template = "            
                    <h5>$file</h5>
                    <a class='hyperlink' onclick=nextPage(this,'read.php') rel='$file' name=$folder>read</a><br/>
                    <a class='hyperlink' onclick=nextPage(this,'code_type.php') rel='$file' name=$folder>type</a>
                     
    
                    ";
        
        echo $template;
    }
?>
<meta charset="UTF-8">
<html>
<style>
    h5{
        background: linear-gradient(to right, navy ,navy, white);
        color:white;
        width:25%;
        margin:0;
        margin-top: 5px;
    }

    a{
        padding-left: 10px;
    }
    p{
        padding-left: 10px;   
    }
</style>
<title>timelines</title>
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
        var page_template='/Dropbox/pure_code/modes/MODE?fileName=FILENAME&folder=PATH&mode=MODE&cleanup=0';
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

makeButtons('timeline_of_human_prehistory.txt');
makeButtons('ancient.txt');
makeButtons('timeline_of_middleages.txt');
    
    

?>






</html>