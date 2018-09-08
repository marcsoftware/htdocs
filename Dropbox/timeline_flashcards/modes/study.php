<!-- this file handles the actually typeing game-->
<!DOCTYPE html>
<html>

 <head>
<meta charset="UTF-8">
<title>study</title>
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


span:hover {
    background-color: yellow;
    cursor: pointer;
}

body{
    font-size: 20px;
	cursor: pointer;
}

</style>



<script src="../../jquery-3.1.0.min.js"></script>
<script type='text/javascript'>


var original;
var handle;

/*
//----------------------------------------------------------------------
//
//----------------------------------------------------------------------
*/
function init(){
	original = document.getElementById('file').innerHTML;
	

    //make study version
	var study_file=original.replace(/[a-zA-Z]+/g, function (x) {
        return shuffleWord(x);
    });

	
	document.getElementById('study_file').innerHTML=study_file;

    //make hard version
    var hard_file=original.replace(/[a-zA-Z]+/g, function (x) {
        return hideWord(x);
    });

    document.getElementById('hard_file').innerHTML=hard_file;
}		


/*
//----------------------------------------------------------------------
//
//----------------------------------------------------------------------
*/
function loopSpans(){
	var spans = document.getElementsByTagName('span');
	 l = spans.length;
	for (var i=0;i<l;i++) {
    		spans[i].word = spans[i].innerHTML; 
    		spans[i].scrambled_word = shuffleWord(spans[i].word);
    		spans[i].innerHTML=spans[i].scrambled_word;


			spans[i].addEventListener("mouseover", function(e){

				try{
					this.innerHTML=this.word;


				}catch(e){};

				
			}); 


			spans[i].addEventListener("mouseout", function(e){

				try{
					this.innerHTML=this.scrambled_word;


				}catch(e){};

				
			}); 

    		
	}
}

/*
//----------------------------------------------------------------------
//
//----------------------------------------------------------------------
*/
function shuffleWord(word){
    var shuffledWord = '';
    word = word.split('');
    while (word.length > 0) {
      shuffledWord +=  word.splice(word.length * Math.random() << 0, 1);
    }
    return shuffledWord;
}


/*
//----------------------------------------------------------------------
//
//----------------------------------------------------------------------
*/
function hideWord2(word){
    var first_letter = word.charAt(0);

    word=word.replace(/./g,'◦');
    word=word.replace(/^./g,first_letter);
    
    return word;
}


/*
//----------------------------------------------------------------------
//
//----------------------------------------------------------------------
*/
function hideWord(word){
    var first_letter = word.charAt(0);

    word=word.replace(/[^aeiou]/g,'●');
    word=word.replace(/^./g,first_letter);
    
    return word;
}


/*
//----------------------------------------------------------------------
// event listener
//----------------------------------------------------------------------
*/
    // TODO press enter to submit 
    var global_mode=0;
    $(document).ready(function(){
        
      

        var values = ["block","none"];

        $(document).keyup(function(e,element){ // keyboard event is only attached to "input" elements
            
            var file=document.getElementById('file');
            var study_file=document.getElementById('study_file');
            var hard_file=document.getElementById('hard_file');

            var test  = [study_file,hard_file];
             

            if(e.keyCode ){ //numpad 1 is 97
                                                 
                
             
                if (file.style.display === "none") {
                    file.style.display = "block";
                    test[global_mode].style.display = "none";
                } else {
                    file.style.display = "none";
                    test[global_mode].style.display = "block";
                }


                // keycode 51 is the '3' key
                 if(e.keyCode ==51 ){ //numpad 1 is 97
                    file.style.display = "none";
                    test[0].style.display = "none";
                    test[1].style.display = "block";
                    global_mode=1;

                 }

                 // keycode 51 is the '3' key
                 if(e.keyCode ==50 ){ //numpad 1 is 97
                    file.style.display = "none";
                    test[0].style.display = "block";
                    test[1].style.display = "none";
                    global_mode=0;

                 }
            }

            

        });


    });


</script>
<body onload='init()'>
<p id='file'>
    <?php echo $contents;
    ?>

</p>
<p id='study_file'>
	
	

</p>

<p id='hard_file'>
    
    

</p>

<p class='small'>
  <span id='navBar'></span><br/>
    <?php echo str_replace("/Dropbox/pure_code/material/",'',$file_path) .' <br>' ?> <br/>

    
     
    <br/><br/><br/> 
</p>



<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</body>
</html>
