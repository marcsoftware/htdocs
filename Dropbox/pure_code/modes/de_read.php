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
 Quiz.BLOCK = 1;

    this.create = function(id) {
       this.readDictionary();
        this.id = id;

        text = text.replace(/&nbsp;/g,'');
        text = text.replace(/\t/g,'\n'); //this is where it turns two columns into one column.

       
        
        this.codes=text;

        

        this.maxScore=this.codes.length;

        var new_text  = text;

        Quiz.totalChars+=new_text.match(/\S/g).length;

        this.handle.innerHTML='';


        //this.handle.innerHTML+="<br/><br/><br/>"; //make space between butotns and text
      this.handle.innerHTML+="<p></p> <p></p> <input type='text'></input> <p></p> " //make the place holder elements
        
        //this.display(this.lines);



        
        //this.drawTextBox();

        // if example  was compledted by user in previous session then mark it as grey
    


        document.title=fileName+' '; // 
        this.score=Number(saveLines[this.id]);

        this.clear();

        // calutlate the lines that have been typed and display
        Quiz.prototype.totalLines=Number(Quiz.prototype.totalLines)+Number(this.maxScore);




       


        //update character progress
       
       
     

        
        

        
        this.smartDisplay();
        


    };

    function lookup2(german){
           

   
    
    var xmlhttp;

    if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else{
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders

            var en = (xmlhttp.responseText);
            document.getElementById('hint').innerHTML=(en);
            


        }
    }

      
   


    xmlhttp.open("GET","/Dropbox/pure_code/lookup.php?german="+german,
    false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();


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


    //input: String containing a GERMAN word
    //output: String containing a ENGLISH word
    function lookup(german){
        
        (lookup2(german));
        return 'javascript marc';

    }

    Quiz.new_index;
    this.smartDisplay= function(){
            
            this.codes = this.codes.replace(/([\wäÄÖöÜüß]+)/g,'<span>$1</span>');

                    
            document.getElementById('file').innerHTML=this.codes;
            var list = document.getElementsByTagName("span");
             
            for(var i=0;i<list.length;i++){
                //add event to look up words
                list[i].addEventListener("mouseover", function(x,y){
                     var de = this.innerHTML;
                     en = lookup(de);


                     
                     this.style.color='lightgreen';
                });

                list[i].addEventListener("mouseout", function(x,y){
                     
                     this.style.color='white';
                     document.getElementById('hint').innerHTML='';
                });


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
