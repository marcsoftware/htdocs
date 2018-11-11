<!DOCTYPE html>
<html>
<tag autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
<title>beatsaber sheetmusic</title>>
<script>
var pretty={
	'up':'↑',
	'down':'↓',
	'left':'←',
	'right':'→',
	'upleft':'↖',
	'upright':'↗',
	'downleft':'↙',
	'downright':'↘',
	'dot':'●'

}


	//args: x is a string of text
	//----------------------------------------------------------------------------------------------------
	//
	//----------------------------------------------------------------------------------------------------
	// out put is placed in the element with id=output
		var global_direction;
		var global_color;
		var time_cheat=[];
		var global_barMax;
		var rowCheck;
		
	function clean() {
		rowCheck = document.getElementById('rowCheck').checked;
		
   		

		x=document.getElementById('input').value;
	
		x=x.replace(/,/g,',\n'); 
		x=x.replace(/\[/g,',]\n');
		x=x.split(/[{}]/);
		global_barMax=x.length; //sideeffect: 
		for(var i=0;i<x.length;i++){
			if(x[i].includes('_type') ){
				//get infomation
				var raw = getInfo(x[i]); //extract info from the json
				save(raw); //save it for easier access.

				
			}else{
				
			}
		}
		   

	   for(var i =0;i<time_cheat.length;i++){
	   		draw(time_boards[time_cheat[i]],time_cheat[i]);
	   		
	   }
	
	}


function updateProgressBar(i){
	console.log(i);
	document.getElementById('barValue').style.width='10%';
}

/*
//--------------------
//
//--------------------
*/

function getInfo(x){
	/*
    _lineLayer: the vertical position where the note sits (0-2, 0 being the bottom, 2 being the top)
    _lineIndex: the horizontal position where the note sits (0 being left most, 4 being right most)
    _type: the color of the note (0 is red, 1 is blue)
    _time: the position in time of the note (in standard notation, i.e X.0 = 1/1, X.5 = 1/2, etc)
    _cutDirection: the direction which the note has to be cut 
      (0 is cut up, 1 is cut down, 2 is cut left, 3 is cut right, 4 is cut up left, 
      5 is cut up right, 6 is cut down left, 7 is cut down right, 8 is cut any direction)
    */

    x=JSON.parse('{'+x+'}');
    return [x._time,x._type,x._cutDirection,x._lineIndex,x._lineLayer];
}

/*
//--------------------
// save ARROW so that can be retieved by their TIME values.
// and we can also combine ARROWS that appear at the same time. 
//--------------------
*/
var time_boards=[];
function save(arrow){


	var time=arrow[0];
	 time=''+time+'';
	var color=arrow[1];
	var direction=arrow[2];
	var x=arrow[3];
	var y=arrow[4];
 	
	var blank_board=[];
	//if  
	if( time_boards[time] === undefined){
		var note= `(${x},${y},${notation(color,direction)})`;
		
		time_cheat.push(time);
		//blank_board[x][y]=note;
		time_boards[time]=(note); //all boards can now br 
	} else{
		time_boards[time]+=`(${x},${y},${notation(color,direction)})`;
	}


    
}
/*
//--------------------
//
//--------------------
*/
function notation(color,direction){

	// <h1 style="color:blue;">This is a Blue Heading</h1> 
	
	var arrow='';
    if(color=='0'){//0 means red
    	color='red';
       var red_arrows= ['⇑','⇓','⇐','⇒','⇖','⇗','⇙','⇘','◍'];
       arrow= red_arrows[direction];
       
    }else if(color=='1'){
    	color='blue';
    	var blue_arrows= ['⇑','⇓','⇐','⇒','⇖','⇗','⇙','⇘','◍'];
    	arrow= blue_arrows[direction];
    }else{
    	return '💣';
    }
	return `<span style="color:${color};">`+arrow+'</span>';
}

/*
//--------------------
//	set attributes that we need to draw
// and check when we get the attributes. 
//--------------------
*/
var global_arrow={};
function setObject(attr,value){
	
	global_arrow[attr]=value;

	if(global_arrow['direction'] && global_arrow['color']){
		//render
        draw(global_arrow['color'],global_arrow['direction']);
		global_arrow['direction']='';
		global_arrow['color']='';


	}
}

/*
//--------------------
// render a colored arrow
//--------------------
*/

function draw(board,time){
	
if(board ==undefined){
	return;
}

board=board.replace(/\)/g,'');
	var arrows= board.split('(');

	arrows = arrows.filter(function (el) {
 		 return el.length >= 2;
	});

	/*
    _lineLayer: the vertical position where the note sits (0-2, 0 being the bottom, 2 being the top)
    _lineIndex: the horizontal position where the note sits (0 being left most, 4 being right most)
    _type: the color of the note (0 is red, 1 is blue, 3 is a mine)
    _time: the position in time of the note (in standard notation, i.e X.0 = 1/1, X.5 = 1/2, etc)
    _cutDirection: the direction which the note has to be cut 
      (0 is cut up, 1 is cut down, 2 is cut left, 3 is cut right, 4 is cut up left, 
      5 is cut up right, 6 is cut down left, 7 is cut down right, 8 is cut any direction)
    */

   var filler='.';
    var blank=[filler,filler,filler,filler,filler,filler,filler,filler,filler,filler,filler,filler];
	for(var i =0;i<arrows.length;i++){
		
		var numbers=arrows[i].split(',');
		
		
		var x = Number(numbers[0]);
		var y = Number(numbers[1])*4;
		var symbol = numbers[2];
		
		blank[x+y]=symbol;

	}




   
var min=Math.floor(time/60);
var seconds = Math.floor(time%60);
	document.getElementById('sheetmusic').innerHTML+='<span class="time">'+time+'</span>';
	document.getElementById('sheetmusic').innerHTML+=makeTable(blank);

	document.getElementById('sheetmusic').innerHTML+='<hr/>';




}

/*
//--------------------------------------------------------------------
// turn array of 12 length  into a 3by4 table
//--------------------------------------------------------------------
*/

function makeTable(list){
	/*list=blank[8]+blank[9]+blank[10]+blank[11]+'<br/>';
	list+=blank[4]+blank[5]+blank[6]+blank[7]+'<br/>';
	list+=blank[0]+blank[1]+blank[2]+blank[3]+'<br/>';*/

	

	var tr1=	` <tr>
					<td>${list[8]}</td>
					<td>${list[9]}</td> 
					<td>${list[10]}</td>
					<td>${list[11]}</td>
				  </tr>`;
 var tr2=` 		<tr>
				    <td>${list[4]}</td>
				    <td>${list[5]}</td>
				    <td>${list[6]}</td>
				    <td>${list[7]}</td>
				  </tr>`;
 var tr3= `
  <tr>
    <td>${list[0]}</td>
    <td>${list[1]}</td>
    <td>${list[2]}</td>
    <td>${list[3]}</td>
  </tr>`;




	if(rowCheck){
		if((list[8]+list[9]+list[10]+list[11]).match(/[^.]/g)===null){
			tr1='';
		}

		if((list[4]+list[5]+list[6]+list[7]).match(/[^.]/g)===null){
			tr2='';
		}

		if((list[0]+list[1]+list[2]+list[3]).match(/[^.]/g)===null){
			tr3='';
		}
	}

		var table = `<table >
 	${tr1}
 	${tr2}
 	${tr3}


</table>`;
	return table;
}


/*
//--------------------------------------------------------------------
// change title so that when user prints it he will know what the song name is. 
// the title of the html page is automatically added when you print it. 
//--------------------------------------------------------------------
*/
function changeTitle(title){
	document.title=title;
}

/*
//----------------------------------------------------------------------------------------------------
//
//----------------------------------------------------------------------------------------------------
*/
function markRed(){
	document.getElementById('input').style.backgroundColor='#FEBCBD';
}



/*
//----------------------------------------------------------------------------------------------------
//
//----------------------------------------------------------------------------------------------------
*/
function toggleLoader() {
    var x = document.getElementById("loader");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
} 

/*
//----------------------------------------------------------------------------------------------------
//
//----------------------------------------------------------------------------------------------------
*/
function intercept() {
 
    toggleLoader();
    clean();
} 
</script>
<style>

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  display:none;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


textarea{
	width:50%;
	height:100px;
}

td{
	height: 50px;
	width: 50px;
	text-align: center;
	vertical-align:center;
}

body{
	

}

.time{
	font-size:8px;
	padding:0px;
	margin:0px;
}
hr{
	margin:0;
	padding:0;
}
#sheetmusic{
	
	font-family: monospace; 
	font-size:30px;
	margin-left:50px;
}

span{
	margin:0px;}

table{
	margin:0px;
}
</style>
<body>

INPUT:
<textarea id='input' onkeydown='markRed()'>
{"_version":"1.5.0","_beatsPerMinute":113.69999694824219,"_beatsPerBar":16,"_noteJumpSpeed":10,"_shuffle":0,"_shufflePeriod":0.5,"_events":[],"_notes":[{"_time":7.875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":7.875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":15.6875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":15.6875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":16.75,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":17.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":18.75,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":19.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":20.875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":21.875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":22.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":23.875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":23.875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":24.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":25.875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":26.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":27.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":30.4375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":30.4375,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":31.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":31.375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":31.625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":31.875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":32.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":32.375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":33.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":33.5,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":34.3125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":34.75,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":35.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":36.1875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":36.1875,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":37.0625,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":37.0625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":39.75,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":4},{"_time":39.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":4},{"_time":40.1875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":40.6875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":43.5625,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":43.5625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":44.125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":44.125,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":49.375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":49.375,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":6},{"_time":50.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":50.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":50.75,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":1},{"_time":50.75,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":50.75,"_lineIndex":2,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":51.8125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":51.8125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":52.25,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":52.25,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":53.1875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":6},{"_time":53.1875,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":6},{"_time":53.1875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":53.1875,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":6},{"_time":55.625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":56.1875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":56.75,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":56.75,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":5},{"_time":59.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":60.1875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":60.1875,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":1},{"_time":60.1875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":63.5625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":63.5625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":64.125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":64.125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":64.6875,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":5},{"_time":64.6875,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":4},{"_time":65.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":65.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":66.5625,"_lineIndex":1,"_lineLayer":1,"_type":1,"_cutDirection":2},{"_time":66.5625,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":67.75,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":67.75,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":68.6875,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":68.6875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":6},{"_time":69.125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":8},{"_time":69.125,"_lineIndex":1,"_lineLayer":2,"_type":0,"_cutDirection":8},{"_time":69.625,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":1},{"_time":69.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":69.625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":71.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":71.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":71.6875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":71.6875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":72.1875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":72.1875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":72.6875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":72.6875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":74.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":74.125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":74.5625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":74.5625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":75.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":75.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":76.125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":76.125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":76.125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":76.125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":79.25,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":4},{"_time":79.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":7},{"_time":80.1875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":4},{"_time":83,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":5},{"_time":83.5625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":84.0625,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":84.0625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":84.0625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":87.0625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":87.0625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":87.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":4},{"_time":87.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":5},{"_time":88.1875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":88.1875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":89.4375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":89.875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":90.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":90.75,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":91.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":91.6875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":92.125,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":5},{"_time":92.125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":93.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":93.75,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":1},{"_time":93.75,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":93.75,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":97.375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":98.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":98.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":98.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":98.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":99.6875,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":100.125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":100.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":100.125,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":101.0625,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":101.0625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":101.0625,"_lineIndex":2,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":103.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":5},{"_time":104.125,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":7},{"_time":104.625,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":4},{"_time":104.6875,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":104.75,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":4},{"_time":107.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":107.5,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":107.5,"_lineIndex":1,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":108.0625,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":108.0625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":113.125,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":113.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":114,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":114,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":114.5,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":114.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":115.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":115.9375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":117,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":5},{"_time":117,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":4},{"_time":117.3125,"_lineIndex":0,"_lineLayer":1,"_type":3,"_cutDirection":0},{"_time":117.3125,"_lineIndex":0,"_lineLayer":2,"_type":3,"_cutDirection":0},{"_time":117.3125,"_lineIndex":3,"_lineLayer":0,"_type":3,"_cutDirection":0},{"_time":117.3125,"_lineIndex":3,"_lineLayer":1,"_type":3,"_cutDirection":0},{"_time":117.3125,"_lineIndex":3,"_lineLayer":2,"_type":3,"_cutDirection":0},{"_time":117.3125,"_lineIndex":0,"_lineLayer":0,"_type":3,"_cutDirection":0},{"_time":117.625,"_lineIndex":3,"_lineLayer":1,"_type":3,"_cutDirection":0},{"_time":117.625,"_lineIndex":3,"_lineLayer":2,"_type":3,"_cutDirection":0},{"_time":117.625,"_lineIndex":0,"_lineLayer":0,"_type":3,"_cutDirection":0},{"_time":117.625,"_lineIndex":0,"_lineLayer":1,"_type":3,"_cutDirection":0},{"_time":117.625,"_lineIndex":0,"_lineLayer":2,"_type":3,"_cutDirection":0},{"_time":117.625,"_lineIndex":3,"_lineLayer":0,"_type":3,"_cutDirection":0},{"_time":117.9375,"_lineIndex":3,"_lineLayer":0,"_type":3,"_cutDirection":0},{"_time":117.9375,"_lineIndex":3,"_lineLayer":1,"_type":3,"_cutDirection":0},{"_time":117.9375,"_lineIndex":3,"_lineLayer":2,"_type":3,"_cutDirection":0},{"_time":117.9375,"_lineIndex":0,"_lineLayer":0,"_type":3,"_cutDirection":0},{"_time":117.9375,"_lineIndex":0,"_lineLayer":1,"_type":3,"_cutDirection":0},{"_time":117.9375,"_lineIndex":0,"_lineLayer":2,"_type":3,"_cutDirection":0},{"_time":119.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":120,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":120.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":123.5,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":124,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":127.4375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":128.0625,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":5},{"_time":128.5,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":128.5,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":129.5,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":1},{"_time":129.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":130.4375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":130.4375,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":4},{"_time":131.9375,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":132.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":132.9375,"_lineIndex":2,"_lineLayer":1,"_type":0,"_cutDirection":5},{"_time":133.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":135.375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":135.9375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":136.4375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":5},{"_time":138.0625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":138.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":139.5,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":139.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":139.9375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":139.9375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":143.0625,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":7},{"_time":143.5625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":144.125,"_lineIndex":3,"_lineLayer":1,"_type":0,"_cutDirection":3},{"_time":146.9375,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":6},{"_time":147.625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":148.125,"_lineIndex":0,"_lineLayer":1,"_type":1,"_cutDirection":2},{"_time":151.1875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":151.1875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":151.625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":151.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":151.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":151.625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":152.1875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":152.1875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":152.1875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":152.1875,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":1},{"_time":152.1875,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":1},{"_time":152.1875,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":1},{"_time":153.6875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":153.9375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":154.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":154.4375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":154.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":154.9375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":155.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":155.4375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":155.6875,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":156.0625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":156.0625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":160.6875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":160.6875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":161.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":162.125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":162.6875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":163.0625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":163.5625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":164.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":165.0625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":165.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":166.0625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":166.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":167.0625,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":167.0625,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":168.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":169.0625,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":169.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":170.1875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":170.6875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":170.6875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":171.25,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":171.25,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":171.75,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":172.125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":172.875,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":172.875,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":177.25,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":177.75,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":3},{"_time":178.25,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":178.8125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":179.3125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":2},{"_time":179.8125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":180.9375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":181.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":181.375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":181.6875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":181.9375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":182.4375,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":182.9375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":183.4375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":183.4375,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":184.8125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":185.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":185.9375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":186.5625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":187.0625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":187.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":188.125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":188.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":189.1875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":190.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":190.75,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":191.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":191.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":191.6875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":191.6875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":192.5625,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":192.5625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":192.5625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":192.5625,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":192.5625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":192.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":193.5625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":6},{"_time":193.5625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":6},{"_time":194.125,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":194.625,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":195.0625,"_lineIndex":1,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":195.625,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":196.0625,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":196.5625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":196.5625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":197.6875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":197.6875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":198.625,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":198.625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":198.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":199.5625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":199.5625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":199.5625,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":199.5625,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":201.5625,"_lineIndex":3,"_lineLayer":1,"_type":3,"_cutDirection":3},{"_time":201.5625,"_lineIndex":3,"_lineLayer":2,"_type":3,"_cutDirection":3},{"_time":201.5625,"_lineIndex":3,"_lineLayer":0,"_type":3,"_cutDirection":3},{"_time":201.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":201.5625,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":202.0625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":202.0625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":202.625,"_lineIndex":0,"_lineLayer":0,"_type":3,"_cutDirection":1},{"_time":202.625,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":202.625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":202.625,"_lineIndex":0,"_lineLayer":1,"_type":3,"_cutDirection":1},{"_time":202.625,"_lineIndex":0,"_lineLayer":2,"_type":3,"_cutDirection":1},{"_time":203.0625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":203.0625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":203.5625,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":203.5625,"_lineIndex":3,"_lineLayer":2,"_type":3,"_cutDirection":3},{"_time":203.5625,"_lineIndex":3,"_lineLayer":0,"_type":3,"_cutDirection":3},{"_time":203.5625,"_lineIndex":3,"_lineLayer":1,"_type":3,"_cutDirection":3},{"_time":203.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":204.0625,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":204.0625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":204.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":7},{"_time":204.5625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":205.625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":6},{"_time":205.625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":206.5625,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":206.5625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":209.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":210.0625,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":5},{"_time":210.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":211.0625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":211.0625,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":211.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":212.0625,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":5},{"_time":212.0625,"_lineIndex":2,"_lineLayer":2,"_type":0,"_cutDirection":5},{"_time":212.5,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":213.5,"_lineIndex":1,"_lineLayer":1,"_type":3,"_cutDirection":0},{"_time":213.5,"_lineIndex":1,"_lineLayer":2,"_type":3,"_cutDirection":0},{"_time":213.5,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":213.5,"_lineIndex":1,"_lineLayer":0,"_type":3,"_cutDirection":0},{"_time":214.5625,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":214.5625,"_lineIndex":2,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":215.5625,"_lineIndex":1,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":215.5625,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":215.5625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":216.5625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":217.0625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":217.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":218,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":218.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":219.9375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":219.9375,"_lineIndex":2,"_lineLayer":0,"_type":3,"_cutDirection":1},{"_time":219.9375,"_lineIndex":1,"_lineLayer":0,"_type":3,"_cutDirection":1},{"_time":219.9375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":220.4375,"_lineIndex":1,"_lineLayer":0,"_type":3,"_cutDirection":1},{"_time":220.4375,"_lineIndex":2,"_lineLayer":0,"_type":3,"_cutDirection":1},{"_time":220.4375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":220.4375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":221.5625,"_lineIndex":2,"_lineLayer":2,"_type":3,"_cutDirection":1},{"_time":221.5625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":221.5625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":221.5625,"_lineIndex":1,"_lineLayer":2,"_type":3,"_cutDirection":1},{"_time":222.5,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":222.5,"_lineIndex":1,"_lineLayer":0,"_type":3,"_cutDirection":1},{"_time":222.5,"_lineIndex":2,"_lineLayer":0,"_type":3,"_cutDirection":1},{"_time":222.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":224,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":224,"_lineIndex":0,"_lineLayer":0,"_type":3,"_cutDirection":2},{"_time":224.4375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":224.4375,"_lineIndex":3,"_lineLayer":1,"_type":3,"_cutDirection":2},{"_time":225.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":225.9375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":226.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":226.9375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":227.4375,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":227.9375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":228.4375,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":230.875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":230.875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":232,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":232,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":233,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":233,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":233.625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":233.625,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":234.5625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":234.5625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":235.0625,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":235.0625,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":236.0625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":236.5,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":237.5,"_lineIndex":2,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":237.5,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":240.0625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":240.0625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":240.5625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":240.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":241.0625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":241.0625,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":244.0625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":244.5625,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":244.5625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":249.4375,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":7},{"_time":249.4375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":250.375,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":250.8125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":2},{"_time":251.875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":252.375,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":3},{"_time":253.3125,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":253.3125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":255.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":256.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":256.9375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":256.9375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":5},{"_time":259.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":259.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":260.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":260.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":263.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":264.3125,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":5},{"_time":264.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":265.3125,"_lineIndex":2,"_lineLayer":1,"_type":0,"_cutDirection":5},{"_time":265.8125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":267.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":268.25,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":268.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":269.75,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":269.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":270.3125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":270.3125,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":1},{"_time":270.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":270.3125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":271.8125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":272.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":272.8125,"_lineIndex":2,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":272.8125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":274.3125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":274.875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":275.9375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":276.375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":276.375,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":7},{"_time":279.1875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":279.1875,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":279.6875,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":3},{"_time":279.6875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":2},{"_time":280.25,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":4},{"_time":280.25,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":5},{"_time":283.375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":283.875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":284.375,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":284.375,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":284.375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":284.375,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":284.375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":284.375,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":287.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":287.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":288.3125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":288.3125,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":5},{"_time":289.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":289.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":290.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":290.8125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":291.3125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":291.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":292.3125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":293.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":293.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":294.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":294.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":295.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":295.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":296.25,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":296.25,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":296.25,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":296.25,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":296.25,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":296.25,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":297.375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":7},{"_time":297.875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":298.375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":298.8125,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":299.375,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":5},{"_time":299.875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":300.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":301.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":301.3125,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":301.375,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":302.375,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":302.4375,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":302.5,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":303.375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":303.4375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":303.5,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":303.5625,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":305.25,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":305.25,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":305.75,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":305.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":306.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":306.3125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":306.875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":306.875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":307.375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":307.375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":307.8125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":307.8125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":1},{"_time":307.875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":307.875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":308.4375,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":308.4375,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":308.4375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":308.4375,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":309.375,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":309.375,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":310.375,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":310.375,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":313.0625,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":313.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":313.1875,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":313.6875,"_lineIndex":3,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":313.75,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":313.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":314.25,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":314.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":7},{"_time":315.375,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":315.8125,"_lineIndex":3,"_lineLayer":1,"_type":0,"_cutDirection":3},{"_time":316.4375,"_lineIndex":2,"_lineLayer":1,"_type":0,"_cutDirection":6},{"_time":316.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":6},{"_time":317.375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":318.25,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":318.3125,"_lineIndex":2,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":319.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":319.375,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":319.4375,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":320.3125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":7},{"_time":320.3125,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":7},{"_time":320.8125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":321.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":321.875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":322.5,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":322.5,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":322.5625,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":322.5625,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":323.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":324.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":325.1875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":4},{"_time":325.1875,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":5},{"_time":326.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":326.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":327.6875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":327.6875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":328.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":328.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":328.3125,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":328.3125,"_lineIndex":2,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":328.375,"_lineIndex":2,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":328.375,"_lineIndex":1,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":329.4375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":329.875,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":330.375,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":330.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":331.375,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":331.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":332.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":332.3125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":333.375,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":333.375,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":334.625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":334.625,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":335.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":335.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":336.3125,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":336.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":336.3125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":336.3125,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":336.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":336.3125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":337.375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":337.875,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":338.375,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":338.8125,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":339.25,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":339.75,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":340.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":341.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":341.3125,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":341.375,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":342.25,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":342.3125,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":342.375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":3},{"_time":343.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":343.3125,"_lineIndex":1,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":343.375,"_lineIndex":0,"_lineLayer":0,"_type":1,"_cutDirection":2},{"_time":345.375,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":345.375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":345.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":345.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":346.375,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":346.375,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":346.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":346.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":347.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":347.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":347.75,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":347.75,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":348.3125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":348.3125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":349.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":349.3125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":1},{"_time":349.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":349.3125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":1},{"_time":350.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":350.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":350.375,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":350.375,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":0},{"_time":350.4375,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":350.4375,"_lineIndex":3,"_lineLayer":2,"_type":1,"_cutDirection":0},{"_time":353.1875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":353.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":354.25,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":354.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":355.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":355.75,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":2},{"_time":356.25,"_lineIndex":2,"_lineLayer":0,"_type":0,"_cutDirection":3},{"_time":357.1875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":358.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":358.3125,"_lineIndex":1,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":359.25,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":359.3125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":0},{"_time":359.375,"_lineIndex":0,"_lineLayer":2,"_type":0,"_cutDirection":0},{"_time":360.3125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":360.3125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":360.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":360.8125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":361.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":361.25,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":361.6875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":361.6875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":362.1875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":362.1875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":363.8125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":363.8125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":364.25,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":364.25,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":365.1875,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":2},{"_time":365.1875,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":3},{"_time":366.125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":366.125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":367.8125,"_lineIndex":0,"_lineLayer":1,"_type":0,"_cutDirection":4},{"_time":367.8125,"_lineIndex":3,"_lineLayer":1,"_type":1,"_cutDirection":5},{"_time":368.3125,"_lineIndex":3,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":368.3125,"_lineIndex":0,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":369.25,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":369.8125,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":370.3125,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":370.75,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1},{"_time":371.1875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":0},{"_time":371.625,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":0},{"_time":372.1875,"_lineIndex":1,"_lineLayer":0,"_type":0,"_cutDirection":1},{"_time":372.1875,"_lineIndex":2,"_lineLayer":0,"_type":1,"_cutDirection":1}],"_obstacles":[{"_time":114.5,"_lineIndex":0,"_type":1,"_duration":1,"_width":4},{"_time":115,"_lineIndex":3,"_type":0,"_duration":1,"_width":1},{"_time":115,"_lineIndex":0,"_type":0,"_duration":1,"_width":1},{"_time":116,"_lineIndex":3,"_type":0,"_duration":1,"_width":1},{"_time":116.0625,"_lineIndex":0,"_type":0,"_duration":1,"_width":1},{"_time":119.5,"_lineIndex":2,"_type":0,"_duration":1,"_width":2},{"_time":123.5,"_lineIndex":0,"_type":0,"_duration":1,"_width":2},{"_time":131.1875,"_lineIndex":2,"_type":0,"_duration":1,"_width":1},{"_time":131.1875,"_lineIndex":0,"_type":0,"_duration":1,"_width":1},{"_time":132.1875,"_lineIndex":0,"_type":0,"_duration":1,"_width":1},{"_time":132.3125,"_lineIndex":3,"_type":0,"_duration":1,"_width":1},{"_time":161.1875,"_lineIndex":2,"_type":0,"_duration":1,"_width":2},{"_time":162.6875,"_lineIndex":0,"_type":0,"_duration":1,"_width":2},{"_time":164.625,"_lineIndex":0,"_type":1,"_duration":1,"_width":4},{"_time":165.5625,"_lineIndex":0,"_type":1,"_duration":1,"_width":4},{"_time":184.8125,"_lineIndex":0,"_type":1,"_duration":1,"_width":4},{"_time":185.8125,"_lineIndex":0,"_type":1,"_duration":1,"_width":4},{"_time":186.8125,"_lineIndex":0,"_type":1,"_duration":1,"_width":4},{"_time":187.8125,"_lineIndex":0,"_type":1,"_duration":1,"_width":4},{"_time":194.125,"_lineIndex":2,"_type":0,"_duration":1,"_width":2},{"_time":196.0625,"_lineIndex":0,"_type":0,"_duration":1,"_width":2},{"_time":209.5625,"_lineIndex":2,"_type":0,"_duration":1,"_width":2},{"_time":213.6875,"_lineIndex":0,"_type":0,"_duration":1,"_width":2},{"_time":216.5,"_lineIndex":3,"_type":0,"_duration":1,"_width":1},{"_time":216.5625,"_lineIndex":0,"_type":0,"_duration":1,"_width":1},{"_time":227.1875,"_lineIndex":0,"_type":0,"_duration":1,"_width":2}]}

</textarea>
<br/>
<input type="checkbox" name="compress" class='compress' id=rowCheck value="row"> delete empty rows<br>

 <input type=button value='parse' onclick='intercept()'>


<input type='text' id='title' onchange='changeTitle(this.value)' placeholder="song name"></input> before printing page,you can add songName here so that it printout will be labeled. <br/>
<div  id=loader class=loader></div>
<div id='sheetmusic'></div>





</body>
</html>
