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


progress{
  width: 100%;

}


#map{
  font-family: monospace;
  max-width: 25%;
  width: 25%;
  word-wrap: break-word;
  font-size: 1px;
  

}
#buffer{
     /* height should be equal to the bottom fixed menu <small> to stop content from being covered up */
  height:100px;
}
body {
        color: white;
        background-color: black;
        max-width: 100%;
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
    padding-right: 10px;


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
   /* position:fixed;*/
    
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

.buttons{

  margin:1px;
  padding:1px;
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

//play sound


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
var saveLines=null;


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
     Quiz.BLOCK = 4; // number of lines the user enters at once
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
     this.perfect= true;

     this.dictionary;



    this.create = function(id) { //BROCKEN
      
      
        this.id = id;


        this.readCookie();
        
        
       
     
        text = text.replace(this.catchComments,'');
        text = text.replace(/;.*/g,'');
        
         
        //get unique words and then look them up
        this.readDictionary();
        
        text = this.getUniqueWords(text); 
        var text2=text;
        
        var super_text=[];
        var count_missing=0;
        for(var i = 0;i<text.length;i++){
            var eng = lookup(text[i]);

            if(eng != null){
              super_text[i]=(text[i]+'\t'+eng.trim());

              
            }else{
              count_missing++;
              
            }
            
        }
      
        super_text = super_text.filter(function(n){ return n != undefined });  //delete empty elements from super_text
        text = super_text.join('\n');

        

        if(count_missing != 0){
          alert('Missing word count: '+count_missing);
        }else{
          console.log('All words found.'+count_missing);
        }

        
        
        this.codes=text.split('\n');
        
       
        
        this.codes=this.codes.filter(function(n){ return n != undefined }); 

        this.maxScore=this.codes.length;

        var new_text  = text.replace(/\<br\/\>/gm,'');

        Quiz.totalChars+=new_text.match(/\S/g).length;

        this.handle.innerHTML='';


        //this.handle.innerHTML+="<br/><br/><br/>"; //make space between butotns and text
        this.handle.innerHTML+="<p></p> <p></p>  <p></p> " //make the place holder elements
        
        //this.display(this.lines);



        this.smartDisplay();
        //this.drawTextBox();

         
        // if example  was compledted by user in previous session then mark it as grey
       
        
        
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
        
        var list = this.handle.getElementsByTagName('p');
        var obj= this;
        var ans = this.getCurrentLine();

        list[0].addEventListener("mouseout", function(){
          obj.scrambleDisplay();
        }); 

        list[0].addEventListener("mouseover", function(){
          obj.smartDisplay();
        }); 



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
                    
                    
                    
                    globalEng=en[0].split("\t")[1].trim();

                }
            };

              
           


            xmlhttp.open("GET","/Dropbox/pure_code/lookup.php?german="+german,
            false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();
            
            return globalEng;

    }


 this.getUniqueWords = function(x){
    var words =  x.match(/\w+/g);
    var unique = words.filter(function(elem, index, self) {
      return index == self.indexOf(elem);
    });

    return(unique);

 }

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




 this.lineDisplay = function(){
  org_targets= targets.split("<br/>");
    var word = org_targets[Quiz.page_score];
      word = `<p class='green'>${word}</p>`;
      org_targets[Quiz.page_score]= word;

org_targets= org_targets.join("<br/>");
      var list = this.handle.getElementsByTagName('p');
       
       list[0].innerHTML=org_targets;
   




 }

function playSound() {
  var click=audioLineDone.cloneNode();
  click.volume=0.5;
  click.play();
}

  // when user inputs correct answere, call this function
  this.correctAns = function( skip=0){
      playSound();
      Quiz.page_score++;
      // hiligh current word
      
      var pageLength = Quiz.BLOCK;
      
      if(targets.split("<br/>").length !== Quiz.BLOCK ){
        
          pageLength = targets.split("<br/>").length;

      }
      
      if(Quiz.page_score>=pageLength){ //Turn the page
console.log('befure turnpage');
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
    
    var format = date.toISOString().substr(11, 8);
    document.getElementById('predicttimer').innerHTML=format;


  }


  //this save contents from a file to an element called 'file' when a file path is passed to ti
 this.readDictionary = function() {
   var url = '../smallDictionary.csv';
    var xhr = new XMLHttpRequest();

    var master = this;
    xhr.onload = function () {
        var result = this.responseText; 
        master.dictionary = result;

        return 1;

    };




    xhr.open('GET', url,false);
    xhr.send();



}


  this.turnPage = function(){
    var list = this.handle.getElementsByTagName('p');
       list[1].innerHTML='';
       list[0].innerHTML='';
      Quiz.page_score = 0;

      if(this.perfect){
        this.score+=Quiz.BLOCK;

      }
      this.perfect=true;
      this.scrambleDisplay();
     
      

  }


  function compare(x,y){

    x= x.replace(/[\W]/g,'');
    y= y.replace(/[\W]/g,'');

    x=x.toLowerCase();
    y=y.toLowerCase();
    
    return x===y;


  }


    //check if users input is correct 
    this.check = function(this_button, input) {
      
      targets_array = targets.split('<br/>');
       key = targets_array[Quiz.page_score];
      terms_array = original_terms;
      
      targets_array = original_targets;
      
     
      //find all copies of INPUT if they exist
     
      terms_array = terms_array.map(
              function(value,index){

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

      //delete empty array elemtns
      //targets_array = targets_array.filter(function(value) { return value; });
      found = -1;
      number = -1;
      for(var i =0;i<targets_array.length;i++){
         number= targets_array[i];

         if(found<0){
          found = terms_array.indexOf(number);
        }
      }
      
      
     
      if(found>=0){
        this.correctAns();
      }else{
        //this.perfect=false;
      }


      

    };



    


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
            thisline= thisline.replace(/\t+/g,' ≈ ');


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
    


    this.makeButtons = function(){

      
    }

    this.clear = function(){


    }

    //hiights the current line of code
    // context: uses global variable score
    this.smartDisplay = function(input='') {
        
       var list = this.handle.getElementsByTagName('p');
       list[1].innerHTML='';
       list[0].innerHTML=this.getCurrentLine();
       
       
       

    };


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

    this.scrambleDisplay = function(input='') {
       //TODO scramble the german words
       

       var all = this.getCurrentLine();

       all = all.split('<br/>');
       all = all.join(',').split('≈');
       all = all.join().split(',');

       // get list of de terms. 
       targets = all.filter(function(element, index, array) {
          return (index % 2 === 0);
        });
       
       original_targets= targets.slice(); //copy array

       
       // get list of TERMS
        terms = all.filter(function(element, index, array) {
          return (index % 2 !== 0);
        });
       
       
       // scramble TERMS 
       original_terms = terms.slice();
       shuffle(terms);
       
       targets = targets.join('<br/>')
       
        myobj = this;
       // draw buttons
       terms_wrapped = terms.map(function(x){return ` <button onclick='myobj.check(this,"${x}")' type="button" class="buttons">${x}</button> `;});
       terms_wrapped= terms_wrapped.join('');

       var list = this.handle.getElementsByTagName('p');
       
       list[0].innerHTML=targets;
       list[1].innerHTML=terms_wrapped;
       
       

    };


   

}

NewQuiz.prototype = new Quiz();

</script>
<body>


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
</body>
</html>
