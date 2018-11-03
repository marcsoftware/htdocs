<!DOCTYPE html>
<html>
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
	// out put is placed in the element with id=output
		var global_direction;
		var global_color;
	function clean(x) {
		x=x.replace(/,/g,',\n'); //delete the number on the very first line if there is one
		x=x.replace(/\[/g,',]\n');
		x=x.split(',');
		for(var i=0;i<x.length;i++){
			if(x[i].includes('_type') ||x[i].includes('_cutDirection') ||x[i].includes('_time')){
				x[i]=notation(x[i]);
			}else{
				x[i]='';
			}
		}
		

		 x = x.filter(function (el) {
  			return el != '';
		});

	
		
		x=x.join();
	    document.getElementById('output').value=x;
	}

/*
//--------------------
//
//--------------------
*/
function notation(x){
	var number = x.replace( /\D+/g, '');//delete all not digits. 

     var type= ['red','blue']; //0 is red. 1 in blue in beatsaber notatoins
	if(x.includes('_type')){
		setObject('color',type[number]);
		return type[number];
	}


// (0 is cut up, 1 is cut down, 2 is cut left, 3 is cut right, 4 is cut up left, 5 is cut up right, 6 is cut down left, 7 is cut down right, 8 is cut any //direction)
	var cutDirection= ['_up','_down','_left','_right','upleft','upright','downleft','downright','dot']; //0 is red. 1 in blue in beatsaber notatoins
	if(x.includes('cutDirection')){
		var raw= [number];
		setObject('direction',raw);
		return raw;
	}

	
	if(x.includes('_time')){
		if(number){
			return number;
		}else{
			return 'none';
		}
	}
	return 'wtf';
}

/*
//--------------------
//	set attributes that we need to draw
// and check when we get the attributes. 
//--------------------
*/
var global_arrow={};
function setObject(attr,value){
	console.log(attr);
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

function draw(color,direction){
	console.log(color);
	var arrow='';
    if(color==='red'){

       var red_arrows= ['↑','↓','←','→','↖','↗','↙','↘','●'];
       arrow= red_arrows[direction];
       
    }else{
    	 	 	 	
    	var blue_arrows= ['⇑','⇓','⇐','⇒','⇖','⇗','⇙','⇘','◍'];
    	arrow= blue_arrows[direction];
    }
	document.getElementById('sheetmusic').innerHTML+=arrow+'<br/>';

}
</script>
<style>
textarea{
	width:400px;
	height:400px;
}
</style>
<body>
	<a href='http://downsub.com/'>downsubs.com</a><br/>
INPUT:
<textarea id='input' onchange=clean(this.value)>
</textarea>

<textarea id='output' ></textarea>
<div id='sheetmusic'></div>





</body>
</html>
