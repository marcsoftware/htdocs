<?php 

	if(isset($_SESSION["customer_name"])){
		echo $_SESSION["customer_name"] . "<br/>";
	}else{
		 
	}
?>
<?php include 'Dropbox/header.php';?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">

<style>

body{
	font-size: 30px;
}
</style>
	
</head>
<body>
	



<h1>CSV</h1>

<p>My Top 5 Projects</p>
1.<a href='/Dropbox/diet/diet.php'>Diet</a><br/>
2.<a href='/Dropbox/todo/todo.php'>TODO list</a>*<br/>
3.<a href='/Dropbox/german_simple/duolingo.php'> Flashcards - duolingo german</a><br/>
4.<a href='/Dropbox/skill/skill.php'> skill trainer</a><br/>
5.<a href='/Dropbox/quicktools/beatsaber.php'> BeatSaber - printable notation</a><br/>



<?php
	if(isset($_SESSION["customer_name"]) && $_SESSION["customer_name"] == "bob"){
		echo "
		----EXPERIMENTAL : STILL IN DEVELOPMENT----<br/>
a. <a href='/Dropbox/todo2/todo2.php'>todo version 2</a><br/>
        #<a href='http://offline.com/Dropbox/dashboard/js.php'> code js typer</a><br/>

        b. <a href='/Dropbox/passwords/write.ignorethisfile.php'> money</a><br/>
        c.<a href='/Dropbox/timeline_flashcards/timeline_home.php'> timelines</a><br/>
		#.<a href='/Dropbox/programming_simple/js.php'>JavaScript Notes</a><br/>
		#.<a href='/Dropbox/pure_code/index.php'>Monolith</a><br/>
		#.<a href='/Dropbox/guides/github/github.php'>Github Guide</a><br/>
		#.<a href='/Dropbox/quicktools/clean_captions.php'>clean captions</a><br/>
		#.<a href='/Dropbox/quicktools/clean_keys.php'>clean ans keys</a><br/>
		#.<a href='/Dropbox/quicktools/grammartable.php'>grammartable.php</a>-turn table into grammar questions<br/>
		#.<a href='/Dropbox/quicktools/grammerSentence.php'>grammartable.php</a>-make sentences to translate<br/>
		----<br/>
		#.<a href='/Dropbox/german_simple/german.php'>German Flashcards - short stories</a><br/>
		grammerSentence.php
		
		  
		";
	}
?>






</body>
</html>
