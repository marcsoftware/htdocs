
var goodcolor='royalblue'; 
var badcolor='maroon';
var records =[]; //this variable will be passed to databse
var roundNumber=0;
var hovered = [];// save handles to cards taht were hovered over to they can be un-hovered.


// added to avoid error
function init(){}
/**
//---------------------------------------------------------------------
// called when user click a button
// removes all words that are not colored red
// it then turns all red words back into unmarked-black words.
//---------------------------------------------------------------------
*/

function focusRedWords(){
   
        // delete all the gold numbers
        var element = document.getElementsByTagName("h6"), index;

        for (index = element.length - 1; index >= 0; index--) {
          element[index].parentNode.removeChild(element[index]);
        }



    obj = {};
    
    var spans = document.getElementById('file').getElementsByTagName('span');
   
   var missedAtLeastOne=false;


   //deltes all words that are not marked RED.
   var redwords=[];
    for(var i = 0, l = spans.length; i < l; i++){
        if(spans[i].style.backgroundColor!=badcolor){
          records.push(spans[i].target_word,spans[i].source_word,roundNumber);
          //delete the element
         
        }else{
          missedAtLeastOne=true; // 
          redwords.push(spans[i].target_word+'\t'+spans[i].source_word);
         
        }
    }

    document.getElementById('file').innerHTML='';
    displayTheWords(redwords);

    saveWords();    
    //if user didn't mark anywords as missed
    if(!missedAtLeastOne){ 
                          
      // then save all words to the database and end the game
      
      endGame();

      //
    }
     roundNumber++; // this is used to mark the difficulty of words
}

/**
//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
*/
function endGame(){
    document.getElementById('focusredwords').disabled = true; 
    document.getElementById('file').innerHTML='YOU WON - your progress is saved.';
}




/**
//---------------------------------------------------------------------
// save words listed on the webpage to the database
// called when the game is over.
// this functions can send more words at a time. 
//---------------------------------------------------------------------
*/
      function saveWords(){
          var xhr = new XMLHttpRequest();
          xhr.open("POST", '/Dropbox/pure_code/saveWordsPOST.php', true);

          //Send the proper header information along with the request
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

          xhr.onreadystatechange = function() {//Call a function when the state changes.
              if(this.readyState == XMLHttpRequest.DONE && this.status == 200) {
                  // Request finished. Do processing here.
                  records=[]; // delte after saving
                  
              }
          }
          xhr.send("records="+records); 



      }





/**
//---------------------------------------------------------------------
// called when user click a button
// Ans will appear when user hovers over a word.
// but calling this function will re-hide all the ansers
//---------------------------------------------------------------------
*/
function hideAns(){
    
    obj = {};
    
    var spans = document.getElementById('file').getElementsByTagName('span');
    for(var i = 0, l = spans.length; i < l; i++){

   
          if(!spans[i].deleted){
            spans[i].hideAns();
          }
    }
    
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
$( document ).ready(function() {
    var button=document.getElementById('focusredwords');
    
     button.addEventListener("mouseup", function(e){
        focusRedWords();
     },true);

     var button=document.getElementById('hideans');
      button.addEventListener("mouseup", function(e){
        hideAns();
     },true);


    readFile(file_path); //the variable called 'original' now contains the file contents.
    var lines = original.replace(/[\n\r]+/g,'\n');
    lines=lines.split('\n');
    
    displayTheWords(lines);
});

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var global_group_container;
function displayTheWords(lines){
    var line_length=lines.length;

    var result;
    var element;
    var container=document.getElementById("file");
    container.innerHTML='';
    

   // for(var i =0;i<line_length;i++){
     // element=lines[i];
    
    lines.forEach(function(element, i) {
        if(i==0){

           global_group_container = document.createElement("div");
        
          
          //container.appendChild(global_group_container);
        }
        //put blank line before each 7th word to make it easier for the user to scroll
        if(i!=0 && i%6==0){
          container.appendChild(global_group_container);//render the old group
          
          //create the shuffle button
          var btn = document.createElement("BUTTON");       
          var t = document.createTextNode("shuffle");       
          btn.appendChild(t);    

          //make button clickable
          btn.handle=global_group_container;
          btn.addEventListener("mouseup", function(e){
            //this.handle=global_group_container.innerHTML;
            //TODO pass a reference here
            shuffleWordGroup(this.handle);
          });

          container.appendChild(btn);  

          

          global_group_container = document.createElement("div");//start making a new group

          var node = document.createTextNode(i+' / '+line_length+'\n');
          var numberContainer = document.createElement("h6");
          numberContainer.appendChild(node);
          container.appendChild(numberContainer);
        }
        result=lines[i].split('\t');
        
        
        var para = document.createElement("span");
        var node = document.createTextNode(result[0]+'\n');

       

        para.appendChild(node);

        para.source_word=result[1];
        para.both=result.join(' --- ');
        para.target_word=result[0];
        para.hideAns = function(){
          
          para.innerHTML=para.target_word+'\n';

        };
       para.addEventListener("mouseover", function(e){
            
            try{
              if(hovered.length>=3){
                var lasthovered=hovered.shift();
                lasthovered.innerHTML=lasthovered.target_word+'\n';
                
              }
              
              
            }catch(e){};

            para.innerHTML=para.both+'\n';
            hovered.push(para);
          }); 

        para.addEventListener("mouseup", function(e){
          
            if(e.which==1){ //if left mouse button was clicked
              
              var color=e.target.style.backgroundColor;
             
             if(color!==goodcolor){
                 e.target.style.backgroundColor=goodcolor;
             }else{
                e.target.style.backgroundColor='black'
             }

            }else if(e.which==3){ //if RIGHT mouse button was clicked
              
              var color=e.target.style.backgroundColor;
             if(color!==badcolor){
                 e.target.style.backgroundColor=badcolor;
             }else{
                e.target.style.backgroundColor='black'
             }
              
            }
            
          }); 


        //prevent blank spans from being created
        if(!result[1]===undefined){
            delete para;
          
        }else{
          
        	global_group_container.appendChild(para);

        }
        
        //appendToElement('file',result[1]);
    });
    //printToElement('file',lines);
}

/*
//---------------------------------------------------------------------
// re-arrange group of words
//---------------------------------------------------------------------
*/
function shuffleWordGroup(ref){
  


  //Array.from(Array(10).keys())
 
  var items = ref.children;

  arr=Array.from(Array(items.length).keys());
   
  arr= shuffle(arr);
  console.log(arr);
    
    



    arr.forEach(function(idx) {
      ref.appendChild(items[idx]);

    });
    
    //ref.innerHTML = null;
    ref.appendChild(elements);

}

/**
 * Shuffles array in place.
 * @param {Array} a items An array containing the items.
 */
function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}
/**
//---------------------------------------------------------------------
// edits the innerHTML of an element with an ID
// and it makes sure it exsist first so that their are no error messages
//---------------------------------------------------------------------
*/
function printToElement(id,text){
  try{
    document.getElementById(id).innerHTML=text;
  }catch(e){
    console.log(id+' <- this element does not exsist with this ID.');
  }
}


/**
//---------------------------------------------------------------------
// edits the innerHTML of an element with an ID
// and it makes sure it exsist first so that their are no error messages
//---------------------------------------------------------------------
*/
function appendToElement(id,text){
  try{
    document.getElementById(id).innerHTML+=text+'\n';
  }catch(e){
    console.log(id+' <- this element does not exsist with this ID.');
  }
}

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


