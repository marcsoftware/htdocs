<?php include '../../header.php';?><!-- this file handles the actually typeing game-->
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
<script src="multichoice.js" content="text/html; charset=utf-8" ></script>

<title>learn to spell</title>



<script>

</script>

<link rel="stylesheet" type="text/css" href="multichoice.css">

</head>
<body>

<span id='bar'></span>

<div class="loader" id='loader'> saving progress...</div> 
<pre id='file'></pre>
<pre id='track'></pre>


<input type='text' id='input' onkeyup='check(this.value)' ></input>
<input type='button' value='play audio' onclick='playAudio()' ></input><br/>
<br/><br/><br/><br/>

<input type='button' value='hint' onclick='showhint()' ></input><br/>

  <span id='last'></span>





<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</body>

</html>
