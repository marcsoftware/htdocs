
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

original = shuffleGroup(original)
total=original.length;
//initilize quickPage
  quickPage.length=total;
  quickPage.fill('◼');
  //
	draw(original[mask(page)]);
	
  
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var global_hint='';
function draw(text){
quickPage[page]='☀';
  updateBar();
  
text=text.trim();
  var que = makeInput(text);
  
  document.getElementById('que').innerHTML=que;
  setFocus();
  

}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var lap=0;
var start=0;
function mask(page_number){
 

  
  return page;
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
var path=false;
function makeInput(text){

 if(path){
  return makeBlank(text);
}else{
  return makeButton(text);
}

}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function makeButton(text){
  global_hint=text.match(/\[.*\]/g);  
  text = text.replace(/\[(.*)\]/g,function (match, capture) { 
    return parseButton(capture);
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
   x=x.replace(/\:.*/g,'')
  x=x.replace(/\ /g,'_');

    return `<input  onkeyup=check(this,'${x}')></input>`;
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
function updateBar(){
  document.getElementById('bar').innerHTML=page+' /'+total;
  updateQuickPage();
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
var quickPage=[];
function updateQuickPage(){
  var newpage = quickPage.slice();
   newpage.forEach(wrap);
  document.getElementById('quickPage').innerHTML=newpage.join('');
}

/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function wrap(item, index,array){
  array[index]= `<span onclick=gotoPage(${index})>${item}</span>`;
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
function gotoPage(number){
    
    page=number;
    draw(original[page]);
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
  input=input.replace(/\_/g,' ');
  key=key.toLowerCase();
  input=input.toLowerCase();
	var ans_key = key;
  
console.log(ans_key);
	if(ans_key===input){
			handleCorrectInput(ref);
      
	}else{
		  handleIncorrectInput(ref);
	}

	

}



/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function handleCorrectInput(ref){
  if(quickPage[page]!='☒'){
    quickPage[page]='☑';
  }
  ref.style.backgroundColor='green';
      next();
}


/*
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
function handleIncorrectInput(ref){
  quickPage[page]='☒';
  ref.style.backgroundColor='red';
  updateQuickPage();
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
*
*/

function shuffleSubarray(arr, start, length) {
    var i = length, temp, index;
    while (i--) {
        index = start + Math.floor(i * Math.random());
        temp = arr[index];
        arr[index] = arr[start + i];
        arr[start + i] = temp;
    }
    return arr;
}



/**
 * 
 */

 function shuffleGroup(a){
  var size=6;
  for(var i=0;i<a.length;i+=size){
    shuffleSubarray(a,i,size);
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


   




