
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
	globalCounter=0;
	
	

	
	
	drawActive();
	drawButtons();
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var global_ans_key;
function drawActive(){
  if(globalCounter >= global_lines.length){
    endGame();

  }
  var words = global_lines[globalCounter].split('\t');
  var german= words[0];
  var english= words[1];
  global_audio=german;
  german = removeArticles(german);
  english = removeArticles(english);
  global_ans_key=german;
  global_audio=german;
  document.getElementById('track').innerHTML=english;
  playAudio();
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function playAudio(){
     word = global_audio;
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
//
//---------------------------------------------------------------------
*/
function removeArticles(word){
  return word.replace(/(der |die |das |the )/g,'')
}

/*
//---------------------------------------------------------------------
//  draw buttons that the user clicks on
//---------------------------------------------------------------------
*/
function drawButtons(){

	
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function check(input){
	
	
	var key=global_ans_key.toLowerCase();
  input = input.toLowerCase();
  var key = simplify(global_ans_key);
  input = simplify(input);



	if(key===input){
			
			nextWord();
	}else{
		
	}



}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function simplify(text){
  text = text.toLowerCase();
  text=text.replace(/[ÄäÖöÜüẞß\ ]/g,'');
  return text;

}




/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function drawBar(){
	var total = global_lines.length;
	document.getElementById('bar').innerHTML=globalCounter+'/'+total;
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function nextWord(){
  document.getElementById('last').innerHTML=global_lines[globalCounter].replace(/\t/g, '---');
	globalCounter++;	
  document.getElementById('input').value='';
  drawBar();
	drawActive();

	
}

/**
//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
*/
function endGame(){
    
    document.getElementById('file').innerHTML='YOU WON - your progress is saved.';
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
$( document ).ready(function() {

 
    
 
    

    readFile(file_path); //the variable called 'original' now contains the file contents.

     lines = original.replace(/[\n\r]+/g,'\n');
    lines=lines.split('\n');
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





   




