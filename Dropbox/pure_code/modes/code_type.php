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
        time = 0;
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
var saveLines=null;


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
    this.real_length ;
 Quiz.BLOCK = 1;
this.catchComments =  new RegExp(   "(?:/\\*(?:[^*]|(?:\\*+[^*/]))*\\*+/)|(?://.*)","g");
    this.create = function(id) {

        this.id = id;




       
        this.real_length = text.replace(this.catchComments,'');
        this.real_length = this.real_length.split('\n');
        
        this.real_length=this.real_length.filter(function(n){ return n != undefined && n !='' }); 
        
        
        this.codes=text.split('\n');

        this.codes=this.codes.filter(function(n){ return n != undefined }); 

        this.maxScore=this.codes.length;


        var new_text  = text.replace(/\<br\/\>/gm,'');

        Quiz.totalChars+=new_text.match(/\S/g).length;

        this.handle.innerHTML='';
   
         if(this.score >= this.maxScore) {
           
           saveLines[this.id]=0;
         }

        //this.handle.innerHTML+="<br/><br/><br/>"; //make space between butotns and text
        this.handle.innerHTML+="<p></p> <p></p> <input type='text'></input> <p></p> " //make the place holder elements
        this.makeEvents();
        //this.display(this.lines);



        
        //this.drawTextBox();

        // if example  was compledted by user in previous session then mark it as grey
       
       var isDone=0;

        if(saveLines[this.id]>=this.maxScore){ //TODO test if this comapre works
          saveLines[this.id]=0;
          this.markAsDone();
          isDone=1;
          
        }

        
        this.smartDisplay();
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

var comments='';
var skipped=0;
 //track the skipped lines.
 this.getCurrentLine =function(s){

       //return this.codes.slice(this.score,this.score+block);
       var x = [1,1];
       var result =[];
      var whitespace='';
      var thisline='';

      if(this.score>=this.maxScore){
        result= [''];

      }

        var suspect;
        comments='';
         skipped=0;
       


       for(var i=0;result.length<Quiz.BLOCK && this.codes[this.score+i];i++){ // keeps looping until it gets a current line that is long enought
          var comment = this.codes[this.score+i].match(this.catchComments); 
          if(comment != null){
            comments +=  comment; //collect all comments;
          }
           
           skipped++;
           suspect = this.codes[this.score+i].replace(this.catchComments,'');
          if(suspect && suspect.match(/[0-zA-Z]/g)){
            if(result.length !== 0){
                //whitespace = '<br/>';


            }

            thisline = (whitespace+this.codes[this.score+i]).replace(this.catchComments,'\n');
            result.push(thisline);
            
          }

       }

 
       if(result.join().match(/[0-zA-Z]/g) === null){
              // currenLine is empty
              //this.correctAns();

          }


      comments=comments.replace(/\/\//g,'\n//');

       return result;
    }


    //hiights the current line of code
    // context: uses global variable score
    this.smartDisplay = function(input='') {
    
   
          var line = (this.getCurrentLine().join('\n')).trim();
            
        line = this.scrub(line);
        
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
        list[0].innerHTML=comments;

        // dont display text that was type, or the text that still needs to be typed
      //  list[2].style.display='none'; // this hides the code.
      //  list[0].style.display='none';

        //autoscroll to input box
        var box = this.handle.getElementsByTagName('input')[0];
       // window.scroll(0,this.findPos(list[1])); //autoscr


        //


    };


     this.correctAns = function( skip=0){
      audioLineDone.play();
       if(skip === 1){
            this.score -= Quiz.BLOCK; // will be added later in this function
            this.score++; // increment to skip
       }
    
      //if already done then dont overcount
      if(this.already_done && skip === 0){
         this.score += Quiz.BLOCK;
        return; 
      }
      //calulate lines
      Quiz.doneLines+=Quiz.BLOCK;
      
     this.totalLinesBar(Quiz.doneLines,Quiz.prototype.totalLines);

      //calculate char stats
      var raw='';
      var done =0;
      try{
        raw = (this.getCurrentLine().join('')).trim();

        if(raw !== null){
          raw =raw.replace(/\<br\/\>/gm, ''); // delete the html elements like <br/>
          }
          
         done =raw.match(/\S/g);

         if(raw !== null){ 
          done = done.length;

         }else{
            done =0;

         }
         
       }catch(e){
         done = 0 ;
         console.log('error: '+e);
         //if done is null then the user is probably done.
         

       }
       
      
      Quiz.doneChars += done;
      this.totalCharsBar(Quiz.doneChars,Quiz.totalChars);

      //update the map bar
      //document.getElementById('map').innerHTML=this.updateMapBar(Quiz.doneChars);
      this.updateMap(this.getCurrentLine());
       this.predictETA();
      //this.score += Quiz.BLOCK;
      this.score += skipped;
      saveLines[this.id]=this.score;
      console.log(this.score);
 
  }
  


      var lastLength=0;
   this.smartCompare = function(user_input,ans_key) {
     var fresh = user_input.length;
     user_input = this.decodeEntities(user_input);
     ans_key = this.decodeEntities(ans_key );

     ans_key = ans_key.replace(/\</g,'≤');     

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
     

     
     //template = template.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()\+\<\>]/g,punc_char); // replace punctuation with char
    // template= template.replace(/[a-zA-Z]/g,filler_char); // replace letters with char, but keep length the same

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

         }else if(key[i]==='≤' && input[i]==='<'){
            template[i]='<span class="green">'+key[i]+'</span>';
             counter++;




         }else if(input[i]===key[i]){ //correct letter
             template[i]='<span class="green">'+input[i]+'</span>';
             counter++;

         }else if(key[i].search(/[\ \t\r\n\v\f]/g)>=0){ // wrong char, should be whitespace instead
             template[i]='<span class="needswhite">'+input[i]+'</span>';


         }else if(key[i].search(/[.,?!]/g)>=0){ // wrong char, should be puntuation //TODO change this test to incldue all typale puctuation
             template[i]='<span class="yellow">'+input[i]+'</span>';
             allGreen =0;

         }else if(input[i].toLowerCase()===key[i].toLowerCase()){ //wrong char, should be differant case
            allGreen =0;
             template[i]='<span class="underline">'+input[i]+'</span>';

         }else if(input[i]==='`' && key[i].search(/[•…－–—]/)>=0){

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
}

NewQuiz.prototype = new Quiz();

</script>



<pre id='file'></pre>





<!--bar -->
<span id='totalLines'></span><span class='space'></span>line:<br/>
<progress id='lineProgress' value="22" max="100">
</progress><br/>

<!--bar -->
<span id='totalChars'></span>characters:<br/>
<progress id='charProgress' value="22" max="100">
</progress>
 ⏱ <span id='timer'>_</span>⏱ <span id='predicttimer'>_</span>  <span class='space'></span>  <br/>
<span id='map'></span>
<p class='small'>
  <span id='navBar'></span><br/>
    <?php echo str_replace("/Dropbox/pure_code/material/",'',$file_path) .' <br>'.$mode?> <br/>
    <span class='placeholder' id='doneChars'>0</span>/<span id='totalCharCount' class='placeholder'> </span><br/>
    
     
    <br/><br/><br/> 
</p>

<p id='buffer'></p> <!-- this <p> is a buffer to stop the bottom fixed menu <small> from hidding content at the bottom of the page-->
</html>
