<?php session_start(); 
    if(isset($_SESSION["customer_name"])){
        echo $_SESSION["customer_name"];
    }

?>

<html>
    <title>diet-pantry</title>


    <meta charset="UTF-8"> 
    <style>


     
        input{
            height:25%;
             vertical-align: text-bottom;
            padding-top: 0px;
            margin-top: 0px;
        }



        input:focus {
           background-color: #ffff66;
        }
        
       
        

      
        textarea{
            width:50%;
            height:25%;
        }

       input[type=text]{
        height: auto;
       }

        a{
            width:100px;
            display: inline-block;
            
            
            

        }

    </style>






<script src="pantry.js"></script>




<body >
<br/>
<div>
    <p >output
 here</p>
<textarea id='inputUPC'></textarea>

 <input type='button' value='submit' id='submit' ></input>

 <div>
    <h6>missing info:</h6>
    <div id='missingData'></div>
</body>
<?php include '../header.php';?>
</html> 