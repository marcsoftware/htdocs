
"use strict";
var audioLineDone = new Audio('../beep1.mp3');
audioLineDone.preload = 'auto';
audioLineDone.load();
var audio2 = new Audio('../beep2.mp3');
var audioExampleDone = new Audio('../beep3.mp3');
var audioMedium = new Audio('../beep4.mp3');

//lower the volume
audioExampleDone.volume=0.5;
audioMedium.volume=0.5;

var fileName = "<?php echo $fileName ?>";
var file_path = "<?php echo $file_path ?>";
var folder = "<?php echo $folder ?>";

var totalCharCount=0;
var totalWordCount=0;
var doneChars=0; // a running total of the chars user has correctly entered
// global vars that are passed to makeCookie()
var timeRibbon=[];
var original;
var mode = '<INSERT MODE HERE>';
var completed=0;
var timer=0;
var saveLines=null;

var seconds=0;
var time_unit=1000*60; // one minute
var doneWords;
var doneChars;


/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function playAudio(word){
      word=word.replace(/\ /g,'.'); //our audiofolder has dots instead of spaces.
      var word = new Audio(`../../audio-de/${word}.wav`);
      word.play();
      try{
       
      }catch(e){
        console.log("ERROR: cant delete word");
      }
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function stopwatch(){
    seconds++;


    setTimeout(stopwatch, time_unit); // keep counting
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
//this save contents from a file to an element called 'file' when a file path is passed to ti
function readFile(url) {

    var xhr = new XMLHttpRequest();

    xhr.onload = function () {
        original = this.responseText; //HACKED save in element called file, since can'it use global varibale in async anonymous function
        original= original.replace(/\</g,"&lt");

    };




    xhr.open('GET', url,false);
    xhr.send();



}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function count(s){
    var str, temp= document.createElement('p');
    s=s.replace(/\s/g,'');
    temp.innerHTML= s;

    str= temp.textContent || temp.innerText;
    temp=null;
    return str.length;// delete  whitespace chars and count the remaining
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
// wraps all exmaples with <p> tags
function parse(text){
    text=text.replace(/\uFFFC/g,'');// delete strange unicode chars //TODO would this cause a total typed char to be higher than total char?
    totalCharCount = count(text);
    totalWordCount = text.match(/\S*/g).length/2; //TODO why need to divid by two?




    window.labels=0;

    // delete the regular text pragraphs but keep the example code
    text=text.replace(/\`\`\r/g,'``marc');
    
    if( text.includes("``")){

      try{
       text = text.match(/(``)([^`]+)(``)/g).join(' '); // deletes the text that is not in the actual exmaple
       text = "``"+text.replace(/\`\`/g,'')+"``"; // turns all examples into just one example
     }catch(e){};



    }else{
        
        text = '<div>'+text+'</div>';

    }



    
    original=text;
    return text;
}



/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function init(){

    //display file
    stopwatch();

    //    readFile('/Dropbox/pure_code/material/'+fileName);
    readFile(file_path);

    original=parse(original); // TODO bad name. ReadFIle() returns this as a global varibale which is bad
    
    document.getElementById('file').innerHTML=original.trim();

    //make file look like a quiz
    makeQuiz();
}
window.onload = init;


/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function testArray(element){
    return element != 'NaN';
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;
 var seed = 0.1234;
  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(seed * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}


    /**
     * Shuffles array in place.
     * @param {Array} a items The array containing the items.
     */
    function shuffle2(a) {
        var j, x, i;
        for (i = a.length; i; i--) {
            j = Math.floor(Math.random() * i);
            x = a[i - 1];
            a[i - 1] = a[j];
            a[j] = x;
        }
    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
var Quiz= function(text,handle) {
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
    this.colors = []; // holds the higlihed chars for smarCompare()
     Quiz.BLOCK = 2; // number of lines the user enters at once
     this.already_done=0; // check this variable to prevent double counting of doneChars and doneLines
     Quiz.prototype.totalLines=0;
     Quiz.totalChars=0;
     Quiz.doneLines=0;
    Quiz.doneChars=0;
     this.catchComments =  new RegExp("\/\/.*","g");
     Quiz.prototype.navBar=[];
     Quiz.startChars;
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
       
        
        if(saveLines[0]>=this.maxScore-1){ //TODO test if this comapre works
          
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

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    this.updateNavBar = function(){
        var new_bar = this.navBar.map(function(value,index) { 
            if(value===1){
                value = '▣';
            }else{
                value = '▢';
            }
           return `<span class='nospace' onclick="moveTo(${index})" >${value}</span>`;
        }); 

        document.getElementById('navBar').innerHTML=new_bar.join('');

    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    moveTo = function(where){
        document.getElementsByTagName('div')[where].scrollIntoView();
    }

    //TODO find textarea and attach events
    this.makeEvents = function() {

        var object = this;
        //var textBox = object.handle.childNodes[2]; // the 3rd node[2] is always a input-text
        var textBox = this.handle.getElementsByTagName('input')[0];
        textBox.addEventListener("keyup", function(event) {
            //this.handleClick(event); //TODO need to use this line of code

            // object.check(1);  //TODO delete this line of code


            object.check(textBox.value);  //TODO delete this line of code


        });

    };

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    // keep track of completed chars and words
    // TODO this does words as well
    this.countChar = function(){




    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/

 // arg input is a string
 // returns same string with special chars removed
  this.scrub = function(x) {
      x = x.replace(/\<br\/\>/g,'\n');
      return x;

  }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
 this.totalLinesBar = function(done,total){
  var percent = (done/total)*100;
      percent = Math.floor(percent);  
      percent = pad(percent,2)+'%';

   var size = total.toString().length;
   done = pad(done,size);
   document.getElementById('totalLines').innerHTML =percent+"  "+ done+'/'+total;
   document.getElementById('lineProgress').value=done;
    document.getElementById('lineProgress').max=total;

 }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
 function pad(num, size) {
    var s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
  }

  /**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
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

       }
       

      Quiz.doneChars += done;
      this.totalCharsBar(Quiz.doneChars,Quiz.totalChars);

      //update the map bar
      //document.getElementById('map').innerHTML=this.updateMapBar(Quiz.doneChars);
      this.updateMap(this.getCurrentLine());
       this.predictETA();
      this.score += Quiz.BLOCK;
 
  }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
  this.predictETA=function(){
     var current = Number(Quiz.doneChars)-Number(Quiz.startChars);
    var time = document.getElementById('timer').innerHTML;
    time = time.split(':');
    var seconds = Number(time[2]);
    var minutes = Number(time[1])*60;//conver minutes to seconds
    var hours = Number(time[0])*60*60;//convert hours to seconds

    var totalSeconds = seconds+minutes+hours;

    var charsPerSec = current/totalSeconds; 
   var charsLeft = Quiz.totalChars-Quiz.doneChars;
    var secondsETA= charsLeft/charsPerSec;


    var date = new Date(null);

    date.setSeconds(secondsETA); // specify value for SECONDS here
    try{
      var format = date.toISOString().substr(11, 8);

      document.getElementById('predicttimer').innerHTML=format;
    }catch(e){}

  }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
  this.totalCharsBar= function(done,total){
    var percent = (done/total)*100;
        percent = Math.floor(percent);
        percent = pad(percent,2)+'%';
    
    var size = total.toString().length;
    done = pad(done,size);

    document.getElementById('charProgress').value=done;
    document.getElementById('charProgress').max=total;
    document.getElementById('totalChars').innerHTML=percent+'  '+done+'/'+total;
  }


/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
var last_done;
this.updateMapBar= function(done){
  last_done = last_done || done;
  var stamp = "X".repeat(done-last_done);
  


    return stamp;

    
  }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
  this.updateMap = function(text){
      document.getElementById('map').innerHTML+=text.join('').replace(/\s/g,'');
  }


/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    //check if user
    this.check = function(input) {
          
        
        input= input.replace(/\</g,"&lt;"); //make sure input with special char '<' still displays correctly

      //  this.smartDisplay(input);
        var ans_key = this.getCurrentLine().join('').trim();

        
        

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

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
  // is user complete an example mark it done.
  this.markAsDone = function(){
    
    this.already_done =true;


  }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    this.decodeEntities =function(s){
        if(s==null){
            return "";


        }
        s=s.replace(/\</g,'&lt;');

        s=s.replace(/[“”]/g,'"'); // replace smart quotes
        s=s.replace(/[‘’]/g,"'");

        var str, temp= document.createElement('p');
        temp.innerHTML= s;
        str= temp.textContent || temp.innerText;
        temp=null;
        return str;
    };


/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    this.getCurrentLine =function(s){

       //return this.codes.slice(this.score,this.score+block);
       var x = [1,1];
       var result =[];
      var whitespace='';
      var thisline='';

      if(this.score>=this.maxScore){
        result= [''];

      }

 
       for(var i=0;result.length<Quiz.BLOCK;i++){


          if(this.codes[this.score+i] && this.codes[this.score+i].match(/[0-zA-Z]/g)){
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

      

       return result;
    }

  /**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
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
        //list[0].innerHTML=(this.codes.slice(0,this.score).join('\n')); //lines of code that the user has typed, if any

        // dont display text that was type, or the text that still needs to be typed
      //  list[2].style.display='none'; // this hides the code.
      //  list[0].style.display='none';

        //autoscroll to input box
        var box = this.handle.getElementsByTagName('input')[0];
       // window.scroll(0,this.findPos(list[1])); //autoscr


        //


    };

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    //Finds y value of given object
    this.findPos = function(obj) {
        
        var curtop = 0;
        if (obj.offsetParent) {
            do {
                curtop += obj.offsetTop;
            } while (obj = obj.offsetParent);
            return [curtop];
        }
    }

    /**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    this.encodeEntities = function(letter){
        
        try{
            letter = letter.replace(/\</g,'&lt;');
            letter = letter.replace(/\>/g,'&gt;');
        }catch(e){


        }
        return letter;
    };



/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
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
   

   /**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    //y is the KEY and x is the user's input
    this.compare = function(x,y){
        
  
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


/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    // turn input into long version of char ex. < become '&lt;'
    this.longChar = function(x){
        
        x = x.replace(/\>/g,'&gt;');
        x = x.replace(/\</g,'&lt;');
        x = x.replace(/\&\&/g,'&amp;&amp;');

        return x;
    }


    /**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    this.display = function(input = "") {
        this.clear();
        var t = document.createTextNode(input);      // Create a text node
        this.handle.appendChild(t);                     // Append the text to <p>



    };

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    //clears original text in the example but keeps the input-text element
    this.clear = function() {

        
        var box = this.handle.getElementsByTagName('input')[0];

        this.handle.childNodes[0].innerHTML='';
        this.handle.childNodes[1].innerHTML='';
        box.value='';

        this.handle.childNodes[3].innerHTML='';
        // box.focus(); // automaticall scroll window to the input box, this ensures user can always see the box


    };





/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    this.handleClick = function(input) {
        // assume DOM Level 2 events support

        // pass to application logic
        //this.check(1);

  
    };


/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/

    this.drawTextBox = function() {

  
        //this.handle.innerHTML+='<input type="text" value=""></input>';
        this.handle.innerHTML+='<input type="text" value="" id="jumphere"></input>';

    };

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    // shuffle an array
    this.shuffle = function(o){
  
        for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
        return o;
    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/

    // dont confue THIS.updateCookie() with nothing dot updateCookie()
     this.missed_words= '';
    this.updateCookie = function(){
           
  
    var cheated=0;
    var score=this.score;

    var subject=fileName;

    var totalTime=0;

    var missed_words = missed_words || 0;
    //var timeRibbon=0;
    //var mode = 0;
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

            //alert('after call:'+xmlhttp.responseText);


        }
    }

       timeRibbon = []; // fuck time ribbin
   

    //timer = document.getElementById('timer').innerHTML;
    
  timer=time;
    xmlhttp.open("GET","/Dropbox/pure_code/createCookie.php?mode="+mode+'&score='+score+
    '&maxScore='+this.maxScore+'&completed='+completed+'&subject='+subject+
    '&timer='+timer+'&totalTime='+totalTime+'&timeRibbon='+timeRibbon+
    '&book='+folder+'&saveLines='+saveLines+'&missed_words='+missed_words,
    false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();


    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    this.readCookie = function(){
        
       var score=0;
    var cheated=0;
    var completed=0;


    var totalTime=0;

    var xmlhttp;
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

        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            var result=xmlhttp.responseText.split('~');
            console.log(result);
            timeRibbon=result[0].split(',');

            if(result.length >=2){
                saveLines=result[1].split(',');
                
            }

            try{
              saveLines[5]=1;
            }catch(e){}

            try{
              document.getElementById('missed').innerHTML=result[2].split(',').length;
              missed_words=result[2];
              this.codes.push(result[2].split(','));
              this.maxScore = this.codes.length;
              
              console.log(result[3]);


            }catch(e){}



        }
    }


    xmlhttp.open("GET","/Dropbox/pure_code/readCookie.php?mode="+mode+'&score='+score+
    '&cheated='+cheated+'&completed='+completed+'&chapter='+fileName+
    '&timer='+timer+'&totalTime='+totalTime+'&timeRibbon='+timeRibbon+
    '&book='+folder,
    false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();
      
    }

}



/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
//read from the database cookie
function readCookie(){
    
    var score=0;
    var cheated=0;
    var completed=0;


    var totalTime=0;

    var xmlhttp;
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

        if (xmlhttp.readyState==4 && xmlhttp.status==200){

            var result=xmlhttp.responseText.split('~');
            
            timeRibbon=result[0].split(',');

            if(result.length >=2){
                saveLines=result[1].split(',');

                
            }

            try{
              saveLines[5]=1;
            }catch(e){}

            try{
              
              //TODO deal with missed words better.
              //document.getElementById('missed').innerHTML=result[2].split(',').length;
              //missed_words=result[2];
              //this.codes.push(result[2].split(','));
              //this.maxScore = this.codes.length;
              
              score=(result[3]); 
              time=parseInt(result[4]);
              

              if (saveLines[1] >=this.maxScore){
                saveLines[1]=1;

              }

            }catch(e){console.log(e);}



        }
    }

    xmlhttp.open("GET","/Dropbox/pure_code/readCookie.php?mode="+mode+'&score='+score+
    '&cheated='+cheated+'&completed='+completed+'&chapter='+fileName+
    '&timer='+timer+'&totalTime='+totalTime+'&timeRibbon='+timeRibbon+
    '&book='+folder,
    false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();

}
