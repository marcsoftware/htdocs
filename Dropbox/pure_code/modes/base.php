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



<link rel="stylesheet" href="../modestyle.css">



</head>
<body>

<input type='button'  onclick='prevGroup()' value='prev group' />
<input type='button'  onclick='nextGroup()' value='next group' /><span id='bar'></span>

<div class="loader" id='loader'> saving progress...</div> 
<pre id='file'></pre>
<pre id='track'></pre>
<pre id='buttons'></pre>

<input type='button'  onclick='getHint()' value='hint' /><pre id='hint'></pre>

<body oncontextmenu="return false;">


  <span id='timer'></span>





<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</body>

</html>
