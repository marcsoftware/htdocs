<style>
 .header{
            background-color:#e6e6e6;
            display:inline-block;
            padding:5px;
            margin: 0px;
            font-size: 10px;

            position: fixed;
    		top: 0;
    right: 0;
        }


</style>
<script type='text/javascript'>

	var customer_name =  '<?php if(isset($_SESSION["customer_name"] )){echo true; } ?>' ;
	
    window.onload = main;

    function main(){


   
   		if(customer_name){
   			//if user is logged in draw the logout button
    		document.getElementById('log').innerHTML=`<a href='/Dropbox/login/logout.php'>logout</a><br/>`;
    	}else{
    		//if user is not logged in draw the login button
    		document.getElementById('log').innerHTML=`<a href='/Dropbox/login/login.php'>login</a><br/>`;
    		document.getElementById('log').innerHTML+=`<a href='/Dropbox/login/register.php'>register</a><br/>`;

            
    	}

        //init();
    }

document.title='🌌 '+document.title;
	</script>


<html>

    <p class='header'>
        <a href='/'>HOME</a><br/>
        <span id='log'></span>       
    </p><br/>
<html>