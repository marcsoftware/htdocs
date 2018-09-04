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
  $file_path="../$folder/$fileName ";

$contents= file_get_contents($file_path);


?>

</head>


<style>
pre {
    display: block;
    font-family: monospace;
    white-space: pre;
    margin-left: 100px;
    margin-right: 100px;
} 


p {
    display: block;
    font-family: monospace;
    white-space: pre;
    white-space: -moz-pre-wrap; 
    

        white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
} 

body{

    font-size: 20px;
}
</style>




<script type='text/javascript'>

function init(){
	
}



</script>
<body onload='init()'>

<p id='file'>
	<?php echo $contents;
	?>

</p>

<p class='small'>
  <span id='navBar'></span><br/>
    <?php echo str_replace("/Dropbox/pure_code/material/",'',$file_path) .' <br>' ?> <br/>

    
     
    <br/><br/><br/> 
</p>



<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</body>
</html>
