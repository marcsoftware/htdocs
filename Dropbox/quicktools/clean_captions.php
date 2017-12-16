<!DOCTYPE html>
<html>
<script>

	//args: x is a string of text
	// out put is placed in the element with id=output
	function clean(x) {
		x=x.replace(/^\d\b/g,''); //delete the number on the very first line if there is one
	    x=x.replace(/[\n]\d+\n/g,''); // delete all other line numbers 
	    x=x.replace(/\d\d\:\d\d\:\d+,\d+\ --> \d\d\:\d\d\:\d+,\d+\n/g,''); // delte the timeindexes
	    


	    document.getElementById('output').value=x;
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





</body>
</html>
