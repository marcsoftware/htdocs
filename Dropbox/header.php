<?php  session_start();
 ?> 
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
    		document.getElementById('log').innerHTML=`<a href='/Dropbox/login/logout.php'>logout</a><br/>`;
            document.getElementById('username').innerHTML=customer_name;
    	}else{
    		//if user is not logged in draw the login button
    		document.getElementById('log').innerHTML=`<a href='/Dropbox/login/login.php'>login</a><br/>`;
    		document.getElementById('log').innerHTML+=`<a href='/Dropbox/login/register.php'>register</a><br/>`;

            
    	}

        //init();
    }


	</script>


<html>

    <p class='header'>
        <a href='/'>HOME</a><br/>
        <span id='log'></span>       
        <span id='username'></span>   
    </p><br/>
<html>