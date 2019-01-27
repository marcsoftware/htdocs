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
                    <a class='hyperlink' onclick=nextPage(this,'de_selftest.php') rel='$file' name='$folder'>selftest</a><a class='hyperlink' onclick=nextPage(this,'read.php') rel='$file' name='$folder'> r</a>

                    
                    <br/>type german:
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


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
var htmlContent = "";
var FebNumberOfDays = "";
var counter = 1;

var dateNow = new Date();
var month = dateNow.getMonth();
var curMonth = month;
var day = dateNow.getDate();
var year = dateNow.getFullYear();
var curYear = year;

// names of months and week days.
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday"];
var dayPerMonth = ["31", "" + FebNumberOfDays + "", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31"];

function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

// days in previous month and next one , and day of week.
var nextDate, weekdays, weekdays2, numOfDays, nextMonth, prevMonth;

//to set the correct htmlContent
function getCal() {
        //TODO wrap contents here

 //TODO pass the global var date123456789
            php_calendar = [];
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

        
        

       echo "php_calendar['$i']='$diffs';";
        
    }    
}

?>


 

  htmlContent = "";
  nextMonth = month + 1; //+1; //Used to match up the current month with the correct start date.
  prevMonth = month - 1;
  counter = 1;


  //Determing if February (28,or 29)  
  if (month == 1) {
    if ((year % 100 != 0) && (year % 4 == 0) || (year % 400 == 0)) {
      FebNumberOfDays = 29;
    } else {
      FebNumberOfDays = 28;
    }
  }


  // names of months and week days.
  monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday"];
  dayPerMonth = ["31", "" + FebNumberOfDays + "", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31"];

  // days in previous month and next one , and day of week.
  nextDate = new Date(nextMonth + ' 1 ,' + year);
  weekdays = nextDate.getDay();
  weekdays2 = weekdays;
  numOfDays = dayPerMonth[month];

  // this leave a white space for days of pervious month.
  while (weekdays > 0) {
    htmlContent += "<td class='monthPre'></td>";

    // used in next loop.
    weekdays--;
  }

  // loop to build the calander body.
  while (counter <= numOfDays) {

    // When to start new line.
    if (weekdays2 > 6) {
      weekdays2 = 0;
      htmlContent += "</tr><tr>";
    }

    //TODO create the look up string
    var lookup = ( curYear+'/'+padDigits(month+1,2)+'/'+padDigits(counter,2));
     
    
    var contents='';
    if(php_calendar[lookup] ==  void 0){
        
    }else{
        
        contents = php_calendar[lookup] ;
    }
    

    // if counter is current day.
    // highlight current day using the CSS defined in header.
    i=lookup;
    diffs=php_calendar[lookup];
    
    green_total=0;
    red_total=0;

    if(diffs !== void 0){
       var both=simplifyDiffs(diffs);
       green_total=both[0];
       red_total=both[1];
    }
    var template = `<p onmouseover=showStats(this,'${i}','${diffs}'')>
                    <span class='green' onclick=studyDay(this,'${i}','${diffs}',0)>${green_total}</span> <br/>\
                    <span class=red onclick=studyDay(this,'${i}','${diffs}',1)>${red_total} </span></p>`;
    //var blank = "<p onmouseover=showStats(this,'"+i+"','"+diffs+"')>$i <span class='green' onclick=studyDay(this,'"+i+"','"+diffs+"',0)> green_total</span> \
    //             <span class=red onclick=studyDay(this,'"+i+"','"+diffs+"',1)>$red_total</span></p>";
    
    if(green_total !=0 || red_total !=0){
     contents = template;
    }else{

    }

    if (counter == day && month == curMonth && year == curYear) {
      htmlContent += "<td class='dayNow'  onMouseOver='this.style.background=\"#FF0000\"; this.style.color=\"#FFFFFF\"' " +
        "onMouseOut='this.style.background=\"#FFFFFF\"; this.style.color=\"#FF0000\"'>" + counter +contents +"</td>";
    } else {
      htmlContent += "<td class='monthNow' onMouseOver='this.style.background=\"#FF0000\"'" +
        " onMouseOut='this.style.background=\"#FFFFFF\"'>" + counter +contents +"</td>";

    }

    weekdays2++;
    counter++;
  }
}

//turn the diff string into simplified form
// eg 0:1.1:1.2:3 becomes [1,4]

function  simplifyDiffs(diff_string){
    var diff_array 
    diffs_array = diff_string.split('.');
     diffs_array.pop(); //delete the last element since it is always empty   
    total=0;
    green_total=0;
    red_total=0;
    //for (diffs_array as $j => $diff_string) {
    for (var i =0;i<diffs_array.length;i++) {          
        
        diff_element = diffs_array[i];
        
        both = diff_element.split(':');
        
        if(both[1] != void 0){
           both[1] =parseInt(both[1]); 
           
           total+=( both[1]);
        }

        if(both[0] == 0 ){
            green_total = parseInt(both[1]);
        }
    }

    red_total = total-green_total;
    
    return [green_total,red_total];
}


function displayCalendar() {

  getCal(); // to get the htmlContent

  // building the calendar html body.
  var calendarBody = "<table class='calendar'> <tr class='monthNow'><th colspan='7'>" +
    monthNames[month] + " " + year + "</th></tr>";
  calendarBody += "<tr class='dayNames'>  <td>Sun</td>  <td>Mon</td> <td>Tues</td>" +
    "<td>Wed</td> <td>Thurs</td> <td>Fri</td> <td>Sat</td> </tr>";
  calendarBody += "<tr>";
  calendarBody += htmlContent;
  calendarBody += "</tr></table>";
  // set the content of div .
  document.getElementById("calendar").innerHTML = calendarBody;

}

function next() {

  if(month+1==12){
    ++year;
    month=-1;
  }

  var calendarBody = "<table class='calendar'> <tr class='monthNow'><th colspan='7'>" +
    monthNames[++month] + " " + year + "</th></tr>";
  calendarBody += "<tr class='dayNames'>  <td>Sun</td>  <td>Mon</td> <td>Tues</td>" +
    "<td>Wed</td> <td>Thurs</td> <td>Fri</td> <td>Sat</td> </tr>";
  calendarBody += "<tr>";

  getCal(); // to get the htmlContent

  calendarBody += htmlContent;
  calendarBody += "</tr></table>";
  // set the content of div .
  document.getElementById("calendar").innerHTML = calendarBody;

}

function prev() {
  if(month-1==-1){
    --year;
    month=12;
  }

  var calendarBody = "<table class='calendar'> <tr class='monthNow'><th colspan='7'>" +
    monthNames[--month] + " " + year + "</th></tr>";
  calendarBody += "<tr class='dayNames'>  <td>Sun</td>  <td>Mon</td> <td>Tues</td>" +
    "<td>Wed</td> <td>Thurs</td> <td>Fri</td> <td>Sat</td> </tr>";
  calendarBody += "<tr>";

  getCal(); // to get the htmlContent

  calendarBody += htmlContent;
  calendarBody += "</tr></table>";
  // set the content of div .
  document.getElementById("calendar").innerHTML = calendarBody;

}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    window.onload = function(e){ 
        document.getElementById('focusstudy').addEventListener("click", function(){gotoFocusStudyPage(false)});
        document.getElementById('studyall').addEventListener("click", function(){gotoFocusStudyPage(true)}); 
        displayCalendar();
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


        td{
            height:30px;
            width:100px;
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

        echo "<p onmouseover=showStats(this,'$i','$diffs')>$i <span class='green' onclick=studyDay(this,'${i}','$diffs',0)>
                    $green_total</span><span class=red onclick=studyDay(this,'$i','$diffs',1)>$red_total</span></p>"; 
        
    }    
}
?>


<button class='btns' onclick=prev()>Prev</button>
<button style=margin-left:3.25%; class='btns' onclick=next()>Next</button>

  <div id="calendar"></div>


<h4>learn new words</h4>
<?php
    $folder = '../pure_code/material/german/duolingo';
    $file = 'tinycards-test1.txt';
    makeButtons('tinycards-test1.txt');
    makeOtherButtons('grammar1.txt');
    makeSenButtons('grammar1s.txt');

    makeButtons('tinycards-test2.txt');
    makeOtherButtons('grammar2.txt');
    makeSenButtons('grammar2s.txt');

    makeButtons('tinycards-test3.txt');
    makeOtherButtons('grammar3.txt');
    makeSenButtons('grammar3s.txt');
    
    makeButtons('tinycards-test4a.txt');
    makeButtons('tinycards-test4b.txt');
    makeOtherButtons('grammar4.txt');

    makeButtons('tinycards-test5.txt');
    makeOtherButtons('grammar9a.txt');
    
    makeButtons('tinycards-test6.txt');
    makeButtons('tinycards-test7.txt');
    makeButtons('tinycards-test8.txt');
    makeButtons('all-german-words.txt');
    makeOtherButtons('grammar9.txt');
    
    
?>


</html>