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

</head>


<style>




#file{
    width: :50%;
}



body {
        color: white;
        font-size: 20px;
        background-color: black;
        max-width: 100%;
        cursor:help;
           
}

div{
  margin: 0px;
    padding: 0px;
    border-style:dotted;
    padding: 0px;
    font-size: 20px;
    margin-top: 0px;
}

span{
  margin: 0px;
    padding: 0px;

    min-width: 100%;
    background-color:rgba(1,0,0,0)  ;
    padding-right: 0px;
cursor:help;

}

p{
    margin: 0px;
    padding: 0px;
    letter-spacing: 1px;
    font-family:  monospace;
    word-wrap: break-word;
    padding:0px;
}



main {
    margin-bottom: 500px; /* Add a top margin to avoid content overlay */
}

.small{ /*this is the bottom fixed menu*/
    font-size:8px;
    
    
    bottom: 0;
    left:0;
    width:100%;
    height:60px;
    color:black;
    background-color:rgb(175, 175, 204);
}

.nospace{
   margin: 0;
    padding: 0;
    letter-spacing: 3px;
    font-family:  monospace;
    word-wrap: break-word;

}
.green{

    background-color:green;
padding-right: 0px;

}

.placeholder{
    margin:0;
    padding:0;
}

#totalChars{

  background-color:rgb(63, 64, 162)
}
.red{

    background-color:red;
   padding-right: 0px;


}

.yellow{

    background-color:yellow;
   padding-right: 0px;
   color: red;


}
<!-- grey class used when an example is completed -->
.grey{

    background-color: yellow;
   padding-right: 0px;
   color: black;
   border-color: green;


}

.underline{

   padding-right: 0px;
   text-decoration: underline wavy red;
}
.now{

    background-color:lightblue;

   padding-right: 10px;



}

#hint{
  position:absolute;
  border-radius: 20px;
  background-color: darkgreen;
  color:white;
  padding:2px;
  margin-left: 15px;
}

.current{
border-left-style: solid;
  border-left-color: blue;
}

textarea {
    width: 10em;
    height: 1em;
}

</style>

<script src="../library-3.js">
</script>

<script type='text/javascript'>



// make tooltip, hovers around mouse cursor
$(document).mousemove(function(e){
    $("#hint").css({left:e.pageX, top:e.pageY});
});


// create shortcut key to showfull example code
  var show = true;
$(document).ready(function(){
    var values = ["block","none"];

    $("input").keyup(function(e){ // keyboard event is only attached to "input" elements
      console.log('key '+e.keyCode);
      if(e.keyCode==112){ //F!

        $(this ).next().css("display", values[Number(show)]);
        show = !show;
      }

      if(e.keyCode==113){//F2
        $(this ).next().css("display", values[0]);

      }

      if(e.keyCode==118){//F7 change the block length
        
        


        var number = prompt("BLOCK is "+Quiz.BLOCK+".\n Enter new block length", "");

          if (number != null) {
              Quiz.BLOCK =number;
          }else{
              Quiz.BLOCK =2;
          }
        
          
      }



    });


});

// TODO make window timer that only counts when window is in focus
var time;
(function() {
   time=0;
       var delta = 1000, // 1000 ms is 1 second
        tid;

    tid = setInterval(function() {
        if ( window.blurred ) { return; }
        time += delta;

        var seconds = (time/1000).toFixed(0);
        var minutes = Math.floor(seconds / 60);
        seconds = (seconds % 60).toFixed(0);
        var hours = Math.floor(seconds / 3600);

        document.getElementById('timer').innerHTML = hours+':'+minutes+':'+seconds;
    }, delta);

})();


window.onblur = function() { window.blurred = true; };
window.onfocus = function() { window.blurred = false; };

var fileName = "<?php echo $fileName ?>";
var file_path = "<?php echo $file_path ?>";
var folder = "<?php echo $folder ?>";
file_path=file_path.replace('/pure_code',""); //TODO make all file_paths absolute to avoid this, and put all file paths in their own file
var totalCharCount=0;
var doneChars=0; // a running total of the chars user has correctly entered
// global vars that are passed to makeCookie()
var timeRibbon=[];
var original;
var mode = "<?php echo $mode ?>";
var completed=0;
var timer=0;
var saveLines=0;


function makeQuiz(){

    readCookie();
    var x = document.getElementsByTagName("div");
    var i;
    var quizes=[];

    //loop through all elemets of type 'p' and create an object
    for ( var i = 0; i < x.length; i++) {
        var text =x[i].innerHTML;

        quizes.push(new NewQuiz(text,x[i]));

    }


    //set static properties
    Quiz.totalOfExamples = quizes.length;
    Quiz.typedExamples =0;
    
    //initialize saveLines array
    if(saveLines === null){
        saveLines = '0'.repeat(Quiz.totalOfExamples);
        saveLines=saveLines.split('');
    }


    if(timeRibbon == 'none' && quizes.length > 0){
        timeRibbon = 'NaN,'.repeat(quizes.length-1);
        timeRibbon+='NaN'; // note that this doesn't end with comma
        timeRibbon=timeRibbon.split(',');
    }

    //make the objects and add events to them
    for(var i=0;i<quizes.length;i++){

        quizes[i].create(i);
        //quizes[i].makeEvents();

    }

  



}


function NewQuiz (text,handle) {
    this.text=text;
    this.handle=handle;
    this.resultHandle;
    this.score=1;
    this.lines;
    this.maxScore=0;
    this.comments;
    this.codes;
    this.id;
    //static variables
    this.totalOfExamples;
    this.typedExamples;
    Quiz.dictionary;
    this.gerSentences;
    this.engSentences;
 Quiz.BLOCK = 1;

    this.create = function(id) {
       this.readDictionary();
        this.id = id;

        text = text.replace(/&nbsp;/g,'');
        text = text.replace(/\t+/g,'\n'); //this is where it turns two columns into one column.
        text = text.replace(/(\n\ )+/g,'\n'); //TODO: this deletes paragraphs which is bad

          
         
        var sentences = text.split("\n");
        sentences.splice(0, 1);  //delete the 1st index since it is empty and throws everything off.

        this.gerSentences  = sentences.filter((v, i) => !(i % 2))
        this.engSentences = sentences.filter((v, i) => (i % 2))

       

        
        this.codes=text;


        this.handle.innerHTML='';


        this.handle.innerHTML+="<p></p> <p></p> <input type='text'></input> <p></p> " //make the place holder elements
        
        document.title=fileName+' '; // 
        
        this.clear();

        this.smartDisplay();
        


    };

    function lookup(german){
           

   
            
            var xmlhttp;

            if (window.XMLHttpRequest){
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else{
                // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            var globalEng='x';
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders

                    var en = (xmlhttp.responseText);
                    en=en.split(':');
                    document.getElementById('hint').innerHTML=(en); // return the first match only
                    
                    
                    globalEng=en[0].split("\t")[1];

                }
            };

              
           


            xmlhttp.open("GET","/Dropbox/pure_code/lookup.php?german="+german,
            false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();
            return globalEng;

    }


    // this return the whole line of the dictoinary instead of just the synonym
     function lookupLine(german){
           

   
            
            var xmlhttp;

            if (window.XMLHttpRequest){
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else{
                // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            var globalEng='x';
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders

                    var en = (xmlhttp.responseText);
                    document.getElementById('hint').innerHTML=(en);
                    
                    
                    globalEng=en;

                }
            };

              
           


            xmlhttp.open("GET","/Dropbox/pure_code/lookup.php?german="+german,
            false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();
            return globalEng;

    }

    this.readDictionary = function() {

     // uses lookup.php since it is faster  



    }


    function playAudio(word){
      var word = new Audio(`../../audio-de/${word}.wav`);
      word.play();
      delete word;

    }

    function compare(x,y){
      
      x= x.replace(/[\W]/g,'');
      y= y.replace(/[\W]/g,'');

      x=x.toLowerCase();
      y=y.toLowerCase();
      
      return x===y;


    }



            Quiz.new_index;
            this.smartDisplayOriginal= function(){
                    
                    this.codes = this.codes.replace(/([\wäÄÖöÜüß]+)/g,'<span>$1</span>');

                            
                    document.getElementById('file').innerHTML=this.codes;
                    var list = document.getElementsByTagName("span");
                     
                    for(var i=0;i<list.length;i++){
                        //add event to look up words
                        list[i].addEventListener("mouseover", function(x,y){
                             var de = this.innerHTML;
                             en = lookup(de);


                             
                             //this.style.color='lightgreen';
                        });

                        list[i].addEventListener("mouseout", function(x,y){
                             
                            // this.style.color='white';
                             document.getElementById('hint').innerHTML='';
                        });


                    }
                    


            }
        

        // find the synonyme for GER and check if it is in the engsentence.
        // arg:handle is a reference to a span element
        // that span has to have an id that correspondes to the sentence that it is in.
        // and that spans innerHTML has to be a single german word.
        this.inEngSentence = function(handle){
           

          var ger = handle.innerHTML
          var index = handle.id;

          try{
            var englishSentence = this.engSentences[index].toLowerCase();
          }catch(e){

            return; 
          }


          var ger = handle.innerHTML
          var index = handle.id;

          try{
            var eng = lookup(ger).toLowerCase().trim();
          }catch(e){

            
          }
          

          var found = -2;
          try{
             var words = (eng.split(','));
             for(var i =0;i<words.length;i++){
              eng=words[i];
               eng = new RegExp('\\b'+eng+'\\b','g');
               found = englishSentence.search(eng);
             }
          }catch(e){
            found= -3;
          }

          if(found>=0){
            handle.style.color='green' 
          }else{
            handle.style.color='red'  ; // make the span underlined in red
            
          }
        }



    this.smartDisplay= function(){
            //TODO loop through german and english sentences and wrap in spans as you go.
            //this.codes = this.codes.replace(/([\wäÄÖöÜüß]+)/g,'<span>$1</span>');
            
            document.getElementById('file').innerHTML='';

            for(var i=0;i<this.gerSentences.length;i++){
               var master=this;
                var ger =  this.gerSentences[i].replace(/([\wäÄÖöÜüß]+)/g,`<span id=${i} name="$1" >$1</span>`);


                ger = ger.trim();
                document.getElementById('file').innerHTML+='<br/> '+i+'. '+ger+"";

                //var eng = this.engSentences[i].replace(/([\wäÄÖöÜüß]+)/g,'<span>$1</span>');
                var eng = this.engSentences[i];
                eng=eng.trim();
                document.getElementById('file').innerHTML+='<br/>'+i+'. '+eng+"<br/>";


                
            }

            // get by tag name span.
            var spans = document.getElementsByTagName('span');
            
            
         
          
            for(var i=0;i<spans.length-1;i++){ //TODO combine this forloop with the one above to save time.
              this.inEngSentence(spans[i]); //change CSS style to blue if in sentence.
            }

                    
            //document.getElementById('file').innerHTML=this.codes;

            //Add mouse over event to each span
            var list = document.getElementsByTagName("span");
             var master =this;
            for(var i=0;i<list.length;i++){
                //add event to look up words
                list[i].addEventListener("mouseover", function(x,y){
                     var de = this.innerHTML;
                     en = lookup(de);


                     
                    // this.style.color='lightgreen';
                });

                list[i].addEventListener("mouseout", function(x,y){
                     
                     //this.style.color='white';
                     document.getElementById('hint').innerHTML='';
                });

                list[i].addEventListener("mousedown", function(x,y){
                     
                     
                     
                    
                     if(x.which===1){
                        master.editDictionary(this);//  use this to edit the definition.
                      }else if(x.which ===2){

                        var url = "https://en.langenscheidt.com/german-english/";
                          //window.open(url+this.innerHTML); 

                          var win = window.open(url+this.innerHTML, '_blank');
                          win.focus();

                      }

                });


            }
            


    }


    // this function edits a single line in the dictionary.
    //germanWord: is the german word that has a definition that we will change.
    this.editDictionary  = function(element){
      
      germanWord=element.innerHTML;
      var oldDefinition = lookup(germanWord);
      
      var newDefinition = prompt(germanWord, oldDefinition);
      
      var master=this;
      //TODO re-check to see if we can make the word blue

      //find all toher german words than match. and see if we can make them blue too.

      //call the php file.

        var xmlhttp;

            if (window.XMLHttpRequest){
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else{
                // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            var globalEng='x';
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders

                    var result = (xmlhttp.responseText);

                    if(!result){
                      alert('failed to update word.');
                    }
                    
                    

                }
            };

           
           newDefinition=newDefinition.replace(/\ /g,'%20')
           germanWord=germanWord.replace(/\ /g,'%20')

           newDefinition=newDefinition.replace(/\t/g,'%09')
           germanWord=germanWord.replace(/\t/g,'%09')
           
           
          

            xmlhttp.open("GET","/Dropbox/pure_code/editDictionary.php?germanWord="+germanWord+"&newDefinition="+newDefinition,
            false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();

            this.inEngSentence(element);

            var spans = document.getElementsByName(germanWord);
            
            
         
          
            for(var i=0;i<spans.length-1;i++){ //TODO combine this forloop with the one above to save time.
              this.inEngSentence(spans[i]); //change CSS style to blue if in sentence.
            }


           

    }


 }

NewQuiz.prototype = new Quiz();

</script>


<pre id='file'></pre>







<!--bar -->
<span id='totalChars'></span>characters:<br/>

 ⏱ <span id='timer'>_</span>⏱ <span id='predicttimer'>0:0:0</span>  <span class='space'></span>  <br/>

<p class='small'>
  <span id='navBar'></span><br/>
    <?php echo str_replace("/Dropbox/pure_code/material/",'',$file_path) .' <br>'.$mode?> <br/>
    <span class='placeholder' id='doneChars'>0</span>/<span id='totalCharCount' class='placeholder'> </span><br/>
    
     
    <br/><br/><br/> 
</p>

<p id="hint" ></p>

<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</html>
