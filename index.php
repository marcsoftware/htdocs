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


td,
th {

  text-align: left;
  padding: 0px;
  width:50%;
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
	max-width:100%;
	max-height:100%;
	
	
}

.container{

	width:50%;
}

.tech{
	
	color:#00008B;
	float:right;
}
</style>
	
</head>
<body>
	
<div class="box">
	<h2>Calorie Tracker</h2>
	<table>
		<tr>
			<th>• quickly add food & calories counts to database in fewer clicks that other websites.<br/>
				• has small pre-populated database of popular food items. <br/>
			</th>
			<th><img src="diet_picture.PNG" alt="screenshot of diet app" /></th>

		</tr>

	</table>
	<br/>
	<a href='Dropbox/diet/diet.php' class='button' >Live</a> 
	<a href="https://github.com/marcsoftware/htdocs/tree/master/Dropbox/diet" class='button'>Git</a>
	<div class="tech">-PHP -MySQL -JavaScript</div>
</div>


<div class="box">
	<h2>Pantry Calorie Tracker V2</h2>
	<table>
		<tr>
			<th>• use barcode scanner to scan groceries and have the total-calories automatically calculated<br/>
				
			</th>
			<th><img src="capture_pantry.PNG" alt="screenshot of pantry app" /></th>

		</tr>

	</table>
	<br/>
	<a href='Dropbox/diet/pantry.php' class='button' >Live</a> 
	<a href="https://github.com/marcsoftware/htdocs/tree/master/Dropbox/diet" class='button'>Git</a>
	<div class="tech">-PHP -MySQL -JavaScript</div>
</div>


<div class="box">
	<h2>Flashcards</h2>
	<table>
		<tr>
			<th>• vocabulary based on Duolingo-German course.<br/>
				• many different modes to choose from.<br/>
			</th>
			<th>
				<img src="capture_flashcards.PNG" alt="screenshot of flashcard app" /><br/>
			</th>

		</tr>

	</table>
	<br/>
	<a href='Dropbox/german_simple/duolingo.php' class='button' >Live</a>
<a href="https://github.com/marcsoftware/htdocs/tree/master/Dropbox/pure_code" class='button'>Git</a>
<div class="tech">-PHP -MySQL -JavaScript</div>
</div>



<div class="box">
	<h2>skill trainer</h2>
	<table>
		<tr>
			<th> 
				• target practice for FPS games.<br/> 
				• target appears in same place each time so user will get a consistant score each time.<br/> 
			 </th>
			<th>
				<img src="capture_skill.PNG" alt="screenshot of skill app" />
			</th>

		</tr>

	</table>
	<br/>
	<a href='Dropbox/skill/skill.php' class='button'>Live</a>
<a href='https://github.com/marcsoftware/htdocs/tree/master/Dropbox/skill' class='button'>Git</a>
<div class="tech">-PHP -MySQL -JavaScript</div>
</div>




<div class="box">
	<h2>   BeatSaber - printable notation   </h2>
	<table>
		<tr>
			<th>
				• make printable sheets for BeatSaber game  
			 </th>
			<th>
				
			</th>

		</tr>

	</table>
	<br/>
<a href='Dropbox/quicktools/beatsaber.php' class='button'>Live</a>
<a href='https://github.com/marcsoftware/htdocs/tree/master/Dropbox/quicktools' class='button'>Git</a>

</div>

<div class="box">
	<h2>   todo list  </h2>
	<table>
		<tr>
			<th>
				• a todo list that allows user to add a breakdown of steps  
			 </th>
			<th>
				
			</th>

		</tr>

	</table>
	-CSS -PHP
	<br/>
<a href='Dropbox/todo/todo.php' class='button'>Live</a>
<a href='https://github.com/marcsoftware/htdocs/tree/master/Dropbox/todo' class='button'>Git</a>
<div class="tech">-PHP -MySQL -JavaScript</div>
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
