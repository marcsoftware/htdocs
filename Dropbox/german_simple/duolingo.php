<?php include '../header.php';?>
<?php 

  
    if(isset($_SESSION["customer_name"])){
     
    


    //
    //create table if it doesn't already exsist
    $customer_name = $_SESSION["customer_name"];

    $dbname='flashcards';
    

    require_once('../passwords/db_const.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "CREATE TABLE $customer_name LIKE _clone_user";

    $result = $conn->query($sql);
}


    $folder = '../pure_code/material/german/duolingo';
    //make the buttons
    //global var : mode
    function makeButtons($file){

        //  getTime($file,$folder,'read.php')
        $folder = '../pure_code/material/german/duolingo';
        $template = "<h5>$file</h5>
                   read german: 

                  <a class='hyperlink' onclick=nextPage(this,'base.php') rel='$file' name='$folder'>racetrack</a>
                  <a class='hyperlink' onclick=nextPage(this,'multichoice.php') rel='$file' name='$folder'>multichoice</a>
                  <a class='hyperlink' onclick=nextPage(this,'de_selftest.php') rel='$file' name='$folder'>selftest</a>
                  <a class='hyperlink' onclick=nextPage(this,'read.php') rel='$file' name='$folder'> r</a>

                    <br/>
                    
                    type german:
                    <a class='hyperlink' onclick=nextPage(this,'learnspell.php') rel='$file' name='$folder'>audio</a>
                    <a class='hyperlink' onclick=nextPage(this,'typetrack.php') rel='$file' name='$folder'>typetrack</a>
                    <a class='hyperlink' onclick=nextPage(this,'de_selftest_reverse.php') rel='$file' name='$folder'>selfttest</a>
                    <a class='hyperlink' onclick=nextPage(this,'testvocab.php') rel='$file' name='$folder'>blank</a>

                    ";
        
        echo $template;
    }


    function makeOtherButtons($file){

        //  getTime($file,$folder,'read.php')
        $folder = '../pure_code/material/german/duolingo';
        $template = "            
                    <br/>grammar:
                    <a class='hyperlink' onclick=nextPage(this,'grammarButtons.php') rel='$file' name='$folder'>buttons</a>
                    <a class='hyperlink' onclick=nextPage(this,'grammarBlank.php') rel='$file' name='$folder'>blank</a>
                    
                   
                    
                    ";
        
        echo $template;
    }


    function makeSenButtons($file){

        //  getTime($file,$folder,'read.php')
        $folder = '../pure_code/material/german/duolingo';
        $template = "            
                    <br/>sentences:
                    <a class='hyperlink' onclick=nextPage(this,'grammartrack.php') rel='$file' name='$folder'>gtrack</a>
                    <a class='hyperlink' onclick=nextPage(this,'grammarBlank.php') rel='$file' name='$folder'>blank</a>
                    
                   
                    
                    ";
        
        echo $template;
    }

?>
<meta charset="UTF-8">
<html>
<style>

  body{
     background-color: #2ECC71;
     background-color: white;
  }
    h5{
        
        color:#299F2B;
        
        padding:0px;

        margin:0px;
    }

  
    p{
        
  
        display: block;
        margin:auto;
        float:none;
        text-align: center;
       
    }


        .hyperlink{
            text-decoration: underline;
            cursor: pointer;
            color:black;
 background-color: #09770B;
  border: none;
 
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  width: 25%;
  line-height: 0px;
  margin:auto;
  margin-bottom: 5px;
  padding-left: 10px;
        display: block;


        }
  a:hover {
    background-color: #299F2B;
    color:white;
  }


div{
  color:white;
  padding-bottom:5px;
  width:30%;
  margin:auto;
  padding-top: 2px;
  padding-left: 2px;
    border-style: dashed;
    border-color: #2ECC71;
    border-bottom-color: black;
  
}
div:hover{
  border-style: dashed;
  border-color: black;
}


 

</style>
<link rel="stylesheet" type="text/css" href="component.css">
<title>german duolingo</title>

<?php include '../pure_code/getUsersTime.php';?>


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


    /**
    //---------------------------------------------------------------------
    // creates a SESSION varibles that hold the 'day' that the user clicked on calendar
    //---------------------------------------------------------------------
    */
    function setDate(date,color){

        var xmlhttp;    
        
        if (window.XMLHttpRequest){
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else{
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders
                 
                //alert(xmlhttp.responseText);
                
            }
        }



        //TODO pass the global var date
        

        xmlhttp.open("GET",'/Dropbox/pure_code/modes/setDate.php?date='+date+'&color='+color,false); // TODO This is badpractice. Turn false into true. //////
        xmlhttp.send();
        
    }


   /**
    //---------------------------------------------------------------------
    // empty table
    //---------------------------------------------------------------------
    */
    function emptyTable(){

        var xmlhttp;    
        
        if (window.XMLHttpRequest){
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else{
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders
                 
                //alert(xmlhttp.responseText);
                
            }
        }



        //TODO pass the global var date
        

        xmlhttp.open("GET",'/Dropbox/pure_code/emptyTable.php',false); // TODO This is badpractice. Turn false into true. //////
        xmlhttp.send();
        
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
</script>

<script type='text/javascript'>
	// this functin is called by an href element. that element has properties name and value
    // value should have the filename
    // name should be the filepath
    /// mode : global variable
    function nextPage(handle,mode,block_length=4){

        // these variables come from the href elements properties


        name = handle.rel;
        path = handle.name;

        //make url

        var page_template='/Dropbox/pure_code/modes/MODE?fileName=FILENAME&folder=PATH&mode=MODE&cleanup=0&block=BLOCK';
        var new_page = page_template.replace(/FILENAME/g,name);
        new_page = new_page.replace(/PATH/g,path);
        new_page = new_page.replace(/MODE/g,mode);
        new_page = new_page.replace(/BLOCK/g,block_length)
        //new_page = "http://127.0.1.1"+new_page;


        //go to a new web page

        window.location.href=new_page; 

        

    }




 
</script>









  

<body>



<h4>learn new words</h4>
<div>
<h5>Part 1</h5>
             <p>     
                  
   read german: <br/>
                  
                  <a  class='btn btn-4 btn-4a icon-arrow-right' onclick='nextPage(this,"base.php")' rel='tinycards-test1.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick='nextPage(this,"multichoice.php")' rel='tinycards-test1.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick='nextPage(this,"de_selftest.php")' rel='tinycards-test1.txt' name='../pure_code/material/german/duolingo'>selftest</a>
                

                    <br/>
               
                    type german:<br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick='nextPage(this,"learnspell.php")' rel='tinycards-test1.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick='nextPage(this,"typetrack.php")' rel='tinycards-test1.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick='nextPage(this,"de_selftest_reverse.php")' rel='tinycards-test1.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick='nextPage(this,"testvocab.php")' rel='tinycards-test1.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>tinycards-test2.txt</h5>
<p>
                   read german:  <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='tinycards-test2.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='tinycards-test2.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='tinycards-test2.txt' name='../pure_code/material/german/duolingo'>selftest</a>
                 

                    <br/>
                    
                    type german: <br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='tinycards-test2.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='tinycards-test2.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='tinycards-test2.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='tinycards-test2.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>tinycards-test3.txt</h5>
                    <p>
                   read german:       <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='tinycards-test3.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='tinycards-test3.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='tinycards-test3.txt' name='../pure_code/material/german/duolingo'>selftest</a>
                  

                    <br/>
                    
                    type german:      <br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='tinycards-test3.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='tinycards-test3.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='tinycards-test3.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='tinycards-test3.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>tinycards-test4a.txt</h5>
                    <p>
                   read german:       <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='tinycards-test4a.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='tinycards-test4a.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='tinycards-test4a.txt' name='../pure_code/material/german/duolingo'>selftest</a>
               

                    <br/>
                    
                    type german: <br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='tinycards-test4a.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='tinycards-test4a.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='tinycards-test4a.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='tinycards-test4a.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>tinycards-test4b.txt</h5>
                    <p>
                   read german:       <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='tinycards-test4b.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='tinycards-test4b.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='tinycards-test4b.txt' name='../pure_code/material/german/duolingo'>selftest</a>
               

                    <br/>
                    
                    type german:<br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='tinycards-test4b.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='tinycards-test4b.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='tinycards-test4b.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='tinycards-test4b.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>tinycards-test5.txt</h5>
                    <p>
                   read german: <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='tinycards-test5.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='tinycards-test5.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='tinycards-test5.txt' name='../pure_code/material/german/duolingo'>selftest</a>
              

                    <br/>
                    
                    type german:<br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='tinycards-test5.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='tinycards-test5.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='tinycards-test5.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='tinycards-test5.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>tinycards-test6.txt</h5>
                    <p>
                   read german: <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='tinycards-test6.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='tinycards-test6.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='tinycards-test6.txt' name='../pure_code/material/german/duolingo'>selftest</a>
        

                    <br/>
                    
                    type german:<br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='tinycards-test6.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='tinycards-test6.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='tinycards-test6.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='tinycards-test6.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>tinycards-test7.txt</h5>
                    <p>
                   read german: <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='tinycards-test7.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='tinycards-test7.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='tinycards-test7.txt' name='../pure_code/material/german/duolingo'>selftest</a>
           

                    <br/>
                    
                    type german:<br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='tinycards-test7.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='tinycards-test7.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='tinycards-test7.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='tinycards-test7.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>tinycards-test8.txt</h5>
                    <p>
                   read german: <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='tinycards-test8.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='tinycards-test8.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='tinycards-test8.txt' name='../pure_code/material/german/duolingo'>selftest</a>
             

                    <br/>
                    
                    type german:<br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='tinycards-test8.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='tinycards-test8.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='tinycards-test8.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='tinycards-test8.txt' name='../pure_code/material/german/duolingo'>blank</a>
</p>
</div>
<div>
                    <h5>all-german-words.txt</h5>
                    <p>
                   read german: <br/>

                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'base.php') rel='all-german-words.txt' name='../pure_code/material/german/duolingo'>racetrack</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='all-german-words.txt' name='../pure_code/material/german/duolingo'>multichoice</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='all-german-words.txt' name='../pure_code/material/german/duolingo'>selftest</a>
           

                    <br/>
                    
                    type german:<br/>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='all-german-words.txt' name='../pure_code/material/german/duolingo'>audio</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'typetrack.php') rel='all-german-words.txt' name='../pure_code/material/german/duolingo'>typetrack</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='all-german-words.txt' name='../pure_code/material/german/duolingo'>selfttest</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='all-german-words.txt' name='../pure_code/material/german/duolingo'>blank</a>

         </p>           

</div>

</body>
</html>