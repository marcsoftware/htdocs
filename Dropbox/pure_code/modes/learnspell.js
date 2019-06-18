
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



   // compares two string and returns a string with colorized feedback.
    // the return string has a <span> around each letter. green for correct char. red for incorrect
    // compares two string and returns a string with colorized feedback
    var lastLength=0;
    function smartCompare(user_input,ans_key) {


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
  german = removeArticles(german);
  global_ans_key=german;
  document.getElementById('track').innerHTML=german;
  playAudio();
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function playAudio(){
     word = global_ans_key;
     word=word.trim();
      word=word.replace(/\ /g,'.'); //our audiofolder has dots instead of spaces.
      var word = new Audio(`../../audio-de/${word}.wav`);
      word.play();
      try{
       
      }catch(e){
        console.log("ERROR: cant delete word");
      }
}



/**
//---------------------------------------------------------------------
//  when user completes a task save it to database
//---------------------------------------------------------------------
*/
var modeName='learnspell.php'
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

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function removeArticles(word){
  return word.replace(/(der |die |das )/g,'')
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
    saveProgress();
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





   




