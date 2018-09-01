<?php

//include 'diet.php';

?>
<script src="../jquery-3.1.0.min.js"></script>
<script src="diet.js"></script>
<script>

function print(msg){
	document.getElementById('message').innerHTML+=msg+'<br/>';
}



function testing(){
	print('marc');

	// test 1 reeses 1giant & reeses 1xl
	var name = 'reeses'; 
	var total_cals ='' ;
	var total_amount = '1giant'; 
	var cal_per_serv = '';
	var  amount_per_serv ='' ;
	                

	var item = {
		'name':name,
		'total_cals':total_cals,
		'total_amount':total_amount,
		'cal_per_serv':cal_per_serv,
		'amount_per_serv':amount_per_serv
	};
	   
	print(JSON.stringify(item));
	addNew(item);
	print(JSON.stringify(item));

	if(item.total_cals=='1000'){
		print('✔️ 1giant is 1000calories');

	}else{
		print('❌️ 1giant is 1000calories');
	}

   // test reeses xl
	var name = 'reeses'; 
	var total_cals ='' ;
	var total_amount = '1xl'; 
	var cal_per_serv = '';
	var  amount_per_serv ='' ;
	                

	var item = {
		'name':name,
		'total_cals':total_cals,
		'total_amount':total_amount,
		'cal_per_serv':cal_per_serv,
		'amount_per_serv':amount_per_serv
	};
	   
	print(JSON.stringify(item));
	addNew(item);
	print(JSON.stringify(item));

	if(item.total_cals=='600'){
		print('✔️ 1xl is 600 cals');

	}else{
		print('❌️ 1xl is 600cals');
	}



}
	 /**
        //---------------------------------------------------------------------
        // delete all records from today that match the username
        //---------------------------------------------------------------------
        */
        // function gets all the stats for the item_name and puts them in the form.
    
        function deleteToday(){
               var xmlhttp;

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

                        var result = xmlhttp.responseText;
                        
                   
                        
                    }
                };

               
               
               
               
       
                
                xmlhttp.open("GET","/Dropbox/diet/deleteBeforeAutotest.php?",
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   
        }




</script>
<title>testing diet</title>
<style type="text/css">
	
	#hide{
		display:none;
	}
</style>
<html>
<body onload='testing()'>
<p id='message'></p>
<div id='hide'>
	<p id='result'></p>
	<p id='name'></p>
	<p id='burnedCal'></p>
	<p id='consumedCal'></p>
	<p id='netCal'></p>
	<p id='rate'></p>
	<p id='suggestions'></p>
	<p id='more_labels'></p>
	<p id='suggestion_label'></p>
</div>
</body>
</html>