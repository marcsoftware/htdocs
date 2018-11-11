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
		
		for(var i=0;i<x.length;i++){
			if(x[i].includes('_type') ){
				//get infomation
				var raw = getInfo(x[i]); //extract info from the json
				save(raw); //save it for easier access.
				
				
			}else{
				
			}
		}
		   

	   for( i =0;i<time_cheat.length;i++){
	   		draw(time_boards[time_cheat[i]],time_cheat[i]);
	   		
	   		
	   }
		toggleLoader(); //turn off the loading  animation
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
    	return 'X';
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
	document.getElementById('songtitle').innerHTML=title;
}

/*
//--------------------------------------------------------------------
// 
//--------------------------------------------------------------------
*/
function changeCol(col_number){
	document.getElementById('sheetmusic').style.columnCount=col_number;
}

/*
//--------------------------------------------------------------------
// 
//--------------------------------------------------------------------
*/
function changeFontSize(size){

	if(size.match(/(px|\%)/g)==null){
		label='px';

	}
	document.getElementById('sheetmusic').style.fontSize=size+label;
}

/*
//----------------------------------------------------------------------------------------------------
//
//----------------------------------------------------------------------------------------------------
*/
function markRed(){
	document.getElementById('input').style.backgroundColor='#fff099';
}



/*
//----------------------------------------------------------------------------------------------------
//
//----------------------------------------------------------------------------------------------------
*/
function toggleLoader() {
    var x = document.getElementById("loader");
    
    if (x.style.display === "none" || x.style.display === "") {
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
 	document.getElementById('input').style.backgroundColor='white';
    toggleLoader();


    setTimeout(function() {
// some length calculations
clean();
}, 300);

    
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
	height: 20px;
	width: 20px;
	text-align: center;
	vertical-align:center;
}

body{
	
font-size:12px;
}

.time{
	font-size:4px;
	padding:0px;
	margin:0px;
}
hr{
	margin:0;
	padding:0;
}
#sheetmusic{
	
	font-family: monospace; 
	font-size:10px;
	
	column-count: 3;
}

span{
	margin:0px;}

table{
	margin:0px;
}
hr{
	margin:0px;
}

br{
	margin:0px;
	padding:0px;
	height:0px;
}
</style>
<body>

INPUT:
<textarea id='input' onkeydown='markRed()'>
</textarea>
<br/>
<input type="checkbox" name="compress" class='compress' checked id=rowCheck value="row"> delete empty rows(saves paper)<br>

 <input type=button value='make beatsaber notation' onclick='intercept()'><br/>


<input type='text'  onkeyup='changeTitle(this.value)' placeholder="song name"></input> before printing page,you can add songName here so that it printout will be labeled. <br/>
<input type='text'   onkeyup='changeCol(this.value)' placeholder="number of columns"></input> number of columns. <br/>
<input type='text'   onkeyup='changeFontSize(this.value)' placeholder="font-size"></input>font-size. <br/>
<div  id=loader class=loader></div>
<div id='barValue'></div>
<div id='songtitle'></div>
<div id='sheetmusic'></div>





</body>
</html>
