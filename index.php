<?php 
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 199);
session_start(); 
	if(isset($_SESSION["customer_name"])){
		echo $_SESSION["customer_name"] . "<br/>";
	}
?>
<?php include 'Dropbox/header.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">


	
</head>
<body>
	



<h1>CSV</h1>

<p>My Top 5 Projects</p>
1.<a href='/Dropbox/diet/diet.php'>Diet</a><br/>
2.<a href='/Dropbox/manager/manager.php'>Manager</a><br/>
3.<a href='/Dropbox/german_simple/german.php'>German Flashcards</a><br/>
4. Mouse performance tester<br/><br/>



<?php
	if($_SESSION["customer_name"] == "bob"){
		echo "

		#.<a href='/Dropbox/programming_simple/js.php'>JavaScript Notes</a><br/>
		#.<a href='/Dropbox/pure_code/index.php'>Monolith</a><br/>
		#.<a href='/Dropbox/guides/github/github.php'>Github Guide</a><br/>
		#.<a href='/Dropbox/quicktools/clean_captions.php'>clean captions</a><br/>
		  
		";
	}
?>






</body>
</html>
