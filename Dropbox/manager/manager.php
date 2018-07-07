 <?php session_start(); 
    if(isset($_SESSION["customer_name"])){
        echo $_SESSION["customer_name"] . "<br/>";
    }else{
        echo '...<br/>';
    }
?>
 <!DOCTYPE html>
 <!-- in this version the user clicks based on the commentary -->
<html>
<title>manger</title>
<script src="../jquery-3.1.0.min.js"></script>
<?php include '../header.php';?>
<?php

    ?>
<meta charset="UTF-8"> 
<style>
 hr{
        width:100%;
        display: block;
    }

    div{
        
        margin-bottom: 10px;
        
        padding:2px;
        display: table;
        width: 100%;

    }
   
   input[type=button]{
    cursor: pointer;
    
   }
    

/*-------------------------------------*/
    .big {
        width: 98%;
        float: right;
        padding:0px;
        margin:0px;
        background: black;
        color:LightGreen  ;
        border: none;
        font-size: 12px;
        height:20px;
    }

    .notepad{
        width: 100%;
        float: right;
        padding:0px;
        margin:0px;
        border:none;
        padding-left: 40px;
        color:green;
        font-size: 8px;
        background-color: black;
    }

    .small {
        float:left;
        height:40px;
        padding: 1px;
        width: 2%;

    }

    
    .filter{
       
       
       width: 5%px;

    }


/* ------------------------------------*/
    
    #submit{
        height: 30px;
    }
    
 
    </style>


<script src="manager.js"></script>
<body onload='main();'>



project:<input type='text' id='project'></input><br/>
name:<input type='text' id='name' value=''></input><br/>
body:<textarea type='text'  id='body'></textarea><br/>
<input type='button' value='submit' id='submit' onclick='saveItem()'></input><br/><br/>
<hr/>
<input class='filter' type='button' id='startblue2'  value=''  onclick='setProject(this)'></input>
<p id='menu'></p>

<input class='filter' type='button' id='startblue'  value='active'  onclick='setFilter(this)'></input>
<input class='filter' type='button' value='completed' onclick='setFilter(this)'></input>
<input class='filter' type='button' value='both'  onclick='setFilter(this)'></input>
<span id='stats'></span><br/>
<p id='result'></p>




</body>
</html> 