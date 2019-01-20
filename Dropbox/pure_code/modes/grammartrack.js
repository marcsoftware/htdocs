
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
	
	global_group=global_lines.slice(0,7);
	shuffle(global_group);	

	globalCounter=0;
	globalArrow=0;
	drawActive();
	drawButtons();
}



/*
//---------------------------------------------------------------------
//  draw buttons that the user clicks on
//---------------------------------------------------------------------
*/
function drawButtons(){
	document.getElementById('buttons').innerHTML='';
var all = global_group.join('\t');
	all = all.split('\t');


		
		var template= `<input type=text class='userInput' id='userinput'  onkeyup='check(this.value)'></input>`;
	
		document.getElementById('buttons').innerHTML+=template;
	}
	


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function handlecorrectinput(){
    
      document.getElementById('userinput').value='';
      nextWord();
      if(globalArrow==7){
        showLastLap();
      }

}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function showLastLap(){
    
     
        document.getElementById('track').style.backgroundColor='green';
      

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



  if(key===input){
    
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
function check(input){

var ans_key=global_ans;

	if(compare(ans_key,input)){
			handlecorrectinput();
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
function addWord(){
	
	if(globalCounter>=global_group.length){
		globalCounter=global_group.length-1;
    // if the remaining words are less the the standard group length group_length
		//nextGroup();
    showLastLap();
	}

	minishuffle(global_group);
	drawActive();

}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var global_level_counter=0;
function nextGroup(){
	document.getElementById('track').style.backgroundColor='black';
	global_level_counter++;
	
	//
	var end_index=global_level_counter*7+7;
	if(end_index>=global_lines.length){
		end_index=global_lines.length-1;

	}

	global_group=global_lines.slice(global_level_counter*7,end_index);

	drawButtons();
	shuffle(global_group);	

	globalCounter=0;
	globalArrow=0;
	drawActive();
	
	drawBar();
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/

function prevGroup(){
	
	global_level_counter--;
	
	//
	var end_index=global_level_counter*7+7;
	if(end_index>=global_lines.length){
		end_index=global_lines.length-1;

	}

	global_group=global_lines.slice(global_level_counter*7,end_index);
	drawButtons();
	shuffle(global_group);	


	globalCounter=6;
	globalArrow=0;
	drawActive();
	
	drawBar();
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function drawBar(){
	var total = Math.ceil(global_lines.length/7);
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

	
	drawActive();			
}
/*
//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
*/
var global_ans='';
function drawActive(){
	document.getElementById('track').innerHTML='';
	var all = global_group;
  all=all.join('--------').replace(/\{.*\}/g,'');  //delete the hint-button stuff
  
  all = all.split('--------');

   var arrow='  ';
	for(var i =0;i<=globalCounter && i<all.length;i++){
    var problem = all[i];
    problem = problem.replace(/[\t\r\n\ ]+/g,' ');

    if(i===globalArrow){
        arrow='->';
        global_ans = problem.match(/\[[^\:]+\:/);
        global_ans=global_ans[0].replace(/[ \: \[ ]/g,'');
        
    }else{
      arrow='  ';
    }

    problem=problem.replace(/\[.*\]/g,'');
    var template= `<span>${problem}</span> \n`;
    
		
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
	var ans_key = word_pair[0];

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




   




