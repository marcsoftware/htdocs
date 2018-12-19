
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
var page =0;
var total;
function init(){
	
original=original.replace(/\/\/.*/g,'');
//original=original.match(/`([^`]+)\`/g);
original=original.split(/`/g);

//delete empty elements
original =original.filter(function (el) {
  return el.search(/[a-zA-Z]/g)>=0;
});
total=original.length;
	draw(original[page]);
	
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var global_hint='';
function draw(text){
  updateBar();
text=text.trim();
  var que = makeBlank(text);
  
  document.getElementById('que').innerHTML=que;
  setFocus();
  

}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function setFocus(){
  //ex1
    //document.getElementById("mytext").focus();
//ex2
    document.getElementById("que").firstElementChild.focus();

}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function makeBlank(text){
  global_hint=text.match(/\[.*\]/g);  
  text = text.replace(/\[(.*)\]/g,function (match, capture) { 
    return parse(capture);
}); 
/*
"string".replace(/st(ring)/, function (match, capture) { 
    return "gold " + capture + "|" + match;
}); 
*/
  return text;

}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function parse(x){
  
  x=x.replace(/\ /g,'_');

    return `<input  onkeyup=check(this,'${x}')></input>`;
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function updateBar(){
  document.getElementById('bar').innerHTML=page+' /'+total;
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function next(){
 page++;

  draw(original[page]);

}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function prev(){
page--;

  draw(original[page]);

}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function check(ref,key){
	key=key.replace(/\_/g,' ');
	input=ref.value

  key=key.toLowerCase();
  input=input.toLowerCase();
	var ans_key = key;
  
console.log(ans_key);
	if(ans_key===input){
			
      ref.style.backgroundColor='green';
			next();
	}else{
		console.log('x: '+ans_key);
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

 
    
 
    

    readFile(file_path); //the variable called 'original' now contains the file contents.

     //lines = original.replace(/[\n\r]+/g,'\n');
  
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


/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function showHint(){
  alert(global_hint);
}


   




