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

body {
        color: white;
        background-color: black;
}

div{
    border-style:dotted;
    padding: 10px;
} 

span{
    min-width: 100%;
    background-color:rgba(1,0,0,0)  ;
    padding-right: 10px;


}

.small{
    font-size:8px;
}
p{
    margin: 0;
    padding: 0;
    letter-spacing: 1px;
    font-family:  monospace;
}

.green{

    background-color:green;
padding-right: 0px;

}

.placeholder{
    margin:0;
    padding:0;
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

.grey{

    background-color:grey;
   padding-right: 0px;
   color: black;


}

.underline{

   padding-right: 0px;
   text-decoration: underline wavy red;  
}
.now{

    background-color:lightblue;
   padding-right: 10px;


}

textarea {
    width: 20em;
    height: 1em;
}

</style>

<script src="../library-2.js">
</script>

<script type='text/javascript'>

"use strict";

var fileName = "<?php echo $fileName ?>";
var file_path = "<?php echo $file_path ?>";
var folder = "<?php echo $folder ?>";

var totalCharCount=0;
var doneChars=0; // a running total of the chars user has correctly entered
// global vars that are passed to makeCookie()
var timeRibbon=[];
var original;
var mode = '<INSERT MODE HERE>';
var completed=0;
var timer=0;
var saveLines=null;        


function makeQuiz(){
    
    readCookie();
    var x = document.getElementsByTagName("div");
    var i;
    var quizes=[];
    
    
    //loop through all elemets of type 'p' and create an object
    for ( var i = 0; i < x.length; i++) {
        var text =x[i].innerHTML;
        
        quizes.push(new Quiz(text,x[i]));
        
    }
    
    
    //set static properties
    Quiz.totalOfExamples = quizes.length;
    Quiz.typedExamples =0;
    
    //initialize saveLines array
    if(saveLines === null){
        saveLines = '1'.repeat(Quiz.totalOfExamples); 
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
    
    this.create = function(id) {
        
        this.id = id;
        
        
        
        this.comments=text.match(/\/\/.*/g);
        this.lines=text.replace(/\/\/.*/g,'_____');
        this.codes=text.split('\n');
        this.maxScore=this.codes.length;
        this.handle.innerHTML='';
        
        //this.handle.innerHTML+="<br/><br/><br/>"; //make space between butotns and text
        this.handle.innerHTML+="<p></p> <p></p> <input type='text'></input> <p></p> " //make the place holder elements
        this.makeEvents();
        //this.display(this.lines);
        
        
        this.smartDisplay();
        //this.drawTextBox();
        
        // if example  was compledted by user in previous session then mark it as grey
        if(saveLines[this.id]>=this.maxScore){ //TODO test if this comapre works
            
            this.handle.className = 'grey'; // mark progress by drawing as grey example
        }
        
        document.title=Quiz.typedExamples+'/'+Quiz.totalOfExamples; // TODO make Gerneric dont use Quiz keyword
        this.score=Number(saveLines[this.id]);
        this.clear();
        
        this.smartDisplay();
        this.countChar();
        
        
    };
}

NewQuiz.prototype = new Quiz();

</script>


<p class='small'>
    <?php echo str_replace("/Dropbox/pure_code/material/",'',$file_path) .' <br>'.$mode?> <br/>
    <span class='placeholder' id='doneChars'>0</span>/<span id='totalCharCount' class='placeholder'> </span>
</p>


<pre id='file'></pre>
</html>