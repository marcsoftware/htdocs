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



function openTab(ref) {
  
  tabName=ref.innerHTML;
  var i;
  var x = document.getElementsByClassName("tab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(tabName).style.display = "block";  
}


window.onload = function() {
  openTab(document.getElementById('start'));
};

</script>











  

<body>

<div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button"  id='start' onclick="openTab(this)">1</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">2</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">3</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">4a</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">4b</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">5</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">6</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">7</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">8</button>
  <button class="w3-bar-item w3-button" onclick="openTab(this)">all</button>
</div>


<div class='tab' id='1'>
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
<div class='tab' id='2'>
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
</div >
<div class='tab' id='3'> 
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
<div class='tab' id='4a'>
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
<div class='tab' id='4b'>
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
<div class='tab' id='5'>
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
<div class='tab' id='6'>
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
<div class='tab' id='7'>
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
<div class='tab' id='8'>
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
<div class='tab' id='all' >
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