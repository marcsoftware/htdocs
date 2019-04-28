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
	

}


.button {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: blue;
  color: white;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
  margin-right: 5px;

}



.box h2 {
	width:100%;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
	padding:0px;
	margin:0;
	font-size: 30px;
	color:#0094ff;
}
.box p {
	font-size: 25px;
	
	padding:0;
	margin:0;
	color:#333;
	 font-family: "Times New Roman", Times, serif;
}
.box {
	border:2px solid #0094ff;
	width:40%;
	padding:10px;
	margin:auto;
    -moz-border-radius-topright:5px;
    -moz-border-radius-topleft:5px;
    -webkit-border-top-right-radius:5px;
    -webkit-border-top-left-radius:5px;
    margin-bottom: 20px;
}

img{
	object-fit: scale-down;
	max-width:50%;
	max-height:50%;
	
	
}

.container{

	width:50%;
}

</style>
	
</head>
<body>
	

<div class="box">
    <h2>Calorie Tracker</h2>
    <p> 
    	
    	• quickly add food & calories counts to database in fewer clicks that other websites. <br/>
    </p>
    <div class="container">
    		<img src="diet_picture.PNG" alt="screenshot of diet app" /><br/>
    </div>
<br/>
<a href='/Dropbox/diet/diet.php' class='button' >Live</a> 
<a href="https://github.com/marcsoftware/htdocs/tree/master/Dropbox/diet" class='button'>Git</a></p>
</div>

<div class="box">
    <h2>Flashcards </h2>
    <p> 
    	• flashcards but with lots of different modes.<br/>
    	• Vocabulary is based on Duolingo German course.<br/>

    </p>
    <div class="container">
    		<img src="capture_flashcards.PNG" alt="screenshot of flashcard app" /><br/>
    </div>
<br/>
<a href='/Dropbox/german_simple/duolingo.php' class='button' >Live</a>
<a href="https://github.com/marcsoftware/htdocs/tree/master/Dropbox/pure_code" class='button'>Git</a>
</div>

<div class="box">
    <h2>skill trainer </h2>
    <p>
     • target practice for FPS games but the target is not random so metrics are consistant.<br/>
     </p>
     <div class="container">
    		<img src="capture_skill.PNG" alt="screenshot of skill app" /><br/>
    </div>
<br/>
<a href='/Dropbox/skill/skill.php' class='button'>Live</a>
<a href='https://github.com/marcsoftware/htdocs/tree/master/Dropbox/skill' class='button'>Git</a>

</div>




<div class="box">
    <h2>BeatSaber - printable notation </h2>
    <p>
     • make printable sheets for BeatSaber game<br/>
     </p>
     <div class="container">
    		
    </div>
<br/>
<a href='/Dropbox/quicktools/beatsaber.php' class='button'>Live</a>
<a href='https://github.com/marcsoftware/htdocs/tree/master/Dropbox/quicktools' class='button'>Git</a>

</div>

<div class="box">
    <h2>skill trainer </h2>
    <p>
     • a todo list that allows user to add a breakdown of steps<br/>
     </p>
     <div class="container">
    		
    </div>
<br/>
<a href='/Dropbox/todo/todo.php' class='button'>Live</a>
<a href='https://github.com/marcsoftware/htdocs/tree/master/Dropbox/todo' class='button'>Git</a>

</div>

<?php
	if(isset($_SESSION["customer_name"]) && $_SESSION["customer_name"] == "bob"){
		echo "
		----EXPERIMENTAL : STILL IN DEVELOPMENT----<br/>



        b. <a href='/Dropbox/passwords/write.ignorethisfile.php'> money</a><br/>
        c.<a href='/Dropbox/timeline_flashcards/timeline_home.php'> timelines</a><br/>
		#.<a href='/Dropbox/programming_simple/js.php'>JavaScript Notes</a><br/>

		#.<a href='/Dropbox/guides/github/github.php'>Github Guide</a><br/>

		#.<a href='/Dropbox/quicktools/clean_keys.php'>clean ans keys</a><br/>


		----<br/>

		
		  
		";
	}
?>






</body>
</html>
