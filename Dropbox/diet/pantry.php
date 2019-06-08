

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
            width: 14%;

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

        
       .title{
        text-decoration:underline;
        display: inline-block;
         width: 14.5%;
         
         font-size: 24px;
         margin-right:1px;
         padding-left: 5px;
        
         border-color: red;
         margin-bottom: 0px;  
         padding:0px;
         text-align: center;

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
<a href='getAllTodayPantry.php'>today</a>
<form method="POST" action="saveUPC.php" id="aform">
    <textarea name='records' id='inputUPC'></textarea>

     <input type="submit" value="Submit">
</form>
<div class="loader" id='loader'></div> 

<div>
<h6>Todays Items:</h6>
<span  class='title padding' value="name" >name</span>
    <span class='title'  value="total cals" >total cals</span>

    <span  class='title' value="amount  serv" > calories per container</span>
    
<div id='missingData'></div>
</body>
<?php include '../header.php';?>
total calories scanned:<span id='global_total_calories'></span>
<script src="pantry.js"></script>
</html> 