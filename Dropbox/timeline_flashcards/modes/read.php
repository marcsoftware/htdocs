<!-- this file handles the actually typeing game-->
<!DOCTYPE html>
<html>

 <head>
<meta charset="UTF-8">
<title>read</title>
<script src="../../jquery-3.1.0.min.js"></script>
<?php
 $fileName = ($_GET["fileName"]);
  $folder = ($_GET["folder"]);
 $mode = ($_GET["mode"]);
  $file_path=$folder.'/'.$fileName ;




?>

</head>


<style>


</style>




<script type='text/javascript'>






</script>


<pre id='file'></pre>

<p class='small'>
  <span id='navBar'></span><br/>
    <?php echo str_replace("/Dropbox/pure_code/material/",'',$file_path) .' <br>' ?> <br/>

    
     
    <br/><br/><br/> 
</p>



<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</html>
