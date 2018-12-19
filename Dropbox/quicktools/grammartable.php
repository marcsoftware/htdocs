<!DOCTYPE html>
<html>
<title>make table</title>
<script>

	//args: x is a string of text
	// out put is placed in the element with id=output
	function clean(x) {
		x=x.trim();
		x=x.split('\n'); //delete the number on the very first line if there is one
	    
	    for(var i=1;i<x.length;i++){
	    	console.log(i);
	    	makeRow(x[0],x[i]); 	
	    }
	    
	    print();
	    alert('done');
		
	    
	}

	function makeRow(a,b){
		a=a.trim();
		b=b.trim();
		a=a.split('\t');
		b=b.split('\t');

        var max=a.length;
		for(var i=0;i<max;i++){
			console.log('row:'+i);
			context=a[i];
			que=a[i].split(/\s/)[1];
			que='___'+que;
			key='\['+b[i].trim()+'\]';
			fprint(context+'\n'+que+'\n'+key+'\n`\n');

		}

	}

	/*
	//-----------------------------------------------------------
	//
	//-----------------------------------------------------------
	*/
    var output='';
	function fprint(x){
		output+=x;
	}


	/*
	//-----------------------------------------------------------
	//
	//-----------------------------------------------------------
	*/
    
	function print(){
		document.getElementById('output').value=output;
	}

</script>
<style>
textarea{
	width:400px;
	height:400px;
}
</style>
<body>
	
INPUT:
<textarea id='input' onchange=clean(this.value)>
der Hund 	das Insekt 	die Katze 	die Hunde
ein 	ein 	eine 	(keine)
mein 	mein 	meine 	meine
dein 	dein 	deine 	deine
sein 	sein 	seine 	seine
ihr 	ihr 	ihre 	ihre
unser 	unser 	unsere 	unsere
euer 	euer 	eure 	eure
ihr 	ihr 	ihre 	ihre
</textarea>

<textarea id='output' ></textarea>





</body>
</html>
