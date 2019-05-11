<?php include '../header.php';?>
<?php 
    if(isset($_SESSION["customer_"])){
        echo $_SESSION["customer_name"];
    }

?>

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

        <input type='text' class='form' list="suggestions" id='name' value=''></input>name:<br/>
        <input type='text' class='form' id='total_cals' value='' ></input>total cals:<br/>
        <input type='text'  class='form' id='total_amount' list='suggestion_labels' value=''>total amount:</input><br/>
        <span id='more_labels'> </span><br/>
        <input type='text'  class='form' id='cal_per_serv' value=''></input>cal per serv:<br/>
        <input type='text' class='form' id='amount_per_serv' list='suggestion_labels' value=''></input>amount per serv:<br/>
        <input type='button' class='form' value='submit' id='submit' onclick='saveItem()'></input>

        <a href="pantry.php">pantry</a>

    </div>
  ⚡<span id='consumedCal'></span> consumed<br/>
    <br/>
    <input class='big' type=button value=⇦ onclick='changeDate(-1)'></input>
    <input class='big' type=button value='∘'  onclick='resetDate()'></input>
    <input class='big' type=button value=⇨  onclick='changeDate(1)'></input>

    <br/>
    <input value="name" ></input><input value="total cals" ></input><input value="total amount" ></input><input value="cals  serv" ></input><input value="amount  serv" ></input><input value="date" ></input>
	<div id="play">
	    <ul id="result" class="linked">
	        </ul>
	</div>
  
    <span id="burnedCal"></span> burned<br/>
    <span id='netCal'></span> remaining<br/>
    At this rate you will  <span id='rate'></span> pounds in 6 weeks.

</body>

</html> 