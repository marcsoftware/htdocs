<!-- this file handles the actually typeing game-->
<!DOCTYPE html>
<html>

 <head>
<meta charset="UTF-8">

<script src="../jquery-3.1.0.min.js"></script>
<?php
  $fileName = ($_GET["fileName"]);
  $folder = ($_GET["folder"]);
  $mode = ($_GET["mode"]);
  $file_path=$folder.'/'.$fileName ;

?>
<script type="text/javascript">
  //pass php variable to de_selftest.php
  
  var fileName = "<?php echo $fileName ?>";
  var folder = "<?php echo $folder ?>";
  var file_path = "<?php echo $file_path ?>";
   file_path=file_path.replace('/pure_code',""); //TODO make this abosolute
  
 
</script>
<script src="base.js" content="text/html; charset=utf-8" ></script>

<title>racetrack</title>
<?php include '../../header.php';?>


<script>

</script>


<style>
.hide{
  display: invisible;
}
.tiny{
  font-size: 8px;
  padding-bottom: 2px;
  margin:10px;
}
#hint{ 
  position:absolute;
  border-radius: 20px;
  background-color: darkgreen;
  color:white;
  padding:2px;
  margin-left: 15px;
}

progress{
  width: 100%;

}


#map{
  font-family: monospace;
  max-width: 25%;
  width: 25%;
  word-wrap: break-word;
  font-size: 1px;
  

}
#buffer{
     /* height should be equal to the bottom fixed menu <small> to stop content from being covered up */
  height:100px;
}
body {
        color: white;
        background-color: black;
        max-width: 100%;
        font-size: 50px;
}

.userInput{
  font-size: 30px;
  
   margin:1px;
  padding:1px;
}

div{
  margin: 0px;
    padding: 0px;
    border-style:dotted;
    padding: 0px;
    font-size: 20px;
    margin-top: 0px;
}

span{
  margin: 0px;
    padding-left: 0px;

    min-width: 100%;
    background-color:rgba(1,0,0,0)  ;
    padding-right: 0px;

       -moz-user-select: -moz-none;
   -khtml-user-select: none;
   -webkit-user-select: none;

   /*
     Introduced in IE 10.
     See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
   */
   -ms-user-select: none;
   user-select: none;
}

p{
    margin: 0px;
    padding: 0px;
    letter-spacing: 1px;
    font-family:  monospace;
    word-wrap: break-word;
    padding:0px;
}

#file{
  padding-left: 10px;
  font-size: 20px;
   display: block;    
  width:50%;
  
    margin: 0px auto;

}



.small{ /*this is the bottom fixed menu*/
    font-size:8px;
   /* position:fixed;*/
    
    bottom: 0;
    left:0;
    width:100%;
    height:60px;
    color:black;
    background-color:rgb(175, 175, 204);
}

.nospace{
   margin: 0;
    padding: 0;
    letter-spacing: 3px;
    font-family:  monospace;
    word-wrap: break-word;

}
.green{

    background-color:green;
padding-right: 0px;

}

.placeholder{
    margin:0;
    padding:0;
}

#totalChars{

  background-color:rgb(63, 64, 162)
}
.red{

    background-color:red;
   padding-right: 0px;


}

.yellow{

    background-color:yellow;
   padding-right: 0px;
   color: red;


}
<!-- grey class used when an example is completed -->
.grey{

    background-color: yellow;
   padding-right: 0px;
   color: black;
   border-color: green;


}

h6{
  
  padding:5px;
  padding-left: 10px;
  color:gold;
  margin: 0px;
  
}
.underline{

   padding-right: 0px;
   text-decoration: underline wavy red;
}
.now{

    background-color:lightblue;

   padding-right: 10px;



}

.buttons{

 
}

.current{
border-left-style: solid;
  border-left-color: blue;
}

textarea {
    width: 10em;
    height: 1em;
}


.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
     display: none;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>




</head>
<body>

<input type='button'  onclick='prevGroup()' value='prev group' />
<input type='button'  onclick='nextGroup()' value='next group' /><span id='bar'></span>

<div class="loader" id='loader'> saving progress...</div> 
<pre id='file'></pre>
<pre id='track'></pre>
<pre id='buttons'></pre>



<body oncontextmenu="return false;">


  <span id='timer'></span>





<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</body>

</html>
