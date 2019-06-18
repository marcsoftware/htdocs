<script type="text/javascript">

// make tooltip, hovers around mouse cursor
$(document).mousemove(function(e){
    $("#hint").css({left:e.pageX, top:e.pageY-30});
});

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/

function showHint(handle){
  document.getElementById('hint').innerHTML=handle;
  

}

//play sound

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
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

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/

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

var fileName = "tinycards-test1.txt";
var file_path = "../pure_code/material/german/duolingo/tinycards-test1.txt";
var folder = "../pure_code/material/german/duolingo";
file_path=file_path.replace('/pure_code',""); //TODO make all file_paths absolute to avoid this, and put all file paths in their own file
var totalCharCount=0;
var doneChars=0; // a running total of the chars user has correctly entered
// global vars that are passed to makeCookie()
var timeRibbon=[];
var original;
var mode = "de_selftest.php";
var completed=0;
var timer=0;
var saveLines=null;

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function makeQuiz(){

    //this.readCookie();
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

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function NewQuiz (text,handle) {
    this.text=text;
    this.handle=handle;
    this.resultHandle;
    this.score=0;
    this.lines;
    this.maxScore=0;
    this.comments;
    this.codes;
    this.id;
    //static variables
    this.totalOfExamples;
    this.typedExamples;
    this.colors = []; // holds the higlihed chars for smarCompare()
     Quiz.BLOCK = 200; // number of lines the user enters at once
     this.already_done=0; // check this variable to prevent double counting of doneChars and doneLines
     Quiz.prototype.totalLines=0;
     Quiz.totalChars=0;
     Quiz.doneLines=0;
    Quiz.doneChars=0;
     this.catchComments =  new RegExp("\/\/.*","g");
     Quiz.prototype.navBar=[];
     Quiz.startChars;
     Quiz.page_score=0;
     this.save_score;
     this.startScore=0;
     this.perfect=true;

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    this.create = function(id) {

        this.id = id;


        this.readCookie();
        
        
       
        text = text.replace(this.catchComments,'');
        this.codes=text.split('\n');

        this.codes=this.codes.filter(function(n){ return n != undefined }); 

        this.maxScore=this.codes.length-1;

        var new_text  = text.replace(/\<br\/\>/gm,'');

        Quiz.totalChars+=new_text.match(/\S/g).length;

        this.handle.innerHTML='';


        
        this.handle.innerHTML+=`<p></p> <p></p>  <p></p> ` ;//make the place holder elements

        
        
        this.updateNavBar();
        Quiz.prototype.totalLines=Number(Quiz.prototype.totalLines)+Number(this.maxScore);


        document.title=fileName+' '; // TODO make Gerneric dont use Quiz keyword
        

        this.clear();

        // calutlate the lines that have been typed and display
        Quiz.prototype.totalLines=Number(Quiz.prototype.totalLines)+Number(this.maxScore);



        // prevent NaN value
        if(isNaN(parseFloat(this.score))){ // if score in invalid do nothing
          //
        }else{
          Quiz.doneLines+=this.score; // score is valid so safe to add.
        }

        if(this.score>=this.maxScore){
          this.score =0;


        }


        if(this.score >=this.maxScore){

          this.score=0;
        }
    


        this.totalLinesBar(Quiz.doneLines,this.maxScore);
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
       
     
        Quiz.startChars=Quiz.doneChars;
        this.totalCharsBar(Quiz.doneChars,Quiz.totalChars);


        document.getElementById('map').innerHTML=this.updateMapBar(Quiz.doneChars,Quiz.totalChars);
        this.smartDisplay();
        this.countChar();

        this.startScore = this.score;
        // add mouse over event
        
        
        var obj= this;
        var ans = this.getCurrentLine();
        this.scrambleDisplay();
        
        



    };

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
 this.gaveup = function(){
      this.perfect=false;
      targets_array = targets.split('<br/>');
       key = targets_array[Quiz.page_score];

        //user input was incorrect so add it to the end
        
        var missed_word = key +'\t '+original_terms[Quiz.page_score];


        //this.codes.push(missed_word);
        this.maxScore=this.codes.length;
        document.getElementById('missed').innerHTML=missed_word;


      
    }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
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

    var master = this;
    xmlhttp.onreadystatechange=function(){

        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            var result=xmlhttp.responseText.split('~');
            
            timeRibbon=result[0].split(',');
            master.score=Number(result[3])|| 0;
            
              

            if(result.length >=2){
                saveLines=result[1].split(',');
                
            }

            try{
              saveLines[100]=1;
            }catch(e){}

            try{
              document.getElementById('missed').innerHTML=result[2].split(',').length;
              missed_words=result[2];
              this.codes.push(result[2].split(','));
              this.maxScore = this.codes.length;
              
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



/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
 this.lineDisplay = function(){
  org_targets= targets.split("<br/>");
    var word = org_targets[Quiz.page_score];
      word = `<p class='green'>${word}</p>`;
      org_targets[Quiz.page_score]= word;

org_targets= org_targets.join("<br/>");
      var list = this.handle.getElementsByTagName('p');
       
       list[0].innerHTML=org_targets;
       
   




 }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function playSound() {
  var click=audioLineDone.cloneNode();
  click.volume=0.5;
  click.play();
}

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
  // when user inputs correct answere, call this function
  this.correctAns = function( skip=0){
      playSound();
      Quiz.page_score++;
      document.getElementById('userbox').value='';
      document.getElementById('missed').innerHTML='';
      // hiligh current word
      
      var pageLength = Quiz.BLOCK;
      
      if(targets.split("<br/>").length !== Quiz.BLOCK ){
        
          pageLength = targets.split("<br/>").length;

      }
      
      if(Quiz.page_score>=pageLength){ //Turn the page

        this.turnPage();
        this.totalLinesBar(this.score, this.maxScore);
        this.predictETA(this.score,this.maxScore);
        this.updateCookie();



        

        }

      if(this.score >= this.maxScore){

        alert('You win!');
        this.score=0;
      }

       this.lineDisplay();
 
  }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    this.predictETA=function(done,total){
     var current = Number(done)-Number(this.startScore);
    var time = document.getElementById('timer').innerHTML;
    time = time.split(':');
    var seconds = Number(time[2]);
    var minutes = Number(time[1])*60;//conver minutes to seconds
    var hours = Number(time[0])*60*60;//convert hours to seconds

    var totalSeconds = seconds+minutes+hours;

    var charsPerSec = current/totalSeconds; 
    
   var charsLeft = total-done;
    var secondsETA= charsLeft/charsPerSec;


    var date = new Date(null);
    date.setSeconds(secondsETA); // specify value for SECONDS here
    

    try{
      var format = date.toISOString().substr(11, 8);
    }catch(e){}
    document.getElementById('predicttimer').innerHTML=format;


  }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
  this.turnPage = function(){
    var list = this.handle.getElementsByTagName('p');
       list[1].innerHTML='';
       list[0].innerHTML='';

      Quiz.page_score = 0;
      if(this.perfect){
        this.score+=Quiz.BLOCK;

      }
      console.log(this.perfect);
      this.perfect=true;
      this.scrambleDisplay();

     
      

  }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
  function compare(x,y){

    x= x.replace(/[\W]/g,'');
    y= y.replace(/[\W]/g,'');

    x=x.toLowerCase();
    y=y.toLowerCase();
    
    return x===y;


  }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    //check if users input is correct 
    this.check = function(input) {
      targets_array = targets.split('<br/>');

       key = targets_array[Quiz.page_score];
      terms_array = original_terms; //TODO variable with  TERMS in their name should be changed to SOURCE
      
      targets_array = original_targets;
      
      
     
      //find all copies of INPUT if they exist
     
      terms_array = terms_array.map( //source language 
              function(value,index){ //

                if(compare(value,input)){

                  return index;
                }
                //else
                return '';
              }
          );

      
      // find all copies of ans key if they exist
      
       targets_array = targets_array.map(
              function(value,index){

                if(compare(value,key)){

                  return index;
                }
                //else
                return '';
              }
          );

       

       targets_array = targets_array.filter(function(x){return x !== ''; });
       terms_array = terms_array.filter(function(x){return x !== ''; });
       
      //delete empty array elemtns
      //targets_array = targets_array.filter(function(value) { return value; });
      found = -1;
      number = -1;
      for(var i =0;i<targets_array.length;i++){
         number= targets_array[i];
          
         
         if(found <0){
          found = terms_array.indexOf(number);
        }

         
      }
      
     

         
     
      if(found>=0){
        this.correctAns();
      }
      

    };



    

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    this.getCurrentLine =function(s){

       //return this.codes.slice(this.score,this.score+block);
       var x = [1,1];
       var result =[];
      var whitespace='';
      var thisline='';
       
       skipped = 0;
       for(var i=0;result.length<Quiz.BLOCK ;i++){

          if(this.codes[this.score+i] && this.codes[this.score+i].match(/[0-zA-Z]/g)){
            
            
            thisline = (this.codes[this.score+i]);
            thisline= thisline.replace(/\t\<br/g,'');
            thisline= thisline.replace(/\t/g,' ≈ ');


            if(thisline){ // is THISLINE is valid
              result.push(thisline);
            }
          }

          if (this.score+i>this.maxScore){
            
            return result.join('<br/>');
          }

       }

       

       if(result.join().match(/[0-zA-Z]/g) === null){
              // currenLine is empty
              //this.correctAns();

          }

      

       return result.join('<br/>');
    }
    

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    this.makeButtons = function(){

      
    }
/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    this.clear = function(){


    }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    //hiights the current line of code
    // context: uses global variable score
    this.smartDisplay = function(input='') {
        console.log('Entered smartDisplay');
       var list = this.handle.getElementsByTagName('p');
       list[1].innerHTML='';
       list[0].innerHTML=this.getCurrentLine();
       
       
       

    };

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    /**
     * Shuffles array in place.
     * @param {Array} a items The array containing the items.
     */
    function shuffle(a) {
        var j, x, i;
        for (i = a.length; i; i--) {
            j = Math.floor(Math.random() * i);
            x = a[i - 1];
            a[i - 1] = a[j];
            a[j] = x;
        }
    }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
// Will remove all falsy values: undefined, null, 0, false, NaN and "" (empty string)
function cleanArray(actual) {
  var newArray = new Array();
  for (var i = 0; i < actual.length; i++) {
    if (actual[i]) {
      newArray.push(actual[i]);
    }
  }
  return newArray;
}


    this.scrambleDisplay = function(input='') {
       //TODO scramble the german words
       

       var all = this.getCurrentLine();
       
       
       all = all.split('<br/>');
       var keys = all;
       all = all.join(',').split('≈');
       all = all.join().split(',');
       

       // get list of de terms. 
       targets = all.filter(function(element, index, array) {
          return (index % 2 === 0);
        });

        // get list of TERMS
        terms = all.filter(function(element, index, array) {
          return (index % 2 !== 0);
        });


       var parent = document.getElementById('file');
       parent.innerHTML='';
       targets.forEach(function(element, index) {
          var x = document.createElement("span");
          
          var t = document.createTextNode(element+'\n');
          x.appendChild(t);
          x.addEventListener("mouseover", function(){
            document.getElementById('hint').innerHTML=(terms[index]);
          }); 

          x.addEventListener("mouseout", function(){
            document.getElementById('hint').innerHTML='';
          }); 

          x.addEventListener("mouseup", function(event){
            if(event.which==1){ // 1 means the left-mouse button
                x.innerHTML='------\n';
            }
          });
          
          parent.appendChild(x);

        });

       original_targets= targets.slice(); //copy array

       
      

       //var list = this.handle.getElementsByTagName('p');
       
       //list[0].innerHTML=targets;

     
        
    };


   

}

NewQuiz.prototype = new Quiz();

</script>
-----------------
function main(){
  var fileName = "1";
  alert(fileName);
}



/**
//---------------------------------------------------------------------
// this function is called when user clicks a button
// this function removes all words that are not marked as red
//     so that the user can study just the red words
//---------------------------------------------------------------------
*/
function focusRedWords(){
    //TODO scroll to top
    // TODO remove green words and umkared words
    // TODO hide the translations
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
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
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

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/

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

        //document.getElementById('timer').innerHTML = hours+':'+minutes+':'+seconds;
    }, delta);

})();

window.onblur = function() { window.blurred = true; };
window.onfocus = function() { window.blurred = false; };

var fileName = "<?php echo $fileName ?>";
var file_path = "<?php echo $file_path ?>";
var folder = "<?php echo $folder ?>";
file_path=file_path.replace('/pure_code',""); //TODO make all file_paths absolute to avoid this, and put all file paths in their own file


// global vars that are passed to makeCookie()

var original;
var mode = "<?php echo $mode ?>";

var timer=0;




/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function NewQuiz (text,handle) {
    this.text=text;
    this.handle=handle;
    this.resultHandle;
    this.score=0;
    this.lines;
    this.maxScore=0;
    this.comments;
    this.codes;
    this.id;
    //static variables
    this.totalOfExamples;
    this.typedExamples;
    this.colors = []; // holds the higlihed chars for smarCompare()
     Quiz.BLOCK = 200; // number of lines the user enters at once
     this.already_done=0; // check this variable to prevent double counting of doneChars and doneLines
     Quiz.prototype.totalLines=0;
     Quiz.totalChars=0;
     Quiz.doneLines=0;
    Quiz.doneChars=0;
     this.catchComments =  new RegExp("\/\/.*","g");
     Quiz.prototype.navBar=[];
     Quiz.startChars;
     Quiz.page_score=0;
     this.save_score;
     this.startScore=0;
     this.perfect=true;

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    this.create = function(id) {

        this.id = id;


        this.readCookie();
        
        
       
        text = text.replace(this.catchComments,'');
        this.codes=text.split('\n');

        this.codes=this.codes.filter(function(n){ return n != undefined }); 

        this.maxScore=this.codes.length-1;

        var new_text  = text.replace(/\<br\/\>/gm,'');

        Quiz.totalChars+=new_text.match(/\S/g).length;

        this.handle.innerHTML='';


        
        this.handle.innerHTML+=`<p></p> <p></p>  <p></p> ` ;//make the place holder elements

        
        
        
        Quiz.prototype.totalLines=Number(Quiz.prototype.totalLines)+Number(this.maxScore);


        document.title=fileName+' '; // TODO make Gerneric dont use Quiz keyword
        

        this.clear();

        // calutlate the lines that have been typed and display
        Quiz.prototype.totalLines=Number(Quiz.prototype.totalLines)+Number(this.maxScore);



        // prevent NaN value
        if(isNaN(parseFloat(this.score))){ // if score in invalid do nothing
          //
        }else{
          Quiz.doneLines+=this.score; // score is valid so safe to add.
        }

        if(this.score>=this.maxScore){
          this.score =0;


        }


        if(this.score >=this.maxScore){

          this.score=0;
        }
    


        
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
       
     
        Quiz.startChars=Quiz.doneChars;
        


       // document.getElementById('map').innerHTML=this.updateMapBar(Quiz.doneChars,Quiz.totalChars);
        
        

        this.startScore = this.score;
        // add mouse over event
        
        
        var obj= this;
        var ans = this.getCurrentLine();
        this.scrambleDisplay();
        
        



    };


/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
  function compare(x,y){

    x= x.replace(/[\W]/g,'');
    y= y.replace(/[\W]/g,'');

    x=x.toLowerCase();
    y=y.toLowerCase();
    
    return x===y;


  }

/**
//---------------------------------------------------------------------
// called when user click a butt
// removes all words that are not colored red
// it then turns all red words back into unmarked-black words.
//---------------------------------------------------------------------
*/
function focusRedWords(){
    window.scrollTo(0, 0);
}

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
    /**
     * Shuffles array in place.
     * @param {Array} a items The array containing the items.
     */
    function shuffle(a) {
        var j, x, i;
        for (i = a.length; i; i--) {
            j = Math.floor(Math.random() * i);
            x = a[i - 1];
            a[i - 1] = a[j];
            a[j] = x;
        }
    }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
// Will remove all falsy values: undefined, null, 0, false, NaN and "" (empty string)
function cleanArray(actual) {
  var newArray = new Array();
  for (var i = 0; i < actual.length; i++) {
    if (actual[i]) {
      newArray.push(actual[i]);
    }
  }
  return newArray;
}




   

}


