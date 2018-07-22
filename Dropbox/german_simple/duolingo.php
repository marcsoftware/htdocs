<?php session_start(); 
    if(isset($_SESSION["customer_name"])){
        echo $_SESSION["customer_name"] . "<br/>";
    


    //
    //create table if it doesn't already exsist
    $customer_name = $_SESSION["customer_name"];

    $dbname='flashcards';
    

    require_once('../passwords/db_const.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "CREATE TABLE $customer_name LIKE _clone_user";

    $result = $conn->query($sql);
}
    //make the buttons
    //global var : mode
    function makeButton($file){

    $tempalte = <<< EOF
    <p>Hello</p>
    
EOF;
        echo str_replace("world","Peter","Hello world!");
    }


    $folder = '../pure_code/material/german/duolingo';
    //make the buttons
    //global var : mode
    function makeButtons($file){

        //  getTime($file,$folder,'read.php')
        $folder = '../pure_code/material/german/duolingo';
        $template = "            
                    <h5>$file</h5>
                    <a class='hyperlink' onclick=nextPage(this,'read.php') rel='$file' name='$folder'> r</a><br/>
                    <a class='hyperlink' onclick=nextPage(this,'de_spell.php') rel='$file' name='$folder'> spell</a><br/>
                    STEP 1: multiple choice<br/>
                    <a class='hyperlink' onclick=nextPage(this,'de_easy_mc.php') rel='$file' name='$folder'> multichoice:pick english</a><br/>
                    <a class='hyperlink' onclick=nextPage(this,'de_easy_mc_reverse.php') rel='$file' name='$folder'>multichoice: pick german</a><br/>
                    STEP 2: short answerez<br/>
                    <a class='hyperlink' onclick=nextPage(this,'de_easy_blank.php') rel='$file' name='$folder'>type english</a><br/>
                    <a class='hyperlink' onclick=nextPage(this,'de_easy_blank_reverse_hint.php',6) rel='$file' name='$folder'>type german with hint 6</a>
                    <a class='hyperlink' onclick=nextPage(this,'de_easy_blank_reverse_hint.php',4) rel='$file' name='$folder'>4</a>
                    <a class='hyperlink' onclick=nextPage(this,'de_easy_blank_reverse_hint.php',2) rel='$file' name='$folder'>2</a>
                    <a class='hyperlink' onclick=nextPage(this,'de_easy_blank_reverse_hint.php',1) rel='$file' name='$folder'>1</a><br/>
                    <a class='hyperlink' onclick=nextPage(this,'de_easy_blank_reverse.php') rel='$file' name='$folder'>type german</a><br/>
                    <a class='hyperlink' onclick=nextPage(this,'de_selftest.php') rel='$file' name='$folder'>selftest</a><br/>
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
    }

    a{
        padding-left: 10px;
    }
    p{
        padding-left: 10px;   
    }
</style>
<title>german duolingo</title>
<?php include '../header.php';?>
<?php include '../pure_code/getUsersTime.php';?>


<script type='text/javascript'>
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //CALENDARY STUFF

    // show stats on a particular day.
    function showStats(handle,day,diffs){
        console.log(day);
    }



    // selft study the selected day
    //param: color is a number, 1 is for red. 0 is for green
    function studyDay(handle,date,diffs,color){

        console.log(handle.className );
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
        
alert('/Dropbox/pure_code/modes/setDate.php?date='+date+'&color='+color);
        xmlhttp.open("GET",'/Dropbox/pure_code/modes/setDate.php?date='+date+'&color='+color,false); // TODO This is badpractice. Turn false into true. //////
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


    window.onload = function(e){ 
        document.getElementById('focusstudy').addEventListener("click", function(){gotoFocusStudyPage(false)});
        document.getElementById('studyall').addEventListener("click", function(){gotoFocusStudyPage(true)}); 
    }

    // takes user to the special study page that has words form the database
    function gotoFocusStudyPage(all=false){
        var picked=[];     
        if(!all){
            //if user doesn't want to study all words
            var pickDiff = document.getElementsByName("pickDiff");

           
            for(var i=0;i<pickDiff.length;i++){

                if(pickDiff[i].checked){
                    picked.push(pickDiff[i].value);
                    
                }
            }
            

            
        }
        
        //set the session variable
         if(picked.length==0 || all==true){
                picked='ALL';
            }
            setFilter(picked);
        
        //go to a new web page
        var page ="/Dropbox/pure_code/modes/de_selftest.php?fileName=getFilterdWords.php&folder=../pure_code/material/german/duolingo&mode=de_selftest.php&cleanup=0&block=4";

        window.location.href=page; 
        

    }




        /**
        //---------------------------------------------------------------------
        // creates a SESSION varibles that hold the 'difficulties' that the user selected.
        //---------------------------------------------------------------------
        */
        function setFilter(picked){

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
            

            xmlhttp.open("GET",'/Dropbox/pure_code/modes/setFilter.php?diffs='+picked,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();
            
        }
</script>
<style>



		.hyperlink{
		    text-decoration: underline;
		    cursor: pointer;
		    color:blue;


		}

        h4{
            margin-bottom: 0px;
            padding-bottom: 0px;
            border:0px;
        }

        p{
            margin-top: 0px;
            padding-top: 0px;
            border:0px;
        }


        .red{
            background-color:red;
            color:white;
            width:50px; /* or whatever width you want. */
            max-width:50px; /* or whatever width you want. */
            display: inline-block;
            text-align: center;
            border-radius: 25px;
        }
        .green{
            background-color:green;
            color:white;
            width:50px; /* or whatever width you want. */
            max-width:50px; /* or whatever width you want. */
            text-align: center;
            padding-right: 5px;
            display: inline-block;
            margin-right:3px;
            border-radius: 25px;

        }
</style>

<h4>review words</h4>
select flashcards based on difficulty<br/>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// when user completes selfttest.php mode
// save words to database

//create table if it doesn't already exsist
if(isset($_SESSION["customer_name"])){
    $customer_name = $_SESSION["customer_name"];

    $dbname='flashcards';

    require_once('../passwords/db_const.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //get stats
    $sql = "SELECT difficulty,COUNT(*)
    FROM $customer_name      
    GROUP BY difficulty;";

    $result = $conn->query($sql);
    $response = $result->fetch_all(MYSQLI_ASSOC);

    for($i=0;$i<count($response);$i++){
        $number = ($response[$i]['difficulty']);
        echo "<input type='checkbox' name='pickDiff' value='$number'>";
        echo $number.'  =>';
        echo ($response[$i]['COUNT(*)']).'<br/>';
    }
}
?>
<input type='button' value='focus study' id='focusstudy' />
<input type='button' value='study all words' id='studyall' />



<h4>CALENDAR VIEW</h4>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// when user completes selfttest.php mode
// save words to database

//create table if it doesn't already exsist
if(isset($_SESSION["customer_name"])){
    $customer_name = $_SESSION["customer_name"];

    $dbname='flashcards';

    require_once('../passwords/db_const.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //get stats

    $customer_name_calendar= $customer_name . '_calendar';
    $sql = "SELECT *,COUNT(*)
    FROM $customer_name_calendar      
    GROUP BY first_look_date,difficulty";

    $result = $conn->query($sql);
    $response = $result->fetch_all(MYSQLI_ASSOC);

    $days = [];
    for($i=0;$i<count($response);$i++){
        $date = ($response[$i]['first_look_date']);

        $number = $response[$i]['COUNT(*)'];
        $diff = $response[$i]['difficulty'];
        
        if(!isset ($days[$date])){
            $days[$date]='';
        }
        $days[$date] .=$diff.':'.$number.'.';
    }

    echo '<br/>';

    foreach ($days as $i => $diffs) {
        $diffs_array = explode('.',$diffs);
        
        $total=0;
        $green_total=0;
        foreach ($diffs_array as $j => $diff_string) {
            
            $both = explode(':', $diff_string);
            if(isset($both[1])){
               $total+=( $both[1]);
            }

            if($j == 0){
                $green_total = $both[1];
            }
        }

$red_total = $total-$green_total;

        echo "<p onmouseover=showStats(this,'".$i."','".$diffs."')>$i <span class='green' onclick=studyDay(this,'".$i."','".$diffs."',0)>
                    $green_total</span><span class=red onclick=studyDay(this,'".$i."','".$diffs."',1)>$red_total</span></p>"; 
        
    }    
}
?>




<h4>learn new words</h4>
<?php
    $folder = '../pure_code/material/german/duolingo';
    $file = 'tinycards-test1.txt';
    makeButtons('tinycards-test1.txt');
    makeButtons('tinycards-test2.txt');
    makeButtons('tinycards-test3.txt');
    makeButtons('tinycards-test4.txt');
    
    
?>



<hr>
<h4>Duolingo flashcards</h4>
 <?php
    
    $file = 'test1-spelling.txt';
?>
<h5>spelling</h5>
test1:<br/>
<a class="hyperlink" onclick="nextPage(this,'de_spell.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">muscle memory</a>
 <?php getTime($file,$folder,'de_spell.php')?> <br/> 
<a class="hyperlink" onclick="nextPage(this,'de_ear.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">spelling test</a>
 <?php getTime($file,$folder,'de_ear.php')?> <br/> 

 <?php
    
    $file = 'test2-spelling.txt';
?>
test2:<br/>
<a class="hyperlink" onclick="nextPage(this,'de_spell.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">muscle memory</a>
 <?php getTime($file,$folder,'de_spell.php')?> <br/> 
<a class="hyperlink" onclick="nextPage(this,'de_ear.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">spelling test</a>
 <?php getTime($file,$folder,'de_ear.php')?> <br/> 

  <?php
    
    $file = 'test3-spelling.txt';
?>
test2:<br/>
<a class="hyperlink" onclick="nextPage(this,'de_spell.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">muscle memory</a>
 <?php getTime($file,$folder,'de_spell.php')?> <br/> 
<a class="hyperlink" onclick="nextPage(this,'de_ear.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">spelling test</a>
 <?php getTime($file,$folder,'de_ear.php')?> <br/> 


 <?php
    
    $file = 'charts-test1.txt';
?>
<h5> charts</h5>
<p>
STEP 1: multiple choice<br/> 
<a class="hyperlink" onclick="nextPage(this,'de_easy_mc.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">multichoice</a>
 <?php getTime($file,$folder,'de_easy_mc.php')?> <br/> 

STEP 2: short answere---------------------<br/> 
<a class="hyperlink" onclick="nextPage(this,'de_easy_blank.php')" rel="<?php  echo $file ;?>"name="<?php  echo $folder ;?>">easy blank type english</a>
 <?php getTime($file,$folder,'de_easy_blank.php')?> <br/> 
   <a class="hyperlink" onclick="nextPage(this,'de_easy_blank_reverse_hint.php',4)" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">easy type german with hints</a>
 <?php getTime($file,$folder,'de_easy_blank_reverse_hint.php')?> <br/> 
 <a class="hyperlink" onclick="nextPage(this,'de_easy_blank_reverse.php')" rel="<?php  echo $file ;?>" name="<?php  echo $folder ;?>">type german</a>
 <?php getTime($file,$folder,'de_easy_blank_reverse.php')?> 

<p>


</html>