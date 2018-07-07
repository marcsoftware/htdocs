<!DOCTYPE html>
<html>
<script>

	//args: x is a string of text
	// out put is placed in the element with id=output
	function clean(x) {
		

		x=x.replace(/([0-9]+)\./g,'\n\t\t$1\t');
		x=x.replace(/Exercise ([0-9]+)/g,'\n$1');


	    document.getElementById('output').value=x;
	}

</script>
<style>
textarea{
	width:50%;
	
}
</style>
<body>
	
INPUT:
<textarea id='input' onchange=clean(this.value)>
	Exercise 1
1. der 2. der 3. die 4. das 5. die 6. das 7. die 8. das 9. die 10. das 11. das 12. die 13. die 14. der 15. die 16. die
17. das 18. die 19. der 20. das 21. die 22. das 23. der 24. der 25. der
Exercise 2
These are sample answers. 1. Verständnis 2. Gesundheit 3. Gesicht 4. Bitte 5. Museum 6. Kellner 7. Mantel
8. Einsamkeit 9. Frühling 10. der König 11. Eigentum 12. Schauspielerin 13. Laden 14. Büchlein 15. Situation
</textarea>

<textarea id='output' >

</textarea>





</body>
</html>
