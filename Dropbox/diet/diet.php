<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    if(isset($_SESSION["customer_name"])){
        echo $_SESSION["customer_name"];
    }else{
        $_SESSION["customer_name"]="bob";
        echo $_SESSION["customer_name"];

    }

?>
<?php include '../header.php';?>


<html>
    <title>diet2</title>


    <meta charset="UTF-8"> 
    <style>


       #consumedCal{
            color:red;
            font-size: 20px;
       }

      
        .form{
         width: 70%;
         height: 40px;
         font-size: 24px;
         margin-right:1px;
         padding-left: 5px;
         margin-bottom:4px;

        }

        input{
        	 width: 15%;
         height: 40px;
         font-size: 24px;
         margin-right:1px;
         padding-left: 5px;
         margin-bottom:4px;
        }

        .recalc{
            width: 100px;
            height: 15px;
            font-size:9px;
            margin-right:1px;
            padding-left: 2px;
            display: none;
        }

        input:focus {
           background-color: #ffff66;
        }
        
       
        #submit{
            height: 60px;
        }
        

        .big{

            height:40px;

        }

        .label{
            
            background: linear-gradient(to bottom right, #826FD6, #412AA4);
            border-radius: 15px;
            color: white;
            margin-top:5px;
            width:25%;
            font-size: 20px;
        }
        span{
            cursor:default;
        }

        #form{
            background-color: #e6e6ff;
            margin:auto;
            width:40%;
            padding:10px;
           border: 1px solid blue;
        }

        #play{
        	background-color:white; 
        	margin-top:0px;
        	padding-top: 0px;
        }

        ul{
        	list-style-type: none;
        	margin.left:0px;
        	padding-left: 0px;
        }

        li{
        	margin.left:100px;
        	padding-left: 100px;
            border-radius: 25px;
            cursor: grab;
        }

        ul li:before {
         
         color:black;
         font-size: 30px;
         
         
         }

         #day_menu{
         	margin:auto;
         	display:block;
         	width:20%;
         	margin-bottom: 0px;
         	
         }


        .day_button{
        	 width: 32%;
         height: 40px;
         font-size: 24px;
         margin-right:1px;
         padding-left: 5px;
         margin-bottom:4px;
        }

       .title{
       	text-decoration:underline;
       	display: inline-block;
         width: 14%;
         
         font-size: 24px;
         margin-right:1px;
         padding-left: 5px;
        
         border-color: red;
         margin-bottom: 0px;  
         padding:0px;
         text-align: center;

       }

       .padding{
       	margin-left: 110px;
       }

       #more_labels{
  			vertical-align: top;
  
		}

        .tutorial{
             font-style: italic;
             border-right-color: red;
             
             border-right-style: dotted;
             text-align: right;
             margin-top: 10px;
        }
    </style>




<script src="../jquery-3.1.0.min.js"></script>
<script src="../yui-min.js"></script>



<script src="diet.js"></script>
<script src="sortable.js"></script>
<body >

<span id='debug'></span>
    <div id='form' >

            
        <datalist id="suggestions">
          <option value="1">

        </datalist>

        <datalist id="suggestion_labels">
           <option value="1">

        </datalist>

        
        

        

       
<table>
  <tr> <td></td>
    <td><input type='text' class='form' list="suggestions" id='name' value='marcmelcher'></input>name:<br/>
<input type='text'  class='form' id='total_amount' list='suggestion_labels' value='1cup'>total amount:</input><br/>
    </td>
   
    
  </tr>
  <tr> <td class='tutorial'>the total-calories will<br/> automatically be calculated.</td>
    <td><input type='text' class='form' id='total_cals' value='100' ></input>total cals:<br/>
        
        <span id='more_labels'> </span><br/></td>
   
    
  </tr>
  <tr>
      <td class='tutorial'>enter any ratio.<br/>example: 12oz is 140calories</td>
    <td>
        <input type='text'  class='form' id='cal_per_serv' value=''></input>cal per serv:<br/>
        <input type='text' class='form' id='amount_per_serv' list='suggestion_labels' value=''></input>amount per serv:<br/></td>
  
   
  </tr>
 
 
</table>
<input type='button' class='form' value='submit' id='submit' onclick='saveItem()'></input> <a href="pantry.php">pantry</a>
    </div>
  ⚡<span id='consumedCal'></span> consumed<br/>
    <br/>
    <span id='day_menu'>
	    <input class='day_button' type=button value=⇦ onclick='changeDate(-1)'></input>
	    <input class='day_button' type=button value='∘'  onclick='resetDate()'></input>
	    <input class='day_button' type=button value=⇨  onclick='changeDate(1)'></input>
   </span>
    <br/>
    <span  class='title padding' value="name" >name</span>
    <span class='title'  value="total cals" >total cals</span>
    <span  class='title' value="total amount" >total amout</span>
    <span  class='title' value="cals  serv" >cals serv</span>
    <span  class='title' value="amount  serv" >amount serv</span>
    <span  class='title' value="date" >date</span>
	<div id="play">
	    <ul id="result" class="linked">
	        </ul>
	</div>
  
    <span id="burnedCal"></span> burned<br/>
    <span id='netCal'></span> remaining<br/>
    At this rate you will  <span id='rate'></span> pounds in 6 weeks.

</body>

</html> 