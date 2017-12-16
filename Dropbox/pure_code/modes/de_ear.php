<!-- this file handles the actually typeing game DE_EAR-->
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


<link rel="stylesheet" type="text/css" href="../style.css">

<script src="../library-3.js">
</script>

<script type='text/javascript'>

//play sound


// create shortcut key to showfull example code
  var show = true;
$(document).ready(function(){
    var values = ["block","none"];

    $("input").keyup(function(e){ // keyboard event is only attached to "input" elements
      
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
 Quiz.BLOCK = 1;

    this.create = function(id) {

        this.id = 0;



       
        text = text.replace(this.catchComments,'');
        this.codes=text.split('\n');

        this.codes=this.codes.filter(function(n){ return n != undefined || n != '\n'}); 
 
        this.maxScore=this.codes.length-1;

        var new_text  = text.replace(/\<br\/\>/gm,'');

        Quiz.totalChars+=new_text.match(/\S/g).length;

        this.handle.innerHTML='';


        //this.handle.innerHTML+="<br/><br/><br/>"; //make space between butotns and text
        this.handle.innerHTML+="<p></p> <p></p> <input type='text'></input> <p></p> " //make the place holder elements
        this.makeEvents();
        //this.display(this.lines);



        this.smartDisplay();
        //this.drawTextBox();

        // if example  was compledted by user in previous session then mark it as grey
       
       var isDone=0;
       
        
        if(saveLines[0]>=this.maxScore){ //TODO test if this comapre works
          
          this.markAsDone();
          isDone=1;
          saveLines[0]=1;
        }

        Quiz.prototype.navBar[this.id]=isDone;
        this.updateNavBar();



        document.title=fileName+' '; // TODO make Gerneric dont use Quiz keyword
        this.score=Number(saveLines[this.id]);
 
        this.clear();

        // calutlate the lines that have been typed and display
        Quiz.prototype.totalLines=Number(Quiz.prototype.totalLines)+Number(this.maxScore);



        // prevent NaN value
        if(isNaN(parseFloat(this.score))){ // if score in invalid do nothing
          //
        }else{
          Quiz.doneLines+=this.score; // score is valid so safe to add.
        }

    


        this.totalLinesBar(Quiz.doneLines,Quiz.prototype.totalLines);
        // calutlate the lines that have been typed and display
        var raw;
        var where = this.score;
        if(this.score >= this.maxScore){ // make sure raw is valid, and always use smaller number
           raw = this.codes.join('');

        }else if(this.score <= 1){
          raw ="";

        }else{

           raw = this.codes.slice(0,where-1).join('');

        }

        //raw =this.codes.slice(0,16);
        done =0;
       try{
          done =raw.match(/\S/g).length;
        }catch(e){
          done =0;

        }

          Quiz.doneChars += done;


        //update character progress
        Quiz.doneChars=parseInt(Quiz.doneChars);
       
     

        this.totalCharsBar(Quiz.doneChars,Quiz.totalChars);
        Quiz.startChars=Quiz.doneChars;

        document.getElementById('map').innerHTML=this.updateMapBar(Quiz.doneChars,Quiz.totalChars);
        this.smartDisplay();
        this.countChar();


    };

    function playAudio(word){
      var word = new Audio(`../../audio-de/${word}.wav`);
      word.play();
      delete word;

    }



    this.smartCompare_NOTUSED = function(user_input,ans_key) {

      user_input = this.decodeEntities(user_input).split('');
      ans_key = this.decodeEntities(ans_key ).split('');
     var index = user_input.length-1;


     if(user_input[index]===ans_key[index]){
        this.colors[index]=('<span class="green">'+user_input[index]+'</span>');


     }else{
       this.colors[index]=('<span class="red">'+user_input[index]+'</span>');
     }



     return '\n'+this.colors.join('')+'\n';
    };

     // compares two string and returns a string with colorized feedback.
    // the return string has a <span> around each letter. green for correct char. red for incorrect
    // compares two string and returns a string with colorized feedback
    var lastLength=0;
   this.smartCompare = function(user_input,ans_key) {


     var fresh = user_input.length;
     user_input = this.decodeEntities(user_input);
     ans_key = this.decodeEntities(ans_key );

     // if too long prevent error later in this function
     var user_input_right = '';
     if(user_input.length>ans_key.length){
         var user_input_left=user_input.substr(0,ans_key.length); // if too long prevent later in this function
         user_input_right=user_input.substr(ans_key.length);
         user_input = user_input_left;

     }

     var chars = ['⌁','˽','·','•','⁀','⊛',
                      '░','▒','▕','◥','▯',
                      '▮','▩','▢','☲','☰'];
     var filler_char = chars[6];
     var punc_char = chars[7];

     ans_key=ans_key.replace("<br/>",'¶');
     ans_key=ans_key.replace(/\¶+/g,'¶');
     ans_key=ans_key.replace(/\n/g,'¶');
     ans_key =ans_key.replace(/\s\s+/g,' '); //replace double whitespaces
     ans_key=ans_key.replace(/\¶+/g,'¶');
     ans_key=ans_key.replace(/\ \¶/g,'¶');
     ans_key=ans_key.trim();
     var template =ans_key; //preserve line break
     

     
     template = template.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()\+\<\>]/g,punc_char); // replace punctuation with char
     template= template.replace(/[a-zA-Z]/g,filler_char); // replace letters with char, but keep length the same

     var input=user_input.split('');
     
     //var key=ans_key.replace(/zzzzzzz/g,' ').trim().split(''); //one
     var key = ans_key;

     
     var text;

     template=template.split('');


     var green_span = document.createElement("span");
     green_span.className='green';

     var colors = [];
     // wraps a span around each individual letter
     
     var counter=0;
     var allGreen =1;
     for(var i=0;i<input.length && i<key.length;i++){

         if(template[i]==='¶'){
            input.unshift(' ');

         } else if(input[i]===key[i]){ //correct letter
             template[i]='<span class="green">'+input[i]+'</span>';
             counter++;

         }else if(key[i].search(/[ \t\r\n\v\f]/g)>=0){ // wrong char, should be whitespace instead
             template[i]='<span class="grey">'+input[i]+'</span>';


         }else if(key[i].search(/[.,?!]/g)>=0){ // wrong char, should be puntuation //TODO change this test to incldue all typale puctuation
             template[i]='<span class="yellow">'+input[i]+'</span>';
             allGreen =0;

         }else if(input[i].toLowerCase()===key[i].toLowerCase()){ //wrong char, should be differant case
            allGreen =0;
             template[i]='<span class="green">'+key[i]+'</span>'; //ignore case

         }else if(input[i]==='`' && key[i].search(/\w/)<0){

             // if key has a key that is not easy to type than skip it with ` key
             template[i]='<span class="green">'+key[i]+'</span>';
             counter++;

         }else {
             template[i]='<span class="red">'+input[i]+'</span>';
             allGreen =0;
             

         }

         //play audio?
         lastLength = lastLength || 0;
         if( counter > lastLength && counter%10 ==0 && allGreen){
            audioMedium.play(); //TODO dings too much bug

         }

     }

     
      lastLength = fresh;

     //text = document.createTextNode('\n'+template.join()+'\n');
     template = template.join('');
     template = template.replace(/¶/g,'\n');

     return '\n'+template+user_input_right+'\n';
   };

 //check if user
    this.check = function(input) {
          
        
        input= input.replace(/\</g,"&lt;"); //make sure input with special char '<' still displays correctly

      //  this.smartDisplay(input);
        var ans_key = this.getCurrentLine().join('').trim();

        
        if(input.length<=1){
          playAudio(ans_key);

        }

        ans_key =this.scrub(ans_key);
        
        
        ans_key = ans_key.replace(this.catchComments,'\n'); // delete comment so that user doesn't have to type them
        
         if(this.score<=1){

            // get the current time in milliseconds
            var now = new Date();
            now = now.getTime();

            timeRibbon[this.id]=now;

        }

         if(!this.score){ // make sure valid value
             this.score=0;

        }

         if(ans_key===undefined || ans_key.length <= 1){
            
            this.correctAns(1);

             if(saveLines[this.id]<this.score || saveLines[this.id] === undefined){// if the new number is bigger
              saveLines[this.id]=this.score; // permantanly safe the users progress
            }

            this.updateCookie();

            //return;
            
            



        } else if(this.compare(input,ans_key)){
            //if users answere is correct


            this.clear();

            this.correctAns();
            playAudio(this.getCurrentLine().join('').trim());
            if(saveLines[this.id]<this.score || saveLines[this.id] === undefined){// if the new number is bigger
              saveLines[this.id]=this.score; // permantanly safe the users progress
            }


            //check that the next line is not empty
            /*while( this.getCurrentLine() !== undefined && this.codes[this.score].search(/\S/g) == -1){
                // if no match is found skip the next line, and keep skipping if ther ea remultiple empty lines in a row

                this.correctAns();
            }*/



            // TODO line count progress bar

            this.updateCookie();

            

            this.smartDisplay();
            this.countChar();
            

        }else{

            //else users input is incorrect or just not completed typing whole answere
            this.smartDisplay(input);
        }
        
        if(this.score>=this.maxScore){

                //if example completed make it look different


                //play cooler sound
                

                this.markAsDone(); // change color of example

                audioExampleDone.play();

                var now = new Date();
                now = now.getTime();
                var new_time=Math.abs(now- timeRibbon[this.id]);
                timeRibbon[this.id]=new_time; // if example is just one line long this will produce NaN
                timer+=new_time;


                this.score=0;

                Quiz.typedExamples++;
                document.title=Quiz.typedExamples+'/'+Quiz.totalOfExamples; // TODO make Gerneric dont use Quiz keyword

                //if all examples are completed
                if(Quiz.typedExamples===Quiz.totalOfExamples){ // s make Gerneric dont use Quiz keyword
                    completed=1;
                }

                this.updateCookie();



            }




    };

 //y is the KEY and x is the user's input
    this.compare = function(x,y){
    //ignore case


    x=x.toLowerCase();
    y=y.toLowerCase();        

        x=x.replace(/\&/g,'`');
        y=y.replace(/\&amp;/g,'`');  //TODO find out why '&' in y become '&amp;' in y but not x
        y=y.replace(/\&/g,'`');  //TODO find out why '&' in y become '&amp;' in y but not x

        x=x.replace(/\</g,'&lt;');
        x=x.replace(/\>/g,'&gt;');
        y=y.replace(/\</g,'&lt;');
        y=y.replace(/\>/g,'&gt;');

        x=x.replace(/[^\w\d\s]/g,'`');
        y=y.replace(/[^\w\d\s]/g,'`');



        // remove wierd charecters
        x=x.replace(/[\uFFFC]/g,'');
        y=y.replace(/[\uFFFC]/g,'');
        //remove smart quotation marks
        x=x.replace(/[”“]/g,'"');
        y=y.replace(/[”“]/g,'"');

        x=x.replace(/[’‘]/g,"'");
        y=y.replace(/[’‘]/g,"'");

        x=x.toString();
        
        // delete all spaces

        
        x=x.replace(/\s/g,'').trim().toString();
        y=y.replace(/\s/g,'').trim().toString();


        return x === y;

    }


     //hiights the current line of code
    // context: uses global variable score
    this.smartDisplay = function(input='') {
        
        var line = (this.getCurrentLine().join('\n')).trim();
        line = this.scrub(line);
        
        if(input === '`'){
            

            this.giveup();

        }
        if(input===''){
            this.clear();
            this.colors = [];
            

            var word = line;




        }

        //get hilghted code or plain code
        if(input === '' ){
            // get plain code
            if(line == null){

                line=this.codes.join(""); // this is where newlines get added
                
            }

            line=line.replace(/\w/g,'░');
            var hilighted = ('\n'+line+'\n'); //not hilighted
            hilighted = hilighted.trim();
            //hilighted = hilighted.replace(/\s/g,' ');

        }else{//else get hilighted

            //var hilighted = document.createTextNode('\n'+this.codes[this.score].replace(/./g," ")+'\n');
            
            var hilighted = (this.smartCompare(input,line)) ; // this is the hilighted line

        }

        //fill in place holders
        var list = this.handle.getElementsByTagName('p');


        list[1].innerHTML=hilighted;                   // current line
        

        
        
        //list[1].style.borderLeftColor= 'red';
        list[1].classList.add('current');

        // display text that was typed , and then text that still needs ot be typed
        
        //list[2].innerHTML=(this.codes.slice(this.score+Quiz.BLOCK).join('\n')); // lines that the user needs to type next
        //list[0].innerHTML=(this.codes.slice(0,this.score).join('\n')); //lines of code that the user has typed, if any

        // dont display text that was type, or the text that still needs to be typed
      //  list[2].style.display='none'; // this hides the code.
      //  list[0].style.display='none';

        //autoscroll to input box
        var box = this.handle.getElementsByTagName('input')[0];
       // window.scroll(0,this.findPos(list[1])); //autoscr


        //


    };

    this.setCharAt=function(str,index,chr) {

        if(index > str.length-1) return str;
        str= str.substr(0,index) + chr + str.substr(index+1);

        return str;
    }

    var lastkey;
    this.giveup =function(){
        var key = this.codes[this.score];
        if(key===lastkey){
            return;
        }
        alert(key);
        missed_words+=key+',';
        this.codes.push(key);
        this.maxScore = this.codes.length;
        document.getElementById('missed').innerHTML++;
        lastkey=key;

    }
}

NewQuiz.prototype = new Quiz();

</script>



<pre id='file'></pre>

<p id='missed'>0</p>




<!--bar -->
<span id='totalLines'></span><span class='space'></span>line:<br/>
<progress id='lineProgress' value="22" max="100">
</progress><br/>

<!--bar -->
<span id='totalChars'></span>characters:<br/>
<progress id='charProgress' value="22" max="100">
</progress>
 ⏱ <span id='timer'>_</span>⏱ <span id='predicttimer'>0:0:0</span>  <span class='space'></span>  <br/>
<span id='map'></span>
<p class='small'>
  <span id='navBar'></span><br/>
    <?php echo str_replace("/Dropbox/pure_code/material/",'',$file_path) .' <br>'.$mode?> <br/>
    <span class='placeholder' id='doneChars'>0</span>/<span id='totalCharCount' class='placeholder'> </span><br/>
    
     
    <br/><br/><br/> 
</p>

<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</html>
