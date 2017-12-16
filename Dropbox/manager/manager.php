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

    div{
        

    }
   
   .filter{
    display: inline;

   }


    input{
        display: block;
     width: 10%;
     height: 18px;
     font-size: 12px;
     margin-right:1px;
    }

    .big{
        width:100%;
    }

    hr{
        width:100%;
    }
    
    #submit{
        height: 30px;
    }
    
    textarea{
    
        font-size: 12px;
        color:green;
        background-color: black;

        overflow:hidden;

        display: inline-block;
        right: 0px;


        width: 100%;
        display: block;
        resize: vertical;
    }
    </style>


<script src="manager.js"></script>
<body onload='main();'>



project:<input type='text' id='project'></input>
name:<input type='text' id='name' value=''></input>
body:<textarea type='text'  id='body'></textarea><br/>
<input type='button' value='submit' id='submit' onclick='saveItem()'></input><br/>

<input class='filter' type='button' id='startblue2'  value=''  onclick='setProject(this)'></input>
<div id='menu'></div>

<input class='filter' type='button' id='startblue'  value='active'  onclick='setFilter(this)'></input>
<input class='filter' type='button' value='completed' onclick='setFilter(this)'></input>
<input class='filter' type='button' value='both'  onclick='setFilter(this)'></input><br/>
<span id='stats'></span>
<div id='result'></div>




</body>
</html> 