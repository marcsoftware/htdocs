<?php  

if(!session_id()){
    // server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 36000000);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(36000000);
        session_start();
}

 ?> 
<style>
 .header{
            background-color:#e6e6e6;
           
            padding:5px;
            margin: 0px;
            font-size: 10px;

            position: fixed;
    		top: 0;
    right: 0;
        }


        p span{
            font-color:black;
        }


</style>
<script type='text/javascript'>

	var is_logged_in =  '<?php if(isset($_SESSION['customer_name'])){echo true; } ?>' ;
    var customer_name =  '<?php if(isset($_SESSION['customer_name'])){echo $_SESSION['customer_name']; } ?>' ;
	
    window.onload = main;

    function main(){


   
   		if(is_logged_in){
   			//if user is logged in draw the logout button
    		document.getElementById('log').innerHTML=`<a href='/Dropbox/login/logout.php'>logout</a>`;
            document.getElementById('username').innerHTML=customer_name;
    	}else{
    		//if user is not logged in draw the login button
    		document.getElementById('log').innerHTML=`<a href='/Dropbox/login/login.php'>login</a>`;
    		document.getElementById('log').innerHTML+=`<a href='/Dropbox/login/register.php'>register</a>`;

            
    	}

        //init();
    }


	</script>


<html>

    <p class='header'>
        <a href='/'>HOME</a>
        <span id='log'></span>       
        <span id='username'></span>   
    </p><br/>
<html>