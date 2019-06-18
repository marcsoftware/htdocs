<?php include '../header.php';?>
<?php 

   $completed='';


    if(isset($_SESSION["customer_name"])){
     
    


    //
    //create table if it doesn't already exsist
     $customer_name = $_SESSION["customer_name"];

    $dbname='flashcards';
    

    require_once('../passwords/db_const.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "CREATE TABLE $customer_name LIKE _clone_user";

    $result = $conn->query($sql);

    getCompleted();
}


//get list of all tast the user completed from the database



function getCompleted(){
  global $servername;
  global $username;
  global $password;
  global $customer_name;
  global $completed;
 
   

  $conn = new mysqli($servername, $username, $password, 'flashcards');
    
  $sql = "SELECT * from completed where user='$customer_name' ;";

  
  $result = $conn->query($sql);


  while($row = $result->fetch_assoc()) {
      
      

     ($completed.= $row["chapter"].",".$row["mode"]);
   }
 
  
}




    $folder = '../pure_code/material/german/duolingo';
    //make the buttons
    //global var : mode
    function makeButtons($file,$id){

        //  getTime($file,$folder,'read.php')


        $check_list=array(); // contains a checkmark for each item the user completed
        $check_list[0]=isCompleted($file,'multichoice.php');
        $check_list[1]=isCompleted($file,'de_selftest.php');
        $check_list[2]=isCompleted($file,'learnspell.php');
        $check_list[3]=isCompleted($file,'de_selftest_reverse.php');
        $check_list[4]=isCompleted($file,'testvocab.php');
        $folder = '../pure_code/material/german/duolingo';
        $template = "
                  <div class='tab' id='$id'>
                  <h5>$file</h5>
                   read german: 

                  
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'multichoice.php') rel='$file' name='$folder'>multichoice $check_list[0]</a>
                  <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest.php') rel='$file' name='$folder'>selftest $check_list[1]</a>
                  

                    <br/>
                    
                    type german:
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'learnspell.php') rel='$file' name='$folder'>audio $check_list[2]</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'de_selftest_reverse.php') rel='$file' name='$folder'>selfttest $check_list[3]</a>
                    <a class='btn btn-4 btn-4a icon-arrow-right' onclick=nextPage(this,'testvocab.php') rel='$file' name='$folder'>blank $check_list[4]</a>
</div>
                    ";
        
        echo $template;
    }


    function isCompleted($file,$mode){
      
       global $completed;
      
      if (strpos($completed, $file.','.$mode) !== false) {
    
    return  'true⭐️';
}
       return 'false';
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

  .big{
    font-size: 20px;
  }

  body{
     background-color: #2ECC71;
     background-color: white;
  }
    h5{
        
        color:red;
        
        padding:0px;

        margin:0px;
    }

  
    p{
        
  
        display: block;
        margin:auto;
        float:none;
        text-align: left;
       
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
  color:black;
  padding-bottom:5px;
  width:30%;
  margin:auto;
  padding-top: 2px;
  padding-left: 2px;
   
    border-color: #2ECC71;
    border-bottom-color: black;
    margin-top:0px;
  
}
.tab:hover{

}


.tabBar{
  border-style: none;

}


.tab_button{
  background-color: black;
  color:white;
  margin:0;
  width: 9%;
  border-style: none;
  border-color: black;
  padding: 0;
}



.clicked{
  background-color:white;
  color:red;
  border-top-color: red;
  border-top-style: solid;
}

 

</style>
<link rel="stylesheet" type="text/css" href="component.css">
<title>german duolingo</title>

<?php include '../pure_code/getUsersTime.php';?>


<script type='text/javascript'>

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

function openTab(ref) {
  
  tabName=ref.innerHTML;
  var i;
  var x = document.getElementsByClassName("tab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }

  var x = document.getElementsByClassName("clicked");
  for (i = 0; i < x.length; i++) {
    x[i].classList.remove('clicked');
  }
  ref.classList.add('clicked');

  document.getElementById(tabName).style.display = "block";  
}



window.onload = function() {
  openTab(document.getElementById('start'));
};

function getCheckmark(handle,mode){
  
  handle.innerHTML+= '<span class="big"> 🌟</span>';
  

}

</script>











  

<body>

<div class="w3-bar w3-black tabBar" >
  <button class="w3-bar-item w3-button tab_button"  id='start' onclick="openTab(this)">1</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">2</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">3</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">4a</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">4b</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">5</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">6</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">7</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">8</button>
  <button class="w3-bar-item w3-button tab_button" onclick="openTab(this)">all</button>
</div>
<?php
    $folder = '../pure_code/material/german/duolingo';
    $file = 'tinycards-test1.txt';
    makeButtons('tinycards-test1.txt','1');
    
    

    makeButtons('tinycards-test2.txt','2');
    
    

    makeButtons('tinycards-test3.txt','3');
    
    
    
    makeButtons('tinycards-test4a.txt','4a');
    makeButtons('tinycards-test4b.txt','4b');
    

    makeButtons('tinycards-test5.txt','5');
    
    
    makeButtons('tinycards-test6.txt','6');
    makeButtons('tinycards-test7.txt','7');
    makeButtons('tinycards-test8.txt','8');
    makeButtons('all-german-words.txt','all');
    
    
    
?>


</body>
</html>