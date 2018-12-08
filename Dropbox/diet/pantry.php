

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

        input[type=button]{
            height:25%;
            vertical-align: text-bottom;
            padding-top: 0px;
            margin-top: 0px;



        }

        a{
            cursor:pointer;
            display: inline-block;
            
            
            

        }

        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
             display: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>











<body >
<br/>
<div>
   
 <a href='allpantry.php'>all pantry</a>
<textarea id='inputUPC'></textarea>

 <input type='button' value='submit' id='submit' onclick='saveUPC()' ></input>
  <div class="loader" id='loader'></div> 

 <div>
    <h6>missing info:</h6>
    <div id='missingData'></div>
</body>
<?php include '../header.php';?>
<script src="pantry.js"></script>
</html> 