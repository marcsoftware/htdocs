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
    canvs.width = 0.9*(window.innerWidth);
    canvs.height = 0.9*(window.innerHeight);
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

	

	drawMessage('Click the dot to start.');

	startListening();
	
}

//draws timer after user clicks the 1st dot.
function startListening(){
	range.addEventListener('mousedown',function(event){
	    var point = getPos(event);//psuedo function
	    
	    
	    if(point.x > liveXY[0] && point.x < live_width && point.y > liveXY[1] && point.y< live_height){
	       if(score===0 && reset_counter==0){ //this is the 1st hit user makes so start the timer
	       		 startTime = Date.now();
	       		 
	       		 timer_handle = setInterval(drawTimer, 100);
	       }
	       moveTarget();
	        
	    }
	},false); // close event listener

}
function drawMessage(message,offset=0,size=30){
	//draw start
	var ctx = canvs.getContext("2d");
	ctx.font = size+"px Arial";
	ctx.fillStyle = 'black';
	ctx.fillText(message,cenX/2,cenY+offset); 
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

//moves target around in a pattern
// decides when to change direction and reset distance
// called when user hits a target
var score=0;
var interval =2;
function moveTarget(){
   score++;
   if(score % 2 == 1){ // if odd...

		distance+=interval; // .. increase distance
	}
	
	vector=vector.reverse();
	moveDirection(vector[0],distance);
	
	
}

// draw target in a particlar direction and distance from center
function moveDirection(vector,d){
	var coords = addVector(vector);

	drawTarget(coords[0],coords[1])
	
	if(coords[1] >= range.height || coords[1]<=0){
		reset();
	}else if(coords[0] >= range.width || coords[0]<=0){
		reset();
	}
	
}
var reset_counter=0;
function reset(){
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

//called when user completes the round.
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



	xmlhttp.open("GET","/Dropbox/skill/savescore.php?milliseconds="+elapsedTime+'&width='+canvs.width+'&height='+canvs.height,false); // TODO This is badpractice. Turn false into true. //////
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

