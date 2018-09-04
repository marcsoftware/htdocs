<?php include '../header.php';
?>
<html> 
<?php
	   
    //make the buttons
    //global var : mode
    function makeButtons($file){

        //  getTime($file,$folder,'read.php')
         $folder = '/timelines';
        $template = "            
                    <h5>$file</h5>
                    
                 
                   <a class='hyperlink' onclick=nextPage(this,'read.php') rel='$file' name='$folder'> read </a><br/>
                   <a class='hyperlink' onclick=nextPage(this,'study.php') rel='$file' name='$folder'> study </a><br/>
                   <a class='hyperlink' onclick=nextPage(this,'blurry.php') rel='$file' name='$folder'> blurry </a><br/>
                    ";
        
        echo $template;
    }

    makeButtons('21.txt');
?>  

<style>
    h5{
        background: linear-gradient(to right, navy ,navy, white);
        color:white;
        width:25%;
    }

    a{
        padding-left: 10px;
    }
    p{
        padding-left: 10px;   
    }
</style>

<script type='text/javascript'>


  main();
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //CALENDARY STUFF

    // show stats on a particular day.
    function showStats(handle,day,diffs){
       // console.log(day);
    }



    // selft study the selected day
    //param: color is a number, 1 is for red. 0 is for green
    function studyDay(handle,date,diffs,color){
        
        //console.log(handle.className );
        gotoCalendarPage(date,color);
    }


    // takes user to the special study page that has words form the database
    function gotoCalendarPage(date,color){
        
        setDate(date,color);
        
      
        //go to a new web page
        var page ="/Dropbox/pure_code/modes/de_selftest.php?fileName=getCalendarWords.php&folder=../pure_code/material/german/duolingo&mode=de_selftest.php&cleanup=0&block=4";

        window.location.href=page; 
        

    }



    	// this functin is called by an href element. that element has properties name and value
    // value should have the filename
    // name should be the filepath
    /// mode : global variable
    function nextPage(handle,mode,block_length=4){

        // these variables come from the href elements properties


        name = handle.rel;
        path = handle.name;

        //make url

        var page_template='/Dropbox/timeline_flashcards/modes/MODE?fileName=FILENAME&folder=PATH&mode=MODE&cleanup=0&block=BLOCK';
        var new_page = page_template.replace(/FILENAME/g,name);
        new_page = new_page.replace(/PATH/g,path);
        new_page = new_page.replace(/MODE/g,mode);
        new_page = new_page.replace(/BLOCK/g,block_length)
        //new_page = "http://127.0.1.1"+new_page;


        //go to a new web page

        window.location.href=new_page; 

        

    }


</script>
 

</html>