<!-- this file handles the actually typeing game-->
<!DOCTYPE html>
<html>

 <head>
<meta charset="UTF-8">
<title>blurry</title>
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
     background-color:yellow;
    cursor: pointer;
}

body{
    font-size: 20px;
    letter-spacing: 0px;
    cursor: pointer;
}

span:not(:hover), span:not(:hover) * {
            /* start*/
            
             
        }
        span:not(:hover) {
            /* start*/
            
             letter-spacing: -6px;
            
        }
        span {
            transition:color 0.25s ease, text-shadow 0.25s ease;

        }
       span * {
            transition:color 0.25s ease;

        }

</style>




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
    handle = document.getElementById('file');


    original=original.replace(/[a-zA-Z]+/g,"<span>$&</span>");
    handle.innerHTML=original;
   
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
