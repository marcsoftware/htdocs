 <?php session_start(); 
    if(isset($_SESSION["customer_name"])){
        echo $_SESSION["customer_name"] ;
    }else{
        echo '';
    }
?>
 <!DOCTYPE html>
 <!-- in this version the user clicks based on the commentary -->
<html>
<title>TODO LIST</title>
<script src="../jquery-3.1.0.min.js"></script>
<?php include '../header.php';?>
<?php

    ?>
<meta charset="UTF-8"> 
<style>



body{
      background-color:  #003d99 ;
      color:gold;
      font-size: 1px;
}
    div{
     

    }
   
   .filter{
     font-size:20px;


   }



.title{
	font-size: 20px;
	height:auto;
	width: 100%;
	margin:1px;
}

  #menu{
  	float:left;
  	margin-right: 5px;
	
  }

  #result{
  	float:left;
  	width:80%;
  }

    .big{
        
        font-size: 30px;
        color:green;
        background-color: black;
        border:none;

        overflow:hidden;

        
        display: block;
        resize: vertical;
        
        padding-left: 2px;
        
        height: 40px;
        width: 100%;
        margin-left:auto;
        margin-right:auto;
         
    }


    .projectName{
       margin-top: 10px;
        font-size: 20px;
        color:white;
        background-color: darkgreen;
        border:none;
        text-align: center;
        overflow:hidden;
          border-radius: 25px;
    
    
      
    
        
        display: block;
        resize: vertical;
        
        padding-left: 2px;
        
        
        width: 50%;
        margin-left:auto;
        margin-right:auto;
         
    }

    hr{
        width:100%;
    }
    
    #submit{
        height: 25px;
    }
    
    

    input{
        display: block;
        
        
        font-size: 15px;
        margin-right:1px;

        border:none;
        
        

        background-color:   #080808;
        color:#034F84;
        margin-bottom:0px;


    }

    input[type=text]{
        
    }
    </style>


<script src="todo.js"></script>
<body onload='main();'>



<input type='button' value='ADD NEW' id='submit' onclick='saveItem("add...","add...")'></input>

<input class='filter' type='button' id='startblue2'  value=''  onclick='setProject(this)'></input>
<div id='menu'></div>

<span id='stats'></span>
<div id='result'></div>


<input class='filter' type='button' id='startblue'  value='active'  onclick='setFilter(this)'></input>
<input class='filter' type='button' value='completed' onclick='setFilter(this)'></input>
<input class='filter' type='button' value='both'  onclick='setFilter(this)'></input>


</body>
</html> 