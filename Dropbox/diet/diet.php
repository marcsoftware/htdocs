<?php session_start(); 
    if(isset($_SESSION["customer_name"])){
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

       #burnedCal{
            font-size: 20px;
        } 

        #netCal{
            font-size: 20px;
        }
        input{
         width: 15%;
         height: 40px;
         font-size: 24px;
         margin-right:1px;
         padding-left: 2px;
        }

        input:focus {
           background-color: #ffff66;
        }
        
        #name{
            width: 50%;

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

        div{
            background-color: gray;
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
        	margin.left:0px;
        	padding-left: 0px;
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
    <div>

            
        <datalist id="suggestions">
          <option value="1">

        </datalist>

        <datalist id="suggestion_labels">
           <option value="1">

        </datalist>

        name:<input type='text' list="suggestions" id='name' value='coke'></input><br/>
        total cals:<input type='text' id='total_cals' value='' ></input><br/>
        total amount:<input type='text' id='total_amount' list='suggestion_labels' value='1 liter'></input><span id='more_labels'></span><br/>
        cal per serv:<input type='text' id='cal_per_serv' value='140'></input><br/>
        amount per serv:<input type='text' id='amount_per_serv' list='suggestion_labels' value='12oz'></input><br/>
        <input type='button' value='submit' id='submit' onclick='saveItem()'></input>

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
<?php include '../header.php';?>
</html> 