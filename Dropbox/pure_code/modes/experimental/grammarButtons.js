
var goodcolor='royalblue'; 
var badcolor='maroon';
var records =[]; //this variable will be passed to databse
var roundNumber=0;
var hovered = [];// save handles to cards taht were hovered over to they can be un-hovered.


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function init(){

  var track=document.getElementById('track');
  //shuffle(global_lines);
  global_group=global_lines[0];
 
  

  globalCounter=0;
  globalArrow=0;
  drawEverything();
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function playAudio(){
  var word_pair = global_group[globalArrow];
  word_pair = word_pair.split('\t');
  var ans_key = word_pair[0];

     word = ans_key;
     word=word.trim();
      word=word.replace(/\ /g,'.'); //our audiofolder has dots instead of spaces.
      var word = new Audio(`../../audio-de/${word}.wav`);
      word.play();
      try{
       
      }catch(e){
        console.log("ERROR: cant delete word");
      }
}


/*
//---------------------------------------------------------------------
//  draw buttons that the user clicks on
//---------------------------------------------------------------------
*/
function drawButtons(){
  removeElement('buttons');
  
  
    var x = global_group;

    try{
    document.getElementById('active').innerHTML+='<span id="buttons"></span>';
    
    var buttons = makeButton(x);
    
    
    

    document.getElementById('buttons').innerHTML+='';

    document.getElementById('buttons').innerHTML+=buttons;
}catch(e){console.log(e)}
  
}

/*
//---------------------------------------------------------------------
//  draw buttons that the user clicks on
//---------------------------------------------------------------------
*/

    function removeElement(elementId) {
      try{
        // Removes an element from the document
        var element = document.getElementById(elementId);
        element.parentNode.removeChild(element);
      }catch(e){}
    }

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function parseButton(x){
      var options=x.split(':');

      //delete repeats
      options = options.filter(function(item, pos) {
        return options.indexOf(item) == pos;
      })

      options.forEach(wrapOptions);
      shuffle(options);



      x=x.replace(/\ /g,'_');

      return options.join('');
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function makeButton(text){
  original=text;
  global_hint=text.match(/\[.*\]/g);  
  if(global_hint !== null){
  text = global_hint.toString().replace(/\[(.*)\]/g,function (match, capture) { 
    return parseButton(capture);
   }); 
}
  helpLink=original.match(/\{.*\}/g); 
  if(helpLink !== null){ // check if not null
    helpLink=helpLink.join().match(/[\d\w]+/g); 
    getRef(global_chapterID,helpLink);
    helpLink=`<span class='icon' onclick=gotoRefPage(${helpLink})>🌐</span>`;
  }else{
    helpLink='';
    document.getElementById('ref').innerHTML='';
  }
  return text+helpLink;

}
/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function gotoRefPage(numbers){
  // parse for filename & elementID
  
  if(numbers.length > 1){
    
    elementID=numbers[0];
    
  }else{
    elementID=numbers;
    
  }
  openInNewTab(elementID,global_chapterID);
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function openInNewTab(elementID,chapterID) {
  chapterID=global_chapterID;
  url = `../material/german/duolingo/grammar${chapterID}.php?s=`+elementID;
  var win = window.open(url, '_blank');
  win.focus();
}
/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function getRef(chapterID,elementID) {
 
   if(elementID.length==2){
      elementID=elementID[1];
       
   }

   chapterID=global_chapterID;
   chapterID=`../material/german/duolingo/grammar${chapterID}b.php`;
    var xhr = new XMLHttpRequest();

    xhr.onload = function () {
        original = this.responseText; 
        
        //original= original.replace(/\</g,"&lt");
        document.getElementById('ref').innerHTML=(original);
        

    };



    url=`/Dropbox/pure_code/modes/getRef.php?ch=${chapterID}&el=${elementID}`;
    xhr.open('GET', url,false);
    xhr.send();



}



/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function check(ref,key){
   key=key.replace(/\_/g,' ');

  input=ref.value
  input=input.replace(/\_/g,' ');
  key=key.toLowerCase();
  input=input.toLowerCase();
  var ans_key = key;
  /*
  var word_pair = global_group[globalArrow];
  word_pair = word_pair.split('\t');
  var ans_key = word_pair[1];
*/

  if(ans_key===input){
      
      
      handleCorrectInput(ref);
  }else{
    
  }

  if(globalArrow>globalCounter){
    globalCounter++;
    globalArrow=0;
    addWord();
  }

}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function handleCorrectInput(ref){
 
      nextGroup();
      
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function wrapOptions(item, index,array){
  item=item.replace(/\ /g,'_');
   if(index==0){ // By convention an index of 0  means it is the correct ans
       key=item;
   }else{
       key='wrong';
   }
        array[index]= `<input type=button onclick=check(this,'${key}') value='${item}'></input>`;
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function addWord(){
  
  if(globalCounter>=global_group.length){
    globalCounter=global_group.length-1;
    //nextGroup();
  }

  minishuffle(global_group);
  drawEverything();

}
/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function drawGameOver(){
	document.getElementById('track').innerHTML='GAMEOVER - YOU WIN.'
	document.getElementById('ref').innerHTML='';
	document.getElementById('bar').innerHTML='';
}
/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var global_level_counter=0;
function nextGroup(){
  
  global_level_counter++;
  
  //
  var end_index=global_level_counter;
  if(end_index>=global_lines.length){
  	drawGameOver();
  	return;
    end_index=global_lines.length-1;

  }

  global_group=global_lines[global_level_counter];

  
  

  globalCounter=0;
  globalArrow=0;
  drawEverything();
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/

function prevGroup(){
  
  global_level_counter--;
  
  //
  var end_index=global_level_counter;
  

  global_group=global_lines[global_level_counter];
  
  


  globalCounter=6;
  globalArrow=0;
  drawEverything();
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function drawBar(){
  var total = Math.ceil(global_lines.length);
  document.getElementById('bar').innerHTML=global_level_counter+'/'+total;
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function nextWord(){
  globalArrow++;  

  if(globalArrow>globalCounter.length){
    globalArrow=0;
    //shuffleWordGroup();

  }

  drawEverything();
  
}


/*
//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
*/
function drawEverything(){
	document.getElementById('ref').innerHTML='';
    drawActive();  
  
  drawButtons();
  drawBar();
}

/*
//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
*/
function drawActive(){
  document.getElementById('track').innerHTML='';
  var all = global_group;
  all=all.replace(/\{.*\}/g,'');  //delete the hint-button stuff
  all=all.replace(/\[.*\]/g,'___');  //delete the button-stuff
  all = all.split('--------');
  
   var arrow='  ';
  for(var i =0;i<=globalCounter && i<=(global_group.length);i++){
    var template= `<span>${all[i].trim()}</span><br/> \n`;
    if(i===globalArrow){
        arrow='<span id="active">';
        arrowRight='</span>\n';
    }else{
      arrow='  ';
      arrowRight='';
    }
    document.getElementById('track').innerHTML+=arrow+template;
  }
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

/*
//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
*/
function getHint(){
    var word_pair = global_group[globalArrow];
  word_pair = word_pair.split('\t');
  var ans_key = word_pair[1];

document.getElementById('hint').innerHTML=ans_key;
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
var global_lines;
var global_chapterID;
$( document ).ready(function() {

 
    
  
    

    readFile(file_path); //the variable called 'original' now contains the file contents.
global_chapterID=(file_path.match(/\d/g));
original=original.replace(/\/\/.*/g,'');
//original=original.match(/`([^`]+)\`/g);
original=original.split(/`/g);

//delete empty elements
original =original.filter(function (el) {
  return el.search(/[a-zA-Z]/g)>=0;
});
     lines = original;
    
    global_lines=lines;
    init();
    
    

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

    container.innerHTML=lines;
   
  }
/*
//---------------------------------------------------------------------
// function make timestap
//---------------------------------------------------------------------
*/
var last_timestamp=new Date();
function makeTimeStamp(handle){
  var timestamp = new Date;

//var timeDiff = Math.abs(date2.getTime() - date1.getTime());
var date_diff=timestamp-last_timestamp;


 seconds=date_diff/1000;
 min=parseInt(seconds/60);
 seconds= parseInt(seconds % 60);
  handle.innerHTML=min+':'+seconds;
  last_timestamp=timestamp;
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
 * Shuffles array in place.
 * @param {Array} a items An array containing the items.
 */
function minishuffle(a) {
    var j, x, i;
    for (i = globalCounter ; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}

/*
//---------------------------------------------------------------------
// re-arrange group of words. 
//arg: ref <--refernce to an html element that has SPANs as children
//---------------------------------------------------------------------
*/
function shuffleWordGroup(ref){
  


  //Array.from(Array(10).keys())
 
  var items = ref.children;

  arr=Array.from(Array(items.length).keys());
   
  arr= shuffle(arr);
  
    
    



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





// global vars that are passed to makeCookie()

var original;
var mode = "<?php echo $mode ?>";

var timer=0;





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




   




