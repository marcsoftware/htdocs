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
<script src="de_selftest_reverse.js" content="text/html; charset=utf-8" ></script>

<title>flash cards</title>



<script>

</script>

<link rel="stylesheet" type="text/css" href="de_selftest_reverse.css">


</head>
<body>

<input type='button'  id='focusredwords' value='focus on red words' />
<input type='button'  id='hideans' value='hide answeres' />
<div class="loader" id='loader'> saving progress...</div> 
<pre id='file'></pre>



<body oncontextmenu="return false;">


  <span id='timer'></span>





<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</body>

</html>
