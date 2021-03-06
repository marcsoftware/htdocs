


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
	
	

	
	shuffle(global_lines);
	drawActive();
  

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
    return;

  }

  current_word_missed=false;
  var words = global_lines[globalCounter].split('\t');

  

  var german= words[0];
  var english= words[1];
  global_audio=german;
  german = removeArticles(german);
  english = removeArticles(english);
  global_ans_key=german;
  global_audio=german;
  document.getElementById('track').innerHTML=english;
  //playAudio();
  drawButtons();
}

/*
//---------------------------------------------------------------------
//  draw buttons that the user clicks on
//---------------------------------------------------------------------
*/
function drawButtons(){

	var random_words = [];

	while(random_words.length < 3){
		random_line = ( global_lines[Math.floor(Math.random()*global_lines.length)] );
		one_word = random_line.split('\t');
		one_word=one_word[0] ;// zero get the left side which is german
		one_word = (one_word);
		random_words.push(one_word); 
	}
	random_words.push(global_ans_key);


	document.getElementById('buttons').innerHTML='';
	var all = random_words;
	shuffle(all);
	for(var i =0;i<all.length;i++){

		var template= `<input type=button class='userInput' value="${all[i]}" onclick='check(this.value)'></input>`;
		if(i==9){
			document.getElementById('buttons').innerHTML+='<br/>';
		}

		document.getElementById('buttons').innerHTML+=template;
	}

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
//
//---------------------------------------------------------------------
*/
function check(input){
	
	if(global_ans_key.includes(':')){
    var keys = global_ans_key.split(':');
    result=false;
    for(var i =0;i<keys.length && !result;i++){
      if(compare(input,keys[i])){
        result=true;
      }
       
    }
     
     if(result){
        nextWord();
     }
    
  }else{
    if (compare(input,global_ans_key)){
      nextWord();
    }else{
      //do nothing.
    }
  }


}



/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var current_word_missed = false;
function showhint(){
    alert(global_ans_key);

    if(!current_word_missed){
      // not already added to add it to end
      addWordToEnd();

    }
    current_word_missed=true;
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var missed_list=[];
function addWordToEnd(){
  missed_list.push(global_lines[globalCounter]);

}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function compare(input,key){
  
  input=input.trim();

  input = input.toLowerCase();
  var key = simplify(key);
  input = simplify(input);



  if(key[0]===input[0]){ //[0] mean compare just the 1st letter
    
      return true;
      
  }else{
    return false;
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

	drawBar();
	drawActive();

	
}

/**
//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
*/


function endGame(){
    
    var missed_count = missed_list.length ;

    if(missed_count !=0){
      button = `<input type='button' value=review onclick=nextStage()></input>`;
      msg = `missed: ${missed_count} word(s)`+button;

    }else{
      msg = 'you missed 0 words!'
    }
    document.getElementById('file').innerHTML='YOU WON - your progress is saved.<br/>'+msg;

    saveProgress();
}





/**
//---------------------------------------------------------------------
//  when user completes a task save it to database
//---------------------------------------------------------------------
*/
var modeName='multichoice.php'
function saveProgress(){
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
                    
                    var result = (xmlhttp.responseText);
                  
                    
      
                }
            };


          

            
         
            xmlhttp.open("GET","/Dropbox/pure_code/saveProgress.php?fileName="+fileName+'&modeName='+modeName,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();
}

/**
//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
*/
function nextStage(){
  alert('next stage');
  global_lines=missed_list.slice(); //copy array by value 
  globalCounter=0;
  missed_list=[];
  document.getElementById('file').innerHTML='';
  drawBar();
  drawActive();

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
    lines = findMultiMaps(lines);
    
    global_lines=lines;
    //
    init();
    
    

});

/**
//---------------------------------------------------------------------
// Some german words are maped to the same english word.
// Therefore, modes that require the user to type German 
// might have multiple correct answeres. 
//---------------------------------------------------------------------
*/
function findMultiMaps(list){
  
  var eng = [];
  var ger = [];
  for(var i=0;i<list.length;i++){
      var sides = list[i].split('\t');
      var left = sides[0];  // GERMAN so should already have  repeats removed
      var right = sides[1]; // may have repeats since GERMAN words may map to same word.
      
      if(eng.indexOf(right)>=0){ //found a repeat
        index =eng.indexOf(right)
        ger[index]+=':'+left; // add german word

      }else{
        
        eng.push(right);
        ger.push(left);
      }
  }
  list = merge(ger,eng);
  
  return list;
}


/**
//---------------------------------------------------------------------
// merge two array to there values alternate.
//---------------------------------------------------------------------
*/
 function merge(array1, array2) {
      if (array1.length == array2.length) {
          var c = [];
          for (var i = 0; i < array1.length; i++) {
              c.push(array1[i]+"\t"+ array2[i]);
          }
          return c;
      }
      return null;

}
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
  function stringcompare(x,y){

    x= x.replace(/[\W]/g,'');
    y= y.replace(/[\W]/g,'');

    x=x.toLowerCase();
    y=y.toLowerCase();
    
    return x===y;


  }





   




