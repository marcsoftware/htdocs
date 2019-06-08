//<script src="skill.js">

var range;
var orgX=0;//constants
var orgY=0;
var cenX; //center of the shooting range
var cenY;
var target_radius=1.5; // size of target
var startTime;

var targets_per_vector=10;
var distance=0;

var live_height;
var live_width;
var vector=[0,0];
var vector_backup=['N','S','E','W','NE','SW','NW','SE'];
var liveXY=[0,0];
var elapsedTime;
var interval; // this is the handle to the timer event
var sessionTimes=[]; //saves the users time for this session.
var canvs;

function resizeCanvas() {
     canvs = document.getElementById("canvas");
    canvs.width = 0.5*(window.innerWidth);
    canvs.height = 0.5*(window.innerHeight);
}

var startTime;
function main(){

    resizeCanvas();
	range=document.getElementById('canvas');

	//get center
	cenX = range.width / 2;
	cenY = range.height / 2;
    
    vector[0] = vector_backup.shift();
    vector[1] = vector_backup.shift();

	drawTarget(cenX,cenY);

	//TODO get checked instead of assumed Horizontal
	var patternChoice=document.getElementById('defaultPattern');
	patternChoice.checked=true;
	var sizeChoice=document.getElementById('defaultSize');
    sizeChoice.checked=true;
	handleClick(patternChoice);
	handleClickSize(sizeChoice);

	

	drawMessage('Click the dot to start.');

	startListening();
	
}

//draws timer after user clicks the 1st dot.
var global_hit_time;
var timer_handle;
function startListening(){
	range.addEventListener('mousedown',function(event){
	    var point = getPos(event);//psuedo function
	    
	    
	    if(point.x > liveXY[0] && point.x < live_width && point.y > liveXY[1] && point.y< live_height){ //if user makes a hit
	       if(score===0 && reset_counter==0){ //this is the 1st hit user makes so start the timer
	       		startTime = Date.now();
	       		
			     
			     last_hit=new Date();
	       		timer_handle = setInterval(drawTimer, 100);
	       		 
	       }else{
	       		
			     new_hit=new Date();
	       		global_hit_time= Math.abs(new_hit-last_hit);
	       		
	       		savescore();
	       }

	       
	       moveTarget();
	       
	        
	    }
	},false); // close event listener

}


function drawMessage(message,offset=10,size=10){
	//draw start
	var ctx = canvs.getContext("2d");
	ctx.font = size+"px Arial";
	ctx.fillStyle = 'black';
	ctx.fillText(message,0+offset,cenY-offset); 
}


function drawTimer(){
	elapsedTime = Date.now() - startTime;
	//document.getElementById("timer").innerHTML = (elapsedTime / 1000).toFixed(3);
	document.getElementById("timer").innerHTML = convertMS(elapsedTime);
}



/**
//----------------------
// detect if user zooms useing the default shortcut ctrl+mousewheel
//-----------------------
*/
document.body.addEventListener("wheel", myFunction);

function myFunction() {
    console.log('The moved the mouse wheel so restarting the round.');
    restartRound();
} 





//automatically end the round if the user switches tab or blurs the window.
window.onblur = onBlur; //event
function onBlur(){
	console.log('The webpage was blurred so restarting the round.');
	
	restartRound();
}

function convertMS(ms) {
  var  m, s;
  s = Math.floor(ms / 1000);
  m = Math.floor(s / 60);
  s = s % 60;
  h = Math.floor(m / 60);
  m = m % 60;
  

  return m+':'+s;
};


function getPos( evt) {
    var rect = range.getBoundingClientRect();
    return {
      x: evt.clientX - rect.left,
      y: evt.clientY - rect.top
    };
}

// renders target at x,y coordinates
// and sets the variables used for collision detection
function drawTarget(x,y){

	liveXY[0]=x-target_radius;
	liveXY[1]=y-target_radius;
	live_width=liveXY[0]+(target_radius*2);
	live_height=liveXY[1]+(target_radius*2);
	

	var ctx = range.getContext("2d");
	ctx.clearRect(0, 0, range.width, range.height);// clear the canvas
	ctx.fillStyle = "#FF0000";
	ctx.fillRect(liveXY[0],liveXY[1],target_radius*2,target_radius*2);
	
}


function clearRect(){
		var ctx = range.getContext("2d");
	ctx.clearRect(0, 0, range.width, range.height);// clear the canvas
	cenX = range.width / 2;
	cenY = range.height / 2;
	drawTarget(cenX,cenY);
}

//when user clicks a pattern-radio button this is called
function handleClick(handle){
	//get center
	cenX = range.width / 2;
	cenY = range.height / 2;

	global_pattern_choice=handle.value; //this variable-value saved in database

	if(handle.value === 'h'){
		global_pattern=[20,cenY,range.width-20,cenY];
	}

	if(handle.value === 'v'){
		
		global_pattern=[cenX,20,cenX,range.height-20];
	}
}

//when user clicks a size-radio button this is called
var global_size_choice;
function handleClickSize(handle){
	//get center
     global_size_choice=handle.value;
    var factor =1.5; 
	if(handle.value === 'small'){
		target_radius=factor;
	}

	if(handle.value === 'medium'){
		target_radius=factor*2;
	}

	if(handle.value === 'large'){
		target_radius=factor*3;
	}

	if(handle.value === 'giant'){
		target_radius=10;
	}
}

//moves target around in a pattern
// decides when to change direction and reset distance
// called when user hits a target
var score=0;
var interval =2;
var global_pattern=[];
function moveTarget(){
   score++;
   

	var removed = global_pattern.shift();
	global_pattern.push(removed);
	
	 removed = global_pattern.shift();
	global_pattern.push(removed);
	
	
	drawTarget(global_pattern[0],global_pattern[1]);
	
	
}





var reset_counter=0;
function reset(){ //what is the differece between reset() and restartRound() function?
		score=0;
		reset_counter++;
		console.log(reset_counter);
		if(reset_counter==4){//
		
			gameover();
			
		}
		//change directions
		vector_backup.push(vector[0]); //
		vector_backup.push(vector[1]);
		vector[0]=vector_backup.shift();
		vector[1]=vector_backup.shift();

		distance=0;
		drawTarget(cenX,cenY);
		
}

//called when user wins . called when user completes the round.
function gameover(save=1){
	savescore();
	sessionTimes.push(convertMS( elapsedTime));
	reset_counter=0;
	score=0;
	reset_counter=0;
	(clearInterval(timer_handle)); //stop the timer
	
	setTimeout(function(){drawMessage('Start Again?',null,10)},500  );
	setTimeout(function(){drawMessage(sessionTimes.reverse(),40)},500  );

}


//called when user invalidates a round.
function restartRound(){
	
	clearRect();
	reset_counter=0;
	score=0;
	reset_counter=0;
	(clearInterval(timer_handle)); //stop the timer
	
	setTimeout(function(){drawMessage('Start Again?',null,10)},500  );
	setTimeout(function(){drawMessage(sessionTimes.reverse(),40)},500  );

}


//when user completes a round save their results to the database
function savescore(){

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
            
            result = (xmlhttp.responseText);

        }
	}


  //time    size    pattern 
  
  time=global_hit_time;
  size=global_size_choice;
  pattern=global_pattern_choice;
  
	xmlhttp.open("GET","/Dropbox/skill/savescore.php?time="+time+'&size='+size+'&pattern='+pattern,false); // TODO This is badpractice. Turn false into true. //////
	xmlhttp.send();
}



function endGame(){
		clearInterval(timer_handle);
		score=0;
		document.getElementById('history').innerHTML+=(elapsedTime / 1000).toFixed(3)+' | ';
}


//adds distance (d) and (vector) to the center coordinates
function addVector(v,d){
	var d1=range.height/2/targets_per_vector-1;
	d1*=distance;
	var d2=range.width/2/targets_per_vector-1;
	d2*=distance;
	coords=[cenX,cenY];
	
 	if(v==='N'){
 		 coords[1]=cenY-d1;

 	}else if(v==='S'){
 		coords[1]=cenY+d1;

 	}else if(v==='E'){
 		coords[0]=cenX+d2;

 	}else if(v==='W'){
 		coords[0]=cenX-d2;

 	}else if(v==='NE'){
 		coords[1]=cenY-d1;
 		coords[0]=cenX+d2;

 	}else if(v==='NW'){
 		coords[1]=cenY-d1;
 		coords[0]=cenX-d2;
 	
 	}else if(v==='SE'){
 		coords[1]=cenY+d1;
 		coords[0]=cenX+d2;

 	}else if(v==='SW'){
 		coords[1]=cenY+d1;
 		coords[0]=cenX-d2;
 	}else{
 		console.log('no match '+v);
 		return [0,0];
 	}

 	return coords;
}


window.onload=main;

