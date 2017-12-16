<?php session_start(); 
    if($_SESSION["customer_name"]){
        echo $_SESSION["customer_name"] . "<br/>";
    }

?>

<?php include '../header.php';?>

<script src="../jquery-3.1.0.min.js"></script>

<script src="diet.js"></script>

<!DOCTYPE html>
 <!-- in this version the user clicks based on the commentary -->
<html>
    <title>diet2</title>


    <meta charset="UTF-8"> 
    <style>


       
        input{
         width: 10%;
         height: 15px;
         font-size: 12px;
         margin-right:1px;
        }
        
        #name{
            width: 50%;

        }
        #submit{
            height: 30px;
        }
        

        .big{

            height:20px;

        }

        div{
            background-color: gray;
        }
    </style>






<body onload='main();'>

    <div>

            
        <datalist id="suggestions">
          

        </datalist>

        name:<input type='text' onkeyup="getSuggestions()" list="suggestions" id='name'></input><br/>
        total cals:<input type='text' id='total_cals'></input><br/>
        total amount:<input type='text' id='total_amount' value=''></input><br/>
        cal per serv:<input type='text' id='cal_per_serv'></input><br/>
        amount per serv:<input type='text' id='amount_per_serv'></input><br/>
        <input type='button' value='submit' id='submit' onclick='saveItem()'></input>
    </div>

    <br/>
    <input class='big' type=button value=⇦ onclick='changeDate(-1)'></input>
    <input class='big' type=button value='∘'  onclick='resetDate()'></input>
    <input class='big' type=button value=⇨  onclick='changeDate(1)'></input>

    <br/>
    <input value="name" ></input><input value="total cals" ></input><input value="total amount" ></input><input value="cals  serv" ></input><input value="amount  serv" ></input><input value="date" ></input>

    <p id="result"></p>


    <span id="burnedCal"></span>-
    <span id='consumedCal'></span>=
    <span id='netCal'></span><br/>
    At this rate you will  <span id='rate'></span> pounds in 6 weeks.

</body>
</html> 